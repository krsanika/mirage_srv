<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2016-09-03
 * Time: 오전 2:59
 */

namespace Mirage\MainBundle\Document;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use JMS\Serializer\Annotation\Type as JMSType;
use Mirage\MainBundle\Document\SkillLevelEffectContent;


/**
 * @MongoDB\EmbeddedDocument
 */
class SkillLevelEffect
{

    /**
     * @MongoDB\Int
     */
    protected $target;

    /**
     * @JMSType("ArrayCollection<Mirage\MainBundle\Document\SkillLevelEffectContent>")
     * @MongoDB\EmbedMany(name="contents", targetDocument="Mirage\MainBundle\Document\SkillLevelEffectContent")
     */
    protected $effectContents;

    /**
     * Effect constructor.
     * @param $effectContents
     */
    public function __construct()
    {
        $this->effectContents = new ArrayCollection();
        $this->effectContents->add(new SkillLevelEffectContent());
        $this->effectContents->add(new SkillLevelEffectContent());
        $this->effectContents->add(new SkillLevelEffectContent());
    }

    /**
     * @return mixed
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param mixed $target
     */
    public function setTarget($target)
    {
        $this->target = $target;
    }


    /**
     * @return mixed
     */
    public function getEffectContents()
    {
        return $this->effectContents;
    }

    /**
     * @param mixed $contents
     */
    public function setEffectContents($effectContents)
    {
        $this->effectContents = $effectContents;
    }

    /**
     * Add effectContent
     *
     * @param Mirage\MainBundle\Document\SkillLevelEffectContent $effectContent
     */
    public function addEffectContent(\Mirage\MainBundle\Document\SkillLevelEffectContent $effectContent)
    {
        $this->effectContents[] = $effectContent;
    }

    /**
     * Remove effectContent
     *
     * @param Mirage\MainBundle\Document\SkillLevelEffectContent $effectContent
     */
    public function removeEffectContent(\Mirage\MainBundle\Document\SkillLevelEffectContent $effectContent)
    {
        $this->effectContents->removeElement($effectContent);
    }



}
