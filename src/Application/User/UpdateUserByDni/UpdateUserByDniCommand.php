<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 18:13
 */

namespace App\Application\User\UpdateUserByDni;


use Assert\Assertion;

class UpdateUserByDniCommand
{

    private $dni;
    private $password;
    private $birthDate;
    private $passwordVerified;
    /**
     * RegisterUserCommand constructor.
     * @param $dni
     * @param $password
     * @param $birthDate
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($dni, $password, $birthDate, $passwordVerified)
    {
        Assertion::regex($dni, '^[0-9]{8,8}[A-Za-z]$^');
        Assertion::string($password);
        Assertion::string($passwordVerified);
        Assertion::minLength($password,5);
        Assertion::same($password, $passwordVerified);
        Assertion::regex($birthDate, '^\d{4}([\-/.])(0?[1-9]|1[1-2])\1(3[01]|[12][0-9]|0?[1-9])$^');
        $this->dni = $dni;
        $this->password = $password;
        $this->birthDate = $birthDate;
        $this->passwordVerified = $passwordVerified;
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

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }
}
