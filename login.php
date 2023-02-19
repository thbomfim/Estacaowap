<?php
///include core.php and config.php files
require_once("core.php");
require_once("config.php");

//html code
echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>";
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\"\"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head>";
echo "<title>$stitle</title>";
echo "<link rel=\"StyleSheet\" type=\"text/css\" href=\"style.css\" />";
echo "</head>";
echo "<body>";
//define get
$usuario = $_GET["usuario"];
$senha   = $_GET["senha"];
//set id in get(usuario)
if(is_numeric($usuario))
{
//transform number in username
$usuario = getnick_uid2($usuario);
}
else
{
//get normal
$usuario = $_GET["usuario"];
}
//verification in user name
$v_usuario = "SELECT COUNT(*) FROM fun_users WHERE name =:name";
$stmt = $pdo->prepare($v_usuario);
$stmt->bindValue(':name',$usuario);
$stmt->execute();
if($v_usuario[0]==0 OR empty($v_usuario[0]))
{
echo "<p align=\"center\">";
echo "<img src=\"images/logo.png\" alt=\"\"><br />";
echo "<br />";
echo "<img src=\"images/notok.gif\">Usuário não existe!<br />";
echo "</p>";
echo "<p align=\"center\">";
echo "<a href=\"index.php\"><img src=\"images/home.gif\">Página principal</a>";
echo "</p>";
}
else
{
//verification in username and password if are correct
$v_senha = "SELECT COUNT(*) FROM fun_users WHERE name = :name AND pass = :pass";
$stmt = $pdo->prepare($v_senha);
$stmt->bindValue(':name', $usuario);
$stmt->bindValue(':pass', substr($senha, 4, 32));
$stmt->execute();
if($v_senha[0]==0 OR empty($v_senha[0]))
{
echo "<p align=\"center\">";
echo "<img src=\"images/logo.png\" alt=\"\"><br />";
echo "<br />";
echo "<img src=\"images/notok.gif\">A senha digitada por voc� n�o confere com a cadastrada!<br />";
echo "</p>";
echo "<p align=\"center\">";
echo "<a href=\"index.php\"><img src=\"images/home.gif\">P�gina principal</a>";
echo "</p>";
}
else
{
    global $pdo;
//delete sessions old
$pdo->exec("DELETE FROM fun_ses WHERE (uid='".getuid_nick($usuario)."')");
$s = sha1($usuario.time());
$sid = strtoupper("php_sessid:".(str_shuffle($s)));
$tempo = time() + 1800;
///insert into in database sid session
$sql = "INSERT INTO fun_ses SET id =:id, uid =:usuario, expiretm =:tempo ";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $sid);
$stmt->bindValue(':usuario', getuid_nick($usuario));
$stmt->bindValue(':tempo', $tempo);
$stmt->execute();
echo "<p align=\"center\">";
echo "<img src=\"images/logo.png\" alt=\"\"><br />";
echo "<br />";
echo "<img src=\"images/ok.gif\"><b>Bem vindo $usuario</b>!<br />";
echo "<br /><a href=\"index.php?action=main&sid=$sid\"><b>Entrar</b></a><br />";
echo "<br />Salve esta pagina nos marcadores para logar automaticamente!";
echo "</p>";
}
}
//fim
?>
