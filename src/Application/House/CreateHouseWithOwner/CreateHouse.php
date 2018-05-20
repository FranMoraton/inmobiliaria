<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 21:37
 */

namespace App\Application\House\CreateHouseWithOwner;

use App\Domain\Model\Entity\House\House;
use App\Domain\Model\Entity\House\HouseRepo;
use App\Domain\Model\HttpResponses\HttpResponses;
use App\Domain\Services\User\FindUserByDni;
use App\Domain\Services\Util\ExceptionObserver\ListException;

class CreateHouse
{

    private $dataTransform;
    private $findUserByDni;
    private $houseRepository;

    /**
     * CreateHouse constructor.
     * @param CreateHouseTransformInterface $dataTransform
     * @param FindUserByDni $findUserByDni
     * @param HouseRepo $houseRepository
     */
    public function __construct(
        CreateHouseTransformInterface $dataTransform,
        FindUserByDni $findUserByDni,
        HouseRepo $houseRepository
    ) {
        $this->dataTransform = $dataTransform;
        $this->findUserByDni = $findUserByDni;
        $this->houseRepository = $houseRepository;
        ListException::instance()->restartExceptions();
        ListException::instance()->attach($findUserByDni);
    }

    public function handle(CreateHouseCommand $createHouseCommand)
    {
        $user = $this->findUserByDni->__invoke($createHouseCommand->getDni());

        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }

        $house = House::createFromApi(
            $user,
            $createHouseCommand->getSellingPrize(),
            $createHouseCommand->getCountry(),
            $createHouseCommand->getCity(),
            $createHouseCommand->getAdress()
        );

        $this->houseRepository->persistAndFlush($house);

        return [
            "data" => $this->dataTransform->transform($house),
            "code" => HttpResponses::OK
        ];
    }
}
