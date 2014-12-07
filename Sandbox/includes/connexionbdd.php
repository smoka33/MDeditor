<?php
try
{
$db = new PDO('mysql:host=localhost;dbname=MDeditor', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>