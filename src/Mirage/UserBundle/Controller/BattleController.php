<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-16
 * Time: 오후 2:19
 */

namespace Mirage\UserBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Util\Debug;
use Mirage\MainBundle\Game\ArkInfo;
use Mirage\UserBundle\Controller\Controller;
use Mirage\UserBundle\Services\GMemcached;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Mirage\MainBundle\Document\Notification;
use Mirage\UserBundle\Entity\IDeckRepository;
use Mirage\UserBundle\Entity\IArkRepository;

class BattleController extends Controller
{
    /**
     * @Route("/enc", name="encounter")
     */
    public function startBattleAction(Request $request)
    {
//        유저가 누군지는 멤캐쉬 참조. 덱ID와 다를경우 이놈은 어뷰징임
//        GMemcached::get('Id')

        $idEnc = $request->get('id_battle');
        $idPlayer = $request->get('id_player');
        $idPlayerDeck = $request->get('id_player_deck');
        $difficulty = $request->get('difficulty');
        $em = $this->getDoctrine()->getManager('user1_readonly');
        $mongoDtr = $this->get('doctrine_mongodb');
        $info = null;
        $now = $this->nowTime();

        $mPlayer = $this->getDoctrine()->getRepository('MirageUserBundle:Player')->findById(1);
        if (!empty($idEnc)) {
            $encounter = $mongoDtr->getRepository('MirageMainBundle:Encounter')->findOneByEncId((int)$idEnc);

            $encounter = $encounter->deleteId();
            if ($encounter->getStartDay() < $now && $encounter->getEndDay() > $now) {
                $iDeck = $em->getRepository('MirageUserBundle:IDeck')->findOneById($idPlayerDeck);

                //$playerDeck = $em->getRepository('MirageUserBundle:IDeck')->loadArkByIdIDeck($idPlayerDeck, $mPlayer);
//                $playerDeck->useBattle();

                $playerArkPhases = $em->getRepository('MirageUserBundle:IArkPhase')->loadArkPhaseByIdIArk($iDeck);

                $arks = $this->sumArk($difficulty, $encounter->getEnemyPos(), $iDeck);

                $info = array("mapInfo" => $encounter->getStageInfo(), "arks" => $arks);

            } else {
                $info = "현재 운영되지 않는 던전입니다.";
            }
        }

        return new Response(
            $this->ObjectToJson(
                $info
            )
        );
    }

    public function sumArk($difficulty, $enemiesInfo, $playerDeck, $playerArkPhases)
    {
        $enemies = $this->combineEnemy($difficulty, $enemiesInfo);

        $playerArks = $this->combinePlayerArk($playerDeck, $playerArkPhases);

        return array($enemies);
    }

    //적들의 레벨, hp, 스테이터스 수정치를 모두 합쳐 전투중 사용될 적 정보를 완성하는 펑션
    public function combineEnemy($difficulty, $enemiesInfo)
    {
        $enemies = null;
        foreach ($enemiesInfo as $enemyInfo) {
            $enemy = $enemyInfo->getEnemy();
            $enemyModifer = $enemy->getModify();
            $enemyPhase = $enemy->getArk()->getPhase($enemy->getPhaseId());
            $enemyPhase->
            sumEnemyStatus(
                $difficulty,
                $enemy->getLv(),
                $enemyModifer["hp"],
                $enemyModifer["atk"],
                $enemyModifer["def"],
                $enemyModifer["spd"],
                $enemyModifer["luk"]
            );
            $totalInfo = array();
            // $enemy = $enemy->deleteId();
            $enemies[$enemyInfo->getPosition()] = $enemy;
        }

        return $enemies;
    }


    //플레이어의 아크들 레벨, hp, 스테이터스 수정치를 모두 합쳐 전투중 사용될 아크 정보를 완성하는 펑션
    public function combinePlayerArk($playerDeck, $playerArkPhases)
    {
        $playerArks = null;

        foreach ($playerDeck->getArkPos() as $position => $ark) {
            if (isset($ark)) {
                //$masterArk = GMemcached::get(GMemcached::PREFIX_ARK.$ark->getIdArk());
                var_dump($ark->getIdArk());
                $masterArk = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Ark')->findOneByArkId((int)$ark->getIdArk());
                $ark->getUpdated();
                var_dump(get_class($ark));
                foreach ($playerArkPhases as $idIArk => $phase) {

                    if(isset($ark)){
                        if ($idIArk == $ark->getId()) {
                            $arkPhase = $masterArk->editPlayerArkStatus((array)$ark, $phase);
                        }
                    }
                }
                $playerArks[$position] = $arkPhase;
            }
        }

        return $playerArks;
    }

}