<?php

namespace Nichozuo\LaravelCommon\Exceptions;


use Exception;

class BaseException extends Exception
{
    private string $description;
    private string $type;
    private string $redirectUrl;

    /**
     * BaseException constructor.
     * @param int $code
     * @param string $message
     * @param string $description
     * @param string $type
     * @param string $redirectUrl
     */
    public function __construct(int $code, string $message, string $description, string $type, string $redirectUrl = '')
    {
        $this->code = $code;
        $this->message = $message;
        $this->description = $description;
        $this->type = $type;
        $this->redirectUrl = $redirectUrl;
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
     * @return string
     */
    public function getType(): string
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

    /**
     * @return string
     */
    public function getRedirectUrl(): string
    {
        return $this->redirectUrl;
    }

    /**
     * @param string $redirectUrl
     */
    public function setRedirectUrl(string $redirectUrl): void
    {
        $this->redirectUrl = $redirectUrl;
    }
}

