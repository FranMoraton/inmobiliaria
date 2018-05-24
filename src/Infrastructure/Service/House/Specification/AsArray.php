<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 24/05/2018
 * Time: 10:14
 */

namespace App\Infrastructure\Service\House\Specification;

use Doctrine\ORM\QueryBuilder;

class AsArray implements Specification
{
    private $parent;
    public function __construct(Specification $parent)
    {
        $this->parent = $parent;
    }
    public function match(QueryBuilder $qb)
    {
        return $this->parent->match($qb);
    }
}