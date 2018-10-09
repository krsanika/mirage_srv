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
use JMS\Serializer\Annotation\Type as JMSType;
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
    protected $idArk;

    /**
     * @MongoDB\Int
     */
    protected $title;

    /**
     * @MongoDB\Int
     */
    protected $origin;


    /**
     * @MongoDB\Bool
     */
    protected $isEnabled;

    /**
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\Phase>")
     * @MongoDB\EmbedMany(targetDocument="Mirage\MainBundle\Document\Phase")
     */
    protected $phases = array();

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
    public function getIdArk()
    {
        return $this->idArk;
    }

    /**
     * @param mixed $arkId
     */
    public function setIdArk($idArk)
    {
        $this->idArk = $idArk;
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
            if($phase->getIdPhase() == $phaseId ){
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

//    public function setPhase($idPhase,$replacePhase)
//    {
//        foreach($this->phases as $phase){
//            if($phase->getPhaseId() == $idPhase ){
//                $phase = $replacePhase;
//            }
//        }
//    }

    /**
     * @param mixed $phases
     */
    public function setPhases($phases)
    {
        $this->phases = $phases;
    }


    //======Custom Function======================//
    public function outPhase($usePhaseId)
    {
        foreach($this->phases as $phase){
            if($phase->getIdPhase() != $usePhaseId ){
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

    public function toArray()
    {
        return (array)$this;
    }

    public function combineIArk($iArk)
    {
        foreach($iArk->getIPhases() as $iPhase)
        {
            if(isset($iPhase))
            {
                foreach($this->phases as $phase)
                {
                    if($phase->getIdPhase() == $iPhase->getIdArkPhase())
                    {
                        $phase->combineIPhase($iPhase);
                    }
                }
            }
        }
        return $this;
    }

    public function replacePhase($useIdPhase, $modify)
    {
        for($i = 0; $i <$this->phases->count();$i++)
        {
            if($this->phases[$i]->getIdPhase() == $useIdPhase)
            {
                $this->phases[$i] = $this->phases[$i]->modifyPhase($modify);
            }
        }
    }
}
