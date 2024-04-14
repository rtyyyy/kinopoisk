<?php
namespace App\Router;

//класс, отвечающий за обработку маршрутов//
class Route
{
   public function __construct(
    private string $uri,
    private string $method,
    private $action
   ){
   } 
     //инстансы 
     public static function get(string $uri, $action): static
     {
          return new static($uri, 'GET', $action);
     }
     public static function post(string $uri, $action): static
     {
          return new static($uri, 'POST', $action);
     }
   public function getUri(): string
   {
    return $this->uri;
   }
   public function getAction(): callable
   {
    return $this->action;
   }
   public function getMethod(): string
   {
    return $this->method;
   }
}