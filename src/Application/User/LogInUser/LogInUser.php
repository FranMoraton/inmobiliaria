<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 20:14
 */

namespace App\Application\User\LogInUser;

use App\Domain\Services\User\CheckPasswordForLogIn;
use App\Domain\Services\User\FindUserByDni;

class LogInUser
{
    private $findUserByDni;
    private $checkPasswordForLogIn;
    private $dataTransform;


    public function __construct(
        FindUserByDni $findUserByDni,
        CheckPasswordForLogIn $checkPasswordForLogIn,
        LogInUserTransformInterface $dataTransform
    ) {
        $this->findUserByDni = $findUserByDni;
        $this->checkPasswordForLogIn = $checkPasswordForLogIn;
        $this->dataTransform = $dataTransform;
    }

    /**
     * @param LogInUserCommand $logInUserCommand
     * @return array
     * @throws \App\Domain\Model\Entity\User\PasswordDoNotMatch
     * @throws \App\Domain\Model\Entity\User\UserNotFound
     */
    public function handle(LogInUserCommand $logInUserCommand)
    {
        $user = $this->findUserByDni->__invoke($logInUserCommand->getDni());

        $this->checkPasswordForLogIn->__invoke($user->getPassword(), $logInUserCommand->getPassword());

        return $this->dataTransform->transform($user);
    }
}
