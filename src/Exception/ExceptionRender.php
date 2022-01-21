<?php

namespace Nichozuo\LaravelCommon\Exception;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class ExceptionRender
{
    public static function Render(Throwable $e)
    {
        $request = request();
        $class = get_class($e);
        $isDebug = config('app.debug');
        $type = 'toast';

        $debugInfo = [
            'exception' => [
                'class' => $class,
                'trace' => self::getTrace($e)
            ],
            'client' => $request->getClientIps(),
            'request' => [
                'method' => $request->getMethod(),
                'uri' => $request->getUri(),
                'params' => $request->all(),
//                'header' => $request->header()
            ],
        ];

        switch ($class) {
            case Err::class:
                $code = $e->getCode();
                $message = $e->getMessage();
                $type = $e->getType();
                $description = $e->getDescription();
                break;
            case AuthenticationException::class:
                $arr = Err::AuthUserNotLogin;
                $code = $arr[0];
                $message = $arr[1];
                $description = $arr[2];
                break;
            case ValidationException::class:
                $code = 999;
                $message = "数据验证失败";
                $errMsg = self::getValidationErrors($e->errors());
                $description = "【{$errMsg}】字段验证失败";
                break;
            case NotFoundHttpException::class:
                $code = 999;
                $message = "请求的资源未找到";
                $description = $e->getMessage();
                break;
            case MethodNotAllowedHttpException::class:
                $code = 999;
                $message = "请求方式不正确";
                $description = $e->getMessage();
                break;
            default:
                $code = 9;
                $message = '系统错误';
                $description = $e->getMessage();
                break;
        }

        $jsonResponse = [
            'code' => $code,
            'type' => $type,
            'message' => $message,
            'description' => $description,
        ];
        if ($isDebug)
            $jsonResponse['debug'] = $debugInfo;

        Log::error($message, $debugInfo);

        return response()->json($jsonResponse);
    }

    /**
     * @param Throwable $e
     * @return array
     */
    private static function getTrace(Throwable $e): array
    {
        $arr = $e->getTrace();
        $file = array_column($arr, 'file');
        $line = array_column($arr, 'line');
        $trace = [];
        for ($i = 0; $i < count($file); $i++) {
            $trace[] = [
                $i => "$file[$i]($line[$i])"
            ];
        }
        return $trace;
    }

    /**
     * @param $errors
     * @return string
     */
    private static function getValidationErrors($errors): string
    {
        $err = [];
        foreach ($errors as $key => $value)
            $err[] = $key;
        return implode(',', $err);
    }
}
