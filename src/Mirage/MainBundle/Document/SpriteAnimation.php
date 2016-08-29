<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-09
 * Time: 오후 8:48
 */

namespace Mirage\MainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class SpriteAnimation
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Int
     */
    protected $charaId;

    /**
     * @MongoDB\Int
     */
    protected $actionId;


    /**
     * @MongoDB\Int
     */
    protected $spriteIndex;

    /**
     * @MongoDB\Float
     */
    protected $time;

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
    public function getCharaId()
    {
        return $this->charaId;
    }

    /**
     * @param mixed $charaId
     */
    public function setCharaId($charaId)
    {
        $this->charaId = $charaId;
    }

    /**
     * @return mixed
     */
    public function getActionId()
    {
        return $this->actionId;
    }

    /**
     * @param mixed $actionId
     */
    public function setActionId($actionId)
    {
        $this->actionId = $actionId;
    }

    /**
     * @return mixed
     */
    public function getSpriteIndex()
    {
        return $this->spriteIndex;
    }

    /**
     * @param mixed $spriteIndex
     */
    public function setSpriteIndex($spriteIndex)
    {
        $this->spriteIndex = $spriteIndex;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }


}
