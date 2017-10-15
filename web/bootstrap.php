<?php


const DEFAULT_APP = 'Frontend';
define('SITE_ROOT', __DIR__);
 
// Si l'application n'est pas valide, on va charger l'application par défaut qui se chargera de générer une erreur 404
if (!isset($_GET['app']) || !file_exists(__DIR__.'/../App/'.$_GET['app'])) $_GET['app'] = DEFAULT_APP;
 
// On commence par inclure la classe nous permettant d'enregistrer nos autoload
require __DIR__.'/../lib/BTFram/SplClassLoader.php';
 
// On va ensuite enregistrer les autoloads correspondant à chaque vendor (BTFram, App, Model, etc.)
$BTFramLoader = new SplClassLoader('BTFram', SITE_ROOT.'/../lib');
$BTFramLoader->register();
 
$appLoader = new SplClassLoader('App', SITE_ROOT.'/..');
$appLoader->register();
 
$modelLoader = new SplClassLoader('Model', SITE_ROOT.'/../lib/vendors');
$modelLoader->register();
 
$entityLoader = new SplClassLoader('Entity', SITE_ROOT.'/../lib/vendors');
$entityLoader->register();

$formLoader = new SplClassLoader('Form', SITE_ROOT.'/../lib/vendors/');
$formLoader->register();

$appClass = 'App\\'.$_GET['app'].'\\'.$_GET['app'].'Application';

$app = new $appClass;
$app->run();

