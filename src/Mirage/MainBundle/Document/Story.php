<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2016-08-17
 * Time: 오후 6:37
 */

namespace Mirage\MainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Type;

/**
 * @MongoDB\Document
 */
class Story
{


    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Int
     */
    protected $titleId;

    /**
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\Chapter")
     * @Type("ArrayCollection<Mirage\MainBundle\Document\Chapter>")
     */
    protected $chapters =array();

    /**
     * Story constructor.
     * @param array $chapters
     */
    public function __construct()
    {
        $this->chapters = new ArrayCollection();
    }

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
    public function getTitleId()
    {
        return $this->titleId;
    }

    /**
     * @param mixed $titleId
     */
    public function setTitleId($titleId)
    {
        $this->titleId = $titleId;
    }

    /**
     * @return mixed
     */
    public function getChapters()
    {
        return $this->chapters;
    }

    /**
     * @param mixed $chapters
     */
    public function setChapters($chapters)
    {
        $this->chapters = $chapters;
    }

    public function unsetObjectId(){
        unset($this->id);
        return $this;
    }



    /**
     * Add chapter
     *
     * @param Mirage\MainBundle\Document\Chapter $chapter
     */
    public function addChapter(\Mirage\MainBundle\Document\Chapter $chapter)
    {
        $this->chapters[] = $chapter;
    }

    /**
     * Remove chapter
     *
     * @param Mirage\MainBundle\Document\Chapter $chapter
     */
    public function removeChapter(\Mirage\MainBundle\Document\Chapter $chapter)
    {
        $this->chapters->removeElement($chapter);
    }
}
