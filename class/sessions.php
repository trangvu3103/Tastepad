<?php
    class Session{
    	private function __construct(){

    	}
    	public static function set($name, $val){
    	  $_SESSION[$name]=$val;
    	}
    	public static function get($name)
    	{
    	  return $_SESSION[$name];
    	}
    }
?>