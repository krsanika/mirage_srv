<?php
/**
 * Created by PhpStorm.
 * User: Krsanika
 * Date: 2016-08-17
 * Time: 오후 6:37
 */

namespace Mirage\MainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Type as JMSType;

/**
 * @MongoDB\Document(repositoryClass="Mirage\MainBundle\Repository\SkillRepository")
 */
class Skill
{

    public function __construct()
    {
        $this->levels = new ArrayCollection();
        $this->levels->add(new SkillLevel(1));
        $this->levels->add(new SkillLevel(2));
        $this->levels->add(new SkillLevel(3));
        $this->levels->add(new SkillLevel(4));
        $this->levels->add(new SkillLevel(5));
        $this->levels->add(new SkillLevel(6));
        $this->levels->add(new SkillLevel(7));
        $this->levels->add(new SkillLevel(8));
        $this->levels->add(new SkillLevel(9));
        $this->levels->add(new SkillLevel(10));
    }

    /**
     * @MongoDB\Id(name="_id")
     */
    protected $id;

    /**
     * @MongoDB\Int
     */
    protected $idSkill;

    /**
     * @MongoDB\Int
     */
    protected $consume;


    /**
     * @MongoDB\Boolean
     */
    protected $isMelee;

    /**
     * @MongoDB\Int
     */
    protected $idSource;




    /**
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\SkillLevel>")
     * @MongoDB\EmbedMany(name="levels", targetDocument="Mirage\MainBundle\Document\SkillLevel")
     */
    protected $levels = array();




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
    public function getIdSkill()
    {
        return $this->idSkill;
    }

    /**
     * @param mixed $idSkill
     */
    public function setIdSkill($idSkill)
    {
        $this->idSkill = $idSkill;
    }


    /**
     * @return mixed
     */
    public function getLevels()
    {
        return $this->levels;
    }

    /**
     * @param mixed $levels
     */
    public function setLevels($levels)
    {
        $this->levels = $levels;
    }




    public function addLevel(\Mirage\MainBundle\Document\SkillLevel $level)
    {
        $this->levels[] = $level;
    }

    public function removeLevel(\Mirage\MainBundle\Document\SkillLevel $level)
    {
        $this->levels->removeElement($level);
    }


    /**
     * @return mixed
     */
    public function getConsume()
    {
        return $this->consume;
    }

    /**
     * @param mixed $consume
     */
    public function setConsume($consume)
    {
        $this->consume = $consume;
    }


    //===================================//
    public function deleteId()
    {
        unset($this->id);

        return $this;
    }

    public function getDataWithLevel($lv){
//        var_dump($this->getIdSkill()."_".$this->levels->count());
        foreach($this->levels as &$level){
            if($level->getLv() != $lv){
                $this->levels->removeElement($level);
            }
        }

        $data = [
            'idSkill' => $this->idSkill,
            'lv' => $this->levels->first()->getLv(),
            'effects' => $this->levels->first()->getEffects()
        ];



        return $data;
    }

    /**
     * @return mixed
     */
    public function isMelee()
    {
        return $this->isMelee;
    }

    /**
     * @param mixed $isMelee
     */
    public function setIsMelee($isMelee)
    {
        $this->isMelee = $isMelee;
    }

    /**
     * @return mixed
     */
    public function getIdSource()
    {
        return $this->idSource;
    }

    /**
     * @param mixed $idSource
     */
    public function setIdSource($idSource)
    {
        $this->idSource = $idSource;
    }

    public function serializer()
    {
        $encoder    = new JsonEncoder();
        $normalizer = new ObjectNormalizer();

        $normalizer->setIgnoredAttributes(array(
            'whatever', 'attributes', 'you', 'want', 'to', 'ignore'
        ));

        // The setCircularReferenceLimit() method of this normalizer sets the number
        // of times it will serialize the same object
        // before considering it a circular reference. Its default value is 1.
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getName();
        });

        $serializer = new Serializer(array($normalizer), array($encoder));
        return $serializer->serialize($this, 'json');
    }



}
