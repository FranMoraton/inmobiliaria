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
use App\Infrastructure\Service\House\Specification\AndX;
use App\Infrastructure\Service\House\Specification\AsArray;
use App\Infrastructure\Service\House\Specification\City;
use App\Infrastructure\Service\House\Specification\Country;
use App\Infrastructure\Service\House\Specification\MaxSellingPrize;
use App\Infrastructure\Service\House\Specification\MinSellingPrize;
use Doctrine\ORM\EntityRepository;

class HouseRepository extends EntityRepository implements HouseRepo
{
    const MAX_RESULTS_QUERY = 20;

    public function persistAndFlush(House $house): void
    {
        $this->getEntityManager()->persist($house);
        $this->getEntityManager()->flush();
    }

    public function findAllHouses(): array
    {
        return $this->findAll();
    }

    public function findHouseById($id): ?House
    {
        return $this->findOneBy([ "id" => $id ]);
    }

    public function findHouseByOwner(User $user): array
    {
        return $this->findBy([ "houseOwner" => $user ]);
    }

    public function filterHouses(int $page, $maxSellingPrize, $minSellingPrize, $city, $country): array
    {
        $query = $this->createQueryBuilder('house')
            ->setFirstResult(self::MAX_RESULTS_QUERY * ($page - 1)) // set the offset
            ->setMaxResults(self::MAX_RESULTS_QUERY);
        $specification = new AsArray(
            new AndX(
                new MaxSellingPrize($maxSellingPrize),
                new MinSellingPrize($minSellingPrize),
                new City($city),
                new Country($country)
            )
        );
        $specification->match($query);
        return $query->getQuery()->execute();
    }
}
