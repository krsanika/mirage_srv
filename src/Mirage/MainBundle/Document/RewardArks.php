<?php

namespace Mirage\MainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Collection;
use JMS\Serializer\Annotation\Type as JMSType;

/**
 * @MongoDB\EmbeddedDocument
 */
class RewardArks
{

    /**
     * @MongoDB\ReferenceOne(targetDocument="Mirage\MainBundle\Document\Ark")
     */
    protected $ark;

    /**
     * @MongoDB\Int
     */
    protected $phaseId;

    /**
     * Set ark
     *
     * @param Mirage\MainBundle\Document\Ark $ark
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
     * @return Mirage\MainBundle\Document\Ark $ark
     */
    public function getArk()
    {
        return $this->ark;
    }

    /**
     * Set phaseId
     *
     * @param int $phaseId
     * @return self
     */
    public function setPhaseId($phaseId)
    {
        $this->phaseId = $phaseId;
        return $this;
    }

    /**
     * Get phaseId
     *
     * @return int $phaseId
     */
    public function getPhaseId()
    {
        return $this->phaseId;
    }
}
