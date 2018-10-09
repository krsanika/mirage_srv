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
 * @MongoDB\Document(repositoryClass="Mirage\MainBundle\Repository\StoryRepository")
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
    protected $idTitle;

    /**
     * @MongoDB\Int
     */
    protected $year;


    /**
     * @MongoDB\Int
     */
    protected $yearUiValue;

    /**
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\Chapter")
     * @Type("ArrayCollection<Mirage\MainBundle\Document\Chapter>")
     */
    protected $chapters = array();

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
    public function getIdTitle()
    {
        return $this->titleId;
    }

    /**
     * @param mixed $titleId
     */
    public function setIdTitle($idTitle)
    {
        $this->idTitle = $idTitle;
        return $this;
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
        return $this;
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

    public function getYearUiValue()
    {
       return $this->yearUiValue;
    }

    public function setYearUiValue($yearUiValue)
    {
        $this->yearUiValue = $yearUiValue;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    public function unsetYearAndValue(){
        unset($this->year);
        unset($this->yearUiValue);
        return $this;
    }

}
