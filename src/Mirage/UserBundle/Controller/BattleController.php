<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-16
 * Time: 오후 2:19
 */

namespace Mirage\UserBundle\Controller;

use Mirage\MainBundle\Document\AlterSkill;
use Mirage\MainBundle\Document\Ark;
use Mirage\MainBundle\Game\ArkInfo;
use Mirage\MainBundle\Game\Combat;
use Mirage\MainBundle\Game\SystemMassage;
use Mirage\UserBundle\Controller\Controller;
use Mirage\UserBundle\Entity\IEncounter;
use Mirage\UserBundle\Entity\IEncounterPawn;
use Mirage\UserBundle\Entity\IEncounterPawnStatus;
use Mirage\UserBundle\Entity\Player;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Mirage\UserBundle\Entity\IDeckRepository;
use Mirage\UserBundle\Entity\IArkRepository;
use Mirage\UserBundle\Entity\IItem;
use Mirage\UserBundle\Controller\SummonController as UserSummon;
use Mirage\AdminBundle\Controller\GameConfig;
use Symfony\Component\Security\Acl\Exception\Exception;

class BattleController extends Controller
{
    /**
     * @Route("/start", name="start")
     */
    public function startAction(Request $request)
    {
//      http://1.229.95.138:9000/app_krsanika.php/user/battle/start?token=1&id_enc=5&deck_number=1&id_friend_phase=91&friend_position=a0&difficulty=3
        $dm = $this->get('doctrine_mongodb')->getManager();
        $em = $this->getDoctrine()->getManager('user1_admin');


//        유저가 누군지는 멤캐쉬 참조. 덱ID와 다를경우 이놈은 어뷰징임
//        GMemcached::get('Id')
        $token = $request->get('token');
        $player = $this->getPlayer($token);
//        인트면 에러에욧 되돌려욧
        if (empty($player) || is_int($player))
            return new Response(SystemMassage::ERROR_PLAYER_NOT_EXIST);

//      이미 전투가 있으면 안열어욧
        $exist = $em->getRepository('MirageUserBundle:IEncounter')->findBy(["idPlayer" => $player->getId(), "isEnabled" => true]);
//        if(count($exist))
//            return new Response(SystemMassage::ERROR_ENCOUNTER_EXIST);


//      아니면 다른 값을 불러와서 일을 시작해욧
        $deckNumber = $request->get('deck_number');
        $idEncounter = $request->get('id_enc');
        $idFriend = $request->get('id_friend_phase');
        $friendPosition = $request->get('friend_position');
        $difficulty = $request->get('difficulty');

//      인풋된 값이 잘됐는지 확인해욧
        if (empty($deckNumber) || empty($idEncounter) || empty($difficulty))
            return new Response(SystemMassage::ERROR_INPUT_INCORRECT);

//      이 엔카운터를 진행해도 되는지 조회하는 에피소드쪽 메소드 필요해욧 지금은 바빠서 못해욧
        $encounter = $dm->getRepository('MirageMainBundle:Encounter')->findOneByIdEnc((int)$idEncounter);


//      플레이어 덱을 가져와욧
        $iDeck = $em->getRepository('MirageUserBundle:IDeck')->findOneBy(["id" => $player->getId(), "deckNumber" => $deckNumber]);
        if(isset($idFriend)){
            $friend = $em->getRepository('MirageUserBundle:IArkPhase')->find($idFriend);
        }

//      덱이 없으면 게임할 준비가 안된거에욧
        if (empty($iDeck))
            return new Response($this->ObjectToJson(SystemMassage::ERROR_PLAYER_NOT_EXIST));

//      친구 사용했으니 업데이트함. 생판남이면 암것도 안함
        if(isset($idFriend)){
            $iFriend = $em->getRepository('MirageUserBundle:IFriend')->findOneBy(['idPlayer' => $player->getId(), 'idFriend' => $friend->getIdPlayer()]);
            if (isset($iFriend))
                $iFriend->setUpdated($this->nowTime());
        }


//      엔카운터 작성
        $iEncounter = new IEncounter($player->getId(), $encounter, $this->nowTime());

        $em->persist($iEncounter);
        $em->flush();

//      작성된놈의 ID취득


//
//      아군등록
        foreach ($iDeck->getArkPosition() as $posStr => $iArkPhase) {
            if (empty($iArkPhase)) continue;
            $myPawn = new IEncounterPawn($iEncounter, $this->nowTime());
            $phase = $dm->getRepository('MirageMainBundle:Ark')->findOnePhaseByIdPhase($iArkPhase->getIdPhase());
            $myPawn->createFromIArkPhase($iArkPhase, $phase, $posStr);
            $em->persist($myPawn);
            //스킬등록
            $myPawn = $this->addSkillToPawn($dm, $myPawn, $iArkPhase, $iArkPhase->getSkillOpen());
            //패시브버프확인
            $iEncounter->getPawns()->add($myPawn);

        }

//      친구캐등록
        if(isset($idFriend)){
            $friendPawn = new IEncounterPawn($iEncounter, $this->nowTime());
            $fPhase = $dm->getRepository('MirageMainBundle:Ark')->findOnePhaseByIdPhase($friend->getIdPhase());
            $friendPawn->createFromIArkPhase($friend, $fPhase, $friendPosition);
            $em->persist($friendPawn);
            //스킬등록
            $friend = $this->addSkillToPawn($dm, $friendPawn, $friend, $friend->getSkillOpen());

            //패시브버프확인
            $iEncounter->getPawns()->add($friendPawn);
        }

//      적군등록
        foreach ($encounter->getTiles() as $tile) {
//            foreach ($tile->getEnemies() as $enemy) {
            $enemy = $tile->getEnemy();
                $enemyPawn = new IEncounterPawn($iEncounter, $this->nowTime());
                $phase = $dm->getRepository('MirageMainBundle:Ark')->findOnePhaseByIdPhase($enemy->getIdPhase());
                $enemyPawn->createFromEnemy($enemy, $phase, $tile->getLocation());
                $enemyPawn = $this->addSkillToPawn($dm, $enemyPawn, $phase, $enemy->getModify()->getSkillActivate(), $difficulty, $enemy->getModify()->getAlterSkill());

                $iEncounter->getPawns()->add($enemyPawn);
                $em->persist($enemyPawn);
                //패시브버프확인

//            }
        }
        $pawns = Combat::startSkills($iEncounter->getPawns(), $em, $iEncounter, $this->nowTime(), 0);
        $iEncounter->setPawns($pawns);
        $data = $iEncounter;
        $em->flush();



//      되돌릴 데이터 가공시작
//      엔카운터, 스킬 등 SQL저장안되는 정보를 붙임
        $data->setEncounter($encounter);



        $data->unsetForBattle($token);
        return new Response($this->ObjectToJson($data));
    }


