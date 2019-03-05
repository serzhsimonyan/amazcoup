<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psy\Util\Str;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\CssSelector;
use App\Helpers\StringHelper;


class GazzleClass
{

    public static function getDataFromWebsite($url)
    {
        $client = new Client();
        $response = $client->get($url);
        $html = $response->getBody()->getContents();
        $crawler = new Crawler($html);

       /////////////////////rating stars/////////////
        $starsCrawler = $crawler->filter('.a-icon-star>span');
        $rating = ($starsCrawler->count())? StringHelper::getRatingStars($starsCrawler->text()):null;
        ////////////description/////////
        
        $descriptionCrawler = $crawler->filter('#feature-bullets ul>li>span');
        $description = ($descriptionCrawler->count()) ? StringHelper::prettyDescriptionGazzle(
            $descriptionCrawler->each(function (Crawler $node)  {
                if(!strpos($node->text(),"Make sure this fits")) {return $node->text();};
            })) : null;

        
        //////////////image////
        
        $imageCrawler1 = $crawler->filter('#leftCol img');
        $imageCrawler2 = $crawler->filter('#heroImage img');

        if ($imageCrawler1->count()) {
            $image = StringHelper::getImageSrc($imageCrawler1->first()->attr('src') );
        } elseif ($imageCrawler2->count()) {
            $image = StringHelper::getImageSrc($imageCrawler2->first()->attr('src') );
        } else {
            $image = null;
        };
        //////////title//////////
        
        $titleCrawler = $crawler->filter('#productTitle');
        $title = ($titleCrawler->count()) ? trim(StringHelper::deleteSpaces($titleCrawler->first()->text())) : null;
        if(strlen($title)>190) $title = substr($title,0,189);
        ////////////old price///////////
        
        $oldPriceCrawler1 = $crawler->filter('#priceblock_ourprice');
        $oldPriceCrawler2 = $crawler->filter('#centerCol .a-color-price');

        if ($oldPriceCrawler1->count() and StringHelper::unavailablePriceGuzzle($oldPriceCrawler1) and StringHelper::isPrice($oldPriceCrawler1) ) {
            $oldPrice = StringHelper::prettyPriceGuzzle($oldPriceCrawler1);
        } elseif ($oldPriceCrawler2->count() and StringHelper::unavailablePriceGuzzle($oldPriceCrawler2) and StringHelper::isPrice($oldPriceCrawler2)) {
            $oldPrice = StringHelper::prettyPriceGuzzle($oldPriceCrawler2);
        } else {
            $oldPrice = null;
        }


        //////////new price//////////
        $newPriceCrawler1 = $crawler->filter('#olp_feature_div a');
        $newPriceCrawler2 = $crawler->filter('#buybox_feature_div a');
        $newPriceCrawler3 = $crawler->filter('#toggleBuyBox span');

        if ($newPriceCrawler1->count() and StringHelper::isPrice($newPriceCrawler1)) {
            $newPrice = StringHelper::prettyPriceGuzzle($newPriceCrawler1);
        } elseif ($newPriceCrawler2->count() and StringHelper::isPrice($newPriceCrawler2)) {
            $newPrice = StringHelper::prettyPriceGuzzle($newPriceCrawler2);
        } elseif($newPriceCrawler3->count() and StringHelper::isPrice($newPriceCrawler3)){
            $newPrice = StringHelper::prettyPriceGuzzle($newPriceCrawler3);
        } else {
            $newPrice = null;
        };
        


        if($newPrice>$oldPrice and $oldPrice) {
            $discount_price= $oldPrice;
            $oldPrice = $newPrice;
            $newPrice = $discount_price;
        }

       return  [
            'title' => $title,
            'url' => StringHelper::makeUrl($url),
            'slug' => StringHelper::titleToSlug($title),
            'asin' => StringHelper::makeAsinFromUrl($url),
            'image' => $image,
            'price' => $oldPrice,
            'rating' => $rating,
            'description' => $description,
            'discount_price' => null,
        ];
    }
    
}