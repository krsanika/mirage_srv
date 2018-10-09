<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2017-02-14
 * Time: 오전 10:46
 */

namespace Mirage\UserBundle;

use Mirage\MainBundle\Document\Encounter;
use Mirage\MainBundle\Document\Tile;
use Mirage\UserBundle\Entity\IDeck;
use Mirage\UserBundle\Entity\IEncounter;

class BattleStartData
{
    public function __construct()
    {

    }
    protected $idBackground;
    protected $idBgm;
    protected $idTile;
    protected $mapLength;
    protected $leftEnemy;
    protected $progress;
    protected $spPlayer;
    protected $spEnemy;
    protected $turn;
    protected $eventTrigger = array();
    protected $pawns = array();

    public function setStartData($mongoEncounter, $iDeck)
    {
        $this->idBackground = $mongoEncounter->getIdBackground();
        $this->idBgm = $mongoEncounter->getIdBgm();
        $this->idTile = $mongoEncounter->getIdTile();
        $this->mapLength = $mongoEncounter->getMapLength();
        $this->eventTrigger = $mongoEncounter->getEventTrigger();
        $iEcounter = $this->startEncounter($iDeck,$mongoEncounter);
        $this->leftEnemy = $iEcounter->getLeftEnemy();
        $this->progress = $iEcounter->getProgress();
        $this->spEnemy = $iEcounter->getSpEnemy();
        $this->spPlayer = $iEcounter->getSpPlayer();
        $this->turn = $iEcounter->getTurn();
    }

    public function startEncounter(IDeck $iDeck, Encounter $encounter)
    {
        $iEncounter = new IEncounter();
        $iEncounter->setIdPlayer($iDeck->getIdPlayer());
        $iEncounter->setIdEncounter($encounter->getIdEnc());
        $iEncounter->setLeftEnemy($this->countEnemy($encounter));
        $iEncounter->setProgress($encounter->getMapLength());

        return $iEncounter;
    }

    public function pawnsSetting(IDeck $iDeck, Encounter $encounter)
    {
        return;
    }
    //Enemy들의 수를 샌다.
    public function countEnemy(Encounter $encounter)
    {
        $tiles = $encounter->getTiles();
        $count = 0;
        foreach($tiles as $tile)
        {
            if(!empty($tile->getEnemies()))
            {
                foreach($tile->getEnemies() as $enemy)
                {
                    $count++;
                }
            }
        }
        return $count;
    }
}