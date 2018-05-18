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
use App\Domain\Services\Util\ExceptionObserver\ListException;
use App\Domain\Services\Util\ExceptionObserver\Observer;

class FindUserByDni implements Observer
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


    public function __invoke(string $dni): ?User
    {
        $user = $this->userRepository->findUserByDni($dni);

        if (null === $user) {
            $this->stateException = true;
            ListException::instance()->notify();

        }

        return $user;
    }

    /**
     * @throws UserNotFound
     */
    public function update()
    {
        if ($this->stateException) {
            throw new UserNotFound();
        }
    }
}
