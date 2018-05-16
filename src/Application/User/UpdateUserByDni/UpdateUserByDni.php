<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 18:13
 */

namespace App\Application\User\UpdateUserByDni;


use App\Domain\Model\Entity\User\UserRepo;
use App\Domain\Services\User\EncodePassword;
use App\Domain\Services\User\FindUserByDni;

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
    }


    /**
     * @param UpdateUserByDniCommand $updateUserByDniCommand
     * @return array
     * @throws \App\Domain\Model\Entity\User\UserNotFound
     */
    public function handle(UpdateUserByDniCommand $updateUserByDniCommand)
    {
        $user = $this->findUserByDni->__invoke($updateUserByDniCommand->getDni());

        $password = $this->encodePassword->execute($updateUserByDniCommand->getPassword());


            $user->setPassword($password);

            $user->setBirthDate(
                new \DateTime(date_create(
                    $updateUserByDniCommand->getBirthDate())
                    ->format('Y-m-d'))
        );

        $this->userRepository->persistAndFlush($user);

        return $this->dataTransform->transform($user);
    }
}
