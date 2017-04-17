<?php 
require_once('config.php');
require_once('interface/interface.users.php');
require_once('class.logging.php');
require_once('class.Database.php');
require_once('class.users.php');


$log = Logging::getInstance();
$db = Database::getInstance();
$qry = 'SELECT * FROM users';
$result = $db->execute($qry);
 
$user = Users::getInstance();
$qry = 'SELECT * from users';
$data['userSchema'] = $user->getSchema();
print_r($data);
var_dump($user);

//var_dump($db);
?>
