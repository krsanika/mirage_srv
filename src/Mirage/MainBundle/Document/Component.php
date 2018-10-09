<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-08-26
 * Time: 오후 6:32
 */

namespace Mirage\MainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Type;

/**
 * @MongoDB\Document
 */
class Component
{


    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Int
     */
    protected $idComponent;

    /**
     * @MongoDB\Int
     */
    protected $type;

    /**
     * @MongoDB\Int
     */
    protected $effective;

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
    public function getIdComponent()
    {
        return $this->idComponent;
    }

    /**
     * @param mixed $idComponent
     */
    public function setIdComponent($idComponent)
    {
        $this->idComponent = $idComponent;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getEffective()
    {
        return $this->effective;
    }

    /**
     * @param mixed $effective
     */
    public function setEffective($effective)
    {
        $this->effective = $effective;
    }






    //---------------------//
    /**
     * @return boolean
     */
    public function getIsHad()
    {
        return $this->isHad;
    }

    /**
     * @param boolean $isHad
     */
    public function setIsHad($isHad)
    {
        $this->isHad = $isHad;
    }


}
