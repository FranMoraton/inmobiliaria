<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 23/05/2018
 * Time: 14:01
 */

namespace App\Infrastructure\Service\House\Specification;

use Doctrine\ORM\QueryBuilder;

class Country implements Specification
{
    private $country;
    public function __construct($country)
    {
        $this->country = $country;
    }
    public function match(QueryBuilder $qb)
    {
        if (null !== $this->country && '' !== $this->country) {
            $qb->andWhere('house.country = :country');
            $qb->setParameter('country', $this->country);
        }
        return $qb->expr()->eq('house.country', ':country');
    }
}
