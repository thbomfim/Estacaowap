<?php
//include config.php file
include("config.php");
//protector post and get :P
$_GET = array_map('addslashes', $_GET);
$_POST = array_map('addslashes', $_POST);
$_COOKIE = array_map('addslashes', $_COOKIE);
$_GET = array_map('strip_tags', $_GET);
$_POST = array_map('strip_tags', $_POST);
$_GET = array_map('htmlspecialchars', $_GET);
$_POST = array_map('htmlspecialchars', $_POST);
/*
//function, anti_injection protector
function  anti_injection($sql)
{
//removes  words that contain sql  syntax
$sql = preg_replace("/(from|select|insert|delete|where|drop table|show tables|\*|--|\\\\)/"),"",$sql;
$sql = trim($sql);//clear gaps
return $sql;
}
*/

function arquivo_extfoto($ext)
{
$ext = strtolower($ext);
switch ($ext)
{
case "jpg":
case "gif":
case "jpeg":
case "png":
return "0";
break;
default:
return "1";
break;
}
}
function arquivo($ext)
{
$ext = strtolower($ext);
switch ($ext)
{
case "jpg":
case "gif":
case "jpeg":
case "png":
case "bmp":
case "mp3":
case "wav":
case "aac":
case "3gp":
case "mp4":
case "zip":
case "mid":
return "0";
break;
default:
return "1";
break;
}
}
//browser function
function navegador()
{
$var = $_SERVER['HTTP_USER_AGENT'];
$br = explode(" ", $var);
return $br[0];
}
function candelfoto($uid, $item)
{
$candoit = mysql_fetch_array(mysql_query("SELECT  uid FROM fun_fotos WHERE id='".$item."'"));
if($uid==$candoit[0]||ismod($uid))
{
return true;
}
return false;
}
function candelcmta($uid, $item)
{
$candoit = mysql_fetch_array(mysql_query("SELECT  uid FROM fun_cmt_a WHERE id='".$item."'"));
if($uid==$candoit[0]||ismod($uid))
{
return true;
}
return false;
}
function candelalbum($uid, $item)
{
$candoit = mysql_fetch_array(mysql_query("SELECT  uid FROM fun_albums WHERE id='".$item."'"));
if($uid==$candoit[0]||ismod($uid))
{
return true;
}
return false;
}
function gerador_password($tamanho)
{
$chars = "abcdefghijklmnopqrstuvxz!@$*()_+=-0123456789";
$exemplo_s = str_shuffle($chars);
$retorno = substr($exemplo_s, 1, $tamanho);
return $retorno;
}
function registro($ef)
{
$ue = $errl = $pe = $ce = "";
switch($ef)
{
case 1:
$errl = "<img src=\"images/point.gif\" alt=\"!\"/> Digite o usu???rio!";
$ue = "<img src=\"images/point.gif\" alt=\"!\"/>";
break;
case 2:
$errl = "<img src=\"images/point.gif\" alt=\"!\"/> Digite uma senha!";
$pe = "<img src=\"images/point.gif\" alt=\"!\"/>";
break;
case 3:
$errl = "<img src=\"images/point.gif\" alt=\"!\"/> Confirme sua senha!";
$ce = "<img src=\"images/point.gif\" alt=\"!\"/>";
break;
case 4:
$errl = "<img src=\"images/point.gif\" alt=\"!\"/> Usu???rio inv???lido!";
$ue = "<img src=\"images/point.gif\" alt=\"!\"/>";
break;
case 5:
$errl = "<img src=\"images/point.gif\" alt=\"!\"/> Senha inv???lida!";
$pe = "<img src=\"images/point.gif\" alt=\"!\"/>";
break;
case 6:
$errl = "<img src=\"images/point.gif\" alt=\"!\"/> Senhas n???o combinam!";
$ce = "<img src=\"images/point.gif\" alt=\"!\"/>";
break;
case 7:
$errl = "<img src=\"images/point.gif\" alt=\"!\"/> Usu???rio tem que ter mais de 5 caracteres!";
$ue = "<img src=\"images/point.gif\" alt=\"!\"/>";
break;
case 8:
$errl = "<img src=\"images/point.gif\" alt=\"!\"/> Senha tem que ter mais de 8 caracteres, exemplo <b>".gerador_password(8)."</b>!";
$pe = "<img src=\"images/point.gif\" alt=\"!\"/>";
break;
case 9:
$errl = "<img src=\"images/point.gif\" alt=\"!\"/> Usu???rio em uso escolha outro!";
$ue = "<img src=\"images/point.gif\" alt=\"!\"/>";
break;
case 10:
$errl = "<img src=\"images/point.gif\" alt=\"!\"/> Campos dia, mes, ano n???o podem ficar em branco!";
break;
case 11:
$errl = "<img src=\"images/point.gif\" alt=\"!\"/> Apenas n???meros podem ser colocados no anivers???rio!";
break;
case 12:
$errl = "<img src=\"images/point.gif\" alt=\"!\"/> Digite o c???digo de seguran???a!";
break;
case 13:
$errl = "<img src=\"images/point.gif\" alt=\"!\"/> C???digo de seguran???a errado!";
break;
case 14:
$errl = "<img src=\"images/point.gif\" alt=\"!\"/> Caracteres n???o permitidos no usu???rio!";
break;
}
$rform = "<small>$errl</small>";
return $rform;
}
////////////////////////////////pontos da comunidade
function getplusses_cl($clid)
{
$total = mysql_fetch_array(mysql_query("SELECT plusses FROM fun_clubs WHERE (id='".$clid."')"));
return ceil($total[0]);//retorna todos os pontos da comunidade $clid inteiros
}
////////////////////////////////////wapgrana
function wapgrana_uid($uid)
{
$wapfra = mysql_fetch_array(mysql_query("SELECT wapgrana FROM fun_users WHERE id='".$uid."'"));
return ceil($a[0]);
}

