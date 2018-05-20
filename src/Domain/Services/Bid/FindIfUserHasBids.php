<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 18:04
 */

namespace App\Domain\Services\Bid;

use App\Domain\Model\Entity\Bid\BidRepo;
use App\Domain\Model\Entity\Bid\UserHasNotBids;
use App\Domain\Model\Entity\User\User;
use App\Domain\Services\Util\ExceptionObserver\ListException;
use App\Domain\Services\Util\ExceptionObserver\Observer;

class FindIfUserHasBids implements Observer
{
    private $bidRepository;
    private $stateException;
    /**
     * FindBidById constructor.
     * @param $bidRepository
     */
    public function __construct(BidRepo $bidRepository)
    {
        $this->bidRepository = $bidRepository;
        $this->stateException = false;
    }


    public function __invoke(User $user): array
    {
        $bids = $this->bidRepository->findBidsByOwner($user);

        if (0 === count($bids)) {
            $this->stateException = true;
            ListException::instance()->notify();
        }

        return $bids;
    }

    /**
     * @throws UserHasNotBids
     */
    public function update()
    {
        if ($this->stateException) {
            throw new UserHasNotBids();
        }
    }
}
