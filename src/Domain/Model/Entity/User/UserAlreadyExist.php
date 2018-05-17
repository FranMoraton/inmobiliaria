<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 19:39
 */

namespace App\Domain\Model\Entity\User;

use App\Domain\Model\HttpResponses\HttpResponses;
use Throwable;

class UserAlreadyExist extends \Exception
{
    public function __construct()
    {
        $message = "User Already Exist";
        $code = HttpResponses::CONFLICT_SEARCH;
         parent::__construct($message, $code);
    }
}
