<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 15:19
 */

namespace App\Application\House\ListHouseById;

use Assert\Assertion;

class ListHouseByIdCommand
{
    private $id;

    /**
     * ListHouseByIdCommand constructor.
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
