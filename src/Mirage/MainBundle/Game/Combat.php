<?php
/**
 * Created by PhpStorm.
 * User: Krsanika
 * Date: 2017-04-17
 * Time: 오후 8:39
 */

namespace Mirage\MainBundle\Game;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use Doctrine\ORM\EntityManager;
use Mirage\MainBundle\Document\SkillLevelEffectContent;
use Mirage\MainBundle\Game\GameConfig;
use Mirage\UserBundle\Entity\IEncounter;
use Mirage\UserBundle\Entity\IEncounterPawnStatus;
use Mirage\UserBundle\Entity\IEncounterPawn;

class Combat
{



    /*
     * 전투 도중 각각의 스킬을 적용하는 펑션을 만들고, 거기에서 사용하는 두스킬이 끝난 뒤
     * 기를 채우는것을 잊지말것
     * */

    /*
     * 팀이펙트를 찾아서 걸어주는것이 아직 없습니다.
     * 잊지 말고 구현하지 않으면....
     * */
    public static function startSkills($pawns, $em, $progress, $now, $turn)
    {
        foreach($pawns as &$pawn){
            //스킬을 실행
            foreach($pawn->getSkills() as $skill) {
                foreach ($skill['effects'] as $effect) {
                    foreach ($effect->getEffectContents() as $content) {
                        //듀레이션이 -1이면 시작할때부터 쭉 걸리는 패시브
                        if($content->getDuration() == -1){
                            $consecration = self::consecration($pawn, $pawns, $effect->getTarget(), $content->getArea(), $pawn->getPosition(), $progress);

                            if($consecration->count()){
                                $results = self::doSkill($em, $pawn, $content,$consecration, $progress, $now, $turn);
                            }
                        }
                    }
                }
            }
            //스킬결과를 조회하여 적용
            if(isset($results)){
                foreach($results as $result){
                    if($result['log']['judge'] == GameConfig::$SKILL_JUDGE['MISS'])
                        continue;
                    if($result['modifiedPawn']->getPosition() == $pawn->getPosition()){
                        $pawn = $result['modifiedPawn'];
                    }
                }
            }

        }
//        $em->persist();


        return $pawns;
    }



    //2차원좌표계에 화면내의 폰 좌표를 때려박는 작업
    public static function cubePawns($all, $progress){
        $cube = [[]];
        foreach($all as $pawn) {
            if ($progress < substr($pawn->getPosition(), 1) && substr($pawn->getPosition(), -1, -1) < $progress + 6) {
                switch ($pawn->getPosition()) {
                    case 'a' :
                        $pos = 1;
                        break;
                    case 'b' :
                        $pos = 2;
                        break;
                    case 'c' :
                        $pos = 3;
                        break;
                    default :
                        $pos = 1;
                        break;
                }
                $cube[substr($pawn->getPosition(), 1) - $progress][$pos] = $pawn;
            }
        }
        return $cube;
    }

