<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 12/05/2018
 * Time: 18:12
 */

namespace App\Infrastructure\Repository\House\Coordinates;

use App\Domain\Model\Entity\House\Coordinates\Coordinates;
use Doctrine\ORM\EntityRepository;

class CoordinatesRepository extends EntityRepository
{
    /**
     * @param Coordinates $coordinates
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function persistAndFlush(Coordinates $coordinates): void
    {
        $this->getEntityManager()->persist($coordinates);
        $this->getEntityManager()->flush();
    }

    public function findAllCoordinates()
    {
        return $this->findAll();
    }
}
