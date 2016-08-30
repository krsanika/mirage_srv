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
    protected $phaseId;

    /**
    * @MongoDB\Int
    */
    protected $type;

    /**
    * @MongoDB\Int
    */
    protected $grade;

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
    protected $spd;

    /**
    * @MongoDB\Int
    */
    protected $luk;

    /**
     * @MongoDB\ReferenceMany(targetDocument="Mirage\MainBundle\Document\Skill",  inversedBy="id")
     */
    protected $skills = array();

    /**
    * @MongoDB\Collection
    */
    protected $tags = array();

    /**
     * @MongoDB\Bool
     */
    protected $isEnabled;

    /**
    * @return mixed
    */
    public function getPhaseId()
    {
        return $this->phaseId;
    }

    /**
    * @param mixed $phaseId
    */
    public function setPhaseId($phaseId)
    {
        $this->phaseId = $phaseId;
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

    /**
    * @param mixed $name_jp
    */
    public function setNameJp($name_jp)
    {
        $this->name_jp = $name_jp;
    }

    public function getName(){
        $name = array(
            "KR"=> $this->name_kr,
            "JP"=> $this->name_jp,
        );
        return $name[GameConfig::LANG];
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
    public function getSpd()
    {
        return $this->spd;
    }

    /**
    * @param mixed $spd
    */
    public function setSpd($spd)
    {
        $this->spd = $spd;
    }

    /**
    * @return mixed
    */
    public function getLuk()
    {
        return $this->luk;
    }

    /**
    * @param mixed $luk
    */
    public function setLuk($luk)
    {
        $this->luk = $luk;
    }

    /**
    * @return array
    */
    public function getTags()
    {
        return $this->tags;
    }

    public function addTags($tag){
        if($this->tags->contains($tag)){
            $this->tags->add($tag);
        }
        return $this;
    }

    public function removeTags($tag){
        $this->tags->removeElement($tag);
        return $this;
    }

    /**
    * @param array $tags
    */
        public function setTags($tags)
        {
            $this->tags = $tags;
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



    /**
     * Add skill
     *
     * @param Mirage\MainBundle\Document\Skill $skill
     */
    public function addSkill(\Mirage\MainBundle\Document\Skill $skill)
    {
        $this->skills[] = $skill;
    }

    /**
     * Remove skill
     *
     * @param Mirage\MainBundle\Document\Skill $skill
     */
    public function removeSkill(\Mirage\MainBundle\Document\Skill $skill)
    {
        $this->skills->removeElement($skill);
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


    //================================================//
    public function replaceStatus($hp,$atk,$def,$spd,$luk)
    {
        $this->hp = $hp;
        $this->atk = $atk;
        $this->def = $def;
        $this->spd = $spd;
        $this->luk = $luk;

        return $this;
    }

    public function sumEnemyStatus($difficulty,$lv,$hp,$atk,$def,$spd,$luk)
    {
        $this->type;
        $this->hp += $hp;
        $this->atk += $atk;
        $this->def += $def;
        $this->spd += $spd;
        $this->luk += $luk;

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

}
