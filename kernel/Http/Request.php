<?php

namespace App\Kernel\Http;
//инкапсулируем запросы
class Request
{
    public function __construct(
        public readonly array $get,
        public readonly array $post,
        public readonly array $server,
        public readonly array $files,
        public readonly array $cookies,
    )
    {}
    //создаёт инстанс  себя же для конструктора
    public static function createFromGlobals(): static
    {
        return new static(
            $_GET,
            $_POST,
            $_SERVER,
            $_FILES,
            $_COOKIE,
        );
    }
    public function uri():string
    {
        return strtok($this->server['REQUEST_URI'], token:'?');
    }
    public function method():string
    {
        return $this->server['REQUEST_METHOD'];
    }

}