<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 18/05/2018
 * Time: 10:17
 */

namespace App\Application\Bid\ModifyBid;

use App\Domain\Model\Entity\Bid\BidRepo;
use App\Domain\Model\HttpResponses\HttpResponses;
use App\Domain\Services\Bid\CheckMoneyBiddedOverMin;
use App\Domain\Services\Bid\FindBidByUserAndHouse;
use App\Domain\Services\House\FindHouseById;
use App\Domain\Services\User\FindUserByDni;
use App\Domain\Services\Util\ExceptionObserver\ListException;

class ModifyBid
{

    private $findUserByDni;
    private $findHouseById;
    private $findBidByUserAndHouse;
    private $checkMoneyBiddedOverMin;
    private $dataTransform;
    private $bidRepository;


    public function __construct(
        FindUserByDni $findUserByDni,
        FindHouseById $findHouseById,
        FindBidByUserAndHouse $findBidByUserAndHouse,
        CheckMoneyBiddedOverMin $checkMoneyBiddedOverMin,
        ModifyBidTransformInterface $dataTransform,
        BidRepo $bidRepository
    ) {
        $this->findUserByDni = $findUserByDni;
        $this->findHouseById = $findHouseById;
        $this->findBidByUserAndHouse = $findBidByUserAndHouse;
        $this->checkMoneyBiddedOverMin = $checkMoneyBiddedOverMin;
        $this->dataTransform = $dataTransform;
        $this->bidRepository = $bidRepository;
        ListException::instance()->restartExceptions();
        ListException::instance()->attach($findUserByDni);
        ListException::instance()->attach($findHouseById);
        ListException::instance()->attach($findBidByUserAndHouse);
        ListException::instance()->attach($checkMoneyBiddedOverMin);
    }


    public function handle(ModifyBidCommand $modifyBidCommand)
    {
        $user  = $this->findUserByDni->__invoke($modifyBidCommand->getDni());
        $house = $this->findHouseById->__invoke($modifyBidCommand->getHouseId());

        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }

        $this->checkMoneyBiddedOverMin->__invoke($modifyBidCommand->getMoney(), $house->getSellingPrize());

        $bid = $this->findBidByUserAndHouse->__invoke($user, $house);

        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }


        $bid->setMoneyBidded($modifyBidCommand->getMoney());

        $this->bidRepository->persistAndFlush($bid);

        return[
            "data" => $this->dataTransform->transform($bid),
            "code" => HttpResponses::OK
        ];
    }
}
