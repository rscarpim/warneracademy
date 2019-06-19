<?php

namespace App\Classes;

class Coupon
{

    public static function FSetCoupon()
    {

        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $res = "";

        for ($i = 0; $i < 10; $i++) {
            $res .= $chars[mt_rand(0, strlen($chars) - 1)];
        }            
        return $res;
    }

}