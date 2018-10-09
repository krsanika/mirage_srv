<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2016-08-17
 * Time: 오후 6:37
 */

namespace Mirage\MainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Type;

/**
 * @MongoDB\Document()
 */
class Shop
{
    /**
     * @MongoDB\Id(name="_id")
     */
    protected $id;

    /**
     * @MongoDB\Int
     */
    protected $idShop;

    /**
     * @MongoDB\Int
     */
    protected $startDay;


    /**
     * @MongoDB\Int
     */
    protected $endDay;

    /**
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\ShopProduct")
     * @Type("ArrayCollection<Mirage\MainBundle\Document\ShopProduct>")
     */
    protected $products =array();

    /**
     * Story constructor.
     * @param array $shops
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getIdShop()
    {
        return $this->idShop;
    }

    /**
     * @param mixed $idShop
     */
    public function setIdShop($idShop)
    {
        $this->idShop = $idShop;
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

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param mixed $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

}
