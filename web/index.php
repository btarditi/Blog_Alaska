<?php
require '../app/Autoloader.php';
app\Autoloader::register();
    if(isset($_GET['p'])){
        $p = $_GET['p'];
    }else{
        $p = 'home';
    }
ob_start();
    if ($p === 'home') {
        require '../src/model.php';
        $listEpisodes = getEpisode();
        require '../views/home.php';
    } elseif ($p === 'episode') {
        require '../src/model.php';
        $listEpisodes = getEpisode();
        require '../views/episode.php';
    }
$content = ob_get_clean();
require '../views/templates/layout.php';
