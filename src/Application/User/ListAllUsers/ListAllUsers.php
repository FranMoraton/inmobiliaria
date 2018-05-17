<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 17:23
 */

namespace App\Application\User\ListAllUsers;

use App\Domain\Model\Entity\User\UserRepo;
use App\Domain\Model\HttpResponses\HttpResponses;

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


        return [
            "data" => $this->dataTransform->transform($list),
            "code" => HttpResponses::OK
            ];
    }
}
