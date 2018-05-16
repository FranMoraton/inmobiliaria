<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 19:50
 */

namespace App\Application\Bid\AcceptBid;


use Assert\Assertion;

class AcceptBidCommand
{
    private $dniUser;
    private $bidId;
    private $houseId;

    /**
     * AcceptBidCommand constructor.
     * @param $dniUser
     * @param $bidId
     * @param $houseId
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($dniUser, $bidId, $houseId)
    {
        Assertion::regex($dniUser, '^[0-9]{8,8}[A-Za-z]$^');
        Assertion::numeric($bidId);
        Assertion::numeric($houseId);
        $this->dniUser = $dniUser;
        $this->bidId = $bidId;
        $this->houseId = $houseId;
    }

    /**
     * @return mixed
     */
    public function getDniUser()
    {
        return $this->dniUser;
    }

    /**
     * @return mixed
     */
    public function getBidId()
    {
        return $this->bidId;
    }

    /**
     * @return mixed
     */
    public function getHouseId()
    {
        return $this->houseId;
    }
}
