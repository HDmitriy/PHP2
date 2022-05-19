<?php
require_once 'Twig/Autoloader.php';
Twig_Autoloader::register();

try {
  $dbh = new PDO('mysql:dbname=hw3;host=localhost', 'root', 'root');
} catch (PDOException $e) {
  echo "Error". $e->getMessage();
}

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
  if($_GET['limit']){
    $limit = $_GET['limit'];
  } else {
    $limit = 5;
  }

  $sql = "SELECT goods.id AS id, goods.name AS name, goods.price AS price FROM goods limit $limit";
  $sth = $dbh->query($sql);
  $data = $sth->fetchAll(PDO::FETCH_ASSOC);

  $loader = new Twig_Loader_Filesystem('templates');
  
  $twig = new Twig_Environment($loader);
  
  $template = $twig->loadTemplate('items.tmpl');

  echo $template->render(array (
    'data' => $data,
    'count'=>count($data)
  ));

} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}
?>

