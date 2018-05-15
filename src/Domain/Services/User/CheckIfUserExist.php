<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 19:50
 */

namespace App\Domain\Services\User;

use App\Domain\Model\Entity\User\UserAlreadyExist;
use App\Domain\Model\Entity\User\UserRepo;

class CheckIfUserExist
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
     * @throws UserAlreadyExist
     */
    public function __invoke(string $dni)
    {
        $user = $this->userRepository->findUserByDni($dni);

        if (null !== $user) {
            throw new UserAlreadyExist();
        }
    }
}
