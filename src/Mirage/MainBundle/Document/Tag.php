<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2016-09-03
 * Time: 오전 2:59
 */

namespace Mirage\MainBundle\Document;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class Tag
{
    /**
     * @MongoDB\Int(name="tagType")
     */
    protected $tagType;

    /**
     * Set tagType
     *
     * @param int $tagType
     * @return self
     */
    public function setTagType($tagType)
    {
        $this->tagType = $tagType;
        return $this;
    }

    /**
     * Get tagType
     *
     * @return int $tagType
     */
    public function getTagType()
    {
        return $this->tagType;
    }
}