//////////////////////////////////////////// Search Id
function generate_srid($svar1,$svar2="", $svar3="", $svar4="", $svar5="")
{
$res = mysql_fetch_array(mysql_query("SELECT id FROM fun_search WHERE svar1 like '".$svar1."' AND svar2 like '".$svar2."' AND svar3 like '".$svar3."' AND svar4 like '".$svar4."' AND svar5 like '".$svar5."'"));
if($res[0]>0)
{
return $res[0];
}
$ttime = time();
mysql_query("INSERT INTO fun_search SET svar1='".$svar1."', svar2='".$svar2."', svar3='".$svar3."', svar4='".$svar4."', svar5='".$svar5."', stime='".$ttime."'");
$res = mysql_fetch_array(mysql_query("SELECT id FROM fun_search WHERE svar1 like '".$svar1."' AND svar2 like '".$svar2."' AND svar3 like '".$svar3."' AND svar4 like '".$svar4."' AND svar5 like '".$svar5."'"));
return $res[0];
}

//////////////////////////////////function addlog
function addlog($msg)
{
$msg = strip_tags(htmlspecialchars($msg));
mysql_query("INSERT INTO fun_log SET msg='".$msg."', data='".time()."'");
}
///////////////////////////////////function isuser
function isuser($uid)
{
    global $pdo;
$cus = $pdo->query("SELECT COUNT(*) FROM fun_users WHERE id='".$uid."'")->fetch();
if($cus[0]>0)
{
return true;
}else
{
return false;
}
}
////////////////////////////////////////////Can access forum
function canaccess($uid, $fid)
{
$fex = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_forums WHERE id='".$fid."'"));
if($fex[0]==0)
{
return false;
}
$persc = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_acc WHERE fid='".$fid."'"));
if($persc[0]==0)
{
$clid = mysql_fetch_array(mysql_query("SELECT clubid FROM fun_forums WHERE id='".$fid."'"));
if($clid[0]==0)
{
return true;
}else{
if(ismod($uid))
{
return true;
}else{
$ismm = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_clubmembers WHERE uid='".$uid."' AND clid='".$clid[0]."'"));
if($ismm[0]>0)
{
return true;
}else{
return false;
}
}
}
}else{
$gid = mysql_fetch_array(mysql_query("SELECT gid FROM fun_acc WHERE fid='".$fid."'"));
$gid = $gid[0];
$ginfo = mysql_fetch_array(mysql_query("SELECT autoass, mage, userst, posts, plusses FROM fun_groups WHERE id='".$gid."'"));
if($ginfo[0]=="1")
{
$uperms = mysql_fetch_array(mysql_query("SELECT birthday, perm, posts, plusses FROM fun_users WHERE id='".$uid."'"));
if($ginfo[2]==2)
{
if(isadmin($uid))
{
return true;
}else{
return false;
}
}
if($ginfo[2]==1)
{
if(ismod($uid))
{
return true;
}else{
return false;
}
}
if($uperms[1]>$ginfo[2])
{
return true;
}
$acc = true;
if(getage($uperms[0])< $ginfo[1])
{
$acc =  false;
}
if($uperms[2]<$ginfo[3])
{
$acc =  false;
}
if($uperms[3]<$ginfo[4])
{
$acc =  false;
}
}
}
return $acc;
}
function getnick_uid2($uid)
{
    global $pdo;
$stmt = $pdo->prepare("SELECT name FROM fun_users WHERE id=:uid");
$stmt->execute(array(':uid'=>$uid));
$result = $stmt->fetch(PDO::FETCH_ASSOC);
return $result['name'];
}
function getuage_sid($sid)
{
$uid = getuid_sid($sid);
$uage = mysql_fetch_array(mysql_query("SELECT birthday FROM fun_users WHERE id='".$uid."'"));
return getage($uage[0]);
}
function canenter($rid, $sid)
{
$rperm = mysql_fetch_array(mysql_query("SELECT mage, perms, chposts, clubid FROM fun_rooms WHERE id='".$rid."'"));
$uperm = mysql_fetch_array(mysql_query("SELECT birthday, chmsgs FROM fun_users WHERE id='".getuid_sid($sid)."'"));
if($rperm[3]!=0)
{
if(ismod(getuid_sid($sid)))
{
return true;
}else
{
$ismm = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_clubmembers WHERE uid='".getuid_sid($sid)."' AND clid='".$rperm[3]."'"));
if($ismm[0]>0)
{
return true;
}else
{
return false;
}
}
}
if($rperm[1]==1)
{
return ismod(getuid_sid($sid));
}
if($rperm[1]==2)
{
return isadmin(getuid_sid($sid));
}
return true;
}
////cleandata apaga todos os dados antigos
function cleardata()
{
    global $pdo;
/////deleta as punicoes vencidas
$tempo_fim = time();
$pdo->query("DELETE FROM fun_ban WHERE tempo < '".$tempo_fim."'");
$timeto = 120;
$timenw = time();
$timeout = $timenw - $timeto;
$pdo->query("DELETE FROM fun_chonline WHERE lton<'".$timeout."'");
$timeto = 300;
$timenw = time();
$timeout = $timenw - $timeto;
$pdo->query("DELETE FROM fun_chat WHERE timesent<'".$timeout."'");
$timeto = 60*60;
$timenw = time() ;
$timeout = $timenw - $timeto;
$pdo->query("DELETE FROM fun_search WHERE stime<'".$timeout."'");
$lbpm = $pdo->query("SELECT value FROM fun_settings WHERE name='lastbpm'")->fetch();
$td = date("Y-m-d");
if ($td!=$lbpm[0])
{
$sql = "SELECT id, name, birthday  FROM fun_users where month(`birthday`) = month(curdate()) and dayofmonth(`birthday`) = dayofmonth(curdate())";
$ppl = $pdo->query($sql);
while($mem = $ppl->fetch())
{
$msg = "O ".$snome." deseja a voc?? um feliz anivers??rio![br/]Abra??os da Equipe, at?? breve!";
autopm($msg, $mem[0], "Feliz aniversario");
}
$pdo->query("UPDATE fun_settings SET value='".$td."' WHERE name='lastbpm'");
}
}
///////////////////////////////////////get file ext.
function arquivo_ext($strfnm)
{
$str = trim($strfnm);
if (strlen($str)<4){
return $str;
}
for($i=strlen($str);$i>0;$i--)
{
$ext .= substr($str,$i,1);
if(strlen($ext)==3)
{
$ext = strrev($ext);
return $ext;
}
}
}
///////////////////////////////////////Add to chat
function addtochat($uid, $rid)
{
$bago = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_chonline WHERE uid='".$uid."' AND rid='".$rid."'"));
if($bago[0]==0){
$msg = "*mat Entrou na sala";
mysql_query("INSERT INTO fun_chat SET timesent='".time()."', chatter='".$uid."', msgtext='".$msg."', rid='".$rid."'");
}
$timeto = 120;
$timenw = time();
$timeout = $timenw - $timeto;
$exec = mysql_query("DELETE FROM fun_chonline WHERE lton<'".$timeout."'");
$res = mysql_query("INSERT INTO fun_chonline SET lton='".time()."', uid='".$uid."', rid='".$rid."'");
if(!$res)
{
mysql_query("UPDATE fun_chonline SET lton='".time()."', rid='".$rid."' WHERE uid='".$uid."'");
}
}
////////////////////////////////////////////is mod
function candelgb($uid,$mid)
{
$minfo = mysql_fetch_array(mysql_query("SELECT gbowner, gbsigner FROM fun_gbook WHERE id='".$mid."'"));
if($minfo[0]==$uid)
{
return true;
}
if($minfo[1]==$uid)
{
return true;
}
return false;
}
//////////////////////////function spam
function isspam($text)
{
$sfil = array();
$comando = mysql_query("SELECT txt FROM fun_spam WHERE id");
while($spam = mysql_fetch_array($comando))
{
$sfil[] = $spam[0];
}
$text = str_replace(" ", "", $text);
$text = strtolower($text);
for($i=0;$i<count($sfil);$i++)
{
$nosf = substr_count($text,$sfil[$i]);
if($nosf>0)
{
return true;
}
}
return false;
}
/////////////////////////Get user plusses
function getplusses($uid)
{
$plus = mysql_fetch_array(mysql_query("SELECT plusses FROM fun_users WHERE id='".$uid."'"));
return $plus[0];
}
/////////////////////////Can uid sign who's guestbook?
function cansigngb($uid, $who)
{
if(arebuds($uid, $who))
{
return true;
}
if($uid==$who)
{
return false; //imagine if someone signed his own gbook o.O
}
if(getplusses($uid)>0)
{
return true;
}
return false;
}
/////////////////////////Can uid rate who's photo?
function canratephoto($uid, $who)
{
if($uid==$who)
{
return false; //imagine if someone signed his own gbook o.O
}else
return true;
}
/////////////////////////////////////////////Are buds?
function arebuds($uid, $tid)
{
$res = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_buddies WHERE ((uid='".$uid."' AND tid='".$tid."') OR (uid='".$tid."' AND tid='".$uid."')) AND agreed='1'"));
if($res[0]>0)
{
return true;
}
return false;
}
//////////////////////////////////function get n. of buds
function getnbuds($uid)
{
$notb = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_buddies WHERE (uid='".$uid."' OR tid='".$uid."') AND agreed='1'"));
return $notb[0];
}
/////////////////////////////get no. of requists
function getnreqs($uid)
{
$notb = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_buddies WHERE  tid='".$uid."' AND agreed='0'"));
return $notb[0];
}
/////////////////////////////get no. of online buds
function getonbuds($uid)
{
$counter =0;
$buds = mysql_query("SELECT uid, tid FROM fun_buddies WHERE (uid='".$uid."' OR tid='".$uid."') AND agreed='1'");
while($bud=mysql_fetch_array($buds))
{
if($bud[0]==$uid)
{
$tid = $bud[1];
}else{
$tid = $bud[0];
}
if(isonline($tid))
{
$counter++;
}
}
return $counter;
}
function getpage_go($go,$tid)
{
if(trim($go)=="")return 1;
if($go=="last")return getnumpages($tid);
$counter=1;
$posts = mysql_query("SELECT id FROM fun_posts WHERE tid='".$tid."'");
while($post=mysql_fetch_array($posts))
{
$counter++;
$postid = $post[0];
if($postid==$go)
{
$tore = ceil($counter/5);
return $tore;
}
}
return 1;
}
////////////////////////////mural de recados
function getshoutbox($sid)
{
$lshout = mysql_fetch_array(mysql_query("SELECT shout, shouter, id, cor  FROM fun_shouts ORDER BY shtime DESC LIMIT 1"));
$shnick = getnick_uid($lshout[1]);
$shbox .= "<a href=\"index.php?action=perfil&sid=$sid&who=$lshout[1]\">".$shnick."</a>: ";
$text = scan_msg($lshout[0], $sid);
$shbox .= "<span style=\"color: $lshout[3]\">$text</span>";
$shbox .= "<br/>";
$shbox .= "<a href=\"lists.php?action=shouts&sid=$sid\">mais</a>, ";
$shbox .= "<a href=\"index.php?action=shout&sid=$sid\">escrever</a>";
if (ismod(getuid_sid($sid)))
{
$shbox .= ", <a href=\"modproc.php?action=delsh&sid=$sid&shid=$lshout[2]\">apagar</a>";
}
return $shbox;
}
/////////////////////////////////////////////get tid frm post id
function gettid_pid($pid)
{
$tid = mysql_fetch_array(mysql_query("SELECT tid FROM fun_posts WHERE id='".$pid."'"));
return $tid[0];
}
///////////////////////////////////////////Get IP
function ver_ip_uid($uid)
{
$not = mysql_fetch_array(mysql_query("SELECT ipadd FROM fun_users WHERE id='".$uid."'"));
return $not[0];
}
///////////////////////////////////////////Get Browser
function getbr_uid($uid)
{
$not = mysql_fetch_array(mysql_query("SELECT browserm FROM fun_users WHERE id='".$uid."'"));
return $not[0];
}
/////////////////////////////////////////////get tid frm post id
function gettname($tid)
{
$tid = mysql_fetch_array(mysql_query("SELECT name FROM fun_topics WHERE id='".$tid."'"));
return $tid[0];
}
/////////////////////////////////////////////get tid frm post id
function getfid_tid($tid)
{
$fid = mysql_fetch_array(mysql_query("SELECT fid FROM fun_topics WHERE id='".$tid."'"));
return $fid[0];
}
////////////////get number of pinned topics in forum
function getpinned($fid)
{
$nop = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_topics WHERE fid='".$fid."' AND pinned ='1'"));
return $nop[0];
}
/////////////////////////////////////////////can bud?
function budres($uid, $tid)
{
//3 = can't bud
//2 = already buds
//1 = request pended
//0 = can bud
if($uid==$tid)
{
return 3;
}
if (arebuds($uid, $tid))
{
return 2;
}
$req = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_buddies WHERE ((uid='".$uid."' AND tid='".$tid."') OR (uid='".$tid."' AND tid='".$uid."')) AND agreed='0'"));
if($req[0]>0)
{
return 1;
}
$notb = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_buddies WHERE (uid='".$tid."' OR tid='".$tid."') AND agreed='1'"));
global $max_buds;
if($notb[0]>=$max_buds)
{
return 3;
}
$notb = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_buddies WHERE (uid='".$uid."' OR tid='".$uid."') AND agreed='1'"));
global $max_buds;
if($notb[0]>=$max_buds)
{
return 3;
}
return 0;
}
////////////////////////////////////////////sid expiration
function getsxtm()
{
$getdata = mysql_fetch_array(mysql_query("SELECT value FROM fun_settings WHERE name='sesexp'"));
return $getdata[0];
}
////////////////////////////////////////////Get bud msg
function getbudmsg($uid)
{
$getdata = mysql_fetch_array(mysql_query("SELECT budmsg FROM fun_users WHERE id='".$uid."'"));
return $getdata[0];
}
////////////////////////////////////////////Get forum name
function getfname($fid)
{
$fname = mysql_fetch_array(mysql_query("SELECT name FROM fun_forums WHERE id='".$fid."'"));
return $fname[0];
}
////////////////////////////////////////////torpedo anti repeticao
function flood_torpedos()
{
$getdata = mysql_fetch_array(mysql_query("SELECT value FROM fun_settings WHERE name='pmaf'"));
return $getdata[0];
}
////////////////////////////////////////////torpedo anti repeticao no forum
function flood_forum()
{
$getdata = mysql_fetch_array(mysql_query("SELECT value FROM fun_settings WHERE name='fview'"));
return $getdata[0];
}
////////////////////////////////////////////mural admin
function mural_admin()
{
$getdata = mysql_fetch_array(mysql_query("SELECT value FROM fun_settings WHERE name='4ummsg'"));
return $getdata[0];
}
//////////////////////////////////////////////esta online
function isonline($uid)
{
$uon = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_online WHERE userid='".$uid."'"));
if($uon[0]>0)
{
return true;
}else
{
return false;
}
}
///////////////////////////se o registro ?? permitido
function canreg()
{
    global $pdo;
$getreg = $pdo->query("SELECT value FROM fun_settings WHERE name='reg'")->fetch();
if($getreg[0]=='1')
{
return true;
}else
{
return false;
}
}
///////////////////////////////////////////topico id
function getfid($topicid)
{
$fid = mysql_fetch_array(mysql_query("SELECT fid FROM fun_topics WHERE id='".$topicid."'"));
return $fid[0];
}
////////////////////////////////////////////scan normal de mensagens
function scan_msg($text, $sid="")
{
$text = htmlspecialchars($text);
$sml = mysql_fetch_array(mysql_query("SELECT hvia FROM fun_users WHERE id='".getuid_sid($sid)."'"));
if ($sml[0]=="1")
{
$text = getsmilies($text);
}
$text = getbbcode($text, $sid);
return $text;
}
////////////////////////////////////////////scan de outros tipos de mensagens
function scan_msg_other($text,$sid="")
{
$text = htmlspecialchars($text);
$sml = mysql_fetch_array(mysql_query("SELECT hvia FROM fun_users WHERE id='".getuid_sid($sid)."'"));
if ($sml[0]=="1")
{
$text = getsmilies($text);
}
$text = getbbcode($text, $sid);
return $text;
}
///////////////////////////////////////////torpedo marcado
function isstarred($pmid)
{
$strd = mysql_fetch_array(mysql_query("SELECT starred FROM fun_private WHERE id='".$pmid."'"));
if($strd[0]=="1")
{
return true;
}else{
return false;
}
}
////////////////////////////////////////////IS LOGGED?
function is_logado($sid)
{
    global $pdo;
//delete old sessions first
$deloldses = $pdo->query("DELETE FROM fun_ses WHERE expiretm<'".time()."'");
//does sessions exist?
$sesx = $pdo->query("SELECT COUNT(*) FROM fun_ses WHERE id='".$sid."'")->fetch();
if($sesx[0]>0)
{
if(!isuser(getuid_sid($sid)))
{
return false;
}
//yip it's logged in
//first extend its session expirement time
$xtm = (time() + (60*getsxtm())) ;
$extxtm = $pdo->query("UPDATE fun_ses SET expiretm='".$xtm."' WHERE id='".$sid."'");
return true;
}else{
//nope its session must be expired or something
return false;
}
}
/*
function is_logado($sid)
{
    global $pdo;
  //delete old sessions first
  $stmt = $pdo->query("DELETE FROM fun_ses WHERE expiretm < '".time()."'");

  //does sessions exist?
  $stmt = $pdo->prepare('SELECT COUNT(*) FROM fun_ses WHERE id = :sid');
  $stmt->bindParam(':sid', $sid);
  $stmt->execute();
  $sesx = $stmt->fetch();

  if($sesx[0] > 0)
  {
    if(!isuser(getuid_sid($sid)))
    {
      return false;
    }
    //yip it's logged in
    //first extend its session expirement time
    $xtm = (time() + (60*getsxtm())) ;
    $stmt = $pdo->prepare('UPDATE fun_ses SET expiretm = :xtm WHERE id = :sid');
    $stmt->bindParam(':xtm', $xtm);
    $stmt->bindParam(':sid', $sid);
    $stmt->execute();
    return true;
  }
  else
  {
    //nope its session must be expired or something
    return false;
  }
}
*/
////////////////////////Get user nick from session id
function getnick_sid($sid)
{
    global $pdo;
    $query = $pdo->prepare("SELECT uid FROM fun_ses WHERE id=:sid");
    $query->execute(array(":sid" => $sid));
    $uid = $query->fetch(PDO::FETCH_COLUMN);

    $query = $pdo->prepare("SELECT name FROM fun_users WHERE id=:uid");
    $query->execute(array(":uid" => $uid));
    $unick = $query->fetch(PDO::FETCH_COLUMN);

    return $unick;
}
////////////////////////Get user id from session id
function getuid_sid($sid)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT uid FROM fun_ses WHERE id=:sid");
    $stmt->bindParam(':sid', $sid);
    $stmt->execute();
    $uid = $stmt->fetch(PDO::FETCH_ASSOC);
    return $uid['uid'];
}
function getnotcount($uid)
{
$nopm = $pdo->query("SELECT COUNT(*) FROM fun_notificacoes WHERE touid='".$uid."'")->fetch();
return $nopm[0];
}
function getunreadnot($uid)
{
$nopm = $pdo->query("SELECT COUNT(*) FROM fun_notificacoes WHERE touid='".$uid."' AND unread='1'")->fetch();
return $nopm[0];
}
/////////////////////Get total number of pms
function getpmcount($uid,$view="all")
{
if($view=="all"){
$nopm = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_private WHERE touid='".$uid."'"));
}else if($view =="snt")
{
$nopm = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_private WHERE byuid='".$uid."'"));
}else if($view =="str")
{
$nopm = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_private WHERE touid='".$uid."' AND starred='1'"));
}else if($view =="urd")
{
$nopm = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_private WHERE touid='".$uid."' AND unread='1'"));
}
return $nopm[0];
}
function deleteClub($clid)
{
$fid = mysql_fetch_array(mysql_query("SELECT id FROM fun_forums WHERE clubid='".$clid."'"));
$fid = $fid[0];
$topics = mysql_query("SELECT id FROM fun_topics WHERE fid=".$fid."");
while($topic = mysql_fetch_array($topics))
{
mysql_query("DELETE FROM fun_posts WHERE tid='".$topic[0]."'");
}
mysql_query("DELETE FROM fun_topics WHERE fid='".$fid."'");
mysql_query("DELETE FROM fun_forums WHERE id='".$fid."'");
mysql_query("DELETE FROM fun_rooms WHERE clubid='".$clid."'");
mysql_query("DELETE FROM fun_clubmembers WHERE clid='".$clid."'");
mysql_query("DELETE FROM fun_announcements WHERE clid='".$clid."'");
mysql_query("DELETE FROM fun_clubs WHERE id=".$clid."");
return true;
}
function deleteMClubs($uid)
{
$uclubs = mysql_query("SELECT id FROM fun_clubs WHERE owner='".$uid."'");
while($uclub=mysql_fetch_array($uclubs))
{
deleteClub($uclub[0]);
}
}
///////funcao para atualizar o usuario
function adicionar_online($uid, $place)
{ 
    global $pdo;
/////delete inactive users
$tm = time() ;
$timeout = $tm - 1800; //time out = 30 minutos
$deloff = $pdo->query("DELETE FROM fun_online WHERE actvtime <'".$timeout."'");
///now try to add user to online list and add total time online
$lastactive = $pdo->query("SELECT lastact FROM fun_users WHERE id='".$uid."'")->fetch();
$tolsla = time() - $lastactive[0];
$totaltimeonline = $pdo->query("SELECT tottimeonl FROM fun_users WHERE id='".$uid."'")->fetch();
$totaltimeonline = $totaltimeonline[0] + $tolsla;
$tf = $lastactive[0]+300;
$timee = time();
if($tf>$timee)
{
$res = $pdo->query("UPDATE fun_users SET tottimeonl='".$totaltimeonline."' WHERE id='".$uid."'");
}
$totaltimeonline = $pdo->query("SELECT tempon FROM fun_users WHERE id='".$uid."'")->fetch();
$totaltimeonline = $totaltimeonline[0] + $tolsla;
$tf = $lastactive[0]+300;
$timee = time();
if($tf>$timee)
{
$res = $pdo->query("UPDATE fun_users SET tempon='".$totaltimeonline."' WHERE id='".$uid."'");
}
$info = $pdo->query("SELECT tempon, plusses FROM fun_users WHERE id='".$uid."'")->fetch();
$tempon = floor($info[0]/60);
if($tempon>59)
{
$pontos = $info[1] + 10;
$pdo->query("UPDATE fun_users SET tempon='0', plusses='".$pontos."' WHERE id='".$uid."'");
}
$ttime = time();
$res = $pdo->query("UPDATE fun_users SET lastact='".$ttime."' WHERE id='".$uid."'");
$res = $pdo->query("INSERT INTO fun_online SET userid='".$uid."', actvtime='".$ttime."', place='".$place."', placedet='".$plclink."'");
if(!$res)
{
//most probably userid already in the online list
//so just update the place and time
$res = $pdo->query("UPDATE fun_online SET actvtime='".$ttime."', place='".$place."', placedet='".$plclink."' WHERE userid='".$uid."'");
}
$maxmem=$pdo->query("SELECT value FROM fun_settings WHERE id='2'")->fetch();
$result = $pdo->query("SELECT COUNT(*) FROM fun_online")->fetch();
if($result[0]>=$maxmem[0])
{
$tnow = date("D/d/M/Y - H:i", time());
$pdo->query("UPDATE fun_settings set name='".$tnow."', value='".$result[0]."' WHERE id='2'");
}
$maxtoday = $pdo->query("SELECT ppl FROM fun_mpot WHERE ddt='".date("d m y")."'")->fetch();
if($maxtoday[0]==0||$maxtoday=="")
{
$pdo->query("INSERT INTO fun_mpot SET ddt='".date("d/m/y")."', ppl='1', dtm='".date("H:i:s")."'");
$maxtoday[0]=1;
}
if($result[0]>=$maxtoday[0])
{
$pdo->query("UPDATE fun_mpot SET ppl='".$result[0]."', dtm='".date("H:i:s")."' WHERE ddt='".date("d m y")."'");
}
}
/////////////////////Get members online
function getnumonline()
{
    global $pdo;
$nouo = $pdo->query("SELECT COUNT(*) FROM fun_online ")->fetch();
return $nouo[0];
}
//////////////////////////////////////is ignored
function isignored($tid, $uid)
{
$ign = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_ignore WHERE target='".$tid."' AND name='".$uid."'"));
if($ign[0]>0)
{
return true;
}
return false;
}
///////////////////////////////////////////GET IP
function ver_ip()
{
if (getenv('HTTP_X_FORWARDED_FOR'))
{
$ip=getenv('HTTP_X_FORWARDED_FOR');
}
else
{
$ip=getenv('REMOTE_ADDR');
}
return $ip;
}
//////////////////////////////////////////numero de novos usuarios
function u_pendentes()
{
$pendentes = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_users WHERE pendente='1'"));
return $pendentes[0];
}
//////////////////////////////////////////ignore result
function ignoreres($uid, $tid)
{
//0 user can't ignore the target
//1 yes can ignore
//2 already ignored
if($uid==$tid)
{
return 0;
}
if(ismod($tid))
{
//you cant ignore staff members
return 0;
}
if(arebuds($tid, $uid))
{
//why the hell would anyone ignore his bud? o.O
return 0;
}
if(isignored($tid, $uid))
{
return 2; // the target is already ignored by the user
}
return 1;
}
///////////////////////////////////////////Function getage
function getage($strdate)
{
$dob = explode("-",$strdate);
if(count($dob)!=3)
{
return 0;
}
$y = $dob[0];
$m = $dob[1];
$d = $dob[2];
if(strlen($y)!=4)
{
return 0;
}
if(strlen($m)!=2)
{
return 0;
}
if(strlen($d)!=2)
{
return 0;
}
$y += 0;
$m += 0;
$d += 0;
if($y==0) return 0;
$rage = date("Y") - $y;
if(date("m")<$m)
{
$rage-=1;
}else{
if((date("m")==$m)&&(date("d")<$d))
{
$rage-=1;
}
}
return $rage;
}
/////////////////////////////////////////getavatar
function getavatar($uid)
{
$av = mysql_fetch_array(mysql_query("SELECT avatar FROM fun_users WHERE id='".$uid."'"));
return $av[0];
}
//////////////////////////tempo_msg
function tempo_msg($sec)
{
$ds = floor($sec/60/60/24);
if($ds > 0)
{
return "$ds dias";
}
$hs = floor($sec/60/60);
if($hs > 0)
{
return "$hs horas";
}
$ms = floor($sec/60);
if($ms > 0)
{
return "$ms minutos";
}
return "$sec Segundos";
}
function getstatus($uid)
{
    global $pdo;
$info = $pdo->query("SELECT perm, plusses, vip FROM fun_users WHERE id='".$uid."'")->fetch();
if(is_banido($uid))
{
return "Banido!";
}
else if($info[0]=='2')
{
return "Administrador(a)!";
}else if($info[0]=='1')
{
return "Moderador(a)!";
}else if($info[2]=='1')
{
return "VIP";
}else{
if($info[1]==0)
{
return "Pobre";
}else if($info[1]<20)
{
return "Novato";
}else if($info[1]<59)
{
return "Frequente";
}else if($info[1]<99)
{
return "Esta??????oBronze";
}else if($info[1]<249)
{
return "Super frequente";
}else if($info[1]<499)
{
return "Titan";
}else if($info[1]<749)
{
return "Usu???rio especial";
}else if($info[1]<999)
{
return "Super prata";
}else if($info[1]<1499)
{
return "Veterano";
}else if($info[1]<1999)
{
return "Expert";
}else if($info[1]<2499)
{
return "Earthquake";
}else if($info[1]<2999)
{
return "MelhorOuro";
}else if($info[1]<3999)
{
return "S???cio amigo";
}else if($info[1]<4999)
{
return "Tsunami";
}else if($info[1]<9999)
{
return "Super brilhante";
}else if($info[1]<19999)
{
return "Extreme diamante";
}else if($info[1]<29999)
{
return "Power graduado";
}else if($info[1]<39999)
{
return "Power super graduado";
}else if($info[1]<40000)
{
return "Smart m???ximus";
}else
{
return "Smart m???ximus";
}
}
}
/////////////////////Get Page Jumber
function getjumper($action, $sid,$pgurl)
{
$rets = "<form action=\"$pgurl.php\" method=\"get\">";
$rets .= "Pular  pagina<input name=\"pg\" format=\"*N\" size=\"3\"/>";
$rets .= "<input type=\"submit\" value=\"Ir\"/>";
$rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
$rets .= "<input type=\"hidden\" name=\"tid\" value=\"$tid\"/>";
$rets .= "<input type=\"hidden\" name=\"page\" value=\"$(pg)\"/>";
$rets .= "</form>";
return $rets;
}
/////////////////////Get unread number of pms
function getunreadpm($uid)
{
    global $pdo;
$nopm = $pdo->query("SELECT COUNT(*) FROM fun_private WHERE touid='".$uid."' AND unread='1'")->fetch();
return $nopm[0];
}
function ip_ban($ip, $br)
{
    global $pdo;
$ipa = $pdo->query("SELECT COUNT(*) FROM fun_ban WHERE ip='".$ip."' AND browser='".$br."' AND tipoban='2' ")->fetch();
if($ipa[0]==0)
{
return false;
}else
{
return true;
}
}
function is_banido($uid)
{
    global $pdo;
$ttime = time();
$del = $pdo->exec("DELETE FROM fun_ban WHERE tempo<'".$ttime."'");
$not = $pdo->query("SELECT COUNT(*) FROM fun_ban WHERE uid='".$uid."' AND (tipoban='1' OR tipoban='2')")->fetch();
if($not[0]==0)
{
return false;
}else
{
return true;
}
}
//////////////////////GET USER NICK FROM USERID
function getnick_uid($uid)
{
    global $pdo;
$unick = $pdo->query("SELECT name, plusses, perm, vip, sex FROM fun_users WHERE id='".$uid."'")->fetch();
if($uid=="1")
{
return "<b style=\"color: #000\">$unick[0]</b>";
}
else if(isset($unick[2])? $unick[2]:null =='2')
{
return "<b style=\"color: red\">$unick[0]</b>";
}
else if(isset($unick[2])? $unick[2]: null =='1')
{
return "<b style=\"color: green\">$unick[0]</b>";
}
else if(isset($unick[3])? $unick[3]: null=='1')
{
return "<b style=\"color: #ff4500\">$unick[0]</b>";
}
else if(isset($unick[4])? $unick[4]: null =='G')
{
return "<b style=\"color: purple\">$unick[0]</b>";
}
else if(isset($unick[4])? $unick[4]: null =='M')
{
return "<b style=\"color: #00008b\">$unick[0]</b>";
}
else if(isset($unick[4])? $unick[4]: null=='F')
{
return "<b style=\"color: #ff3e96\">$unick[0]</b>";
}
else{
return isset($unick[0])? $unick[0]: null;
}
}
function getnumpages($tid)
{
$nops = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_posts WHERE tid='".$tid."'"));
$nops = $nops[0]+1; //where did the 1 come from? the topic text, duh!
$nopg = ceil($nops/5); //5 is the posts to show in each page
return $nopg;
}
function getnick_uid_noc($uid)
{
$unick = mysql_fetch_array(mysql_query("SELECT name,plusses, perm FROM fun_users WHERE id='".$uid."'"));
return $unick[0];
}
///////////////////////////////////////////////Get the smilies
function getsmilies($text)
{
$sql = "SELECT * FROM fun_smilies";
$smilies = mysql_query($sql);
while($smilie=mysql_fetch_array($smilies))
{
$scode = $smilie[1];
$spath = $smilie[2];
$text = str_replace($scode,"<img src=\"$spath\" alt=\"$scode\"/>",$text);
}
return $text;
}
function autopm($msg, $who)
{
    global $pdo;
$comando = "INSERT INTO fun_private SET text=:msg, byuid='1', touid=:who, unread='1', timesent=:time";
$stmt = $pdo->prepare($comando);
$stmt->bindValue(':msg', $msg);
$stmt->bindValue(':who', $who);
$stmt->bindValue(':time',time());
$stmt->execute();
}
////////////////////////////////////////////////////Register
/////////////////////// GET fun_users user id from nickname
function getuid_nick($nick)
{
    global $pdo;
$uid = $pdo->query("SELECT id FROM fun_users WHERE name='".$nick."'")->fetch();
return isset($uid[0]) ? $uid[0]: null;
}
////////////////////////////////////////////is mod
function ismod($uid)
{
$perm = mysql_fetch_array(mysql_query("SELECT perm FROM fun_users WHERE id='".$uid."'"));
if($perm[0]>0 OR $uid=="1")
{
return true;
}
else
{
return false;
}
return false;
}
/////////////////////////////////////////Is admin?
function isadmin($uid)
{
$admn = mysql_fetch_array(mysql_query("SELECT perm FROM fun_users WHERE id='".$uid."'"));
if($admn[0]=='2' OR $uid=='1')
{
return true;
}else
{
return false;
}
}
/////////////////////////////////////////Is Owner
function isowner($uid)
{
$owner = mysql_fetch_array(mysql_query("SELECT perm FROM fun_users WHERE id='".$uid."'"));
if($owner[0]=='3')
{
return true;
}else{
return false;
}
}
///////////////////////////////////parse bbcode
function getbbcode($text, $sid="")
{
$text=preg_replace("/\[b\](.*?)\[\/b\]/i","<b>\\1</b>", $text);
$text=preg_replace("/\[i\](.*?)\[\/i\]/i","<i>\\1</i>", $text);
$text=preg_replace("/\[u\](.*?)\[\/u\]/i","<u>\\1</u>", $text);
$text = preg_replace("/\%code%/is","$sid",$text);
$text=preg_replace("/\[big\](.*?)\[\/big\]/i","<big>\\1</big>", $text);
$text=preg_replace("/\[small\](.*?)\[\/small\]/i","<small>\\1</small>", $text);
$text = preg_replace("/\[img\=(.*?)\]/is","<img src=\"$1\"/>",$text);
$text = preg_replace("/\[cor\=(.*?)\](.*?)\[\/cor\]/is","<font color=\"$1\">$2</font>",$text);
$text = preg_replace("/\[relacionamento\=(.*?)\](.*?)\[\/relacionamento\]/is","<a href=\"relacionamento.php?a=aceitar&cid=$1&sid=$sid\">$2</a>",$text);
$text = preg_replace("/\[topic\=(.*?)\](.*?)\[\/topic\]/is","<a href=\"index.php?action=viewtpc&tid=$1&sid=$sid\">$2</a>",$text);
$text = preg_replace("/\[forum\=(.*?)\](.*?)\[\/forum\]/is","<a href=\"index.php?action=viewfrm&tid=$1&sid=$sid\">$2</a>",$text);
$text = preg_replace("/\[club\=(.*?)\](.*?)\[\/club\]/is","<a href=\"index.php?action=gocl&clid=$1&sid=$sid\">$2</a>",$text);
$text = preg_replace("/\[murl\=(.*?)\](.*?)\[\/murl\]/is","<a href=\"$1\">$2</a>",$text);
$text = preg_replace("/\[url\=(.*?)\](.*?)\[\/url\]/is","<a href=\"link.php?url=$1\">$2</a>",$text);
if(substr_count($text,"[br/]")<=3)
{
$text = str_replace("[br/]","<br/>",$text);
}
return $text;
}
/////////////////////////////////Number of registered members
function regmemcount()
{
$rmc = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fun_users"));
return $rmc[0];
}
///////////////////////////function counter
function addvisitor()
{
    global $pdo;
$cc = $pdo->query("SELECT value FROM fun_settings WHERE name='counter'")->fetch();
$cc = $cc[0]+1;
$res = $pdo->query("UPDATE fun_settings SET value='".$cc."' WHERE name='counter'");
}
function scharin($word)
{
$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_@!{[]}";
for($i=0;$i<strlen($word);$i++)
{
$ch = substr($word,$i,1);
$nol = substr_count($chars,$ch);
if($nol==0)
{
return true;
}
}
return false;
}
function isdigitf($word)
{
$chars = "abcdefghijklmnopqrstuvwxyz";
$ch = substr($word,0,1);
$sres = ereg("[0-9]",$ch);
$ch = substr($word,0,1);
$nol = substr_count($chars,$ch);
if($nol==0)
{
return true;
}
return false;
}
