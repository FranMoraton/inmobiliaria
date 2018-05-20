<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 11:57
 */

namespace App\Domain\Services\House\Specification;

use App\Domain\Model\Entity\House\House;

class Country implements Specification
{
    private $country;

    private function __construct($country)
    {
        $this->country = $country;
    }

    public static function isLike($country): self
    {
        return new self($country);
    }

    public function isSatisfiedBy(House $house): bool
    {
        if ($house->getCountry() === $this->country) {
            return true;
        }

        return false;
    }
}
