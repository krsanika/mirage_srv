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
        $this->tilePositions = new ArrayCollection();
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
     * @MongoDB\Field(name="tilePositions", type="hash")
     */
    protected $tilePositions = array();

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
     * Set tilePositions
     *
     * @param hash $tilePositions
     * @return self
     */
    public function setTilePositions($tilePositions)
    {
        $this->tilePositions = $tilePositions;
        return $this;
    }

    /**
     * Get tilePositions
     *
     * @return hash $tilePositions
     */
    public function getTilePositions()
    {
        return $this->tilePositions;
    }
}
