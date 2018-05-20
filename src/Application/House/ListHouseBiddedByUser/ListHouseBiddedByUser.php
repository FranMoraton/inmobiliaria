<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 17:34
 */

namespace App\Application\House\ListHouseBiddedByUser;

use App\Domain\Model\Entity\House\HouseRepo;
use App\Domain\Model\HttpResponses\HttpResponses;
use App\Domain\Services\Bid\FindIfUserHasBids;
use App\Domain\Services\User\FindUserByDni;
use App\Domain\Services\Util\ExceptionObserver\ListException;

class ListHouseBiddedByUser
{
    private $dataTransform;
    private $findUserByDni;
    private $findIfUserHasBids;
    private $houseRepository;

    /**
     * ListHouseBiddedByUser constructor.
     * @param ListHouseBiddedByUserTransformInterface $dataTransform
     * @param FindUserByDni $findUserByDni
     * @param FindIfUserHasBids $findIfUserHasBids
     * @param HouseRepo $houseRepository
     */
    public function __construct(
        ListHouseBiddedByUserTransformInterface $dataTransform,
        FindUserByDni $findUserByDni,
        FindIfUserHasBids $findIfUserHasBids,
        HouseRepo $houseRepository
    ) {
        $this->dataTransform = $dataTransform;
        $this->findUserByDni = $findUserByDni;
        $this->findIfUserHasBids = $findIfUserHasBids;
        $this->houseRepository = $houseRepository;
        ListException::instance()->restartExceptions();
        ListException::instance()->attach($findUserByDni);
        ListException::instance()->attach($findIfUserHasBids);
    }

    public function handle(ListHouseBiddedByUserCommand $listHouseBiddedByUserCommand)
    {
        $user =$this->findUserByDni->__invoke($listHouseBiddedByUserCommand->getDni());

        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }
        $bidsFromUser = $this->findIfUserHasBids->__invoke($user);

        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }

        $listOfHouses = $this->findHousesWithBids($bidsFromUser);

        return [
            "data" => $this->dataTransform->transform($listOfHouses),
            "code" => HttpResponses::OK
        ];
    }

    private function findHousesWithBids(array $bids): array
    {
        $houses = [];
        foreach ($bids as $bid) {
            $houses [] = $this->houseRepository->findHouseById($bid->getHouse());
        }
        return $houses;
    }
}
