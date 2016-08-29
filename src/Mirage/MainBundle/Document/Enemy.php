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
use Mirage\AdminBundle\Controller\GameConfig;
use Mirage\MainBundle\Document\Equipment;
use JMS\Serializer\Annotation\Type as JMSType;
/**
 * @MongoDB\Document
 */
class Enemy
{

    /**
     * @MongoDB\Id(name="_id")
     */
    protected $id;

    /**
     * @MongoDB\Int
     */
    protected $mobId;

    /**
     * @JMSType("Mirage\MainBundle\Document\Ark")
     * @MongoDB\ReferenceOne(targetDocument="Mirage\MainBundle\Document\Ark")
     */
    protected $ark;

    /**
     * @MongoDB\Int
     */
    protected $phaseId;

    /**
     * @MongoDB\Int
     */
    protected $lv;

    /**
     * @MongoDB\Int
     */
    protected $skillOpen;

    /**
     * @MongoDB\String
     */
    protected $description;

    /**
     * @MongoDB\Collection
     */
    protected $modify = array();

    /**
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\Equipment>")
     * @MongoDB\ReferenceMany(targetDocument="Mirage\MainBundle\Document\Equipment",  inversedBy="id")
     */
    protected $equipments = array();


    public function __construct()
    {
        $this->modify = new ArrayCollection();
        $this->equipments = new ArrayCollection();
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
     * Set mobId
     *
     * @param int $mobId
     * @return self
     */
    public function setMobId($mobId)
    {
        $this->mobId = $mobId;
        return $this;
    }

    /**
     * Get mobId
     *
     * @return int $mobId
     */
    public function getMobId()
    {
        return $this->mobId;
    }


    /**
     * @return array
     */
    public function getArk()
    {
        return $this->ark;
    }

    /**
     * @param array $ark
     */
    public function setArk($ark)
    {
        $this->ark = $ark;
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

    /**
     * Set lv
     *
     * @param int $lv
     * @return self
     */
    public function setLv($lv)
    {
        $this->lv = $lv;
        return $this;
    }

    /**
     * Get hp
     *
     * @return int $lv
     */
    public function getLv()
    {
        return $this->lv;
    }

    /**
     * Set skillOpen
     *
     * @param int $skillOpen
     * @return self
     */
    public function setSkillOpen($skillOpen)
    {
        $this->skillOpen = $skillOpen;
        return $this;
    }

    /**
     * Get skillOpen
     *
     * @return int $skillOpen
     */
    public function getSkillOpen()
    {
        return $this->skillOpen;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set modify
     *
     * @param collection $modify
     * @return self
     */
    public function setModify($modify)
    {
        $this->modify = $modify;
        return $this;
    }

    /**
     * Get modify
     *
     * @return collection $modify
     */
    public function getModify()
    {
        return $this->modify;
    }


    public function addEquipment(Equipment $equipment)
    {
        $this->equipments[] = $equipment;
    }


    public function removeEquipment(Equipment $equipment)
    {
        $this->equipments->removeElement($equipment);
    }

    /**
     * Set equipments
     *
     * @param collection $equipments
     * @return self
     */
    public function setEquipments($equipments)
    {
        $this->equipments = $equipments;
        return $this;
    }

    /**
     * Get equipments
     *
     * @return collection
     */
    public function getEquipments()
    {
        return $this->equipments;
    }


    public function addArk(\Mirage\MainBundle\Document\Ark $ark)
    {
        $this->ark[] = $ark;
    }


    public function removeArk(\Mirage\MainBundle\Document\Ark $ark)
    {
        $this->ark->removeElement($ark);
    }

    public function testUnset($phaseId)
    {
        unset($this->equipments);
        return $this;
    }


    public function deleteId()
    {
        unset($this->id);
        foreach($this->equipments as $equipment)
        {
            $equipment->deleteId();
        }
        $this->ark->deleteId();
        return $this;
    }
}
