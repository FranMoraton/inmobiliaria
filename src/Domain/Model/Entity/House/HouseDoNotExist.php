<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 21:10
 */

namespace App\Domain\Model\Entity\House;

use App\Domain\Model\HttpResponses\HttpResponses;
use Throwable;

class HouseDoNotExist extends \Exception
{
    public function __construct()
    {
        $message = "House Not Found";
        $code = HttpResponses::NOT_FOUND;
        parent::__construct($message, $code);
    }
}