    public static function consecration(IEncounterPawn $my, $all, $target, $area, $spot, $progress){
        $sacrifice = new ArrayCollection();

        if($target == 4){
            $sacrifice->add($my);
            return $sacrifice;
        }


        //에리어에 의한 스킬시작점 선별
        $withSelf = true;

        if($area > 100){
            if($area > 10){
                $area -= 10;
                $withSelf = false;
            }
            switch($area){
                case 1 : //1칸
                    foreach($all as $pawn){
                        if($pawn->getPosition() == $spot){
                            $sacrifice->add($pawn);
                            break;
                        }
                    }
                    break;
                case 2 : //줄
                    foreach($all as $pawn){
                        if(substr($pawn->getPosition(), -1) == substr($spot, -1)){
                            $sacrifice->add($pawn);
                        }
                    }
                    break;
                case 3 : //열
                    foreach($all as $pawn){
                        if(substr($pawn->getPosition(), 0, 1) == substr($spot, 0, 1)){
                            $sacrifice->add($pawn);
                        }
                    }
                    break;
                case 4 : //아군전체
                    foreach($all as $pawn){
                        if($pawn->isPlayer() && self::searchMapIn($pawn, $progress)){
                            $sacrifice->add($pawn);
                        }
                    }
                    break;
                case 5 : //적군전체
                    foreach($all as $pawn){
                        if(!$pawn->isPlayer() && self::searchMapIn($pawn, $progress)){
                            $sacrifice->add($pawn);
                        }
                    }
                    break;
                case 6 : //십자
                    foreach($all as $pawn){
                        if(!$pawn->isPlayer() && self::searchMapInCrux($pawn, $progress, $spot)){
                            $sacrifice->add($pawn);
                        }
                    }
                    break;
                case 7 : //맵
                    foreach($all as $pawn){
                        if(self::searchMapIn($pawn, $progress)){
                            $sacrifice->add($pawn);
                        }
                    }
                    break;
                case 8 : //필드
                    $sacrifice = $all;
                    break;

            }

        }else if ($area > 100){ //태그를 이용한 타겟팅
            $idTag = $area - 100;
            foreach($all as $pawn){
                if($pawn->getTags()->contains($idTag)){
                    $sacrifice->add($pawn);
                    continue;
                }
                foreach($pawn->getStatus() as $status){
                    //62 : FALLOW_TAG
                    if($status->getIdCondition() == 62 && $status->getIdSubject() == $idTag ){
                        $sacrifice->add($pawn);
                        continue;
                    }
                }
            }
        }




        //피아식별에 의한 선별
        if($target == 1) $sacrifice = self::filteringFoF($sacrifice, true);
        elseif($target == 2) $sacrifice = self::filteringFoF($sacrifice, false);

        return $sacrifice;
    }

    //적아군 선별기

    public static function searchMapIn($pawn, $progress){
        $mapIn = false;
        $pawnY = (int)substr($pawn->getPosition(), -1);
        if($progress < $pawnY && $pawnY < $progress+6) $mapIn = true;
        return $mapIn;
    }

    public static function searchMapInCrux($pawn, $progress, $spot){
        $mapIn = false;
        $pawnX = substr($pawn->getPosition(), 0, 1);
        $pawnY = (int)substr($pawn->getPosition(), -1);

        if($pawnX == substr($spot, 0, 1) && $progress < $pawnY && $pawnY < $progress+6) $mapIn = true;
        return $mapIn;
    }

    public static function filteringFoF($pawns, $isPlayer){
        foreach($pawns as &$pawn){
            if(!($pawn->isPlayer() == $isPlayer)){
                unset($pawn);
            }
        }
        return $pawns;
    }


    //타겟확정기

    public static function doSkill(&$em, &$my, &$content, &$targets, &$progress, &$now, &$turn)
    {
        $results = [];
        //타입에 의한 분류
        switch($content->getType()){

            case "DEAL" : $results = self::deal($em, $content, $my, $targets, $progress, $now); break;
            case "IGNDEAL" : $results = self::deal($em, $content, $my, $targets, $progress, $now); break;
//            case "DEAL_VAMPRIC" : break;
//            case "DEAL_CRI" :  break;
//            case "DEAL_NOCRI" : break;
//            case "DEAL_SUIIDE" : break;
            case "DEAL_SPECIAL_TAG" : break;
//            case "DEAL_SPECIAL_TEAM" : break;
//            case "DEAL_PER_MAX_HP" : break;
            case "DEAL_PER_CURRENT_HP" : break;

            case "CONDITION_ADD" : self::addCondition($em, $content, $my, $targets, $now);
//            case "CONDITION_REMOVE" : self::removeCondition($em, $content, $my, $targets);
//            case "CONDITION_CLEAR" : self::clearCondition($em, $content, $targets);
//            case "CONDITION_COPY" : break;
//            case "CONDITION_MOVE" : break;
//            case "RANDOM_UP" : break;


            case "HEAL" :  $results = self::heal($em, $content, $my, $targets, $progress, $now); break;
//            case "REVIVE" : break;
            case "VANISH" : $results = self::vanished($em, $content, $my, $targets, $progress, $now); break;

//            case "Y_ADD" : break;
//            case "Y_DIF" : break;
            case "X_ADD" : break;
//            case "X_DIF" : break;
//            case "TELEPORT" : break;

//            case "DRAIN_HP" : break;
//            case "DRAIN_MP" : break;
//            case "EXCHANGE_HP" : break;
            case "DEBUFF_REVERSE" : break;

//            case "BUFF_VOLUME_UP" : break;
//            case "BUFF_VOLUME_DOWN" : break;
//            case "BUFF_DURATION_UP" : break;
//            case "BUFF_DURATION_DOWN" : break;
//            case "DEBUFF_VOLUME_UP" : break;
//            case "DEBUFF_VOLUME_DOWN" : break;
//            case "DEBUFF_DURATION_UP" : break;
//            case "DEBUFF_DURATION_DOWN" : break;
//            case "TERRAIN_MAKE" : break;
//            case "TERRAIN_REMOVE" : break;

            default:
                break;


        }

        return $results;
    }

