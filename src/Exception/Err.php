<?php

namespace Nichozuo\LaravelCommon\Exception;


class Err extends BaseException
{
    const AuthUserNotLogin = [10000, '用户未登陆', '系统将跳转至重新登录'];
    const AuthUserNotFound = [10001, '用户未完善信息', '系统将引导您绑定相关信息'];
    const AuthWrongPassword = [10002, '认证失败', '密码错误'];
    const AuthPasswordNotSame = [10003, '注册失败', '两次输入密码不一致'];

    const DBOperateFailed = [20000, '数据操作失败'];
    const DBRecordExist = [20001, '数据操作失败'];

    /**
     * @param array $arr
     * @param string $description
     * @param int $type
     * @throws Err
     */
    public static function New(array $arr, string $description = '', int $type = 2)
    {
        if ($description == '' && count($arr) == 3)
            $description = $arr[2];

        throw new static((int)$arr[0], $arr[1], $description, $type);
    }

    /**
     * @param string $message
     * @param string $description
     * @param int $type
     * @throws Err
     */
    public static function NewText(string $message, string $description = '', int $type = 2)
    {
        throw new static(999, $message, $description, $type);
    }
}
