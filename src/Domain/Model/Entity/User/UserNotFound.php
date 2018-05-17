<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 18:57
 */

namespace App\Domain\Model\Entity\User;

use App\Domain\Model\HttpResponses\HttpResponses;
use Throwable;

class UserNotFound extends \Exception
{
    public function __construct()
    {
        $code = HttpResponses::NOT_FOUND;
        $message = "user not found";
        parent::__construct($message, $code);
    }
}
