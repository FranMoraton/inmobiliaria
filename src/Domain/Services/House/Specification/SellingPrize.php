<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 11:56
 */

namespace App\Domain\Services\House\Specification;

use App\Domain\Model\Entity\House\House;

class SellingPrize implements Specification
{

    private $maxPrice;
    private $minPrice;

    private function __construct($minPrice, $maxPrice)
    {
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
    }

    public static function between($minPrice, $maxPrice): self
    {
        return new self($minPrice, $maxPrice);
    }

    public function isSatisfiedBy(House $house): bool
    {
        if ($this->maxPrice !== null && $house->getSellingPrize() > $this->maxPrice) {
            return false;
        }

        if ($this->minPrice !== null && $house->getSellingPrize() < $this->minPrice) {
            return false;
        }

        return true;
    }
}
