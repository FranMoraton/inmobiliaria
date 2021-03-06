<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 17/05/2018
 * Time: 22:45
 */

namespace App\Application\Bid\CreateBid;

use App\Domain\Model\Entity\Bid\Bid;
use App\Domain\Model\Entity\Bid\BidRepo;
use App\Domain\Model\HttpResponses\HttpResponses;
use App\Domain\Services\Bid\CheckIfBidAlreadyExist;
use App\Domain\Services\Bid\CheckMoneyBiddedOverMin;
use App\Domain\Services\House\FindHouseById;
use App\Domain\Services\User\FindUserByDni;
use App\Domain\Services\Util\ExceptionObserver\ListException;

class CreateBid
{
    private $findUserByDni;
    private $findHouseById;
    private $checkIfBidAlreadyExist;
    private $checkMoneyBiddedOverMin;
    private $dataTransform;
    private $bidRepository;

    /**
     * CreateBid constructor.
     * @param FindUserByDni $findUserByDni
     * @param FindHouseById $findHouseById
     * @param CheckIfBidAlreadyExist $checkIfBidAlreadyExist
     * @param CheckMoneyBiddedOverMin $checkMoneyBiddedOverMin
     * @param CreateBidTransformInterface $dataTransform
     * @param BidRepo $bidRepository
     */
    public function __construct(
        FindUserByDni $findUserByDni,
        FindHouseById $findHouseById,
        CheckIfBidAlreadyExist $checkIfBidAlreadyExist,
        CheckMoneyBiddedOverMin $checkMoneyBiddedOverMin,
        CreateBidTransformInterface $dataTransform,
        BidRepo $bidRepository
    ) {
        $this->findUserByDni = $findUserByDni;
        $this->findHouseById = $findHouseById;
        $this->checkIfBidAlreadyExist = $checkIfBidAlreadyExist;
        $this->checkMoneyBiddedOverMin = $checkMoneyBiddedOverMin;
        $this->dataTransform = $dataTransform;
        $this->bidRepository = $bidRepository;
        ListException::instance()->restartExceptions();
        ListException::instance()->attach($findUserByDni);
        ListException::instance()->attach($findHouseById);
        ListException::instance()->attach($checkIfBidAlreadyExist);
        ListException::instance()->attach($checkMoneyBiddedOverMin);
    }


    public function handle(CreateBidCommand $createBidCommand)
    {
        $user  = $this->findUserByDni->__invoke($createBidCommand->getDni());
        $house = $this->findHouseById->__invoke($createBidCommand->getHouseId());

        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }

        $this->checkMoneyBiddedOverMin->__invoke($createBidCommand->getMoney(), $house->getSellingPrize());

        $this->checkIfBidAlreadyExist->__invoke($user, $house);

        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }


        $newBid = Bid::createdByApi($house, $user, $createBidCommand->getMoney());
        ;
        $this->bidRepository->persistAndFlush($newBid);

        return[
          "data" => $this->dataTransform->transform($newBid),
          "code" => HttpResponses::OK
        ];
    }
}
