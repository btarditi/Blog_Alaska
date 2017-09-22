<?php
namespace BTFram;

/*
**Classe HTTPResponse composante de la classe application du  Bt Framwork  **
classe représentant la réponse envoyée au client à travers une page
*/ 
class HTTPResponse extends ApplicationComponent
{
  protected $page;
 
  public function addHeader($header) // ajout d'un header spécifique.
  {
    header($header);
  }
 
  public function redirect($location) // redirection de l'utilisateur.
  {
    header('Location: '.$location);
    exit;
  }
 
  public function redirect404() // redirection vers une erreur 404
  {
    $this->page = new Page($this->app);
    $this->page->setContentFile(__DIR__.'/../../Errors/404.html');
 
    $this->addHeader('HTTP/1.0 404 Not Found'); // ajout d'un header disant que le document est non trouvé 
 
    $this->send();
  }
 
  public function send() // envoyer la réponse en générant la page
  {
    exit($this->page->getGeneratedPage());
  }
 
  public function setPage(Page $page) // assigner une page à la réponse
  {
    $this->page = $page;
  }
 
  public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true) // Ajouter un cookie
  {
    setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
  }
}