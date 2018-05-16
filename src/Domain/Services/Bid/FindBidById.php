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

class FindBidById
{
    private $bidRepository;

    /**
     * FindBidById constructor.
     * @param $bidRepository
     */
    public function __construct(BidRepo $bidRepository)
    {
        $this->bidRepository = $bidRepository;
    }

    /**
     * @param int $id
     * @return Bid|null
     * @throws BidDoNotExist
     */
    public function __invoke(int $id): ?Bid
    {
        $bid = $this->bidRepository->findBidById($id);

        if (null === $bid) {
            throw new BidDoNotExist();
        }

        return $bid;
    }


}
