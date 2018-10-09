<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-21
 * Time: 오후 10:38
 */

namespace Mirage\MainBundle\Game;


class GameConfig
{

    const LANG = 'KR';
/*    const LANG = 'JP';
*/
    const SUMMON_TARGET_ARKPHASE = 1;
    const SUMMON_TARGET_EQUIPMENT = 2;
    const SUMMON_TARGET_ITEM = 3;

    //Player의 스위치에서 사용하는 reward 타입.
    const CARGO_GOLD = 1;
    const CARGO_LAPIS = 2;
    const CARGO_FRIEND_POINT = 3;
    const CARGO_REAGENT = 4;
    const CARGO_POWDER = 5;
    const CARGO_TICKET = 100;

    //로그인중 손해보는 템포리스의 비율(나눔셈)
    const LOGIN_TEMPORIS_RATE = 2;



    public static $TYPESTR_KR = array(
        1 => "카발리어",
        2 => "택틱오더",
        3 => "프론티어",
        4 => "엔지니어",
        5 => "트릭스터",
        6 => "에임슈터",
        7 => "필드닥터",
    );



    /*
     * 클래스별 능력 보정치,
     * 안쪽의 순서는 각각 Atk,Def,Spd,HP의 보정치이다.
     */
    public static $CORRECTION_VALUE_OF_CLASS = array(
        1 => array("atk"=>0.9,"def"=>0.9,"spd"=>0.6,"hp"=>0.8),
        2 => array("atk"=>1.0,"def"=>0.8,"spd"=>0.8,"hp"=>0.9),
        3 => array("atk"=>1.2,"def"=>0.4,"spd"=>0.6,"hp"=>0.7),
        4 => array("atk"=>1.2,"def"=>0.4,"spd"=>0.8,"hp"=>0.7),
        5 => array("atk"=>0.6,"def"=>1.2,"spd"=>0.5,"hp"=>1.0),
        6 => array("atk"=>0.5,"def"=>0.5,"spd"=>0.9,"hp"=>0.8),
        7 => array("atk"=>0.6,"def"=>0.6,"spd"=>0.6,"hp"=>0.6),
        8 => array("atk"=>0.9,"def"=>0.7,"spd"=>0.9,"hp"=>0.7),
    );

    public static $CORRECTION_VALUE_OF_DIFFICULTY = array(
        0=> 1.0,
        1=> 1.5,
        2=> 2.0
    );
    public static $BIRTH_HP = array(
        1 => 515,
        2 => 634,
        3 => 340,
        4 => 400,
        5 => 480,
        6 => 235,
        7 => 330,
        8 => 380,
    );

    public static $GRADESTR_KR = array(
        1 => "☆",
        2 => "☆☆",
        3 => "☆☆☆",
        4 => "☆☆☆☆",
        5 => "☆☆☆☆☆",
        6 => "☆☆☆☆☆☆",
        7 => "☆☆☆☆☆☆☆",
    );

    public static $DIGNITY_KR = array(
        1 => "조무래기",
        2 => "보통",
        3 => "엘리트",
        4 => "보스",
        5 => "최종보스",
    );

    public static $VANISHED_DIGNITY = [
        1 => 1.0,
        2 => 1.2,
        3 => 1.5,
        4 => 1.7,
        5 => 1.8,
    ];

