<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2016-08-17
 * Time: 오후 6:39
 */

namespace Mirage\MainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use Mirage\MainBundle\Document\Equipment;
use JMS\Serializer\Annotation\Type as JMSType;
/**
 * @MongoDB\Document
 */
class Gift
{

    /**
     * @MongoDB\Id(name="_id")
     */
    protected $id;

    /**
     * @MongoDB\Int
     */
    protected $idGift;

    /**
     * @JMSType("Mirage\MainBundle\Document\Reward")
     * @MongoDB\ReferenceOne(targetDocument="Mirage\MainBundle\Document\Reward")
     */
    protected $reward;

    /**
     * @MongoDB\Int
     */
    protected $IdNpc;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getIdGift()
    {
        return $this->idGift;
    }

    /**
     * @param mixed $idGift
     */
    public function setIdGift($idGift)
    {
        $this->idGift = $idGift;
    }

    /**
     * @return mixed
     */
    public function getReward()
    {
        return $this->reward;
    }

    /**
     * @param mixed $reward
     */
    public function setReward($reward)
    {
        $this->reward = $reward;
    }

    /**
     * @return mixed
     */
    public function getGiftStrCode()
    {
        return $this->giftStrCode;
    }

    /**
     * @param mixed $giftStrCode
     */
    public function setGiftStrCode($giftStrCode)
    {
        $this->giftStrCode = $giftStrCode;
    }

    /**
     * @return mixed
     */
    public function getIdNpc()
    {
        return $this->IdNpc;
    }

    /**
     * @param mixed $IdNpc
     */
    public function setIdNpc($IdNpc)
    {
        $this->IdNpc = $IdNpc;
    }



}