    //기술들어갈지 말지를 판정
    public static function randCheck($chance){
        //나중에 적당한 확률기 만들것
        $rand = mt_rand(1, 100);
        //확률을 못넘으면 실패!
        if($chance < $rand) return false;
        else return true;
    }


    public static  function deal(EntityManager &$em, SkillLevelEffectContent $content, IEncounterPawn $my, ArrayCollection &$targets, IEncounter $iEncounter)
    {
        $results = [];
        foreach($targets as &$target) {
            $result = [];

            //각 스테이터스 별로 attack과 크리티컬에 관련된 것을 더하거나 빼어 수치를 조정하여 사용.
            $modifier = self::getStatusModifyVolume($my,$target,$content,$iEncounter);

            //히트확률 본다.
            //기술들어갈지 말지를 판정
            $hitChance = $my->getAgi()+$modifier["agi"]+$modifier["accuracyRate"];
            //아군끼리는 저항 안함 (상대의 콘을 보지 않음)
            if($my->isPlayer() != $target->isPlayer())
                $hitChance -= ($target->getCon()+$modifier["targetDef"]);

            //나중에 적당한 확률기 만들것

            //안맞으면 안한다.(리절트에 미스라는 값을 넣어서 주긴해야함
            if(self::randCheck($hitChance)){
                //실패했다는 로그 필요함.
                $results[] += ["judge" => GameConfig::$SKILL_JUDGE['MISS'], "target" => $target];
                continue;
            }else{
                array_push($result, ["judge" => GameConfig::$SKILL_JUDGE['HIT']]);
            }

            //크리로 맞을수도 있다. 크리확률은 공식받아내라. (턴 수 관여한다)
            $criChance = 10 + $modifier["critical"] + ($iEncounter->getProgress() * 2);
            //나중에 적당한 확률기 만들것
            if($content->getType() == "DEAL_CRI"){
                $result['judge'] = GameConfig::$SKILL_JUDGE['CRITICAL'];
            }elseif($content->getType() == "DEAL_NOCRI"){

            }elseif(self::randCheck($criChance)){
                //크리티컬 로그
                $result['judge'] = GameConfig::$SKILL_JUDGE['CRITICAL'];
            }


            //확률에 성공하면 이것저것 판정
            $type = $content->getType();
            $isPercent = false;
            $myAttack = 0;
            switch($type)
            {
                case "DEAL" : $isPercent = true;
                    break;
                default:
                    break;
            }
            if($type > 100) $isPercent = true;

            //맞았을 경우!
            //살해자의 공격력과 타겟의 방어력 산출
            //각자가 가진 관련 버프들을 싹 검사해야함. 포이치.
            //산출이 끝나면 공 빼기 방 하면 대충 그게 데미지겠지 뭐 아몰랑
            //atk업의 경우, 퍼센트에 의한 업과 덧뺄셈에 의한 수정이 별도로 존재함
            //같이 있을땐 먼저 다 더한 뒤 곱한다. 곱하기가 무조건 나중임
            //태그에 의한 보정
            //클래스에 의한 보정
            //각종 특공 때문에 생기는 나구리아이 우주
            if($isPercent)
                $myAttack += floor($my->getAtk()+$content->getVolume()/100) + $modifier["atk"];
            else
                $myAttack += $my->getAtk()+$content->getVolume()+ $modifier["atk"];
            $targetDefend = 0;

            if($type != "IGNDEAL")
            {
                $targetDefend += $target->getDef()+$modifier["targetDef"];
            }

            /* damage 공식 */
            $damage = $myAttack - $targetDefend + $modifier["damage"];

            //damage is min 1
            if($damage < 1)
            {
                $damage = 1;
            }
            //크리가 났었으면 2배 데미지
            if($result['judge'] == GameConfig::$SKILL_JUDGE['CRITICAL'])
            {
                $damage = $damage*2;
            }

            //데미지가 확정된 뒤의 처리
            //hp를 깎는다
            $target->setHp($target->getHp()-$damage);
            if($target->getHp() <= 0)
            {
                //죽었으면 isDead가 트루하다
                $target->setHp(0);
                $target->setIsDead(true);
            }
            //로그에 넣는다
            array_push($result, ['striker' => $my->getId()]);
            array_push($result, ['receiver' => $target->getId()]);
            array_push($result, ['type' => $type]);
            array_push($result, ['volume' => $damage]);


            //em을 플러쉬한다
            $em->flush();
            //변경이 끝난 타겟은 리절트에 넣어서 돌려줘야함
            array_push($results, ['log' => $result, 'modifiedPawn' => $target]);

        }
        return $results;
    }

