<?php

include 'settings.php';


$sql = 'SELECT * FROM users where id = '.intval($_GET['id']).' limit 1';
$user = false;
foreach ($dbh->query($sql) as $row) {
  $user = $row;
}

if ($user == false) {
  echo 'oei die persoon hebben we niet gevonden. <a href="index.php">Proef zelf een svan ons spelletje.</a>';
}
$user['birthday'] = date('d / m / Y',$user['geboortedatum']);
//no id = Oei, probeer het zelf eens
// KNOP to frontpage.


//echo Geboortedatum
echo 'Geboortedatum '.$user['birthday'] . '<br>';
echo 'Name '.$user['name'] . '<br>';
$hitlijst = getHitlijstData('lists?parent_lid=840');
//var_dump($hitlijst);
$aftellijst = getHitlijstData('lists/301');
$first_song = $aftellijst->songs[0];
//var_dump($aftellijst->data->air_date);
echo 'Op 1 in ' . $aftellijst->data->name . ' van ' . date('d m Y',$aftellijst->data->air_date) . '<br>';
echo $first_song->title .' - ' . $first_song->name;

//Load id
// Render HTML