<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 17/05/2018
 * Time: 22:10
 */

namespace App\Application\Bid\ListBidById;

use Assert\Assertion;

class ListBidByIdCommand
{
    private $id;

    /**
     * ListBidByIdCommand constructor.
     * @param $id
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($id)
    {
        Assertion::numeric($id);
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}
