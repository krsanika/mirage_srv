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
use Mirage\AdminBundle\Controller\GameConfig;

/**
 * @MongoDB\Document
 */

class Item
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Int
     */
    protected $itemId;

    /**
     * @MongoDB\String
     */
    protected $name_kr;

    /**
     * @MongoDB\String
     */
    protected $name_jp;

    /**
     * @MongoDB\String
     */
    protected $effect;

    /**
     * @MongoDB\Int
     */
    protected $type;

    /**
     * @MongoDB\Int
     */
    protected $tier;

    /**
     * @MongoDB\Int
     */
    protected $material;

    /**
     * @MongoDB\String
     */
    protected $description;



    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set itemId
     *
     * @param int $itemId
     * @return self
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
        return $this;
    }

    /**
     * Get itemId
     *
     * @return int $itemId
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set nameKr
     *
     * @param string $nameKr
     * @return self
     */
    public function setNameKr($nameKr)
    {
        $this->name_kr = $nameKr;
        return $this;
    }

    /**
     * Get nameKr
     *
     * @return string $nameKr
     */
    public function getNameKr()
    {
        return $this->name_kr;
    }

    /**
     * Set nameJp
     *
     * @param string $nameJp
     * @return self
     */
    public function setNameJp($nameJp)
    {
        $this->name_jp = $nameJp;
        return $this;
    }

    /**
     * Get nameJp
     *
     * @return string $nameJp
     */
    public function getNameJp()
    {
        return $this->name_jp;
    }

    /**
     * Set effect
     *
     * @param string $effect
     * @return self
     */
    public function setEffect($effect)
    {
        $this->effect = $effect;
        return $this;
    }

    /**
     * Get effect
     *
     * @return string $effect
     */
    public function getEffect()
    {
        return $this->effect;
    }

    /**
     * Set type
     *
     * @param int $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return int $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set tier
     *
     * @param int $tier
     * @return self
     */
    public function setTier($tier)
    {
        $this->tier = $tier;
        return $this;
    }

    /**
     * Get tier
     *
     * @return int $tier
     */
    public function getTier()
    {
        return $this->tier;
    }

    /**
     * Set material
     *
     * @param int $material
     * @return self
     */
    public function setMaterial($material)
    {
        $this->material = $material;
        return $this;
    }

    /**
     * Get material
     *
     * @return int $material
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }
}
