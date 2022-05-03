<?php
$nav = './img/small/';
$images = array_slice(scandir($nav), 2);

include 'Twig/Autoloader.php';
Twig_Autoloader::register();

try {
  $loader = new Twig_Loader_Filesystem('templates');
  
  $twig = new Twig_Environment($loader);
  
  $template = $twig->loadTemplate('gallery.tmpl');

  echo $template->render(array (
    'nav' => $nav,
    'images' => $images,
  ));
  
} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}
?>