    public static $TAGSTR_KR = array(
        1 => "남자",
        2 => "여자",
        3 => "어린이",
        4 => "마신",
        5 => "악마",
        6 => "요정",
        7 => "귀신",
        8 => "정령",
        9 => "흡혈귀",
        10 => "수인",
        11 => "무생물",
        12 => "사념체",
        13 => "신령",
        14 => "도깨비",
        15 => "요괴",
        16 => "용족",
        17 => "촉수",
        18 => "군주",
        19 => "왕자",
        20 => "공주",
        21 => "고등학생",
        22 => "대학생",
        23 => "선생",
        24 => "기사",
        25 => "마녀",
        26 => "사장",
        27 => "학자",
        28 => "만화가",
        29 => "해적",
        30 => "사제",
        31 => "싸우는 아가씨",
        32 => "학생회",
        33 => "닌쟈",
        34 => "아이돌",
        35 => "커피파",
        36 => "홍차파",
        37 => "시간능력자",
        38 => "기자",
        39 => "공돌이",
        40 => "연금술사",
        41 => "주술사",
        42 => "소환사",
        43 => "프리랜서",
        44 => "루키",
        45 => "주역",
        46 => "모리배",
        47 => "총잡이",
        48 => "부먹",
        49 => "찍먹",
        50 => "동물",
        51 => "클래식",
        52 => "전교1등",
    );


    public static $TITLESTR_KR = array(
        1 => "아발론",
        10 => "설월화0 제도유곡",
        11 => "설월화",
        12 => "설월화2",
        13 => "설월화3 화신록",
        14 => "설월화4 상륙국풍토기",
        15 => "CIVIL WAR 뱀파이어",
        16 => "CIVIL WAR 워울프",
        21 => "헌티드스쿨/삼백이론",
        22 => "헌티드스쿨/원더러스 에이스",
        23 => "헌티드스쿨/학원기이야담",
        24 => "헌티드스쿨/콘크리트 라비린토스",
        25 => "헌티드스쿨/오늘은 자체휴강",
        26 => "헌티드스쿨/비욘드 스쿨",
        31 => "카메라 ON!",
        41 => "하숙집 도로시",
    );
    public static $TITLESTR_JP = array(
        1 => "아발론",
        10 => "설월화0 제도유곡",
        11 => "설월화",
        12 => "설월화2",
        13 => "설월화3 화신록",
        14 => "설월화4 상륙국풍토기",
        15 => "CIVIL WAR 뱀파이어",
        16 => "CIVIL WAR 워울프",
        21 => "헌티드스쿨/삼백이론",
        22 => "헌티드스쿨/원더러스 에이스",
        23 => "헌티드스쿨/학원기이야담",
        24 => "헌티드스쿨/콘크리트 라비린토스",
        25 => "헌티드스쿨/오늘은 자체휴강",
        26 => "헌티드스쿨/비욘드 스쿨",
        31 => "카메라 ON!",
        41 => "하숙집 도로시",
    );

    public static $ORIGINSTR_KR = array(
        101 => "조커포지 오리지널",
        102 => "계란계란",
        103 => "환상거북",
    );

    public static $ORIGINSTR_JP = array(
        1 => "조커포지 오리지널",
        2 => "계란계란",
        3 => "환상거북",
    );

    public static $TILETYPE = array(
        null => null,
        1 => "독",
        2 => "봉인",
        3 => "방업",
        4 => "속업",
        5 => "공업",
        6 => "재생",
        7 => "크리",
        8 => "즉사",
    );

    public static $POWER_SOURCE = [
        1 => "물리",
        2 => "기공",
        3 => "페이건",
        4 => "과학",
        5 => "그노시스",
        6 => "사이킥",
        7 => "이모션",
        8 => "스피릿",
        9 => "십자교",
        10 => "얄다바오스",
        11 => "사클라스",
        12 => "파편"
    ];

