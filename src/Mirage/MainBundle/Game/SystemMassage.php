<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-15
 * Time: 오후 11:35
 */

namespace Mirage\MainBundle\Game;


class SystemMassage
{

    const REGISTER_ALREADY_USE_EMAIL = "이미 존재하는 메일입니다.";
    const REGISTER_SUCCESS = "가입되었습니다.";

    const ERROR_USER_NOT_EXIST = 9000001; //원래는 디바이스 였으나 로그인 방법이 구글 아이디로 통합되면서 필요없어짐
    const ERROR_NETWORK_DISCONNECT = 9000002;
    const ERROR_PLAYER_NOT_EXIST = 9000003;
    const ERROR_INPUT_INCORRECT = 9000005;

    const ERROR_NAME_EMPTY = 9000004; //닉네임이 비어있다.
    const ERROR_NAME_CHANGE = 9000006; //닉네임을 바꾸는 것을 실패했다.

    //친구관련
    const ERROR_THAT_NOT_FRIEND = 9000011;
    const ERROR_APPLY_REJECTED = 9000012;
    const ERROR_UNABLE_THUMBUP = 9000013;

    //전투관련
    const ERROR_ENCOUNTER_EXIST = 9000021;
    const ERROR_ENCOUNTER_NOT_EXIST = 9000022;
    const ERROR_SKILL_NOT_EXIST = 9000023;






}