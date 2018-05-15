<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 12/05/2018
 * Time: 23:09
 */

namespace App\Infrastructure\Repository\User;

use App\Domain\Model\Entity\User\User;
use App\Domain\Model\Entity\User\UserRepo;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements UserRepo
{
    /**
     * @param User $user
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function persistAndFlush(User $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function findAllUsers(): array
    {
        return $this->findAll();
    }

    public function findUserByDni(string $dni): ?User
    {
         return $this->findOneBy(["DNI" => $dni]);
    }


}
