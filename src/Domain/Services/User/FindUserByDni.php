<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 18:49
 */

namespace App\Domain\Services\User;

use App\Domain\Model\Entity\User\User;
use App\Domain\Model\Entity\User\UserNotFound;
use App\Domain\Model\Entity\User\UserRepo;

class FindUserByDni
{
    private $userRepository;

    /**
     * FindUserByDni constructor.
     * @param $userRepository
     */
    public function __construct(UserRepo $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $dni
     * @return User|null
     * @throws UserNotFound
     */
    public function __invoke(string $dni): User
    {
        $user = $this->userRepository->findUserByDni($dni);

        if (null === $user) {
            throw new UserNotFound();
        }

        return $user;
    }
}
