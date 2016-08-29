<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2016-08-26
 * Time: 오후 2:54
 */

namespace Mirage\MainBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Mirage\AdminBundle\Controller\GameConfig;

/**
 * @MongoDB\EmbeddedDocument
 */
class StageInfo
{
    public function __construct()
    {
        $this->tilePos = new ArrayCollection();
    }


    /**
     * @MongoDB\Int
     */
    protected $backgroundId;

    /**
     * @MongoDB\Int
     */
    protected $bgmId;

    /**
     * @MongoDB\Int
     */
    protected $yLength;

    /**
     * @MongoDB\Int
     */
    protected $defaultTile;

    /**
     * @MongoDB\Field(name="tilePos", type="hash")
     */
    protected $tilePos = array();

    /**
     * Set backgroundId
     *
     * @param int $backgroundId
     * @return self
     */
    public function setBackgroundId($backgroundId)
    {
        $this->backgroundId = $backgroundId;
        return $this;
    }

    /**
     * Get backgroundId
     *
     * @return int $backgroundId
     */
    public function getBackgroundId()
    {
        return $this->backgroundId;
    }

    /**
     * Set bgmId
     *
     * @param int $bgmId
     * @return self
     */
    public function setBgmId($bgmId)
    {
        $this->bgmId = $bgmId;
        return $this;
    }

    /**
     * Get bgmId
     *
     * @return int $bgmId
     */
    public function getBgmId()
    {
        return $this->bgmId;
    }

    /**
     * Set yLength
     *
     * @param int $yLength
     * @return self
     */
    public function setYLength($yLength)
    {
        $this->yLength = $yLength;
        return $this;
    }

    /**
     * Get yLength
     *
     * @return int $yLength
     */
    public function getYLength()
    {
        return $this->yLength;
    }

    /**
     * Set defaultTile
     *
     * @param int $defaultTile
     * @return self
     */
    public function setDefaultTile($defaultTile)
    {
        $this->defaultTile = $defaultTile;
        return $this;
    }

    /**
     * Get defaultTile
     *
     * @return int $defaultTile
     */
    public function getDefaultTile()
    {
        return $this->defaultTile;
    }

    /**
     * Set tilePos
     *
     * @param hash $tilePos
     * @return self
     */
    public function setTilePos($tilePos)
    {
        $this->tilePos = $tilePos;
        return $this;
    }

    /**
     * Get tilePos
     *
     * @return hash $tilePos
     */
    public function getTilePos()
    {
        return $this->tilePos;
    }


}
