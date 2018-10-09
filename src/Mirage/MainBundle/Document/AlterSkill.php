<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2017-02-14
 * Time: 오후 12:08
 */

namespace Mirage\MainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Type as JMSType;
/**
 * @MongoDB\EmbeddedDocument
 */
class AlterSkill
{
    /**
     * @MongoDB\Int
     */
    protected $skillSlotNumber;

    /**
     * @JMSType("Mirage\MainBundle\Document\Skill")
     * @MongoDB\ReferenceOne(targetDocument="Mirage\MainBundle\Document\Skill",  inversedBy="id")
     */
    protected $skill;

    /**
     * @return mixed
     */
    public function getSkillSlotNumber()
    {
        return $this->skillSlotNumber;
    }

    /**
     * @param mixed $skillSlotNumber
     */
    public function setSkillSlotNumber($skillSlotNumber)
    {
        $this->skillSlotNumber = $skillSlotNumber;
    }
    
    /**
     * Set skill
     *
     * @param Mirage\MainBundle\Document\Skill $skill
     * @return self
     */
    public function setSkill(\Mirage\MainBundle\Document\Skill $skill)
    {
        $this->skill = $skill;
        return $this;
    }

    /**
     * Get skill
     *
     * @return Mirage\MainBundle\Document\Skill $skill
     */
    public function getSkill()
    {
        return $this->skill;
    }

}