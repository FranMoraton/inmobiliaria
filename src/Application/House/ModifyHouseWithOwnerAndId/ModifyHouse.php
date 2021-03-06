<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 19:16
 */

namespace App\Application\House\ModifyHouseWithOwnerAndId;

use App\Domain\Model\Entity\House\HouseRepo;
use App\Domain\Model\HttpResponses\HttpResponses;
use App\Domain\Services\User\CheckUsersAreEquals;
use App\Domain\Services\User\FindUserByDni;
use App\Domain\Services\Util\ExceptionObserver\ListException;

class ModifyHouse
{

    private $dataTransform;
    private $findUserByDni;
    private $checkUsersAreEquals;
    private $houseRepository;

    /**
     * ModifyHouse constructor.
     * @param ModifyHouseTransformInterface $dataTransform
     * @param FindUserByDni $findUserByDni
     * @param CheckUsersAreEquals $checkUsersAreEquals
     * @param HouseRepo $houseRepository
     */
    public function __construct(
        ModifyHouseTransformInterface $dataTransform,
        FindUserByDni $findUserByDni,
        CheckUsersAreEquals $checkUsersAreEquals,
        HouseRepo $houseRepository
    ) {
        $this->dataTransform = $dataTransform;
        $this->findUserByDni = $findUserByDni;
        $this->checkUsersAreEquals = $checkUsersAreEquals;
        $this->houseRepository = $houseRepository;
        ListException::instance()->restartExceptions();
        ListException::instance()->attach($findUserByDni);
        ListException::instance()->attach($checkUsersAreEquals);
    }

    public function handle(ModifyHouseCommand $modifyHouseCommand)
    {
        $user = $this->findUserByDni->__invoke($modifyHouseCommand->getDni());

        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }

        $house = $this->houseRepository->findHouseById($modifyHouseCommand->getHouseId());

        $this->checkUsersAreEquals->__invoke($user, $house->getHouseOwner());

        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }

        $house->setSellingPrize($modifyHouseCommand->getSellingPrize());
        $house->setAdress($modifyHouseCommand->getAdress());
        $house->setCity($modifyHouseCommand->getCity());
        $house->setCountry($modifyHouseCommand->getCountry());
        $house->setHouseDisabled($modifyHouseCommand->getDisableHouse());


        $this->houseRepository->persistAndFlush($house);

        return [
            "data" => $this->dataTransform->transform($house),
            "code" => HttpResponses::OK
        ];
    }
}
