<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 2017-06-20
 * Time: 오후 8:02
 */

namespace Mirage\MainBundle\Game;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Type;

class ListIdPhases
{
    public function __construct()
    {
        $idList = new ArrayCollection();
    }
    /**
     * @Type("array<integer>")
     */
    private $idList = array();

    /**
     * @return mixed
     */
    public function getIdList()
    {
        return $this->idList;
    }

    /**
     * @param mixed $idList
     */
    public function setIdList($idList)
    {
        $this->idList = $idList;
    }

    

}