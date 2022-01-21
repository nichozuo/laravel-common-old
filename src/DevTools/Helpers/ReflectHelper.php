<?php

namespace Nichozuo\LaravelCommon\DevTools\Helpers;

use DocBlockReader\Reader;
use Exception;
use Illuminate\Support\Arr;
use ReflectionException;
use ReflectionMethod;

class ReflectHelper
{
    /**
     * @param string $filePath
     * @param string $className
     * @param string $methodName
     * @return array
     * @throws ReflectionException
     */
    public static function GetMethodParamsArray(string $filePath, string $className, string $methodName): array
    {
        $ref = new ReflectionMethod($className, $methodName);
        $startLine = $ref->getStartLine();
        $endLine = $ref->getEndLine();
        $length = $endLine - $startLine;
        $source = file($filePath);
        $code = array_slice($source, $startLine, $length);
        $start = $end = false;
        $arr = [];
        foreach ($code as $line) {
            $t = trim($line);
            if ($t == ']);') $end = true;
            if ($start && !$end)
                $arr[] = $t;
            if ($t == '$params = $request->validate([') $start = true;
        }
        $arr1 = [];
        foreach ($arr as $item) {
            $t1 = explode('\'', $item);
            $t2 = explode('|', $t1[3]);
            $t3 = explode('#', $t1[4]);
            $t4 = [
                $t1[1],
                $t2[0] == 'nullable' ? '-' : 'Y',
                $t2[1],
                (count($t3) > 1) ? trim($t3[1]) : '-'
            ];
            $arr1[] = $t4;
        }
        return $arr1;
    }

    /**
     * @param string $className
     * @param string $methodName
     * @return array
     * @throws Exception
     */
    public static function GetMethodAnnotation(string $className, string $methodName): array
    {
        $reader = new Reader($className, $methodName);
        $data = $reader->getParameters();
        return Arr::only($data, ['intro', 'responseParams']);
    }

    /**
     * @param string $className
     * @return mixed|string
     * @throws Exception
     */
    public static function GetControllerAnnotation(string $className)
    {
        $reader = new Reader($className);
        $data = $reader->getParameters();
        return $data['intro'] ?? '';
    }
}