<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 19:54
 */

namespace App\Application\House\CreateHouseWithOwner;


use Assert\Assertion;

class CreateHouseCommand
{

    private $dni;
    private $houseId;
    private $adress;
    private $sellingPrize;
    private $city;
    private $country;
    private $disableHouse;


    /**
     * ModifyHouseCommand constructor.
     * @param $dni
     * @param $houseId
     * @param $adress
     * @param $sellingPrize
     * @param $city
     * @param $country
     * @param $disableHouse
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($dni, $houseId, $adress, $sellingPrize, $city, $country, $disableHouse)
    {
        Assertion::regex($dni, '^[0-9]{8,8}[A-Za-z]$^');
        Assertion::numeric($houseId);
        Assertion::string($adress);
        Assertion::maxLength($adress, 100);
        Assertion::string($city);
        Assertion::maxLength($city, 20);
        Assertion::string($country);
        Assertion::maxLength($country, 20);
        Assertion::numeric($sellingPrize);
        Assertion::numeric($disableHouse);
        Assertion::between($disableHouse, 0, 1);
        $this->dni = $dni;
        $this->houseId = $houseId;
        $this->adress = $adress;
        $this->sellingPrize = $sellingPrize;
        $this->city = $city;
        $this->country = $country;
        $this->disableHouse = $disableHouse;
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
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * @return mixed
     */
    public function getSellingPrize()
    {
        return $this->sellingPrize;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getDisableHouse()
    {
        return $this->disableHouse;
    }
}
