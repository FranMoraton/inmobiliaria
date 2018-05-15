<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 19:01
 */

namespace App\Domain\Model\Entity\User;

use Throwable;

class PasswordDoNotMatch extends \Exception
{
    public function __construct()
    {
        $message = "password do not match";
        $code = 400;
        parent::__construct($message, $code);
    }
}
