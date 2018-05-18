<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 18/05/2018
 * Time: 8:15
 */

namespace App\Domain\Model\Entity\House;


use App\Domain\Model\HttpResponses\HttpResponses;

class HouseAlreadyExist extends \Exception
{
    public function __construct()
    {
        $message = "House Already Exist";
        $code = HttpResponses::CONFLICT_SEARCH;
        parent::__construct($message, $code);
    }
}
