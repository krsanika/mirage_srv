<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2016-08-17
 * Time: 오후 6:37
 */

namespace Mirage\MainBundle\Document;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Mirage\MainBundle\Game\GameConfig;
use JMS\Serializer\Annotation\Type as JMSType;

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
    protected $idItem;

    /**
     * @MongoDB\Int
     */
    protected $effect;
    /**
     * @MongoDB\Int
     */

    protected $effectSize;

    /**
     * @return mixed
     */
    public function getEffectSize()
    {
        return $this->effectSize;
    }

    /**
     * @param mixed $effectSize
     */
    public function setEffectSize($effectSize)
    {
        $this->effectSize = $effectSize;
    }
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
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\ItemCombine>")
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\ItemCombine")
     */
    protected $combine = array();

    /**
     * Item constructor.
     * @param array $combine
     */
    public function __construct()
    {
        $this->combine = new ArrayCollection();
        $this->combine->add(new ItemCombine());
    }


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
    public function setIdItem($idItem)
    {
        $this->idItem = $idItem;
        return $this;
    }

    /**
     * Get itemId
     *
     * @return int $itemId
     */
    public function getIdItem()
    {
        return $this->idItem;
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
     * @return mixed
     */
    public function getCombine()
    {
        return $this->combine;
    }

    /**
     * @param mixed $combine
     */
    public function setCombine($combine)
    {
        $this->combine = $combine;
    }


    public function deleteId()
    {
        unset($this->id);
        
        return $this;
    }

}
