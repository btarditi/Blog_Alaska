<?php
namespace BTFram;

/*
**Classe HTTPRequest Ccomposante de la classe application du Bt Framwork  **
classe représentant la requête du client
*/ 
class HTTPRequest extends ApplicationComponent
{
  public function cookieData($key) // Obtenir un cookie
  {
    return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
  }
 
  public function cookieExists($key)
  {
    return isset($_COOKIE[$key]);
  }
 
  public function getData($key) // Obtenir une variable GET
  {
    return isset($_GET[$key]) ? $_GET[$key] : null;
  }
 
  public function getExists($key)
  {
    return isset($_GET[$key]);
  }
 
  public function postData($key) // Obtenir une variable POST
  {
    return isset($_POST[$key]) ? $_POST[$key] : null;
  }
 
  public function postExists($key)
  {
    return isset($_POST[$key]);
  }
 
  public function method() // Obtenir la méthode employée pour envoyer la requête (méthode GET ou POST
  {
    return $_SERVER['REQUEST_METHOD'];
  }
  
  public function requestURI() //Obtenir l'URL entrée (utile pour que le routeur connaisse la page souhaitée)
  {
    return $_SERVER['REQUEST_URI'];
  }
}