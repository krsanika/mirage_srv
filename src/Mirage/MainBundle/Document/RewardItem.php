<?php

namespace Mirage\MainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Collection;
use JMS\Serializer\Annotation\Type as JMSType;
use Mirage\MainBundle\Document\Item;

/**
 * @MongoDB\EmbeddedDocument
 */
class RewardItem
{
    /**
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\Item>")
     * @MongoDB\ReferenceOne(targetDocument="Mirage\MainBundle\Document\Item")
     */
    protected $item;

    /**
     * @MongoDB\Int
     */
    protected $amount;

    /**
     * Set item
     *
     * @param \Mirage\MainBundle\Document\Item $item
     * @return self
     */
    public function setItem(Item $item)
    {
        $this->item = $item;
        return $this;
    }

    /**
     * Get item
     *
     * @return \Mirage\MainBundle\Document\Item $item
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set amount
     *
     * @param int $amount
     * @return self
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Get amount
     *
     * @return int $amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    public function deleteId()
    {
        $this->item->deleteId();

        return $this;
    }
}
