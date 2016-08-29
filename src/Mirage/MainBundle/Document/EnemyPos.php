<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2016-08-21
 * Time: 오후 6:45
 */

namespace Mirage\MainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Mirage\MainBundle\Document\Enemy;
use JMS\Serializer\Annotation\Type;
/**
 * @MongoDB\EmbeddedDocument
 */
class EnemyPos
{
    public function __construct()
    {
    }

    /**
     * @MongoDB\String
     */
    protected $position;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Mirage\MainBundle\Document\Enemy", inversedBy="id")
     */
    protected $enemy;

    /**
     * @MongoDB\Int
     */
    protected $targetId;

    /**
     * Add enemy
     *
     * @param Mirage\MainBundle\Document\Enemy $enemy
     * @return self
     */
    public function addEnemy(Enemy $enemy)
    {
        $this->enemy[] = $enemy;
    }

    /**
     * Remove enemy
     *
     * @param Mirage\MainBundle\Document\Enemy $enemy
     * @return self
     */
    public function removeEnemy(Enemy $enemy)
    {
        $this->enemy->removeElement($enemy);
    }

    /**
     * Get enemy
     *
     * @return Mirage\MainBundle\Document\Enemy $enemy
     */
    public function getEnemy()
    {
        return $this->enemy;
    }

    /**
     * Set targetId
     *
     * @param int $targetId
     * @return self
     */
    public function setTargetId($targetId)
    {
        $this->targetId = $targetId;
        return $this;
    }

    /**
     * Get targetId
     *
     * @return int $targetId
     */
    public function getTargetId()
    {
        return $this->targetId;
    }

    /**
     * Set position
     *
     * @param string $position
     * @return self
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * Get position
     *
     * @return string $position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set enemy
     *
     * @param Mirage\MainBundle\Document\Enemy $enemy
     * @return self
     */
    public function setEnemy(\Mirage\MainBundle\Document\Enemy $enemy)
    {
        $this->enemy = $enemy;
        return $this;
    }

    public function deleteId()
    {
        $this->enemy->deleteId();
        return $this;
    }
}
