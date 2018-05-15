<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 12/05/2018
 * Time: 21:17
 */

namespace App\Infrastructure\Repository\User\Role;

use App\Domain\Model\Entity\User\Role\Role;
use App\Domain\Model\Entity\User\Role\RoleRepo;
use Doctrine\ORM\EntityRepository;

class RoleRepository extends EntityRepository implements RoleRepo
{
    /**
     * @param Role $role
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function persistAndFlush(Role $role): void
    {
        $this->getEntityManager()->persist($role);
        $this->getEntityManager()->flush();
    }

    public function returnRole(int $const): ?Role
    {
        return $this->findOneBy(["id" => $const]);
    }
}
