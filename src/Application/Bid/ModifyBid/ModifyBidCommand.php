<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 18/05/2018
 * Time: 10:18
 */

namespace App\Application\Bid\ModifyBid;

use Assert\Assertion;

class ModifyBidCommand
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
