<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-21
 * Time: 오후 10:38
 */

namespace Mirage\AdminBundle\Controller;


class GameConfig
{

    const LANG = 'KR';
/*    const LANG = 'JP';
*/

    public static $TYPESTR_KR = array(
        1 => "타격자",
        2 => "돌격자",
        3 => "포격자",
        4 => "저격자",
        5 => "방어자",
        6 => "지휘자",
        7 => "지원자",
        8 => "회복자",
    );

    public static $GRADESTR_KR = array(
        1 => "낮",
        2 => "노을",
        3 => "삭달",
        4 => "초승달",
        5 => "반달",
        6 => "보름달",
        7 => "별밤",
    );

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
        1 => "조커포지 오리지널",
        2 => "계란계란",
        3 => "환상거북",
    );

    public static $ORIGINSTR_JP = array(
        1 => "조커포지 오리지널",
        2 => "계란계란",
        3 => "환상거북",
    );

    public static $TILETYPE = array(
        0 => "",
        1 => "독",
        2 => "봉인",
        3 => "방업",
        4 => "속업",
        5 => "공업",
        6 => "재생",
        7 => "크리",
        8 => "즉사",
    );
}