    public static $SKILL_TYPE = [
        null => "",
        "DEAL" => "딜",
        "IGNDEAL" => "방무딜",
        "DEAL_VAMPRIC" => "흡혈딜",
        "DEAL_CRI" => "강제크리",
        "DEAL_NOCRI" => "크리없는딜",
        "RANDOM_UP" => "능력치랜덤상승",
        "CONDITION_ADD" => "컨디션 부여",
        "CONDITION_REMOVE" => "컨디션 제거",
        "CONDITION_CLEAR" => "컨디션 전체제거",
        "CONDITION_COPY" => "컨디션 복사",
        "CONDITION_MOVE" => "컨디션 전이",
        "HEAL" =>"힐",
        "REVIVE" => "소생" ,
        "VANISH" => "즉사기",
        "DEAL_SUICIDE" => "자살딜",
        "Y_ADD" => "올리기",
        "Y_DIFF" => "내리기",
        "X_ADD" => "밀기",
        "X_DIFF" => "당기기",
        "TELEPORT" => "텔레포트",
        "DRAIN_HP" => "HP흡수",
        "DRAIN_MP" => "MP흡수",
        "EXCHANGE_HP" => "HP교환",
        "MP_START_ADD" => "초기MP상승",
        "DEBUFF_REVERSE" => "버프/디버프 반전",
        "BUFF_VOLUME_UP" => "버프효과 상승",
        "BUFF_VOLUME_DOWN" => "버프효과 감소",
        "BUFF_DURATION_UP" => "버프지속 상승",
        "BUFF_DURATION_DOWN" => "버프지속 감소",
        "DEBUFF_VOLUME_UP" => "디버프효과 상승",
        "DEBUFF_VOLUME_DOWN" => "디버프효과 감소",
        "DEBUFF_DURATION_UP" => "디버프지속 상승",
        "DEBUFF_DURATION_DOWN" => "디버프지속 감소",
        "TERRAIN_MAKE" =>"지형효과 작성",
        "TERRAIN_REMOVE"=>"지형효과 제거",
        "DEAL_SPECIAL_TAG" => "태그특공",
        "DEAL_SPECIAL_ARK" => "아크특공",
        "DEAL_SPECIAL_TEAM" => "팀특공",
        "DEAL_PER_MAX_HP" => "최대피통퍼딜",
        "DEAL_PER_CURRENT_HP" => "현재피통퍼딜",
    ];

    public static $SKILL_TARGET =  [
        null => "",
        1 => "아군",
        2 => "적군",
        3 => "피아식별 안함",
        4 => "자신"
    ];

    public static $TERRAIN = [
        null => "",
        1 => "메뚜기",
        2 => "봉쇄",
        3 => "함정",
        4 => "진흙탕",
        5 => "벽",
    ];

