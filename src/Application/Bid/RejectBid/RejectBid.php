<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 19:52
 */

namespace App\Application\Bid\RejectBid;

use App\Domain\Model\Entity\Bid\BidRepo;
use App\Domain\Model\HttpResponses\HttpResponses;
use App\Domain\Services\Bid\FindBidById;
use App\Domain\Services\House\FindHouseById;
use App\Domain\Services\User\CheckUsersAreEquals;
use App\Domain\Services\User\FindUserByDni;
use App\Domain\Services\Util\ExceptionObserver\ListException;

class RejectBid
{
    private $bidRepository;
    private $findUserByDni;
    private $findBidById;
    private $checkUserAreEquals;
    private $dataTransform;
    private $findHouseById;

    /**
     * RejectBid constructor.
     * @param BidRepo $bidRepository
     * @param FindUserByDni $findUserByDni
     * @param FindBidById $findBidById
     * @param FindHouseById $findHouseById
     * @param CheckUsersAreEquals $checkUserAreEquals
     * @param RejectBidTransformInterface $dataTransform
     */
    public function __construct(
        BidRepo $bidRepository,
        FindUserByDni $findUserByDni,
        FindBidById $findBidById,
        FindHouseById $findHouseById,
        CheckUsersAreEquals $checkUserAreEquals,
        RejectBidTransformInterface $dataTransform
    ) {
        $this->bidRepository = $bidRepository;
        $this->findUserByDni = $findUserByDni;
        $this->findBidById = $findBidById;
        $this->checkUserAreEquals = $checkUserAreEquals;
        $this->dataTransform = $dataTransform;
        $this->findHouseById = $findHouseById;
        ListException::instance()->restartExceptions();
        ListException::instance()->attach($findHouseById);
        ListException::instance()->attach($checkUserAreEquals);
        ListException::instance()->attach($findBidById);
        ListException::instance()->attach($findUserByDni);
    }


    public function handle(RejectBidCommand $rejectBidCommand)
    {

        $userRequesting = $this->findUserByDni->__invoke($rejectBidCommand->getDniUser());

        $bid = $this->findBidById->__invoke($rejectBidCommand->getBidId());

        $house = $this->findHouseById->__invoke($rejectBidCommand->getHouseId());

        $this->checkUserAreEquals->__invoke($userRequesting, $house->getHouseOwner());

        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }

        $bid->setAccepted(false);
        $bid->setRejected(true);

        $this->bidRepository->persistAndFlush($bid);

        return [
            "data" => $this->dataTransform->transform($bid),
            "code" => HttpResponses::OK
        ];
    }
}