    public function addSkillToPawn($dm, $pawn, $origin, $open, $difficulty = null, $alter = null){
        $phase = $dm->getRepository('MirageMainBundle:Ark')->findOnePhaseByIdPhase($origin->getIdPhase());
        $i = 1;

        foreach($phase->getSkills() as $skill){

            if($i < $open+1){
                if(property_exists($origin, "grade")){ //몹일때

                    $data = $skill->getDataWithLevel($difficulty*2);
                    //알터스킬 끼워넣기
                    foreach($alter as $alt){
                        if($alt->getSkillSlotNumber() == $i){
                            $data = $alt->getSkill()->getDataWithLevel($difficulty*2);
                            break;
                        }
                    }
                }else{ //아군일때
                    $data = $skill->getDataWithLevel($origin->{'getSkill'.$i.'Lv'}() );
                }
                $pawn->getSkills()->add($data);
                $i++;
            }
        }

        $dm->clear();
        return $pawn;
    }

    /**
     * @Route("/prepare", name="prepare")
     */
    public function prepareAction(Request $request)
    {
        // http://1.229.95.138:9000/app_krsanika.php/user/battle/prepare?token=1&id=416

        $em = $this->getDoctrine()->getManager('user1_admin');
        $id = $request->get('id');
        $iEncounter = $em->getRepository('MirageUserBundle:IEncounter')->findOneByIdEnc($id);

        if(empty($iEncounter)){
            return new Response(SystemMassage::ERROR_ENCOUNTER_NOT_EXIST);
        }

        //턴수 증가.
        $iEncounter->setTurn($iEncounter->getTurn()+1);
        $results = [];
        foreach($iEncounter->getPawns() as &$pawn){
            foreach($pawn->getStatus() as &$status){
                //보유한 스테이터스의 남은시간을 계산, 끝나면 빼버림
                if($status->getDuration() != 0 && $iEncounter->getTurn() > $status->getStartTurn() + $status->getDuration() ){
                    $pawn->removeStatus($status);
                    continue;
                }
                //스테이터스중 남은게 있으면 턴 개시 시점에서 적용할 효과가 있는지 확인
                switch($status->getIdCondition()){
                    case 1 :
                    case 3 :
                    case 4 :
                        $result = Combat::applyCondition($pawn, $status);
                        $pawn = $result['pawn'];
                        $results += $result;
                        break;
                    default: break;
                }
            }
        }

        $em->flush();
        array_push($results, ["turn" => $iEncounter->getTurn()]);
        return new Response($this->ObjectToJson($results));

    }

