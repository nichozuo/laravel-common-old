<?php

namespace Nichozuo\LaravelCommon\Exceptions;


class Err extends BaseException
{
    const AuthUserNotLogin = [10000, '用户未登陆','系统将跳转至重新登录'];
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
     * @return static
     */
    public static function NewText($description): Err
    {
        return new static(999, '发生错误', $description, 'Toast');
    }

    /**
     * @intro  吐司
     * @params code,required|integer,错误码
     * @params message,required|string,错误信息
     * @params description,nullable|string,错误描述
     * @params type,required|string,错误类型：Toast,Notice,Modal,Page
     * @param string $code
     * @param string $message
     * @param string $description
     * @return Err
     */
    public static function Toast(string $code, string $message = '发生错误', string $description = ''): Err
    {
        return new static($code, $message, $description, 'Toast');
    }

    /**
     * @intro  通知
     * @params code,required|integer,错误码
     * @params message,required|string,错误信息
     * @params description,nullable|string,错误描述
     * @params type,required|string,错误类型：Toast,Notice,Modal,Page
     * @param string $code
     * @param string $message
     * @param string $description
     * @return Err
     */
    public static function Notice(string $code, string $message = '发生错误', string $description = ''): Err
    {
        return new static($code, $message, $description, 'Notice');
    }

    /**
     * @intro  弹窗
     * @params code,required|integer,错误码
     * @params message,required|string,错误信息
     * @params description,nullable|string,错误描述
     * @params type,required|string,错误类型：Toast,Notice,Modal,Page
     * @param string $code
     * @param string $message
     * @param string $description
     * @return Err
     */
    public static function Modal(string $code, string $message = '发生错误', string $description = ''): Err
    {
        return new static($code, $message, $description, 'Modal');
    }

    /**
     * @intro  跳转页面
     * @params code,required|integer,错误码
     * @params message,required|string,错误信息
     * @params description,nullable|string,错误描述
     * @params type,required|string,错误类型：Toast,Notice,Modal,Page
     * @param string $code
     * @param string $message
     * @param string $description
     * @param string $redirectUrl
     * @return Err
     */
    public static function Page(string $code, string $message = '发生错误', string $description = '', string $redirectUrl = ''): Err
    {
        return new static($code, $message, $description, 'Page', $redirectUrl);
    }
}
