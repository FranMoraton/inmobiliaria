<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 17/05/2018
 * Time: 19:18
 */

namespace App\Application\Bid\ListBids;

use App\Domain\Model\Entity\Bid\BidRepo;
use App\Domain\Model\HttpResponses\HttpResponses;

class ListBids
{
    private $bidRepository;
    private $dataTransform;

    /**
     * ListBids constructor.
     * @param $bidRepository
     * @param $dataTransform
     */
    public function __construct(BidRepo $bidRepository, ListBidsTransformInterface $dataTransform)
    {
        $this->bidRepository = $bidRepository;
        $this->dataTransform = $dataTransform;
    }

    public function handle(ListBidsCommand $listBidsCommand)
    {
        $list = $this->bidRepository->findAllBids();

        $transformed = $this->dataTransform->transform($list);

        return  [
            "data" => $transformed,
            "code" => HttpResponses::OK
        ];
    }
}
