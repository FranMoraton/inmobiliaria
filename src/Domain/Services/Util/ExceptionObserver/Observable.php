<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 17/05/2018
 * Time: 18:08
 */

namespace App\Domain\Services\Util\ExceptionObserver;


interface Observable
{
    public function attach(Observer $observer);
    public function notify();
}
