<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2016-08-27
 * Time: 오후 10:30
 */

namespace Mirage\MainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Collection;
use JMS\Serializer\Annotation\Type as JMSType;
/**
 * @MongoDB\Document
 */
class Reward
{
    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->equipments = new ArrayCollection();
        $this->arks = new ArrayCollection();
        $this->isEnabled = false;
    }

    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Int
     */
    protected $gold;

    /**
     * @MongoDB\Int
     */
    protected $exp;

    /**
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\RewardItems>")
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\RewardItems")
     */
    protected $items = array();

    /**
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\RewardEquipments>")
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\RewardEquipments")
     */
    protected $equipments = array();

    /**
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\RewardArks>")
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\RewardArks")
     */
    protected $arks = array();

    /**
     * @MongoDB\Bool
     */
    protected $isEnabled;

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
     * Set gold
     *
     * @param int $gold
     * @return self
     */
    public function setGold($gold)
    {
        $this->gold = $gold;
        return $this;
    }

    /**
     * Get gold
     *
     * @return int $gold
     */
    public function getGold()
    {
        return $this->gold;
    }

    /**
     * Set exp
     *
     * @param int $exp
     * @return self
     */
    public function setExp($exp)
    {
        $this->exp = $exp;
        return $this;
    }

    /**
     * Get exp
     *
     * @return int $exp
     */
    public function getExp()
    {
        return $this->exp;
    }


    /**
     * Set isEnabled
     *
     * @param bool $isEnabled
     * @return self
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;
        return $this;
    }

    /**
     * Get isEnabled
     *
     * @return bool $isEnabled
     */
    public function getIsEnabled()
    {
        return $this->isEnabled;
    }
}