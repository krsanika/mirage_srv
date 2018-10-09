<?php

namespace Mirage\MainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Collection;
use JMS\Serializer\Annotation\Type as JMSType;

/**
 * @MongoDB\EmbeddedDocument
 */
class RewardEquipment
{

    /**
     * @MongoDB\ReferenceOne(targetDocument="Mirage\MainBundle\Document\Equipment")
     */
    protected $equipment;

    /**
     * @MongoDB\Int
     */
    protected $amount;

    /**
     * Set equipment
     *
     * @param \Mirage\MainBundle\Document\Equipment $equipment
     * @return self
     */
    public function setEquipment(\Mirage\MainBundle\Document\Equipment $equipment)
    {
        $this->equipment = $equipment;
        return $this;
    }

    /**
     * Get equipment
     *
     * @return \Mirage\MainBundle\Document\Equipment $equipment
     */
    public function getEquipment()
    {
        return $this->equipment;
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
        $this->equipment->deleteId();

        return $this;
    }
}
