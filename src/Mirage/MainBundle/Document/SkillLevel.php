<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-02-22
 * Time: 오전 1:26
 */

namespace Mirage\MainBundle\Document;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use JMS\Serializer\Annotation\Type as JMSType;
use Mirage\MainBundle\Document\SkillLevelEffect;

/**
 * @MongoDB\EmbeddedDocument
 */
class SkillLevel
{

    /**
     * @MongoDB\Int
     */
    protected $lv;

    /**
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\SkillLevelEffect>")
     * @MongoDB\EmbedMany(name="effects", targetDocument="Mirage\MainBundle\Document\SkillLevelEffect")
     */
    protected $effects = array();

    /**
     * SkillLevel constructor.
     * @param array $effects
     */

    public function __construct($lv)
    {
        $this->lv = $lv;
        $this->effects = new ArrayCollection();
        $this->effects->add(new SkillLevelEffect());
        $this->effects->add(new SkillLevelEffect());
    }

    /**
     * @return mixed
     */
    public function getLv()
    {
        return $this->lv;
    }

    /**
     * @param mixed $lv
     */
    public function setLv($lv)
    {
        $this->lv = $lv;
    }

    /**
     * @return mixed
     */
    public function getEffects()
    {
        return $this->effects;
    }

    /**
     * @param mixed $effects
     */
    public function setEffects($effects)
    {
        $this->effects = $effects;
    }



    public function addEffect(\Mirage\MainBundle\Document\SkillLevelEffect $effect)
    {
        $this->effects[] = $effect;
    }

    public function removeEffect(\Mirage\MainBundle\Document\SkillLevelEffect $effect)
    {
        $this->effects->removeElement($effect);
    }


}