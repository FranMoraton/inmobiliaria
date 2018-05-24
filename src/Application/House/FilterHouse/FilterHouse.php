<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 23/05/2018
 * Time: 13:29
 */

namespace App\Application\House\FilterHouse;

use App\Domain\Model\Entity\House\HouseRepo;
use App\Domain\Model\HttpResponses\HttpResponses;

class FilterHouse
{
    private $houseRepository;
    private $dataTransform;

    public function __construct(
        HouseRepo $houseRepository,
        FilterHouseTransformInterface $dataTransform
    ) {
        $this->houseRepository = $houseRepository;
        $this->dataTransform = $dataTransform;
    }

    public function handle(FilterHouseCommand $filterHouseCommand)
    {
        $listHouses = $this->houseRepository->filterHouses(
            $filterHouseCommand->getPage(),
            $filterHouseCommand->getMaxPrize(),
            $filterHouseCommand->getMinPrize(),
            $filterHouseCommand->getCity(),
            $filterHouseCommand->getCountry()
        );
        return [
            'data' => $this->dataTransform->transform($listHouses),
            'code' => HttpResponses::OK
        ];
    }
}
