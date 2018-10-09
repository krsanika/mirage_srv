<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2017-01-26
 * Time: 오후 8:01
 */

namespace Mirage\MainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use JMS\Serializer\Annotation\Type;
/**
 * @MongoDB\EmbeddedDocument
 */
class EpisodeMarker
{
    /**
     * @MongoDB\Int
     */
    protected $positionX;

    /**
     * @MongoDB\Int
     */
    protected $positionY;

    /**
     * @MongoDB\Int
     */
    protected $iconId;

    /**
     * Set positionX
     *
     * @param int $positionX
     * @return self
     */
    public function setPositionX($positionX)
    {
        $this->positionX = $positionX;
        return $this;
    }

    /**
     * Get positionX
     *
     * @return int $positionX
     */
    public function getPositionX()
    {
        return $this->positionX;
    }

    /**
     * Set positionY
     *
     * @param int $positionY
     * @return self
     */
    public function setPositionY($positionY)
    {
        $this->positionY = $positionY;
        return $this;
    }

    /**
     * Get positionY
     *
     * @return int $positionY
     */
    public function getPositionY()
    {
        return $this->positionY;
    }

    /**
     * Set iconId
     *
     * @param int $iconId
     * @return self
     */
    public function setIconId($iconId)
    {
        $this->iconId = $iconId;
        return $this;
    }

    /**
     * Get iconId
     *
     * @return int $iconId
     */
    public function getIconId()
    {
        return $this->iconId;
    }
}
