<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 19:28
 */

namespace App\Domain\Services\Bid;


use App\Domain\Model\Entity\Bid\Bid;
use App\Domain\Model\Entity\Bid\BidDoNotExist;
use App\Domain\Model\Entity\Bid\BidRepo;
use App\Domain\Services\Util\ExceptionObserver\ListException;
use App\Domain\Services\Util\ExceptionObserver\Observer;

class FindBidById implements Observer
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


    public function __invoke(int $id): ?Bid
    {
        $bid = $this->bidRepository->findBidById($id);

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
        if($this->stateException) {
            throw new BidDoNotExist();
        }
    }
}
