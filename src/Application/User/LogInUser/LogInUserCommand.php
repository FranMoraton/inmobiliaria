<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 20:25
 */

namespace App\Application\User\LogInUser;

use Assert\Assertion;

class LogInUserCommand
{
    private $dni;
    private $password;

    /**
     * LogInUserCommand constructor.
     * @param $dni
     * @param $password
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($dni, $password)
    {
        Assertion::regex($dni, '^[0-9]{8,8}[A-Za-z]$^');
        Assertion::string($password);
        $this->dni = $dni;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
}
