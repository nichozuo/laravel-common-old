<?php

namespace Nichozuo\LaravelCommon\Exceptions;

use Throwable;

class ExceptionRender
{
    public static function Render(Throwable $e)
    {
        $request = request();
        $class = get_class($e);
        $isDebug = config('app.debug');


    }
}
