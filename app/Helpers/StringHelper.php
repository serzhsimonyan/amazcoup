<?php

namespace App\Helpers;

class StringHelper {

    public static function prettyPriceGuzzle($text)
    {
        $text = $text->text();
        $price =  substr($text, strpos($text,'$')+1);
        return is_numeric($price)? $price : null;
    }
    
    public static function isPrice($text) {
        $text = $text->text();
        return is_numeric(substr($text, strpos($text,'$')+1));
    }
    
    public static function getImageSrc($src) {
        return substr_replace($src,'',strpos($src,'._'), (strpos($src,'_.')-strpos($src,'._')+1));
    }

    public static function unavailablePriceGuzzle($text) {
        return strpos($text->text(), "Currently unavailable.") == null;
    }
    
    public static function prettyDescriptionGazzle($array) {
       return self::deleteSpaces(implode(" ",$array));
    }
    
    public static function titleToSlug ($title) {
        return mb_strtolower(trim(implode("-",explode(' ',preg_replace('/\s+/',' ',preg_replace('/[^\p{L}\p{N}\s]/u', ' ', str_replace(['&','+'],'and',$title))))),'-'),'UTF-8');
    }

    public static function deleteSpaces( $text) {
       return preg_replace('/\s+/', ' ', str_replace(["\n", "\t"], '', $text));
    }
    
    public static function makeAsinFromUrl($url) {
        return substr($url,strpos($url,'/dp/')+4);
    }

    public static function getRatingStars($text) {
        return trim(substr($text,0, strpos($text,' ')));
    }

    public static function makeUrl($url) {
       return substr($url,0,strpos($url,'/',10)).substr($url,strpos($url,'/dp')).'/?tag=asinkey2277-20&ascsubtag=default';
    }

}