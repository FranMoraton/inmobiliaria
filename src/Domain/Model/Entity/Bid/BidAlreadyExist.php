<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 18/05/2018
 * Time: 8:16
 */

namespace App\Domain\Model\Entity\Bid;

use App\Domain\Model\HttpResponses\HttpResponses;

class BidAlreadyExist extends \Exception
{
    public function __construct()
    {
        $message = "Bid Already Exist";
        $code = HttpResponses::CONFLICT_SEARCH;
        parent::__construct($message, $code);
    }
}
