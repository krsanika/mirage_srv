<?php

namespace Mirage\MainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Collection;
use JMS\Serializer\Annotation\Type as JMSType;

/**
 * @MongoDB\EmbeddedDocument
 */
class RewardArk
{

    /**
     * @MongoDB\ReferenceOne(targetDocument="Mirage\MainBundle\Document\Ark")
     */
    protected $ark;

    /**
     * @MongoDB\Int
     */
    protected $idPhase;

    /**
     * @MongoDB\Int
     */
    protected $amount;


    /**
     * Set ark
     *
     * @param \Mirage\MainBundle\Document\Ark $ark
     * @return self
     */
    public function setArk(\Mirage\MainBundle\Document\Ark $ark)
    {
        $this->ark = $ark;
        return $this;
    }

    /**
     * Get ark
     *
     * @return \Mirage\MainBundle\Document\Ark $ark
     */
    public function getArk()
    {
        return $this->ark;
    }

    /**
     * @return mixed
     */
    public function getIdPhase()
    {
        return $this->idPhase;
    }

    /**
     * @param mixed $idPhase
     */
    public function setIdPhase($idPhase)
    {
        $this->idPhase = $idPhase;
    }


    public function deleteId()
    {
        $this->ark->deleteId();

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    
}