    public static $SKILL_AREA = [
        null => "",
        1 => "1칸",
        2 => "줄",
        3 => "열",
        4 => "아군전체",
        5 => "적군전체",
        6 => "십자",
        7 => "맵",
        8 => "필드",
        12 => "줄(자X)",
        13 => "열(자X)",
        14 => "아군전체(자X)",
        16 => "십자(자X)",
        17 => "맵(자X)",
        18 => "필드(자X)",

        101 => "모든 남자",
        102 => "모든 여자",
        103 => "모든 어린이",
        104 => "모든 마신",
        105 => "모든 악마",
        106 => "모든 요정",
        107 => "모든 귀신",
        108 => "모든 정령",
        109 => "모든 흡혈귀",
        110 => "모든 수인",
        111 => "모든 무생물",
        112 => "모든 사념체",
        113 => "모든 신령",
        114 => "모든 도깨비",
        115 => "모든 요괴",
        116 => "모든 용족",
        117 => "모든 촉수",
        118 => "모든 군주",
        119 => "모든 왕자",
        120 => "모든 공주",
        121 => "모든 고등학생",
        122 => "모든 대학생",
        123 => "모든 선생",
        124 => "모든 기사",
        125 => "모든 마녀",
        126 => "모든 사장",
        127 => "모든 학자",
        128 => "모든 만화가",
        129 => "모든 해적",
        130 => "모든 사제",
        131 => "모든 싸우는 아가씨",
        132 => "모든 학생회",
        133 => "모든 닌쟈",
        134 => "모든 아이돌",
        135 => "모든 커피파",
        136 => "모든 홍차파",
        137 => "모든 시간능력자",
        138 => "모든 기자",
        139 => "모든 공돌이",
        140 => "모든 연금술사",
        141 => "모든 주술사",
        142 => "모든 소환사",
        143 => "모든 프리랜서",
        144 => "모든 루키",
        145 => "모든 주역",
        146 => "모든 모리배",
        147 => "모든 총잡이",
        148 => "모든 부먹",
        149 => "모든 찍먹",
        150 => "모든 동물",
        151 => "모든 클래식",
        152 => "모든 전교1등",

        201 => "Manner Maketh Man",
        202 => "금남의 공간",
        203=> "아동보호법!",
        204=> "크레아노미콘",
        205=> "판데모니움",
        206=> "호수의 안개",
        207=> "시나위",
        208=> "시원의 노래소리",
        209=> "밤의 껍데기",
        210=> "자연의 분노",
        211=> "기계의 반란",
        221=> "경계선에 서는 자",
        222=> "판테온",
        223=> "괴력난신",
        224=> "백귀야행",
        225=> "드래곤의 날",
        226=> "Wgah'nagl Fhtagn",
        227=> "왕들의 게임",
        228=> "왕자님의 키스",
        229=> "왕궁의 꽃",
        220=> "원더러즈 에이스",
        231=> "자체휴강",
        232=> "스승의 은혜",
        233=> "원탁의 기사",
        234=> "발푸르기스의 밤",
        235=> "비즈니스 데이",
        236=> "역 앞 분과회",
        237=> "마감인생",
        238=> "너! 내 동료가 되라!",
        239=> "목자의 지팡이",
        230=> "싸우는 아가씨들",
        241=> "예산집행중!",
        242=> "신기루인법첩",
        243=> "게릴라 콘서트",
        244=> "카페 클라츠",
        245=> "백작의 회색",
        246=> "마의 13시",
        247=> "기자정신",
        248=> "공밀레",
        249=> "왕의 예술",
        240=> "천고의 가락",
        251=> "재현된 신비",
        252=> "눈 뜨면 출근",
        253=> "비기너즈 럭",
        254=> "프로타고니스트",
        255=> "하우스 오브 빌런",
        256=> "뜨거운 결투자들",
        257=> "탕수육 소스다!",
        258=> "누가 부먹을 하였는가",
        259=> "생존전략",
        250=> "동화의 비밀",
        261=> "좋은 놈, 나쁜 놈, 이상한 놈",
        262=> "채미리, 유연호 커플(가칭)",
        263=> "마법과 과학",
        264=> "도로시,허수아비 커플(가칭)",
        265=> "선녀와 나무꾼",
        266=> "백설공주와 사냥꾼",
        267=> "인 더 원더랜드",
        268=> "한티 고교 신문부",
        269=> "아가씨와 수인",
        260=> "오즈의 이방인들",
        271=> "이상한 나라의 앨리스",
        272=> "한티 고교 7대 괴담",
        273=> "한티 고교 최강의 라이벌",
        274=> "석상로얄",
    ];

