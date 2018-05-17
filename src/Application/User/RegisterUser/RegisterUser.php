<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 22:57
 */

namespace App\Application\User\RegisterUser;


use App\Domain\Model\Entity\User\Role\Role;
use App\Domain\Model\Entity\User\User;
use App\Domain\Model\Entity\User\UserRepo;
use App\Domain\Model\HttpResponses\HttpResponses;
use App\Domain\Services\User\CheckIfUserExist;
use App\Domain\Services\User\EncodePassword;
use App\Domain\Services\User\Role\ReturnRole;
use App\Domain\Services\Util\ExceptionObserver\ListException;

class RegisterUser
{
    private $dataTransform;
    private $checkIfUserExist;
    private $encodePassword;
    private $userRepository;
    private $returnRole;

    /**
     * RegisterUser constructor.
     * @param RegisterUserTransformInterface $dataTransform
     * @param CheckIfUserExist $checkIfUserExist
     * @param EncodePassword $encodePassword
     * @param UserRepo $userRepository
     * @param ReturnRole $returnRole
     */
    public function __construct(
        RegisterUserTransformInterface $dataTransform,
        CheckIfUserExist $checkIfUserExist,
        EncodePassword $encodePassword,
        UserRepo $userRepository,
        ReturnRole $returnRole
    ) {
        $this->dataTransform = $dataTransform;
        $this->checkIfUserExist = $checkIfUserExist;
        $this->encodePassword = $encodePassword;
        $this->userRepository = $userRepository;
        $this->returnRole = $returnRole;
        ListException::instance()->restartExceptions();
        ListException::instance()->attach($checkIfUserExist);
    }


    public function handle(RegisterUserCommand $registerUserCommand)
    {
        $this->checkIfUserExist->__invoke($registerUserCommand->getDni());
        $password = $this->encodePassword->execute($registerUserCommand->getPassword());

        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }

        $newUser = User::fromRegisterForm(
            $registerUserCommand->getDni(),
            $password,
            new \DateTime(date_create($registerUserCommand->getBirthDate())->format('Y-m-d')),
            $this->returnRole->__invoke(Role::USER)
        );

        $this->userRepository->persistAndFlush($newUser);

        return [
            "data" => $this->dataTransform->transform($newUser),
            "code" => HttpResponses::OK
            ];
    }
}
