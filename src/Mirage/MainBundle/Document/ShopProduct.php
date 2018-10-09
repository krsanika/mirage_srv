<?php
/**
 * Created by PhpStorm.
 * User: Krsanika
 * Date: 2016-08-17
 * Time: 오후 6:37
 */

namespace Mirage\MainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Type as JMSType;

/**
 * @MongoDB\EmbeddedDocument
 */
class ShopProduct
{

    public function __construct()
    {
    }


    /**
     * @MongoDB\Int
     */
    protected $idItem;

    /**
     * @MongoDB\Int
     */
    protected $idEquipment;

    /**
     * @MongoDB\Int
     */
    protected $idArkphase;

    /**
     * @MongoDB\Int
     */
    protected $currency;

    /**
     * @MongoDB\Int
     */
    protected $cost;

    /**
     * @MongoDB\Int
     */
    protected $stack;

    /**
     * @return mixed
     */
    public function getIdItem()
    {
        return $this->idItem;
    }

    /**
     * @param mixed $idItem
     */
    public function setIdItem($idItem)
    {
        $this->idItem = $idItem;
    }

    /**
     * @return mixed
     */
    public function getIdEquipment()
    {
        return $this->idEquipment;
    }

    /**
     * @param mixed $idEquipment
     */
    public function setIdEquipment($idEquipment)
    {
        $this->idEquipment = $idEquipment;
    }

    /**
     * @return mixed
     */
    public function getIdArkphase()
    {
        return $this->idArkphase;
    }

    /**
     * @param mixed $idArkphase
     */
    public function setIdArkphase($idArkphase)
    {
        $this->idArkphase = $idArkphase;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param mixed $cost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    /**
     * @return mixed
     */
    public function getStack()
    {
        return $this->stack;
    }

    /**
     * @param mixed $stack
     */
    public function setStack($stack)
    {
        $this->stack = $stack;
    }




}
