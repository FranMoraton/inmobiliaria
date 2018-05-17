<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 19:58
 */

namespace App\Domain\Services\User;

use App\Domain\Model\Entity\User\PasswordDoNotMatch;
use App\Domain\Services\Util\ExceptionObserver\ListException;
use App\Domain\Services\Util\ExceptionObserver\Observer;

class CheckPasswordForLogIn implements Observer
{
    private $stateException;
    public function __construct()
    {
        $this->stateException = false;
    }


    public function __invoke(string $findUserPassword, string $passwordRequest)
    {
        if (false === password_verify($passwordRequest, $findUserPassword)) {
            $this->stateException = true;
            ListException::instance()->notify();
        }
    }

    /**
     * @throws PasswordDoNotMatch
     */
    public function update()
    {
        if($this->stateException) {
            throw new PasswordDoNotMatch();
        }
    }
}
