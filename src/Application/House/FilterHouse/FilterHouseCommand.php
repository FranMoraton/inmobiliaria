<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 23/05/2018
 * Time: 13:29
 */

namespace App\Application\House\FilterHouse;

use Assert\Assertion;

class FilterHouseCommand
{
    private $page;
    private $maxPrize;
    private $minPrize;
    private $city;
    private $country;

    /**
     * FilterHouseCommand constructor.
     * @param $page
     * @param $maxPrize
     * @param $minPrize
     * @param $city
     * @param $country
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($page, $maxPrize, $minPrize, $city, $country)
    {
        Assertion::numeric($page);
        Assertion::numeric($maxPrize);
        Assertion::numeric($minPrize);
        Assertion::nullOrString($city);
        Assertion::nullOrString($country);
        $this->page = $page;
        $this->maxPrize = $maxPrize;
        $this->minPrize = $minPrize;
        $this->city = $city;
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return mixed
     */
    public function getMaxPrize()
    {
        return $this->maxPrize;
    }

    /**
     * @return mixed
     */
    public function getMinPrize()
    {
        return $this->minPrize;
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
}
