<?php
/* Tilsutningsindstillinger til databasen */
$host = 'mysql20.123hotel.dk';
$user = 'kajkager';
$pass = 'jiA9!jSDAa';
$db = 'kajkager_dk_db';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
