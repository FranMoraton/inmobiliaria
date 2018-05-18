<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 18/05/2018
 * Time: 10:00
 */

namespace App\Domain\Model\Entity\Bid;

use App\Domain\Model\HttpResponses\HttpResponses;

class BidUnderTheMin extends \Exception
{
    public function __construct()
    {
        $message = "Bid Under The Minimum";
        $code = HttpResponses::CONFLICT_SEARCH;
        parent::__construct($message, $code);
    }
}
