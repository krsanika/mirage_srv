<?php

namespace Mirage\MainBundle\Twig;

use Mirage\AdminBundle\Controller\GameConfig;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-19
 * Time: 오전 9:44
 */

class MirageExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
            new \Twig_SimpleFilter('tile', array($this, 'tileStrFilter')),
            new \Twig_SimpleFilter('xtrans', array($this, 'transStrFilter')),
        );
    }

    public function transStrFilter($i){
        $x = array(null, "a", "b", "c");
        return $x[$i];
    }

    public function tileStrFilter($tileType){

        return GameConfig::$TILETYPE[$tileType];
    }
    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$'.$price;

        return $price;
    }

    public function getName()
    {
        return 'mirage_extension';
    }
}