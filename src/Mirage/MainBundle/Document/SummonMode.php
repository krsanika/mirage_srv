<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-09-07
 * Time: 오전 3:20
 */

namespace Mirage\MainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Type;

/**
 * @MongoDB\EmbeddedDocument
 */
class SummonMode
{

    /**
     * @MongoDB\Int
     */
    protected $idMode;

    /**
     * @MongoDB\Int
     */
    protected $billingType;

    /**
     * @MongoDB\Int
     */
    protected $price;

    /**
     * @MongoDB\Int
     */
    protected $drawCount;

    /**
     * @MongoDB\Int
     */
    protected $minGrade;

    /**
     * @MongoDB\Bool
     */
    protected $isRepeat;

    /**
     * @MongoDB\Int
     */
    protected $startDay;

    /**
     * @MongoDB\Int
     */
    protected $endDay;

    /**
     * @return mixed
     */
    public function getIdMode()
    {
        return $this->idMode;
    }

    /**
     * @param mixed $modeId
     */
    public function setIdMode($idMode)
    {
        $this->idMode = $idMode;
    }


    /**
     * @return mixed
     */
    public function getBillingType()
    {
        return $this->billingType;
    }

    /**
     * @param mixed $billingType
     */
    public function setBillingType($billingType)
    {
        $this->billingType = $billingType;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDrawCount()
    {
        return $this->drawCount;
    }

    /**
     * @param mixed $drawCount
     */
    public function setDrawCount($drawCount)
    {
        $this->drawCount = $drawCount;
    }

    /**
     * @return mixed
     */
    public function getMinGrade()
    {
        return $this->minGrade;
    }

    /**
     * @param mixed $minGrade
     */
    public function setMinGrade($minGrade)
    {
        $this->minGrade = $minGrade;
    }
    
    /**
     * @return mixed
     */
    public function getIsRepeat()
    {
        return $this->isRepeat;
    }

    /**
     * @param mixed $isRepeat
     */
    public function setIsRepeat($isRepeat)
    {
        $this->isRepeat = $isRepeat;
    }

    /**
     * @return mixed
     */
    public function getStartDay()
    {
        return $this->startDay;
    }

    /**
     * @param mixed $startDay
     */
    public function setStartDay($startDay)
    {
        $this->startDay = $startDay;
    }

    /**
     * @return mixed
     */
    public function getEndDay()
    {
        return $this->endDay;
    }

    /**
     * @param mixed $endDay
     */
    public function setEndDay($endDay)
    {
        $this->endDay = $endDay;
    }










}