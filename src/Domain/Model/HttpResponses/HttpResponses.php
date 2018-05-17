<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 17/05/2018
 * Time: 18:16
 */

namespace App\Domain\Model\HttpResponses;


class HttpResponses
{
    const BAD_REQUEST = 400;
    const NOT_FOUND = 404;
    const UNAUTHORIZED = 401;
    const CONFLICT_SEARCH = 409;
    const OK = 200;
    const KO = 500;
}
