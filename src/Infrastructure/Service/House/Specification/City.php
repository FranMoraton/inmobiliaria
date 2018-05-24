<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 23/05/2018
 * Time: 14:01
 */

namespace App\Infrastructure\Service\House\Specification;

use Doctrine\ORM\QueryBuilder;

class City implements Specification
{
    private $city;
    public function __construct($city)
    {
        $this->city = $city;
    }
    public function match(QueryBuilder $qb)
    {
        if (null !== $this->city && '' !== $this->city) {
            $qb->andWhere('house.city = :city');
            $qb->setParameter('city', $this->city);
        }
        return $qb->expr()->eq('house.city', ':city');
    }
}
