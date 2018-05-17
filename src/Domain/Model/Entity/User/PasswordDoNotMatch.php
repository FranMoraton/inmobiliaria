<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 19:01
 */

namespace App\Domain\Model\Entity\User;

use App\Domain\Model\HttpResponses\HttpResponses;
use Throwable;

class PasswordDoNotMatch extends \Exception
{
    public function __construct()
    {
        $message = "password do not match";
        $code = HttpResponses::UNAUTHORIZED;
        parent::__construct($message, $code);
    }
}
