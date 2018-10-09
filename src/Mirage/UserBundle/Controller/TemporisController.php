<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-06-26
 * Time: 오후 7:56
 */

namespace Mirage\UserBundle\Controller;

use Mirage\UserBundle\Controller\Controller;
use Mirage\UserBundle\Entity\IItem;
use Proxies\__CG__\Mirage\UserBundle\Entity\Player;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Mirage\UserBundle\Services\GMemcached;
use Mirage\MainBundle\Game\GameConfig;

class TemporisController extends Controller
{

    const TP_TO_AP = 1;
    const TP_TO_GOLD = 2;
    const TP_TO_POWDER = 3;
    const TP_TO_CHARACTER_EXP = 4;
    const TP_TO_CHARACTER_RP = 5;
    const TP_TO_SUMMON_EQUIPMENT = 6;
    const TP_TO_SUMMON_CHARACTER = 7;

    /**
     * @Route("/", name="temporis_index")
     */
    public function indexAction(Request $request){
        $idPlayer = $request->get('id_player');
        $player = $this->getPlayer($idPlayer);
        $temporis = $this->getDoctrine()->getRepository('MirageUserBundle:Temporis')->findOneByIdPlayer($idPlayer);


        $allComponents = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Component')->findAllWithIsHad($idPlayer);

        return new Response($this->ObjectToJson(array('player'=>$player, 'temporis'=>$temporis, 'components'=>$allComponents)));
    }

    /**
     * @Route("/save", name="temporis_save")
     */
    public function saveAction(Request $request){
        $idPlayer = $request->get('id_player');
        $idHour  = $request->get('id_hour');
        $idMinute = $request->get('id_minute');
        $idCrown = $request->get('id_crown');
        $idCase = $request->get('id_case');
        $idChain = $request->get('id_chain');
        $idPlate = $request->get('id_plate');
        $em = $this->getDoctrine()->getManager('user1_admin');
        $temporis = $em->getRepository('MirageUserBundle:Temporis')->findOneByIdPlayer($idPlayer);

        if(isset($idHour)){
            $hourItem = $em->getRepository('MirageUserBundle:IItem')->findOneBy(array('idPlayer'=>$idPlayer, 'idItem'=>$idHour, 'quantity'=> true));
            if(isset($hourItem)) $temporis->setIdHour($idHour);
        }
        if(isset($idMinute)){
            $minuteItem = $em->getRepository('MirageUserBundle:IItem')->findOneBy(array('idPlayer'=>$idPlayer, 'idItem'=>$idMinute, 'quantity'=> true));
            if(isset($minuteItem)) $temporis->setIdMinute($idMinute);
        }
        if(isset($idCrown)){
            $crownItem =  $em->getRepository('MirageUserBundle:IItem')->findOneBy(array('idPlayer'=>$idPlayer, 'idItem'=>$idMinute, 'quantity'=> true));
            if(isset($crownItem)) $temporis->setIdCrown($idCrown);
        }
        if(isset($idCase)){
            $caseItem =  $em->getRepository('MirageUserBundle:IItem')->findOneBy(array('idPlayer'=>$idPlayer, 'idItem'=>$idCase, 'quantity'=> true));
            if(isset($caseItem)) $temporis->setIdCase($idCase);
        }
        if(isset($idChain)){
            $chainItem =  $em->getRepository('MirageUserBundle:IItem')->findOneBy(array('idPlayer'=>$idPlayer, 'idItem'=>$idChain, 'quantity'=> true));
            if(isset($chainItem)) $temporis->setIdCrown($idChain);
        }
        if(isset($idPlate)){
            $plateItem =  $em->getRepository('MirageUserBundle:IItem')->findOneBy(array('idPlayer'=>$idPlayer, 'idItem'=>$idPlate, 'quantity'=> true));
            if(isset($plateItem)) $temporis->setIdCrown($idPlate);
        }

        $temporis->setUpdated($this->nowTime());

        $em->flush();

        return $this->forward('MirageUserBundle:Temporis:index', array('request'=>$request));
    }

