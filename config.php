<?php

ini_set("memory_limit", "256M");
##Hora local
date_default_timezone_set("Brazil/East");

  /**
  * Conexao com o servidor
  */
  try
  {
    $pdo = new PDO("mysql:host=localhost;dbname=estacao", "root", "123");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $conectando = True;
  }
  catch(PDOException $e)
  {
    $conectando = False;
  }
  
##Caso a conexao seja reprovada, exibe na tela uma mensagem de erro
if(!$conectando) die ("<p align='center'>
<img src='teks/hit.gif' alt='*'/>
<br/>
<b>Banco de dados desconectado!</b>
<br/>
<br/>
Tente acessar o site dentro de alguns instantes, ou entre em contato!</p>
<br/>");
//////

$stitle = "EstaçãoWAP";//site title
$snome = "EstaçãoWAP";//site name
$smoeda = "Pontos";//site plusses name
$max_buds = 500;//max buds  
?>