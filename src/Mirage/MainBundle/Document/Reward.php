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
use Mirage\MainBundle\Document\RewardArk;
use Mirage\MainBundle\Document\RewardEquipment;
use Mirage\MainBundle\Document\RewardItem;
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

    protected $idReward;
    /**
     * @MongoDB\Int
     */
    protected $gold;


    /**
     * @MongoDB\Int
     */
    protected $jewel;

    /**
     * @MongoDB\Int
     */
    protected $exp;

    /**
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\RewardItem>")
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\RewardItem")
     */
    protected $items = array();

    /**
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\RewardEquipment>")
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\RewardEquipment")
     */
    protected $equipments = array();

    /**
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\RewardArk>")
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\RewardArk")
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
     * @return mixed
     */
    public function getIdReward()
    {
        return $this->idReward;
    }

    /**
     * @param mixed $idReward
     */
    public function setIdReward($idReward)
    {
        $this->idReward = $idReward;
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
     * Get jewel
     *
     * @return int $jewel
     */
    public function getJewel()
    {
        return $this->jewel;
    }

    /**
     * Set jewel
     *
     * @param int $jewel
     * @return self
     */
    public function setJewel($jewel)
    {
        $this->jewel = $jewel;
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

    /**
     * Add item
     *
     * @param RewardItems $item
     */
    public function addItem(RewardItem $item)
    {
        $this->items[] = $item;
    }

    /**
     * Remove item
     *
     * @param RewardItem $item
     */
    public function removeItem(RewardItem $item)
    {
        $this->items->removeElement($item);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection $items
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param mixed $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * @param mixed $equipments
     */
    public function setEquipments($equipments)
    {
        $this->equipments = $equipments;
    }

    /**
     * Get arks
     *
     * @return \Doctrine\Common\Collections\Collection $arks
     */
    public function getArks()
    {
        return $this->arks;
    }

    /**
     * @param mixed $arks
     */
    public function setArks($arks)
    {
        $this->arks = $arks;
    }

    

    /**
     * Add equipment
     *
     * @param \Mirage\MainBundle\Document\RewardEquipments $equipment
     */
    public function addEquipment(RewardEquipment $equipment)
    {
        $this->equipments[] = $equipment;
    }

    /**
     * Remove equipment
     *
     * @param \Mirage\MainBundle\Document\RewardEquipments $equipment
     */
    public function removeEquipment(RewardEquipment $equipment)
    {
        $this->equipments->removeElement($equipment);
    }

    /**
     * Get equipments
     *
     * @return \Doctrine\Common\Collections\Collection $equipments
     */
    public function getEquipments()
    {
        return $this->equipments;
    }

    /**
     * Add ark
     *
     * @param \Mirage\MainBundle\Document\RewardArks $ark
     */
    public function addArk(RewardArk $ark)
    {
        $this->arks[] = $ark;
    }

    /**
     * Remove ark
     *
     * @param \Mirage\MainBundle\Document\RewardArk $ark
     */
    public function removeArk(RewardArk $ark)
    {
        $this->arks->removeElement($ark);
    }

    /**
     * @param mixed $rewardStr
     */
    public function getRewardStr()
    {
        $rewardStr = "";
        $rewardStr = "g".$this->gold.",e".$this->exp.",";

        foreach($this->getArks() as $ark)
        {
            $arkStr = "a".$ark->getArk()->getIdArk()."p".$ark->getIdPhase().",";
            $rewardStr .= $arkStr;
        }

        foreach($this->getEquipments() as $equipment)
        {
            $equipStr = "q".$equipment->getEquipment()->getIdEquipment()."x".$equipment->getAmount().",";
            $rewardStr .= $equipStr;
        }
        foreach($this->getItems() as $item){
            $itemStr = "i".$item->getItem()->getIdItem()."x".$item->getAmount().",";
            $rewardStr .= $itemStr;
        }
//        $this->rewardStr = substr($this->rewardStr, 0, -1);
        return $rewardStr;
    }

    public function deleteId()
    {
        unset($this->id);
        foreach($this->items as $item)
        {
            $item->deleteId();
        }
        foreach($this->equipments as $equipment)
        {
            $equipment->deleteId();
        }
        foreach($this->arks as $ark)
        {
            $ark->deleteId();
        }

        return $this;
    }
}
