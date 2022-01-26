<?php

namespace Nichozuo\LaravelCommon\Helpers;


class BaseHelper
{
    private static ?BaseHelper $instance = null;

    /**
     * @return static|null
     */
    public static function GetInstance(): ?BaseHelper
    {
        if (self::$instance == null) {
            self::$instance = new static();
        }
        return self::$instance;
    }
}