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
use JMS\Serializer\Annotation\SerializedName;


/**
 * @MongoDB\EmbeddedDocument
 */
class Episode
{

    /**
     * @MongoDB\Int
     */
    protected $idEpisode;

    /**
     * @MongoDB\EmbedOne(targetDocument="Mirage\MainBundle\Document\EpisodeMarker")
     * @Type("Mirage\MainBundle\Document\EpisodeMarker")
     */
    protected $marker;

    /**
     * @Type("Mirage\MainBundle\Document\Encounter")
     * @MongoDB\ReferenceOne(targetDocument="Mirage\MainBundle\Document\Encounter")
     */
    protected $encounter;

    /**
     * @Type("Mirage\MainBundle\Document\Reward")
     * @MongoDB\ReferenceOne(targetDocument="Mirage\MainBundle\Document\Reward")
     */
    protected $reward;

    /**
     * @SerializedName("openIds")
     * @MongoDB\Field(name="openIds", type="hash")
     */
    protected $openIds = [];

    protected $rewardStr;

    /**
     * @SerializedName("enemies")
     */
    protected $enemyIds = [];


    /**
     * @return mixed
     */
    public function getidEpisode()
    {
        return $this->idEpisode;
    }

    /**
     * @param mixed $episodeId
     */
    public function setIdEpisode($idEpisode)
    {
        $this->idEpisode = $idEpisode;
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


    /**
     * @return mixed
     */
    public function getMarker()
    {
        return $this->marker;
    }

    /**
     * @param mixed $marker
     */
    public function setMarker($marker)
    {
        $this->marker = $marker;
        return $this;
    }


/*
    public function remakeForStoryView()
    {
        unset($this->encounter->id);

    }
*/

    public function trimForStoryView(){
        $this->rewardStr = $this->reward->getRewardStr();
//        $this->enemyCount = $this->encounter->getEnemyCount();
        $this->enemyIds = $this->encounter->getEnemyIds();
        unset($this->encounter);
        unset($this->reward);
        return $this;
    }

}
