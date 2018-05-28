<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 17/05/2018
 * Time: 18:08
 */

namespace App\Domain\Services\Util\ExceptionObserver;

class ListException implements Observable
{
    private static $instance;
    /* @var Observer[] $observers */
    private $observers;
    private $exceptions;

    public function __construct()
    {
        $this->observers = [];
        $this->exceptions = [];
    }

    public static function instance(): ListException
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function restartExceptions()
    {
        $this->observers = [];
        $this->exceptions = [];
    }

    public function checkForException()
    {
        return 0 !== count($this->exceptions);
    }

    public function firstException()
    {
        return $this->exceptions[0];
    }

    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function notify()
    {
        $this->exceptions = [];
        foreach ($this->observers as $observer) {
            try {
                $observer->update();
            } catch (\Exception $exception) {
                $this->exceptions[] = [
                    'data' => $exception->getMessage(),
                    'code' => $exception->getCode()
                ];
            }
        }
    }
}
