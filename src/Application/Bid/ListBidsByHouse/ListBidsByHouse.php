<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 28/05/2018
 * Time: 9:43
 */

namespace App\Application\Bid\ListBidsByHouse;

use App\Domain\Model\Entity\Bid\BidRepo;
use App\Domain\Model\HttpResponses\HttpResponses;

class ListBidsByHouse
{
    private $dataTransform;
    private $bidRepository;

    /**
     * ListBidsByHouse constructor.
     * @param $dataTransform
     * @param $bidRepository
     */
    public function __construct(
        ListBidsByHouseTransformInterface $dataTransform,
        BidRepo $bidRepository
    ) {
        $this->dataTransform = $dataTransform;
        $this->bidRepository = $bidRepository;
    }

    public function handle(ListBidsByHouseCommand $listBidsByHouseCommand)
    {
        $list = $this->bidRepository->findBidsByHouse($listBidsByHouseCommand->getHouseId());

        $transformed = $this->dataTransform->transform($list);

        return  [
            "data" => $transformed,
            "code" => HttpResponses::OK
        ];
    }
}
