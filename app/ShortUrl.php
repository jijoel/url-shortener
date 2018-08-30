<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    protected $primaryKey = 'short';
    public $incrementing = false;
    protected $table = 'shorteners';

    /**
     * Makes a short link of alphanumeric characters
     */
    public static function makeShortLink()
    {
        $valid = 'abcdefghijklmnopqrstuwvxyzABCDEFGHIJKLMNOPQRSTUWVXYZ0123456789';

        // it's possible that the resulting
        // string will already be in the system.
        // If so, try again
        while(true) {
            $string = '';
            $hex = uniqid();

            // uniqid is 13 characters. we need an even
            // number, and characters on the right are
            // more random, so start at the second character
            for ($i = 1; $i < strlen($hex); $i+=2) {
                $decimal = hexdec($hex[$i].$hex[$i+1]);
                $alpha = chr($decimal);

                // force it to an alphanumeric character
                $string .= (strpos($valid, $alpha) === false)
                    ? $valid[$decimal % strlen($valid)]
                    : $alpha;

                if(strpos($valid, $alpha) !== FALSE)
                    $string .= $alpha;
            }

            if (! self::find($string))
                return $string;
        }
    }
}
