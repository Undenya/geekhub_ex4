<?php
/**
 * Created by PhpStorm.
 * User: UnDenya
 * Date: 04.11.2018
 * Time: 14:52
 */
namespace Undenya\Images;
class Logger
{
    const LOG_DIR = __DIR__ . "/error.log";
    var $date;

    function __construct()
    {
        $this->date = date("Y-m-d H:i:s");
    }

    function setErrorLog($error)
    {
        error_log($this->date." ".$error, 3, self::LOG_DIR);
    }
}