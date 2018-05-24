<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 23/05/2018
 * Time: 14:01
 */

namespace App\Infrastructure\Service\House\Specification;

use Doctrine\ORM\QueryBuilder;

class MaxSellingPrize implements Specification
{

    private $maxSellingPrize;
    public function __construct($maxSellingPrize)
    {
        $this->maxSellingPrize = $maxSellingPrize;
    }
    public function match(QueryBuilder $qb)
    {
        if (null !== $this->maxSellingPrize && '' !== $this->maxSellingPrize) {
            $qb->andWhere('house.sellingPrize < :maxSellingPrize');
            $qb->setParameter('maxSellingPrize', $this->maxSellingPrize);
        }
        return $qb->expr()->eq('house.sellingPrize', ':maxSellingPrize');
    }
}
