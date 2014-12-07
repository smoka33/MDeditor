<!DOCTYPE html>
<html lang="fr">
<head>
<?php

echo '<title> MDeditor </title>';

?>
<meta charset="UTF-8"/>
<link rel="stylesheet" media="screen" type="text/css" href="" />
</head>
<?php


$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

include("functions.php");
include("variables.php");
?>