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
    protected $idEnemy;

    /**
     * @JMSType("Mirage\MainBundle\Document\Ark")
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
    protected $lv;

    /**
     * @MongoDB\Int
     */
    protected $dressUp;

    /**
     * @MongoDB\Int
     */
    protected $dignity;

    /**
     * @MongoDB\EmbedOne(targetDocument="Mirage\MainBundle\Document\EnemyModify")
     * @JMSType("Mirage\MainBundle\Document\EnemyModify")
     */
    protected $modify;

    /**
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\Equipment>")
     * @MongoDB\ReferenceMany(targetDocument="Mirage\MainBundle\Document\Equipment",  inversedBy="id")
     */
    protected $equipments = array();


    public function __construct()
    {
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
     * Set idEnemy
     *
     * @param int $idEnemy
     * @return self
     */
    public function setIdEnemy($idEnemy)
    {
        $this->idEnemy = $idEnemy;
        return $this;
    }

    /**
     * Get idEnemy
     *
     * @return int $idEnemy
     */
    public function getIdEnemy()
    {
        return $this->idEnemy;
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
    public function setIdPhase($idPhase)
    {
        $this->idPhase = $idPhase;
        return $this;
    }

    /**
     * Get phaseId
     *
     * @return int $phaseId
     */
    public function getIdPhase()
    {
        return $this->idPhase;
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
     * @return mixed
     */
    public function getDressUp()
    {
        return $this->dressUp;
    }

    /**
     * @param mixed $dressUp
     */
    public function setDressUp($dressUp)
    {
        $this->dressUp = $dressUp;
    }

    /**
     * @return mixed
     */
    public function getDignity()
    {
        return $this->dignity;
    }

    /**
     * @param mixed $dignity
     */
    public function setDignity($dignity)
    {
        $this->dignity = $dignity;
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
//=================================================
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

    public function useBattle()
    {
        unset($this->idEnemy);
        unset($this->modify);
        // unset($this->modify["hp"],$this->modify["atk"],$this->modify["def"],$this->modify["spd"],$this->modify["luk"]);
        $this->deleteId();
        return $this;
    }

    public function replaceModify()
    {
        return $this->ark->replacePhase($this->idPhase,$this->modify);
    }

    /**
     * @return mixed
     */
    public function getModify()
    {
        return $this->modify;
    }

    /**
     * @param mixed $modify
     */
    public function setModify($modify)
    {
        $this->modify = $modify;
    }
}
