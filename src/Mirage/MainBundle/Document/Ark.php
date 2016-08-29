<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-21
 * Time: 오후 10:36
 */

namespace Mirage\MainBundle\Document;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Mirage\AdminBundle\Controller\GameConfig;

/**
 * @MongoDB\Document(repositoryClass="Mirage\MainBundle\Repository\ArkRepository")
 */
class Ark
{

    public function __construct()
    {
        $this->phases = new ArrayCollection();
    }

    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Int
     */
    protected $arkId;

    /**
     * @MongoDB\String
     */
    protected $name_kr;

    /**
     * @MongoDB\String
     */
    protected $name_jp;

    /**
     * @MongoDB\Int
     */
    protected $title;

    /**
     * @MongoDB\Int
     */
    protected $origin;

    /**
     * @MongoDB\String
     */
    protected $description;

    /**
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\Phase")
     */
    protected $phases = array();

    /**
<<<<<<< Updated upstream
     * @MongoDB\Bool
     */
    protected $isEnabled;

=======
     * @MongoDB\Boolean
     */
    protected $isEnabled;



>>>>>>> Stashed changes
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
    public function getArkId()
    {
        return $this->arkId;
    }

    /**
     * @param mixed $arkId
     */
    public function setArkId($arkId)
    {
        $this->arkId = $arkId;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


    /**
     * @return mixed
     */
    public function getNameKr()
    {
        return $this->name_kr;
    }

    /**
     * @param mixed $name_kr
     */
    public function setNameKr($name_kr)
    {
        $this->name_kr = $name_kr;
    }

    /**
     * @return mixed
     */
    public function getNameJp()
    {
        return $this->name_jp;
    }

    public function getName(){
        $name = array(
            "KR"=> $this->name_kr,
            "JP"=> $this->name_jp,
        );
        return $name[GameConfig::LANG];

    }
    /**
     * @param mixed $name_jp
     */
    public function setNameJp($name_jp)
    {
        $this->name_jp = $name_jp;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }



    /**
     * @return mixed
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param mixed $origin
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }

    /**
     * @return mixed
     */
    public function getPhases()
    {
        return $this->phases;
    }

    public function getPhase($phaseId = null){
        if(empty($phaseId)){
            return $this->phases->first();
        }
        foreach($this->phases as $phase){
            if($phase->getPhaseId() == $phaseId ){
                return $phase;
            }
        }

    }

    public function addPhase(Phase $phase){
        if($this->phases->contains($phase)){
            $this->phases->add($phase);
        }
        return $this;
    }

    public function removePhase($phase){
        $this->phases->removeElement($phase);
        return $this;
    }

    /**
     * @param mixed $phases
     */
    public function setPhases($phases)
    {
        $this->phases = $phases;
    }

    /**
     * Set isEnabled
     *
     * @param Bool $isEnabled
     * @return self
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;
        return $this;
    }

    /**
     * Get isEnabled
     *
     * @return Bool $isEnabled
     */
    public function getIsEnabled()
    {
        return $this->isEnabled;
    }













    //======Custom Function======================//
    public function outPhase($usePhaseId)
    {
        foreach($this->phases as $phase){
            if($phase->getPhaseId() != $usePhaseId ){
                var_dump($phase->getPhaseId() );
                unset($phase);
            }
        }
        return $this;
    }

    public function deleteId()
    {
        unset($this->id);
        foreach($this->phases as $phase){
            $phase->deleteId();
        }
        return $this;
    }

<<<<<<< Updated upstream
    public function toArray()
    {
        return (array)$this;
    }
    public function editPlayerArkStatus($ark,$arkPhase)
    {
        $arrayThis = $this->toArray();

//        var_dump(new ArrayCollection($ark));
       // var_dump($arrayThis);
        foreach($ark as $key => $value)
        {
        }

        return $this;
    }
=======
    /**
     * @return mixed
     */
    public function getIsEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * @param mixed $isEnabled
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;
        return $this;
    }


>>>>>>> Stashed changes
}
