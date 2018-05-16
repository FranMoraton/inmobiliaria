<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 21:12
 */

namespace App\Domain\Services\House;


use App\Domain\Model\Entity\House\House;
use App\Domain\Model\Entity\House\HouseDoNotExist;
use App\Domain\Model\Entity\House\HouseRepo;

class FindHouseById
{
    private $houseRepository;

    /**
     * findHouseById constructor.
     * @param $houseRepository
     */
    public function __construct(HouseRepo $houseRepository)
    {
        $this->houseRepository = $houseRepository;
    }

    /**
     * @param int $id
     * @return House
     * @throws HouseDoNotExist
     */
    public function __invoke(int $id): House
    {
        $house = $this->houseRepository->findHouseById($id);

        if (null === $house) {
            throw new HouseDoNotExist();
        }

        return $house;
    }

}