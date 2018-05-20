<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 16:30
 */

namespace App\Application\House\ListHouseByOwner;

use App\Domain\Model\Entity\House\HouseRepo;
use App\Domain\Model\HttpResponses\HttpResponses;
use App\Domain\Services\User\FindUserByDni;
use App\Domain\Services\Util\ExceptionObserver\ListException;

class ListHouseByOwner
{
    private $dataTransform;
    private $findUserByDni;
    private $houseRepository;

    /**
     * ListHouseByOwner constructor.
     * @param ListHouseByOwnerTransformInterface $dataTransform
     * @param FindUserByDni $findUserByDni
     * @param HouseRepo $houseRepository
     */
    public function __construct(
        ListHouseByOwnerTransformInterface $dataTransform,
        FindUserByDni $findUserByDni,
        HouseRepo $houseRepository
    ) {
        $this->dataTransform = $dataTransform;
        $this->findUserByDni = $findUserByDni;
        $this->houseRepository = $houseRepository;
        ListException::instance()->restartExceptions();
        ListException::instance()->attach($findUserByDni);
    }

    public function handle(ListHouseByOwnerCommand $listHouseByOwnerCommand)
    {
        $user = $this->findUserByDni->__invoke($listHouseByOwnerCommand->getDni());
        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }

        $list = $this->houseRepository->findHouseByOwner($user);

        return [
            "data" => $this->dataTransform->transform($list),
            "code" => HttpResponses::OK
        ];
    }
}
