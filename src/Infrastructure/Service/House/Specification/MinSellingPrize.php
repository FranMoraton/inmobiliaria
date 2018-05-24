<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 24/05/2018
 * Time: 8:29
 */

namespace App\Infrastructure\Service\House\Specification;

use Doctrine\ORM\QueryBuilder;

class MinSellingPrize implements Specification
{

    private $minSellingPrize;
    public function __construct($minSellingPrize)
    {
        $this->minSellingPrize = $minSellingPrize;
    }
    public function match(QueryBuilder $qb)
    {
        if (null !== $this->minSellingPrize && '' !== $this->minSellingPrize) {
            $qb->andWhere('house.sellingPrize > :minSellingPrize');
            $qb->setParameter('minSellingPrize', $this->minSellingPrize);
        }
        return $qb->expr()->eq('house.sellingPrize', ':minSellingPrize');
    }
}
