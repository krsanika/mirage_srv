<?php
/**
 * Created by PhpStorm.
 * User: raihe
 * Date: 2017-03-19
 * Time: 오후 4:42
 */

namespace Mirage\MainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @MongoDB\EmbeddedDocument
 */
class ItemCombine
{
    /**
     * @MongoDB\Int
     */
    protected $idItem;

    /**
     * @MongoDB\Int
     */
    protected $count;

    /**
     * @return mixed
     */
    public function getIdItem()
    {
        return $this->idItem;
    }

    /**
     * @param mixed $idItem
     */
    public function setIdItem($idItem)
    {
        $this->idItem = $idItem;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }


}