    public static function vanished(EntityManager $em, SkillLevelEffectContent $content, IEncounterPawn $my, ArrayCollection &$targets){
        $results = [];
        foreach($targets as &$target) {
            //즉사율 : (스킬발동확률+공격자어질-방어자콘)/보스등급
            $doom = floor( ($content->getChance() + $my->getAgiContainStatus() - $target->getConContainStatus() ) / GameConfig::DIGNITY_RATE[$target->getDignity()] );
            if($doom < 1) $doom = 1;

            if(!self::randCheck($doom)){
                $results += ["judge" => GameConfig::$SKILL_JUDGE['MISS'], "target" => $target];
                continue;
            }
            $target->setIsDead(true);
            $target->setHp(0);
            $em->flush();
            $results += ["judge"=> GameConfig::$SKILL_JUDGE];
        }

        return $results;
    }



    public static  function heal(EntityManager &$em, SkillLevelEffectContent $content, IEncounterPawn $my, ArrayCollection &$targets,  IEncounter $encounter)
    {
        $results = [];
        $progress = $encounter->getProgress();
        foreach($targets as &$target) {
            $modifyCriticalChanceStatusVolume = 0;
            $modifyAboutHealStatusVolume = 0;
            $modifyAboutDefendStatusVolume = 0;
            $modifyBABStatusVolume = 0;
            $targetHealUp = 0;

            //타겟의 상태중 힐이 불가능한 경우 이 모든것을 패스하고 로그에는 회복불가로 놓는다.
            if(!self::isHealCan($target) || $target->getIsDead())
            {
                //회복이 불가능한 경우 처리할것.
                if($target->getIsDead())
                    $results[] += ["result" => GameConfig::$SKILL_JUDGE['FAIL_TARGET_IS_DEAD'], "target" => $target];
                else
                    $results[] += ["result" => GameConfig::$SKILL_JUDGE['FAIL_FROM_NO_HEAL'], "target" => $target];
                continue;
            }

            //각 스테이터스 별로 힐량과 크리티컬에 관련된 것을 더하거나 빼어 수치를 조정하여 사용.
            $modifier = self::getStatusModifyVolume($my,$target,$content, $encounter);

            //히트확률 본다.
            //기술들어갈지 말지를 판정
            //아군끼리는 저항 안함 (상대의 콘을 보지 않음)
            $baseChance = $my->getAgiContainStatus()+ $modifier["accuracyRate"];
            if($my->isPlayer() != $target->isPlayer())
                $baseChance -= ($target->getConContainStatus()+$modifier["targetDef"]);

            //크리로 맞을수도 있다. 크리확률은 공식받아내라. (턴 수 관여한다)
            $criticalChance = ($baseChance + $modifier["critical"]) * $progress*5;
            //나중에 적당한 확률기 만들것
            $criRend = mt_rand(0, 99);
            $isCritical = false;
            if($criticalChance > $criRend){
                //크리티컬 로그
                $results[] += ["result" => GameConfig::$SKILL_JUDGE['CRITICAL'], "target" => $target];
                $isCritical = true;
            }

            //확률에 성공하면 이것저것 판정
            $type = $content->getType();

            $isPercent = false;
            switch($type)//type에 따라 수정할것
            {
                case "" : $isPercent = true;
                    break;
            }

            //맞았을 경우!
            //heal업의 경우, 퍼센트에 의한 업과 덧뺄셈에 의한 수정이 별도로 존재함
            //같이 있을땐 먼저 다 더한 뒤 곱한다. 곱하기가 무조건 나중임
            //태그에 의한 보정
            //클래스에 의한 보정
            //각종 특공 때문에 생기는 나구리아이 우주
            $myHeal = 0;
            if($isPercent)
                $myHeal += floor( $target->getHp() * $content->getVolume()/100 ) + $modifier["heal"];
            else
                $myHeal += $content->getVolume() + $modifier["heal"];

            /* heal 공식 */
            $healVolume = $myHeal;

            //heal is min 1
            if($healVolume < 1)
            {
                $healVolume = 1;
            }

            if($isCritical)
            {
                $healVolume =  $healVolume*2;
            }

            //데미지가 확정된 뒤의 처리
            //hp를 깎는다
            $target->setHp($target->getHp() + $healVolume);
            //로그에 넣는다
            $battleLog = [
                'judge' => GameConfig::$SKILL_JUDGE['HIT'],
                'striker' => $my->getId(),
                'receiver' => $target->getId(),
                'type' => $type,
                'volume' => $healVolume,
            ];
            //em을 플러쉬한다
            $em->flush();
            //변경이 끝난 타겟은 리절트에 넣어서 돌려줘야함
            array_push($results, ['log' => $battleLog, 'modifiedPawn' => $target]);

        }
        return $results;
    }
    //로그쓰는 놈

