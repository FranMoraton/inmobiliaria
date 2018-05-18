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
use App\Domain\Services\Util\ExceptionObserver\ListException;
use App\Domain\Services\Util\ExceptionObserver\Observer;

class CheckIfUserExist implements Observer
{
    private $userRepository;
    private $stateException;
    /**
     * FindUserByDni constructor.
     * @param $userRepository
     */
    public function __construct(UserRepo $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->stateException = false;
    }


    public function __invoke(string $dni)
    {
        $user = $this->userRepository->findUserByDni($dni);

        if (null !== $user) {
            $this->stateException = true;
            ListException::instance()->notify();
        }
    }

    /**
     * @throws UserAlreadyExist
     */
    public function update()
    {
        if ($this->stateException) {
            throw new UserAlreadyExist();
        }
    }
}
