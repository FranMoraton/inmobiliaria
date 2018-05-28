<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 28/05/2018
 * Time: 9:43
 */

namespace App\Application\Bid\ListBidsByHouse;

use Assert\Assertion;

class ListBidsByHouseCommand
{
    private $houseId;

    /**
     * ListBidsByHouseCommand constructor.
     * @param $houseId
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($houseId)
    {
        Assertion::numeric($houseId);
        $this->houseId = $houseId;
    }

    /**
     * @return mixed
     */
    public function getHouseId()
    {
        return $this->houseId;
    }
}
