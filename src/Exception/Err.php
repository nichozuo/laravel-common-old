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
     * @return Err
     */
    public static function New(array $arr, string $description = ''): Err
    {
        if ($description == '' && count($arr) == 3)
            $description = $arr[2];

        return new static((int)$arr[0], $arr[1], $description, 'Toast');
    }

    /**
     * @param $description
     * @return Err
     */
    public static function NewText($description): Err
    {
        return new static(999, '发生错误', $description, 'Toast');
    }

    /**
     * @param string $message
     * @param string $description
     * @throws Err
     */
    public static function Toast(string $message, string $description = '')
    {
        throw new static(999, $message, $description, 'toast');
    }

    /**
     * @param string $message
     * @param string $description
     * @return Err
     */
    public static function Notice(string $message, string $description = ''): Err
    {
        return new static(999, $message, $description, 'notice');
    }

    /**
     * @param string $message
     * @param string $description
     * @return Err
     */
    public static function Modal(string $message, string $description = ''): Err
    {
        return new static(999, $message, $description, 'modal');
    }

    /**
     * @param string $message
     * @param string $description
     * @return Err
     */
    public static function Page(string $message, string $description = ''): Err
    {
        return new static(999, $message, $description, 'page');
    }
}
