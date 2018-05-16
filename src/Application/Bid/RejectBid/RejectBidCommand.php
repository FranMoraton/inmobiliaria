<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 19:52
 */

namespace App\Application\Bid\RejectBid;


use Assert\Assertion;

class RejectBidCommand
{

    private $dniUser;
    private $bidId;
    private $houseId;

    /**
     * RejectBidCommand constructor.
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
