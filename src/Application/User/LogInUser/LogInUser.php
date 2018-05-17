<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 20:14
 */

namespace App\Application\User\LogInUser;

use App\Domain\Model\HttpResponses\HttpResponses;
use App\Domain\Services\User\CheckPasswordForLogIn;
use App\Domain\Services\User\FindUserByDni;
use App\Domain\Services\Util\ExceptionObserver\ListException;

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
        ListException::instance()->restartExceptions();
        ListException::instance()->attach($findUserByDni);
        ListException::instance()->attach($checkPasswordForLogIn);
    }


    public function handle(LogInUserCommand $logInUserCommand)
    {
        $user = $this->findUserByDni->__invoke($logInUserCommand->getDni());

        $this->checkPasswordForLogIn->__invoke($user->getPassword(), $logInUserCommand->getPassword());

        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }

        return [
            "data" => $this->dataTransform->transform($user),
            "code" => HttpResponses::OK
            ];
    }
}
