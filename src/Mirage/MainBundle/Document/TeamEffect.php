<?php

namespace Mirage\MainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Collection;
use JMS\Serializer\Annotation\Type as JMSType;

/**
 * @MongoDB\Document
 */
class TeamEffect
{
    /**
    * @MongoDB\Id
    */
    protected $id;

    /**
     * @MongoDB\Int
     */
    protected $idTeamEffect;

    /**
     * @MongoDB\Collection(name="teamMembers")
     */
    protected $teamMembers  = array();

    /**
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\Skill>")
     * @MongoDB\ReferenceMany(targetDocument="Mirage\MainBundle\Document\Skill",  inversedBy="id")
     */
    protected $idSkill = array();

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdTeamEffect()
    {
        return $this->idTeamEffect;
    }

    /**
     * @param mixed $idTeamEffect
     */
    public function setIdTeamEffect($idTeamEffect)
    {
        $this->idTeamEffect = $idTeamEffect;
    }

    /**
     * @return mixed
     */
    public function getTeamMembers()
    {
        return $this->teamMembers;
    }

    /**
     * @param mixed $teamMembers
     */
    public function setTeamMembers($teamMembers)
    {
        $this->teamMembers = $teamMembers;
    }


    /**
     * @return mixed
     */
    public function getIdSkill()
    {
        return $this->idSkill;
    }

    /**
     * @param mixed $idSkill
     */
    public function setIdSkill($idSkill)
    {
        $this->idSkill = $idSkill;
    }


}