    public static $CONDITION = [
        null => "",
        1 => "POISON",
        2 => "POSSESSION",
        3 => "STUN",
        4 => "STUN_PERCENT",
        5 => "ATK_UP",
        6 => "DEF_UP",
        7 => "AGI_UP",
        8 => "CON_UP",
        9 => "ATK_DOWN",
        10 => "DEF_DOWN",
        11 => "AGI_DOWN",
        12 => "CON_DOWN",
        13 => "DODGE_UP",
        14 => "UNTOUCHABLE",
        15 => "OVERLORD",
        16 => "DEFENCE_MASTER",
        17 => "OFFENCE_MASTER",
        18 => "FOCUS",
        19 => "VAGUE",
        20 => "COMPOSED",
        21 => "IMPATIENT",
        22 => "UNDEATH",
        23 => "NULLITY_MELEE",
        24 => "NULLITY_RANGE",
        25 => "SHIELD",
        26 => "COVER",
        27 => "SCAPEGOAT",
        28 => "PASSIVE_DMG_UP",
        29 => "PASSIVE_DMG_DOWN",
        30 => "ACTIVE_DMG_UP",
        31 => "ACTIVE_DMG_DOWN",
        32 => "CHARGE_MASTER",
        33 => "CUMULATE_DMG_UP",
        34 => "CUMULATE_DMG_DOWN",
        35 => "TEAM_DMG_UP",
        36 => "CONDITION_COUNT_DMG_UP",
        37 => "PASSIVE_IGN_SPECIAL_DEFENCE",
        38 => "ACTIVE_IGN_SPECIAL_DEFENCE",
        39 => "DEAL_REVENGE",
        40 => "LAST_SHOOTING",
        41 => "CONDITION_CHANCE_UP",
        42 => "MP_GAIN_UP",
        43 => "MP_GAIN_DOWN",
        44 => "PAIN",
        45 => "SANCTUARY",
        46 => "NOT_MOVE",
        47 => "NOT_SKILL",
        48 => "NOT_HEAL",
        49 => "REGENE",
        50 => "BLEED",
        51 => "HP_GAIN_UP",
        52 => "HP_GAIN_DOWN",
        53 => "LAST_STAND",
        54 => "NIER_DEATH",
        55 => "GRAY_MAN",
        56 => "FLY",
        57 => "IMMUNE",
        58 => "OVERLAP_DMG_UP",
        59 => "SHIELD_OTHER",
        60 => "PROTECTION",
        61 => "SACRIFICE",
        62 => "FALLOW_TAG",
        63 => "ARK_DMG_UP",
        64 => "TAG_DMG_UP",
        65 => "BURN",
        101 => "ATK_UP_PERCENT",
        102 => "DEF_UP_PERCENT",
        103 => "AGI_UP_PERCENT",
        104 => "CON_UP_PERCENT",
        105 => "ATK_DOWN_PERCENT",
        106 => "DEF_DOWN_PERCENT",
        107 => "AGI_DOWN_PERCENT",
        108 => "CON_DOWN_PERCENT",
        109 => "REWARD_GOLD_UP_PERCENT",



    ];

    public static $CONDITION_MERIT_LIST = [
        101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114,
    ];



    public static $SUMMON_TARGET_REPOSITORY_STR = array(
        1 => 'MirageMainBundle:Ark',
        2 => 'MirageMainBundle:Equipment',
        3 => 'MirageMainBundle:Item',
    );

    public static $SUMMON_NAME_STR = array(
        1011 => '청금석1연소환',
        1012 => '청금석11연소환',
        1015 => '골드1연소환',
        1016 => '골드11연소환',
        1019 => '티켓 3성이상 1연소환',
        1020 => '이벤트티켓 4성이상 1연소환',
        1020 => '(구)이벤트티켓 5성이상 1연소환',
    );

    public static $CARGO_STR = array(
        self::CARGO_GOLD => "골드",
        self::CARGO_LAPIS => "청금석",
        self::CARGO_FRIEND_POINT => "친구포인트",
        self::CARGO_REAGENT => "시약?",
        self::CARGO_POWDER => "가루",
        self::CARGO_TICKET => "티켓?",

    );

    //전투관련
    const BATTLE_SUPPORT = 12;         //서폿참전 제시수
    const BATTLE_FRIEND_LIMIT = 6;      //부를 수 있는 친구수

    //즉사계산 등에 쓰이는 보스보정
    public static $DIGNITY_RATE = array(
        null => 1,
        0 => 1,
        1 => 1,
        2 => 1.2,
        3 => 1.5,
        4 => 2,
        5 => 3.5,
        6 => 3,
        7 => 4
    );

    public static $SKILL_JUDGE = array(
        "MISS",
        "HIT",
        "CRITICAL",
        "FAIL_TARGET_IS_DEAD",
        "FAIL_FROM_NO_HEAL",
    );

}