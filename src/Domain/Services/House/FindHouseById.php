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
use App\Domain\Services\Util\ExceptionObserver\ListException;
use App\Domain\Services\Util\ExceptionObserver\Observer;

class FindHouseById implements Observer
{
    private $houseRepository;
    private $stateException;
    /**
     * findHouseById constructor.
     * @param $houseRepository
     */
    public function __construct(HouseRepo $houseRepository)
    {
        $this->houseRepository = $houseRepository;
        $this->stateException = false;
    }


    public function __invoke(int $id): ?House
    {
        $house = $this->houseRepository->findHouseById($id);

        if (null === $house) {
            $this->stateException = true;
            ListException::instance()->notify();

        }

        return $house;
    }

    /**
     * @throws HouseDoNotExist
     */
    public function update()
    {
        if ($this->stateException) {
            throw new HouseDoNotExist();
        }
    }
}
