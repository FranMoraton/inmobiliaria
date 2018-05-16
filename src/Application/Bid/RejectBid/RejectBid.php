<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 19:52
 */

namespace App\Application\Bid\RejectBid;

use App\Domain\Model\Entity\Bid\BidRepo;
use App\Domain\Services\Bid\FindBidById;
use App\Domain\Services\House\FindHouseById;
use App\Domain\Services\User\CheckUsersAreEquals;
use App\Domain\Services\User\FindUserByDni;

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
    }

    /**
     * @param RejectBidCommand $rejectBidCommand
     * @return array
     * @throws \App\Domain\Model\Entity\Bid\BidDoNotExist
     * @throws \App\Domain\Model\Entity\House\HouseDoNotExist
     * @throws \App\Domain\Model\Entity\User\UserNotFound
     * @throws \App\Domain\Model\Entity\User\UsersDoNotMatches
     */
    public function handle(RejectBidCommand $rejectBidCommand)
    {

        $userRequesting = $this->findUserByDni->__invoke($rejectBidCommand->getDniUser());

        $bid = $this->findBidById->__invoke($rejectBidCommand->getBidId());

        $house = $this->findHouseById->__invoke($rejectBidCommand->getHouseId());

        $this->checkUserAreEquals->__invoke($userRequesting, $house->getHouseOwner());

        $bid->setAccepted(false);
        $bid->setRejected(true);

        $this->bidRepository->persistAndFlush($bid);

        return $this->dataTransform->transform($bid);
    }
}
