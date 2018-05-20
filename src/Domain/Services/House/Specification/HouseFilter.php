<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 11:45
 */

namespace App\Domain\Services\House\Specification;

use App\Domain\Model\Entity\House\HouseRepo;

class HouseFilter
{
    private $houseRepository;

    public function __construct(HouseRepo $houseRepository)
    {
        $this->houseRepository = $houseRepository;
    }
    public function matchingSpecification(Specification $specification): array
    {
//        $matches = array_filter($this->findAll(), function ($item) {
//            return $specification->isSatisfiedBy($item);
//        });
        $matches = [];
        foreach ($this->houseRepository->findAllHouses() as $house) {
            if ($specification->isSatisfiedBy($house)) {
                $matches[] = $house;
            }
        }
        return $matches;
    }
}