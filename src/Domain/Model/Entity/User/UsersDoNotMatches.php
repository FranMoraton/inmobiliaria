<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 20:18
 */

namespace App\Domain\Model\Entity\User;


use App\Domain\Model\HttpResponses\HttpResponses;
use Throwable;

class UsersDoNotMatches extends \Exception
{
    public function __construct()
    {
        $message = "User Not the Owner";
        $code = HttpResponses::UNAUTHORIZED;
        parent::__construct($message, $code);
    }
}