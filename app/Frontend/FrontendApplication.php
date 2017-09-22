<?php
namespace App\Frontend;
 
use \BTFram\Application;
 
class FrontendApplication extends Application
{
  public function __construct() // appeler le constructeur parent puis de spécifier le nom de l'application
  {
    parent::__construct();
 
    $this->name = 'Frontend';
  }
 
  public function run()
  {
    $controller = $this->getController(); // Obtention du contrôleur
    $controller->execute(); // Exécution du contrôleur
 
    $this->httpResponse->setPage($controller->page()); // Assignation de la page créée par le contrôleur à la réponse
    $this->httpResponse->send(); // Envoi de la réponse
  }
}