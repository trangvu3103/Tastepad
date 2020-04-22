<?php
foreach (glob(dirname(dirname(__FILE__))."/class/*.php") as $filename)
{
    include_once $filename;
}
define('root', 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "/");
$currentPage = basename($_SERVER['SCRIPT_FILENAME'], ".php");

 ?>