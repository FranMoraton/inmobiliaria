<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 0:02
 */

namespace App\Domain\Services\User\Role;

use App\Domain\Model\Entity\User\Role\Role;
use App\Domain\Model\Entity\User\Role\RoleRepo;

class ReturnRole
{
    private $roleRepository;

    /**
     * returnRole constructor.
     * @param $roleRepository
     */
    public function __construct(RoleRepo $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function __invoke(int $id): Role
    {
        return $this->roleRepository->returnRole($id);
    }
}
