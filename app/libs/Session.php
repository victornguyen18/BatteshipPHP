<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 08-Mar-18
 * Time: 01:44 AM
 */
class Session
{
    public static function init(){

        $session_id = session_id();
        if (empty($session_id)) {
            session_start();
        }
    }
    public static function set($key, $value){
        $_SESSION[$key] = $value;
    }

    public static function get($key){
        return array_key_exists($key, $_SESSION)? $_SESSION[$key]: null;
    }

    public static function getAndDestroy($key){

        if(array_key_exists($key, $_SESSION)){

            $value = $_SESSION[$key];
            $_SESSION[$key] = null;
            unset($_SESSION[$key]);

            return $value;
        }

        return null;
    }

    public static function destroy($key){
        if(array_key_exists($key, $_SESSION)){
            $_SESSION[$key] = null;
            unset($_SESSION[$key]);
        }
    }
    public static function destroyAll(){
        session_start();
        session_destroy();
    }
}