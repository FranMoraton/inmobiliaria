<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 12/05/2018
 * Time: 23:55
 */

namespace App\Infrastructure\Repository\House;

use App\Domain\Model\Entity\House\House;
use App\Domain\Model\Entity\House\HouseRepo;
use App\Domain\Model\Entity\User\User;
use Doctrine\ORM\EntityRepository;

class HouseRepository extends EntityRepository implements HouseRepo
{

    public function persistAndFlush(House $house): void
    {
        $this->getEntityManager()->persist($house);
        $this->getEntityManager()->flush();
    }

    public function findAllHouses(): array
    {
        return $this->findAll();
    }

    public function findHouseById(int $id): ?House
    {
        return $this->findOneBy([ "id" => $id ]);
    }

    public function findHouseByOwner(User $user): array
    {
        return $this->findBy([ "user" => $user ]);
    }
}
