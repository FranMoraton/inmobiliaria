<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 20:18
 */

namespace App\Domain\Model\Entity\User;


use Throwable;

class UsersDoNotMatches extends \Exception
{
    public function __construct()
    {
        $message = "User Not the Owner";
        $code = 409;
        parent::__construct($message, $code);
    }
}