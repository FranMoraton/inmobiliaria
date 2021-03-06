<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 17/05/2018
 * Time: 22:45
 */

namespace App\Application\Bid\CreateBid;

use Assert\Assertion;

class CreateBidCommand
{

    private $dni;
    private $houseId;
    private $money;

    /**
     * CreateBidCommand constructor.
     * @param $dni
     * @param $houseId
     * @param $money
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($dni, $houseId, $money)
    {
        Assertion::regex($dni, '^[0-9]{8,8}[A-Za-z]$^');
        Assertion::numeric($houseId);
        Assertion::numeric($money);
        $this->dni = $dni;
        $this->houseId = $houseId;
        $this->money = $money;
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
    public function getHouseId()
    {
        return $this->houseId;
    }

    /**
     * @return mixed
     */
    public function getMoney()
    {
        return $this->money;
    }
}
