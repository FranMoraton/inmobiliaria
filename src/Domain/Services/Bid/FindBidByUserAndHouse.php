<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 18/05/2018
 * Time: 9:26
 */

namespace App\Domain\Services\Bid;

use App\Domain\Model\Entity\Bid\Bid;
use App\Domain\Model\Entity\Bid\BidDoNotExist;
use App\Domain\Model\Entity\Bid\BidRepo;
use App\Domain\Model\Entity\House\House;
use App\Domain\Model\Entity\User\User;
use App\Domain\Services\Util\ExceptionObserver\ListException;
use App\Domain\Services\Util\ExceptionObserver\Observer;

class FindBidByUserAndHouse implements Observer
{
    private $bidRepository;
    private $stateException;

    /**
     * CheckIfBidAlreadyExist constructor.
     * @param BidRepo $bidRepository
     */
    public function __construct(BidRepo $bidRepository)
    {
        $this->bidRepository = $bidRepository;
        $this->stateException = false;
    }


    public function __invoke(User $user, House $house): ?Bid
    {
        $bid = $this->bidRepository->findByUserAndHouse($user, $house);

        if (null === $bid) {
            $this->stateException = true;
            ListException::instance()->notify();
        }

        return $bid;
    }

    /**
     * @throws BidDoNotExist
     */
    public function update()
    {
        if ($this->stateException) {
            throw new BidDoNotExist();
        }
    }
}

