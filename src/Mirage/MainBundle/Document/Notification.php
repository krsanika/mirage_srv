<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-02-26
 * Time: 오후 9:21
 */

namespace Mirage\MainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Notification
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $subject;

    /**
     * @MongoDB\String
     */
    protected $text;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return String
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return String
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this->id;
    }

    /**
     * @param String $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this->subject;
    }

    /**
     * @param String $text
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this->text;
    }



}
