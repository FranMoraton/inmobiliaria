<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 19:49
 */

namespace App\Application\Bid\AcceptBid;

use App\Domain\Model\Entity\Bid\BidRepo;
use App\Domain\Services\Bid\FindBidById;
use App\Domain\Services\House\FindHouseById;
use App\Domain\Services\User\CheckUsersAreEquals;
use App\Domain\Services\User\FindUserByDni;

class AcceptBid
{
    private $bidRepository;
    private $findUserByDni;
    private $findBidById;
    private $checkUserAreEquals;
    private $dataTransform;
    private $findHouseById;


    public function __construct(
        BidRepo $bidRepository,
        FindUserByDni $findUserByDni,
        FindBidById $findBidById,
        FindHouseById $findHouseById,
        CheckUsersAreEquals $checkUserAreEquals,
        AcceptBidTransformInterface $dataTransform
    ) {
        $this->bidRepository = $bidRepository;
        $this->findUserByDni = $findUserByDni;
        $this->findBidById = $findBidById;
        $this->checkUserAreEquals = $checkUserAreEquals;
        $this->dataTransform = $dataTransform;
        $this->findHouseById = $findHouseById;
    }


    /**
     * @param AcceptBidCommand $acceptBidCommand
     * @return array
     * @throws \App\Domain\Model\Entity\Bid\BidDoNotExist
     * @throws \App\Domain\Model\Entity\House\HouseDoNotExist
     * @throws \App\Domain\Model\Entity\User\UserNotFound
     * @throws \App\Domain\Model\Entity\User\UsersDoNotMatches
     */
    public function handle(AcceptBidCommand $acceptBidCommand)
    {
        $userRequesting = $this->findUserByDni->__invoke($acceptBidCommand->getDniUser());

        $bid = $this->findBidById->__invoke($acceptBidCommand->getBidId());

        $house = $this->findHouseById->__invoke($acceptBidCommand->getHouseId());

        $this->checkUserAreEquals->__invoke($userRequesting, $house->getHouseOwner());

        $bid->setAccepted(true);
        $bid->setRejected(false);

        $this->bidRepository->persistAndFlush($bid);

        return $this->dataTransform->transform($bid);
    }
}
