<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 19:41
 */

namespace App\Domain\Model\Entity\Bid;


use App\Domain\Model\HttpResponses\HttpResponses;
use Throwable;

class BidDoNotExist extends \Exception
{
    public function __construct()
    {
        $message = "La puja no existe";
        $code = HttpResponses::NOT_FOUND;
        parent::__construct($message, $code);
    }
}
