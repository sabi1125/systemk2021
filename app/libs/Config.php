<?php
if(false == defined('BASEPATH')) {
    define('BASEPATH', realpath(__DIR__ . '/..'));
}
class Config {
    public static function get(string $name , $default = null) {
        if(null === static::$config) {
            $common = require(BASEPATH . '/common.config');
            $env = require(BASEPATH . '/environment.config');
            static::$config = $env + $common;
        }
        return static::$config[$name] ?? $default;
    }
    private static $config = null;
}
