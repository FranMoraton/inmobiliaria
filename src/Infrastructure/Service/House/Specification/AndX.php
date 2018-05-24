<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 24/05/2018
 * Time: 10:13
 */

namespace App\Infrastructure\Service\House\Specification;

use Doctrine\ORM\QueryBuilder;

class AndX implements Specification
{
    private $children;
    public function __construct()
    {
        $this->children = func_get_args();
    }
    public function match(QueryBuilder $qb)
    {
        return call_user_func_array(
            array($qb->expr(), 'andX'),
            array_map(
                function ($specification) use ($qb) {
                    return $specification->match($qb);
                },
                $this->children
            )
        );
    }
}