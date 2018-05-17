<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 20:15
 */

namespace App\Domain\Services\User;


use App\Domain\Model\Entity\User\User;
use App\Domain\Model\Entity\User\UsersDoNotMatches;
use App\Domain\Services\Util\ExceptionObserver\ListException;
use App\Domain\Services\Util\ExceptionObserver\Observer;

class CheckUsersAreEquals implements Observer
{
    private $stateException;
    public function __construct()
    {
        $this->stateException = false;
    }

    public function __invoke(User $user, User $user2)
    {
        if ($user !== $user) {
            $this->stateException = true;
            ListException::instance()->notify();
        }
    }

    /**
     * @throws UsersDoNotMatches
     */
    public function update()
    {
        if($this->stateException){
            throw new UsersDoNotMatches();
        }

    }
}
