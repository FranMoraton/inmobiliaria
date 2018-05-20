<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 18:01
 */

namespace App\Domain\Model\Entity\Bid;

use App\Domain\Model\HttpResponses\HttpResponses;

class UserHasNotBids extends \Exception
{

    public function __construct()
    {
        $message = "The User Has Not Bids";
        $code = HttpResponses::NOT_FOUND;
        parent::__construct($message, $code);
    }
}
