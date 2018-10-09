<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2016-08-21
 * Time: 오후 6:45
 */

namespace Mirage\MainBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use JMS\Serializer\Annotation\Type as JMSType;
/**
 * @MongoDB\EmbeddedDocument
 */
class Tile
{

    /**
     * @MongoDB\String
     */
    protected $location;

    /**
     * @JMSType("Mirage\MainBundle\Document\Enemy")
     * @MongoDB\ReferenceOne(targetDocument="Mirage\MainBundle\Document\Enemy")
     */
    protected $enemy;

    /**
     * @MongoDB\Int
     */
    protected $terrain;


    public function getEnemy()
    {
        return $this->enemy;
    }

    /**
     * Set enemies
     *
     * @param collection $enemies
     * @return self
     */
    public function setEnemy($enemy)
    {
        $this->enemy = $enemy;
        return $this;
    }

    /**
     * Set location
     *
     * @param int $location
     * @return self
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * Get location
     *
     * @return int $location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set terrain
     *
     * @param string $terrain
     * @return self
     */
    public function setTerrain($terrain)
    {
        $this->terrain = $terrain;
        return $this;
    }

    /**
     * Get terrain
     *
     * @return string $terrain
     */
    public function getTerrain()
    {
        return $this->terrain;
    }

    public function deleteId()
    {
        $this->enemy->deleteId();
        return $this;
    }

    public function unsetEnemy(){
        unset($this->enemy);
        return $this;
    }

    public function unsetLocation(){
        unset($this->location);
        return $this;
    }

}
