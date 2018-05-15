<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 18:31
 */

namespace App\Application\User\ListUserByDni;



use App\Domain\Services\User\FindUserByDni;

class ListUserByDni
{
    private $dataTransform;
    private $findUserByDni;



    public function __construct(
        ListUserByDniTransformInterface $dataTransform,
        FindUserByDni $findUserByDni
    ) {
        $this->dataTransform = $dataTransform;
        $this->findUserByDni = $findUserByDni;
    }


    /**
     * @param ListUserByDniCommand $listUserByDniCommand
     * @return array
     * @throws \App\Domain\Model\Entity\User\UserNotFound
     */
    public function handle(ListUserByDniCommand $listUserByDniCommand)
    {
        $list = $this->findUserByDni->__invoke($listUserByDniCommand->getDni());

        return $this->dataTransform->transform($list);
    }
}
