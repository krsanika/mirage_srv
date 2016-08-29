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
class Episode
{

    /**
     * @MongoDB\Int
     */
    protected $episodeId;

    /**
     * @MongoDB\Int
     */
    protected $nameCode;

    /**
     * @MongoDB\Int
     */
    protected $descriptCode;

    /**
     * @Type("Mirage\MainBundle\Document\Encounter")
     * @MongoDB\ReferenceOne(targetDocument="Mirage\MainBundle\Document\Encounter")
     */
    protected $encounter;

    /**
     * @return mixed
     */
    public function getEpisodeId()
    {
        return $this->episodeId;
    }

    /**
     * @param mixed $episodeId
     */
    public function setEpisodeId($episodeId)
    {
        $this->episodeId = $episodeId;
    }

    /**
     * @return mixed
     */
    public function getNameCode()
    {
        return $this->nameCode;
    }

    /**
     * @param mixed $nameCode
     */
    public function setNameCode($nameCode)
    {
        $this->nameCode = $nameCode;
    }

    /**
     * @return mixed
     */
    public function getDescriptCode()
    {
        return $this->descriptCode;
    }

    /**
     * @param mixed $descriptCode
     */
    public function setDescriptCode($descriptCode)
    {
        $this->descriptCode = $descriptCode;
    }

    /**
     * @return mixed
     */
    public function getEncounter()
    {
        return $this->encounter;
    }

    /**
     * @param mixed $encounter
     */
    public function setEncounter($encounter)
    {
        $this->encounter = $encounter;
    }


    public function remakeForStoryView()
    {
        unset($this->encounter->id);

    }


}