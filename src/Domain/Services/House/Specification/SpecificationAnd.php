<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 11:19
 */

namespace App\Domain\Services\House\Specification;

use App\Domain\Model\Entity\House\House;

class SpecificationAnd implements Specification
{
    private $specifications;

    public function __construct()
    {
        $this->specifications = [];
    }

    public function addSpecification(Specification $specification)
    {
        $this->specifications [] = $specification;
    }

    public function isSatisfiedBy(House $house): bool
    {
        foreach ($this->specifications as $specification) {
            if (false === $specification->isSatisfiedBy($house)) {
                return false;
            }
        }
        return true;
    }
}
