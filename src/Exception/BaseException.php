<?php

namespace Nichozuo\LaravelCommon\Exception;


use Exception;


class BaseException extends Exception
{
    private string $description;
    private string $type;

    /**
     * BaseException constructor.
     * @param int $code
     * @param string $message
     * @param string $description
     * @param string $type
     */
    public function __construct(int $code, string $message, string $description, string $type)
    {
        $this->code = $code;
        $this->message = $message;
        $this->description = $description;
        $this->type = $type;
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return integer
     */
    public function getType(): integer
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
}

