<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 18:13
 */

namespace App\Application\User\UpdateUserByDni;


use App\Domain\Model\Entity\User\UserRepo;
use App\Domain\Model\HttpResponses\HttpResponses;
use App\Domain\Services\User\EncodePassword;
use App\Domain\Services\User\FindUserByDni;
use App\Domain\Services\Util\ExceptionObserver\ListException;

class UpdateUserByDni
{

    private $dataTransform;
    private $findUserByDni;
    private $encodePassword;
    private $userRepository;

    /**
     * UpdateUserByDni constructor.
     * @param $dataTransform
     * @param $findUserByDni
     * @param $encodePassword
     * @param $userRepository
     */
    public function __construct(
        UpdateUserByDniTransformInterface $dataTransform,
        FindUserByDni $findUserByDni,
        EncodePassword $encodePassword,
        UserRepo $userRepository
    ) {
        $this->dataTransform = $dataTransform;
        $this->findUserByDni = $findUserByDni;
        $this->encodePassword = $encodePassword;
        $this->userRepository = $userRepository;
        ListException::instance()->restartExceptions();
        ListException::instance()->attach($findUserByDni);
    }



    public function handle(UpdateUserByDniCommand $updateUserByDniCommand)
    {
        $user = $this->findUserByDni->__invoke($updateUserByDniCommand->getDni());

        $password = $this->encodePassword->execute($updateUserByDniCommand->getPassword());

        if (ListException::instance()->checkForException()) {
            return ListException::instance()->firstException();
        }

            $user->setPassword($password);

            $user->setBirthDate(
                new \DateTime(date_create(
                    $updateUserByDniCommand->getBirthDate())
                    ->format('Y-m-d'))
        );

        $this->userRepository->persistAndFlush($user);

        return [
            "data" => $this->dataTransform->transform($user),
            "code" => HttpResponses::OK
            ];
    }
}
