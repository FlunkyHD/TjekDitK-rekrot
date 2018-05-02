<?php
/* Tilsutningsindstillinger til databasen */
$host = 'mysql20.123hotel.dk';
$user = 'kajkager';
$pass = 'MortenogPeter!';
$db = 'kajkager_dk_db';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
