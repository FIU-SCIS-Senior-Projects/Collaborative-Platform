<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArrayUtils
 *
 * @author aalfonso
 */
class ArrayUtils  extends CComponent {
  
      public static function getValueOrDefault($array, $key, $default=null) 
    {
        return array_key_exists ($key ,$array )  ? $array[$key] : $default;
    }  
    
}