    /**
     * @Route("/playerStep", name="player_step")
     */
    public function playerStepAction(Request $request)
    {
        // http://1.229.95.138:9000/app_krsanika.php/user/battle/playerStep?token=1&id_encounter=416&id_pawn=2551&id_skill=&spot=a3
        $token = $request->get('token');
        $player = $this->getPlayer($token);
        if(empty($player))
            return new Response(SystemMassage::ERROR_PLAYER_NOT_EXIST);
        $em = $this->getDoctrine()->getManager('user1_admin');
        $dm = $this->get('doctrine_mongodb')->getManager();
        $idEncounter = $request->get('id_encounter');
        $idPawn = $request->get('id_pawn');
        $numSkill = $request->get('num_skill');
        $spot = $request->get('spot');

        $iEncounter = $em->getRepository('MirageUserBundle:IEncounter')->findOneById((int)$idEncounter);
        $pawn = $em->getRepository('MirageUserBundle:IEncounterPawn')->findOneById((int)$idPawn);

        if(empty($pawn) || empty($iEncounter))
            return new Response(SystemMassage::ERROR_ENCOUNTER_NOT_EXIST);
        //통신이상
        if(empty($numSkill) || empty($spot))
            return new Response(SystemMassage::ERROR_INPUT_INCORRECT);

        //스킬취득
        $phase = $dm->getRepository('MirageMainBundle:Ark')->findOnePhaseByIdPhase($pawn->getIdPhase());
        $skill = $phase->getSkillByNum($numSkill, $pawn->getSkillLv($numSkill));
        if(empty($skill))
            return new Response(SystemMassage::ERROR_SKILL_NOT_EXIST);
        //consume 처리
        if(($iEncounter->getSpPlayer() - $skill->getConsume()*10) < 0 )
        {
            return new Response(SystemMassage::ERROR_CONSUME_LACKING);
        }
        $iEncounter->setSpPlayer( $iEncounter->getSpPlayer() - $skill->getConsume()*10);
        //본체
        $results = [];
        foreach($skill->getLevels()->first()->getEffects() as $effect){
            foreach($effect->getContents() as $content){
                $consecration = Combat::consecration($pawn, $iEncounter->getPawns(), $effect->getTarget(), $content->getArea(), $spot, $iEncounter->getProgress());
                $results += Combat::doSkill($em, $pawn, $content, $consecration, $iEncounter, $this->nowTime(), $iEncounter->getTurn());
            }
        }




        $em->flush();


        return new Response($results);
    }

    /**
     * @Route("/enemyTurn", name="enemy_turn")
     */
    public function enemyTurnAction(Request $request)
    {
        $token = $request->get('token');

    }

    /**
     * @Route("/phaseChange", name="phase_change")
     */
    public function phaseChangeAction(Request $request)
    {
        $token = $request->get('token');

    }

    /**
     * @Route("/move", name="move")
     */
    public function moveAction(Request $request)
    {
        $token = $request->get('token');

        //좌표를 모두 한칸씩 옮겨준다.
        $em = $this->getDoctrine()->getManager('user1_admin');


    }

    /**
     * @Route("/charge", name="charge")
     */
    public function chargeAction(Request $request)
    {
        $token = $request->get('token');
        //프로그레스를 따서 가장 가까운 적의 한칸 앞까지 아군의 모든 좌표를 이동하고
        //그 화면 안에 존재하는 적에게 칸수에 따른 데미지 공식(기획자에게 받아낼것)에 따라 데미지를 균등하게 나누어 배분한다.
        //기게이지도 채울것.
    }

    /**
     * @Route("/surrender", name="surrender")
     */
    public function surrenderAction(Request $request)
    {
        $token = $request->get('token');
        //Sql에 IEncounter와 관련된 모든 데이터의 isEnabled를 false로 바꿔준다.
    }

}