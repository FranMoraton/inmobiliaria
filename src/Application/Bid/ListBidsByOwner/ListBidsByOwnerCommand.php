<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 17/05/2018
 * Time: 19:41
 */

namespace App\Application\Bid\ListBidsByOwner;

use Assert\Assertion;

class ListBidsByOwnerCommand
{
    private $dni;

    /**
     * ListBidsByOwnerCommand constructor.
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