    /**
     * @Route("/charge", name="temporis_charge")
     */
    public function chargeAction(Request $request){
        $idPlayer = $request->get('id_player');
        $charge = $request->get('charge');
        $em = $this->getDoctrine()->getManager('user1_admin');
        $player = $em->getRepository('MirageUserBundle:Player')->find($idPlayer);
        $temporis = $em->getRepository('MirageUserBundle:Temporis')->findOneByIdPlayer($idPlayer);
        //차지량을 감당해낼 수 없으면 돌려보냄
        if($charge > ($temporis->getInTime()/GameConfig::LOGIN_TEMPORIS_RATE) + $temporis->getOutTime()){
            //TODO: 지금은 그냥 보내지만 에러가 붙어야함
            return $this->forward('MirageUserBundle:Temporis:index', array('request'=>$request));
        }
        //아웃타임에서 우선적으로 소모됨
        $leftOutTime = $temporis->getOutTime() - $charge;
        if($leftOutTime > 0){
            $temporis->subtractOutTime($charge);
        }else{ //아웃타임 고갈됨
            $temporis->setOutTime(0);
            $temporis->subtractInTime(abs($leftOutTime)*GameConfig::LOGIN_TEMPORIS_RATE);
        }

        //템효율을 더하여 TP가 상승
        $hourhand = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Component')->findPartByComponentId($temporis->getIdHour());
        $minutehand = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Component')->findPartByComponentId($temporis->getIdMinute());

        $charge += floor($charge/3600) * $hourhand->getEffective();
        $charge += floor($charge/60) * $minutehand->getEffective();

        $player->addTp($charge);

        $em->flush();

        return $this->forward('MirageUserBundle:Temporis:index', array('request'=>$request));
    }

    /**
     * @Route("/spend", name="temporis_spend")
     */
    public function spendTpAction(Request $request){
        $idPlayer = $request->get('id_player');
        $idContent = $request->get('id_content');
        //적용량. 가챠류의 경우 작용회수
        $count = $request->get('count');
        if(empty($count)) $count = 1;
        //캐릭터가 필요한 경우 타겟의 IArkId
        $idIArk = $request->get('id_iark');

        $em = $this->getDoctrine()->getManager('user1_admin');
        $player = $em->getRepository('MirageUserBundle:Player')->find($idPlayer);
        $temporis = $em->getRepository('MirageUserBundle:Temporis')->findOneByIdPlayer($idPlayer);
        $tpContent = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:TpContent')->findOneByTpContentId((int)$idContent);
        if(isset($idIArk)) $iArk = $em->getRepository('MirageUserBundle:IArk')->find($idIArk);

        //해당항목의 소모량을 버틸수있는지 확인
        if($player->getTp() > $tpContent->getRate() * $count){
            $player->addTp(-($tpContent->getRate() * $count));
        }else{
            //TODO:: 에러뱉어야함
            return $this->forward('MirageUserBundle:Temporis:index', array('request'=>$request));
        }

        //추가
        switch($tpContent->getType()){
            case self::TP_TO_AP :
                $player->addAp($count);
                break;
            case self::TP_TO_GOLD :
                $player->addMoney(GameConfig::CARGO_GOLD, $count);
                break;
            case self::TP_TO_POWDER :
                $player->addMoney(GameConfig::CARGO_POWDER, $count);
                break;
            case self::TP_TO_CHARACTER_EXP :
                $result = $iArk->addExp($count);
                $em->flush();
                return new Response($this->ObjectToJson($result));
            case self::TP_TO_CHARACTER_RP :
                $iArk->addPointRelationship($count);
                break;
            case self::TP_TO_SUMMON_CHARACTER :

                break;
            case self::TP_TO_SUMMON_EQUIPMENT :

                break;

        }

        $niseConsume = array(

        );


        $em->flush();

        return $this->forward('MirageUserBundle:Temporis:index', array('request'=>$request));
    }


    public function convertPlayerResource(&$em, &$player){


    }




}