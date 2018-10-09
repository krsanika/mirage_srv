<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-21
 * Time: 오후 10:36
 */

namespace Mirage\MainBundle\Document;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 */
class TpContent
{

    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Int
     */
    protected $idTpContent;

    /**
     * @MongoDB\Int
     */
    protected $type;

    /**
     * @MongoDB\Int
     */
    protected $rate;

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
    public function getIdTpContent()
    {
        return $this->idTpContent;
    }

    /**
     * @param mixed $idTpContent
     */
    public function setIdTpContent($idTpContent)
    {
        $this->idTpContent = $idTpContent;
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
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param mixed $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }


}
