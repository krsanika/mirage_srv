<?php

namespace Mirage\MainBundle\Twig;

use Mirage\MainBundle\Game\GameConfig;
use Symfony\Component\DomCrawler\Crawler;

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
/*            new \Twig_SimpleFilter('xtrans', array($this, 'transStrFilter')),*/
            new \Twig_SimpleFilter('grade', array($this, 'gradeStrFilter')),
            new \Twig_SimpleFilter('title', array($this, 'titleStrFilter')),
            new \Twig_SimpleFilter('origin', array($this, 'originStrFilter')),
            new \Twig_SimpleFilter('phaseType', array($this, 'phaseTypeStrFilter')),
            new \Twig_SimpleFilter('summonName', array($this, 'summonNameStrFilter')),
            new \Twig_SimpleFilter('str', array($this, 'stringTableStrFilter')),
        );
    }
/*
    public function transStrFilter($i){
        $x = array(null, "a", "b", "c");
        return $x[$i];
    }
*/
    public function gradeStrFilter($grade){
        return GameConfig::$GRADESTR_KR[$grade];
    }

    public function titleStrFilter($title){
        return GameConfig::$TITLESTR_KR[$title];
    }

    public function originStrFilter($origin){
        return GameConfig::$ORIGINSTR_KR[$origin];
    }

    public function tileStrFilter($tileType){

        return GameConfig::$TILETYPE[$tileType];
    }

    public function summonNameStrFilter($summonName){

        return GameConfig::$SUMMON_NAME_STR[$summonName];
    }

    public function phaseTypeStrFilter($type){

        return GameConfig::$TYPESTR_KR[$type];
    }


    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$'.$price;

        return $price;
    }

    public function stringTableStrFilter($code, $genre, $type){
        $crawler = new Crawler();
        $crawler->addXmlContent(file_get_contents(__DIR__.'/../../../../web/bundles/admin/'.$genre.'.xml'), 'UTF-8');
        try{
            $value = $crawler->filterXPath('//StringTable//'.$genre.'[@id="'.$code.'"]//'.$type)->text();
        }catch(\InvalidArgumentException $e){
            $value = "값없음";
        }
        return $value;
    }

    public function getName()
    {
        return 'mirage_extension';
    }
}