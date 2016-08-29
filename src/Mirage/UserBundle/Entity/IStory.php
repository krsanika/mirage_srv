<?php

namespace Mirage\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IStory
 *
 * @ORM\Table(name="IStory")
 * @ORM\Entity(repositoryClass="Mirage\UserBundle\Repository\IStoryRepository")
 */
class IStory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="idPlayer", type="integer")
     */
    private $idPlayer;

    /**
     * @var int
     *
     * @ORM\Column(name="difficulty", type="smallint")
     */
    private $difficulty;

    /**
     * @var int
     *
     * @ORM\Column(name="idTitle", type="smallint")
     */
    private $idTitle;

    /**
     * @var int
     *
     * @ORM\Column(name="idChapter", type="smallint")
     */
    private $idChapter;

    /**
     * @var string
     *
     * @ORM\Column(name="idEpisode", type="smallint")
     */
    private $idEpisode;

    /**
     * @var int
     *
     * @ORM\Column(name="score", type="integer")
     */
    private $score;

    /**
     * @var int
     *
     * @ORM\Column(name="turn", type="smallint")
     */
    private $turn;

    /**
     * @var int
     *
     * @ORM\Column(name="rank", type="smallint")
     */
    private $rank;

    /**
     * @var bool
     *
     * @ORM\Column(name="isNewest", type="boolean")
     */
    private $isNewest;

    /**
     * @var int
     *
     * @ORM\Column(name="created", type="integer")
     */
    private $created;

    /**
     * @var int
     *
     * @ORM\Column(name="updated", type="integer")
     */
    private $updated;

    /**
     * @var bool
     *
     * @ORM\Column(name="isEnabled", type="boolean")
     */
    private $isEnabled;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idPlayer
     *
     * @param integer $idPlayer
     *
     * @return IStory
     */
    public function setIdPlayer($idPlayer)
    {
        $this->idPlayer = $idPlayer;

        return $this;
    }

    /**
     * Get idPlayer
     *
     * @return int
     */
    public function getIdPlayer()
    {
        return $this->idPlayer;
    }

    /**
     * Set difficulty
     *
     * @param integer $difficulty
     *
     * @return IStory
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * Get difficulty
     *
     * @return int
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * Set idTitle
     *
     * @param integer $idTitle
     *
     * @return IStory
     */
    public function setIdTitle($idTitle)
    {
        $this->idTitle = $idTitle;

        return $this;
    }

    /**
     * Get idTitle
     *
     * @return int
     */
    public function getIdTitle()
    {
        return $this->idTitle;
    }

    /**
     * Set idChapter
     *
     * @param integer $idChapter
     *
     * @return IStory
     */
    public function setIdChapter($idChapter)
    {
        $this->idChapter = $idChapter;

        return $this;
    }

    /**
     * Get idChapter
     *
     * @return int
     */
    public function getIdChapter()
    {
        return $this->idChapter;
    }

    /**
     * Set idEpisode
     *
     * @param string $idEpisode
     *
     * @return IStory
     */
    public function setIdEpisode($idEpisode)
    {
        $this->idEpisode = $idEpisode;

        return $this;
    }

    /**
     * Get idEpisode
     *
     * @return string
     */
    public function getIdEpisode()
    {
        return $this->idEpisode;
    }

    /**
     * Set score
     *
     * @param integer $score
     *
     * @return IStory
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set turn
     *
     * @param integer $turn
     *
     * @return IStory
     */
    public function setTurn($turn)
    {
        $this->turn = $turn;

        return $this;
    }

    /**
     * Get turn
     *
     * @return int
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * Set rank
     *
     * @param integer $rank
     *
     * @return IStory
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return int
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set isNewest
     *
     * @param boolean $isNewest
     *
     * @return IStory
     */
    public function setIsNewest($isNewest)
    {
        $this->isNewest = $isNewest;

        return $this;
    }

    /**
     * Get isNewest
     *
     * @return bool
     */
    public function getIsNewest()
    {
        return $this->isNewest;
    }

    /**
     * Set created
     *
     * @param integer $created
     *
     * @return IStory
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return int
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param integer $updated
     *
     * @return IStory
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return int
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set isEnabled
     *
     * @param boolean $isEnabled
     *
     * @return IStory
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * Get isEnabled
     *
     * @return bool
     */
    public function getIsEnabled()
    {
        return $this->isEnabled;
    }
}

