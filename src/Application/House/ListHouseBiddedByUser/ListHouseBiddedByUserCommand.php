<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 17:34
 */

namespace App\Application\House\ListHouseBiddedByUser;

use Assert\Assertion;

class ListHouseBiddedByUserCommand
{
    private $dni;

    /**
     * ListHouseByOwnerCommand constructor.
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
