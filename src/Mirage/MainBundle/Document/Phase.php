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
use JMS\Serializer\Annotation\Type as JMSType;


/**
 * @MongoDB\EmbeddedDocument
 */
class Phase
{
    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->skills = new ArrayCollection();
    }

    /**
    * @MongoDB\Int
    */
    protected $idPhase;

    /**
    * @MongoDB\Int
    */
    protected $type;

    /**
    * @MongoDB\Int
    */
    protected $grade;

    /**
     * @MongoDB\Int
     */
    protected $hp;

    /**
    * @MongoDB\Int
    */
    protected $atk;

    /**
    * @MongoDB\Int
    */
    protected $def;

    /**
    * @MongoDB\Int
    */
    protected $agi;

    /**
    * @MongoDB\Int
    */
    protected $con;


    /**
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\Skill>")
     * @MongoDB\ReferenceMany(targetDocument="Mirage\MainBundle\Document\Skill",  inversedBy="id")
     */
    protected $skills = array();

    /**
     * @MongoDB\Collection(name="tags")
     */
    protected $tags = array();


    /**
     * @MongoDB\Boolean
     */
    protected $isEnabled;


    /**
    * @return mixed
    */
    public function getIdPhase()
    {
        return $this->idPhase;
    }

    /**
    * @param mixed $phaseId
    */
    public function setIdPhase($idPhase)
    {
        $this->idPhase = $idPhase;
    }

    /**
    * @return mixed
    */
    public function getType()
    {
        return $this->type;
    }

    /**
    * @param mixed $type
    */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
    * @return mixed
    */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
    * @param mixed $grade
    */
    public function setGrade($grade)
    {
        $this->grade = $grade;
    }

    /**
     * @return mixed
     */
    public function getHp()
    {
        return $this->hp;
    }

    /**
     * @param mixed $hp
     */
    public function setHp($hp)
    {
        $this->hp = $hp;
    }

    /**
    * @return mixed
    */
    public function getAtk()
    {
    return $this->atk;
    }

    /**
    * @param mixed $atk
    */
    public function setAtk($atk)
    {
        $this->atk = $atk;
    }

    /**
    * @return mixed
    */
    public function getDef()
    {
        return $this->def;
    }

    /**
    * @param mixed $def
    */
    public function setDef($def)
    {
        $this->def = $def;
    }

    /**
     * @return mixed
     */
    public function getAgi()
    {
        return $this->agi;
    }

    /**
     * @param mixed $agi
     */
    public function setAgi($agi)
    {
        $this->agi = $agi;
    }

    /**
     * @return mixed
     */
    public function getCon()
    {
        return $this->con;
    }

    /**
     * @param mixed $con
     */
    public function setCon($con)
    {
        $this->con = $con;
    }

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
    }




    /**
     * @return array
     */
    public function getSkills()
    {
        return $this->skills;
    }

    public function addSkills($skill){
        if($this->skills->contains($skill)){
            $this->skills->add($skill);
        }
        return $this;
    }

    public function removeSkills($skill){
        $this->skills->removeElement($skill);
        return $this;
    }

    /**
     * @param array $skills
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;
    }


    public function addSkill(\Mirage\MainBundle\Document\Skill $skill)
    {
        $this->skills[] = $skill;
    }

    public function removeSkill(\Mirage\MainBundle\Document\Skill $skill)
    {
        $this->skills->removeElement($skill);
    }




    //================================================//
    public function replaceStatus($hp,$atk,$def,$agi,$con)
    {
        $this->hp = $hp;
        $this->atk = $atk;
        $this->def = $def;
        $this->agi = $agi;
        $this->con = $con;


        return $this;
    }

    public function sumEnemyStatus($difficulty,$lv,$hp,$atk,$def,$agi,$con)
    {
        $this->type;
        $this->atk += $atk;
        $this->def += $def;
        $this->agi += $agi;
        $this->con += $con;
        $this->hp = (((($this->atk*$this->def*0.5)*$lv)*GameConfig::$CORRECTION_VALUE_OF_CLASS[$this->getType()]["hp"])*GameConfig::$CORRECTION_VALUE_OF_DIFFICULTY[(int)$difficulty])+$hp;


        return $this;
    }

    public function deleteId()
    {
        foreach($this->skills as $skill){

            $skill->deleteId();
        }
        return $this;
    }

    public function combineIPhase($iPhase)
    {
        $this->hp = $iPhase->getHp();
        $this->atk = $iPhase->getAtk();
        $this->def = $iPhase->getDef();
        $this->spd = $iPhase->getSpd();
        $this->luk = $iPhase->getLuk();


        return $this;
    }

    public function addTag(\Mirage\MainBundle\Document\Tag $tag)
    {
        $this->tags[] = $tag;
    }

    public function removeTag(\Mirage\MainBundle\Document\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection $tags
     */
    public function getTags()
    {
        return $this->tags;
    }

    public function modifyPhase($modify)
    {
        $this->hp += $modify->getHp();
        $this->atk += $modify->getAtk();
        $this->def += $modify->getDef();
        $this->spd += $modify->getSpd();
        $this->luk += $modify->getLuk();

        for($i = 0; $i <$this->skills->count();$i++)
        {
            if(is_null( $modify->replaceSkill($i)))
            {

            }else
            {
                $this->skills[$i] = $modify->replaceSkill($i);
            }
        }
        return $this;
    }

    public function getSkillByNum($num, $lv){
        $result = null;
        $i = 1;
        foreach($this->skills as $skill){
            if($i == $num){
                foreach($skill->levels as &$level){
                    if($level->getLv() != $lv){
                        $this->levels->removeElement($level);
                    }
                }
                $result = $skill;
                break;
            }else $i++;
        }

        return $result;
    }


}
