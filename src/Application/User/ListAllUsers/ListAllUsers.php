<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 17:23
 */

namespace App\Application\User\ListAllUsers;

use App\Domain\Model\Entity\User\UserRepo;

;

class ListAllUsers
{
    private $dataTransform;
    private $userRepository;



    public function __construct(
        ListAllUsersTransformInterface $dataTransform,
        UserRepo $userRepository
    ) {
        $this->dataTransform = $dataTransform;
        $this->userRepository = $userRepository;
    }


    public function handle(ListallUsersCommand $listallUsersCommand)
    {
        $list = $this->userRepository->findAllUsers();


        return $this->dataTransform->transform($list);
    }
}