    public static function isHealCan($target)
    {
        $isHealCan = true;
        foreach($target->getStatus() as $status)
        {
            if($status->getIdCondition() == 52)//회복불가 컨디션 아이디를 넣어둠
            {
                $isHealCan = false;
            }
        }

        return $isHealCan;
    }

    public static function writeBattleLog($judge, $type, $idStriker, $idReceiver, $volume){
        $log = [];

        //실제 기록은 아직 안함. 나중에 추가할 것

        return $log;
    }

    public static function applyCondition($pawn, $status){
        $result = null;
        switch($status->getIdCondition()){
            case 1 : //중독
                $result = Combat::poison($pawn, $status);
            case 3 : //감염
                $result = Combat::infection($pawn, $status);
            case 4 : //출혈
                $result = Combat::bleed($pawn, $status);
                break;
        }

        return $result;
    }

    public static function poison($pawn, $status){
        $per = $status->getPercent();

        return $pawn;
    }

    public static function infection($pawn, $status){

    }

    public static function bleed($pawn, $status){

    }

    public static function getStatusModifyVolume(IEncounterPawn $my, IEncounterPawn $target, SkillLevelEffectContent $contents, IEncounter $iEncounter)
    {
        //공격력, 방어력, 속도, 건강, 체력, 데미지, 회복량, 크리티컬 확률, 즉사 확률, 회피 확률, 명중률, 디버프의 효과, 디버프의 지속시간, 마나 획득에 대한 수정치를 모두 계산한다.
        //이러한 수정치의 기준은 모두 스킬을 사용하는 자의 기준으로 한다.
        //단 예외적으로 상대의 방어와 건강에 대해서만 targetDefModify와 targetConModify에 저장하여 리턴한다.

        //atk, def, agi, con, hp, damage, heal, critical, vanish percent,dodge percent, accuracy rate, debuff volume, debuff duration, get mama
        $modify = [
            "atk" =>0,
            "def"=>0,
            "agi" =>0,
            "con"=>0,
            "maxHp"=>0,
            "heal"=>0,
            "accuracyRate"=>0,
            "damage"=>0,
            "critical" =>0,
            "vanishPercent"=>0,
            "dodgePercent"=>0,
            "targetDef" =>0,
            "targetCon" =>0,
            "debuffVolume"=>0,
            "debuffDuration"=>0,
            "getMyMana"=>0,
            "getTargetMana"=>0,
            "targetStatusResist"=>0,
            "rushDamage"=>0
        ];

        foreach($my->getStatus() as $status)
        {
            switch($status->getIdCondition())
            {
                case  4 : $modify["atk"] += $status->getVolume(); break; //공업	대상의 공격력이 수치 만큼 증가한다
                case  5 : $modify["def"] += $status->getVolume(); break; //방업	대상의 방어력이 수치 만큼 증가한다
                case  6 : $modify["agi"] += $status->getVolume(); break; //속업	대상의 속도가 수치 만큼 증가한다
                case  7 : $modify["con"] += $status->getVolume(); break; //건업	대상의 건강이 수치 만큼 증가한다
                case  8 : $modify["atk"] -= $status->getVolume(); break; //공다운	대상의 공격력이 수치 만큼 감소한다
                case  9 : $modify["def"] -= $status->getVolume(); break; //방다운	대상의 방어력이 수치 만큼 감소한다
                case 10 : $modify["agi"] -= $status->getVolume(); break; //속다운	대상의 속도가 수치 만큼 감소한다
                case 11 : $modify["con"] -= $status->getVolume(); break; //건다운	대상의 건강이 수치 만큼 감소한다
                case 13 : $modify["atk"] += self::CountFOF($iEncounter,$my)["countFoe"] * $status->getVolume(); break; //무쌍	대상의 공격력이 적의 수*수치 만큼 증가한다
                case 15 : $modify["atk"] += $iEncounter->getSpEnemy()/10 * $status->getVolume(); break; //수세전	적 진영의 마나에 비례해 대상의 공격력이 수치 만큼 증가한다
                case 16 : $modify["atk"] += $iEncounter->getSpPlayer()/10 * $status->getVolume(); break; //공세전	아군 진영의 마나에 비례해 대상의 공격력이 수치 만큼 증가한다 (1칸당 지정된 수치)
                case 17 : $modify["accuracyRate"] += $status->getVolume(); break; //집중	대상은 지정된 수치 만큼 명중률이 증가한다
                case 18 : $modify["accuracyRate"] -= $status->getVolume(); break; //번뜩	대상은 지정된 수치 만큼 명중률이 감소한다
                case 19 : $modify["maxHp"] += $status->getVolume(); break; //여유	대상의 최대 HP가 수치 만큼 증가한다
                case 20 : $modify["maxHp"]-= $status->getVolume(); break; //초조	대상의 최대 HP가 수치 만큼 감소한다
                case 29 : $modify["damage"] += $status->getVolume(); break; //진지	주는 피해가 수치 만큼 증가한다
                case 30 : $modify["damage"] -= $status->getVolume(); break; //허무	주는 피해가 수치 만큼 감소한다
                case 31 : $modify["rushDamage"] += $status->getVolume(); break; //전격전	대상의 돌격 피해가 수치 만큼 증가한다
                case 32 : if(self::checkTag($target,$contents->getIdSubject())) $modify["damage"] += $status->getVolume(); break; //원한	특정 팀의 아크페이즈에게 주는 피해가 수치 만큼 증가한다
                case 33 : $modify["damage"] += $my->getStatus()->count() * $status->getVolume(); break; //쾌도난마	자신에게 적용된 상태 이상의 개수 x 지정된 수치 만큼 데미지가 증가한다
                case 38 : $modify["debuffVolume"] += $status->getVolume(); break; //철두철미	자신이 주는 디버프의 효과가 수치 만큼 증가한다
                case 39 : $modify["debuffVolume"] -= $status->getVolume(); break; //설렁설렁	자신이 주는 디버프의 효과가 수치 만큼 감소한다
                case 40 : $modify["debuffDuration"] += $status->getVolume(); break; //잔혹함	자신이 주는 디버프의 지속 시간이 수치 만큼 증가한다
                case 41 : $modify["debuffDuration"] -= $status->getVolume();  break; //신사적	자신이 주는 디버프의 지속 시간이 수치 만큼 감소한다
                case 42 : $modify["getMyMana"] += $status->getVolume(); break; //스웩	대상의 전투 중 마나 얻는 양이 증가한다
                case 43 : $modify["getMyMana"] -= $status->getVolume(); break; //디스	대상의 전투 중 마나 얻는 양이 감소한다
                case 52 : $modify["heal"] += $status->getVolume(); break; //대자대비	자신이 주는 회복 스킬의 효과가 수치 만큼 증가한다
                case 53 : $modify["heal"] -= $status->getVolume(); break; //번아웃 대상이 주는 회복 스킬의 효과가 수치 만큼 감소한다
                case 57 : $modify["vanishPercent"] +=  $status->getPercent(); break; //재수	자신의 공격의 즉사 효과의 확률이 수치 만큼 증가한다
                //$targetHealUp - ($target->getHp()*$status->getPercent())/100;
                //즉사 확률 부분 어느걸 기준으로 올려줄건지 기획자에게 받아서 수정할것. 위쪽은 참고용
            }
        }

        foreach($target->getStatus() as $status)
        {
            switch($status->getIdCondition())
            {
                case  5 : $modify["targetDef"] += $status->getVolume(); break; //방업	대상의 방어력이 수치 만큼 증가한다
                case  7 : $modify["targetCon"] += $status->getVolume(); break; //건업	대상의 건강이 수치 만큼 증가한다
                case  9 : $modify["targetDef"] -= $status->getVolume(); break; //방다운	대상의 방어력이 수치 만큼 감소한다
                case 11 : $modify["targetCon"] -= $status->getVolume(); break; //건다운	대상의 건강이 수치 만큼 감소한다
                case 12 : $modify["dodgePercent"] += $status->getPercent(); break; //능둔	대상이 공격을 회피할 확률이 수치 만큼 증가한다
                case 14 : $modify["targetDef"] += self::CountFOF($iEncounter,$target)["countFoe"] * $status->getVolume(); break; //마왕	대상의 방어력이 적의 수*수치 만큼 증가한다
                case 27 : $modify["damage"] += $status->getVolume(); break; //부끄러움	 받는 피해가 수치 만큼 증가한다
                case 28 : $modify["damage"] -= $status->getVolume(); break; //새침	받는 피해가 수치 만큼 감소한다
                case 37 : $modify["targetStatusResist"] -= $status->getPercent(); break; //내성	대상의 상태 이상의 확률이 수치 만큼 감소한다
                case 42 : $modify["getTargetMana"] += $status->getVolume(); break; //스웩	대상의 전투 중 마나 얻는 양이 증가한다
                case 43 : $modify["getTargetMana"]-= $status->getVolume(); break; //디스	대상의 전투 중 마나 얻는 양이 감소한다
                case 54 : $modify["heal"] += $status->getVolume(); break; //생명력 받는 회복 스킬의 효과가 수치 만큼 증가한다
                case 55 : $modify["heal"] -= $status->getVolume(); break; //역병 받는 회복 스킬의 효과가 수치 만큼 감소한다
            }
        }

        return $modify;
    }

    public static function checkTag(IEncounterPawn $pawn, $checkTag)
    {
        $isTag = false;

        foreach($pawn->getTags() as $tag)
        {
            if($tag == $checkTag)
            {
                $isTag = true;
            }
        }

        return $isTag;
    }

    public static function CountFOF(IEncounter $iEncounter, IEncounterPawn $my)
    {
        $countFriend = 0;
        $countFoe = 0;

        foreach ( $iEncounter->getPawns() as $pawn) {
            $positionNum = intval(substr($pawn->getPosition(), 1));
            if ($iEncounter->getProgress() <= $positionNum && $positionNum < $iEncounter->getProgress() + 6) {
                if ($my->isPlayer() == $pawn->isPlayer()) $countFriend++;
                else $countFoe++;
            }
        }
        return ["countFriend"=>$countFriend, "countFoe"=> $countFoe];
    }
}