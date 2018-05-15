<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 18:31
 */

namespace App\Application\User\ListUserByDni;


use Assert\Assertion;

class ListUserByDniCommand
{
    private $dni;

    /**
     * ListUserByDniCommand constructor.
     * @param $dni
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($dni)
    {
        Assertion::regex($dni, '^[0-9]{8,8}[A-Za-z]$^');
        $this->dni = $dni;
    }

    /**
     * @return mixed
     */
    public function getDni()
    {
        return $this->dni;
    }
}
