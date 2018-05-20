<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 11:57
 */

namespace App\Domain\Services\House\Specification;

use App\Domain\Model\Entity\House\House;

class City implements Specification
{
    private $city;

    private function __construct($city)
    {
        $this->city = $city;
    }

    public static function isLike($city): self
    {
        return new self($city);
    }

    public function isSatisfiedBy(House $house): bool
    {
        if ($house->getCity() === $this->city) {
            return true;
        }

        return false;
    }
}
