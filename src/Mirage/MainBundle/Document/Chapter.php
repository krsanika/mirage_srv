<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-08-26
 * Time: 오후 6:32
 */

namespace Mirage\MainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Type;

/**
 * @MongoDB\EmbeddedDocument
 */
class Chapter
{

    /**
     * @MongoDB\Int
     */
    protected $chapterId;

    /**
     * @MongoDB\Int
     */
    protected $chapterNameCode;

    /**
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\Episode")
     * @Type("ArrayCollection<Mirage\MainBundle\Document\Episode>")
     */
    protected $episodes =array();

    /**
     * Story constructor.
     * @param array $chapters
     */
    public function __construct()
    {
        $this->episodes = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getChapterId()
    {
        return $this->chapterId;
    }

    /**
     * @param mixed $chapterId
     */
    public function setChapterId($chapterId)
    {
        $this->chapterId = $chapterId;
    }

    /**
     * @return mixed
     */
    public function getChapterNameCode()
    {
        return $this->chapterNameCode;
    }

    /**
     * @param mixed $chapterNameCode
     */
    public function setChapterNameCode($chapterNameCode)
    {
        $this->chapterNameCode = $chapterNameCode;
    }

    /**
     * @return mixed
     */
    public function getEpisodes()
    {
        return $this->episodes;
    }

    /**
     * @param mixed $episodes
     */
    public function setEpisodes($episodes)
    {
        $this->episodes = $episodes;
    }



    /**
     * Add episode
     *
     * @param Mirage\MainBundle\Document\Episode $episode
     */
    public function addEpisode(\Mirage\MainBundle\Document\Episode $episode)
    {
        $this->episodes[] = $episode;
    }

    /**
     * Remove episode
     *
     * @param Mirage\MainBundle\Document\Episode $episode
     */
    public function removeEpisode(\Mirage\MainBundle\Document\Episode $episode)
    {
        $this->episodes->removeElement($episode);
    }
}
