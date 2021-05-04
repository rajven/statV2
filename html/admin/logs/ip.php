<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/inc/auth.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/inc/languages/" . $language . ".php");
require_once ($_SERVER['DOCUMENT_ROOT']."/inc/header.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/inc/datefilter.php");

if (isset($_POST['ip'])) { $f_ip = $_POST['ip']; }
if (isset($_GET['ip'])) { $f_ip = $_GET['ip']; }
if (!isset($f_ip) and isset($_SESSION[$page_url]['ip'])) { $f_ip=$_SESSION[$page_url]['ip']; }
if (!isset($f_ip)) { $f_ip=''; }

$_SESSION[$page_url]['ip']=$f_ip;

print_log_submenu($page_url);

$ip_where = '';
if (!empty($f_ip)) {
    if (checkValidIp($f_ip)) { $ip_where = " and ip_int=inet_aton('" . $f_ip . "') "; }
    if (checkValidMac($f_ip)) { $ip_where = " and mac='" . mac_dotted($f_ip) . "'  "; }
    }
?>

<div id="cont">
<br>
Здесь находится история всех работавших когда-то маков/ip.<br>
Если нужно найти место подключения - смотреть приключения маков!<br>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
Начало:&nbsp<input type="date" name="date_start" value="<?php echo $date1; ?>" />
Конец:&nbsp<input type="date"	name="date_stop" value="<?php echo $date2; ?>" />
ip or mac:&nbsp<input type="text" name="ip" value="<?php echo $f_ip; ?>" pattern="^((([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])|([0-9A-Fa-f]{2}[:-]){5}[0-9A-Fa-f]{2}|([0-9a-fA-F]{4}[\\.-][0-9a-fA-F]{4}[\\.-][0-9a-fA-F]{4})|[0-9A-Fa-f]{12})$"/>
Отображать:<?php print_row_at_pages('rows',$displayed); ?>
<input type="submit" value="OK">
</form>

<?php
$countSQL="SELECT Count(*) FROM User_auth WHERE `timestamp`>='$date1' AND `timestamp`<'$date2' $ip_where";
$res = mysqli_query($db_link, $countSQL);
$count_records = mysqli_fetch_array($res);
$total=ceil($count_records[0]/$displayed);
if ($page>$total) { $page=$total; }
if ($page<1) { $page=1; }
$start = ($page * $displayed) - $displayed; 
print_navigation($page_url,$page,$displayed,$count_records[0],$total);
?>
<br>
<table class="data">
		<tr align="center">
				<td class="data"><b>id</b></td>
				<td class="data" width=150><b>Время создания</b></td>
				<td class="data" width=150><b>Последняя работа</b></td>
				<td class="data"><b>IP</b></td>
				<td class="data"><b>mac</b></td>
				<td class="data"><b>dhcp hostname</b></td>
				<td class="data"><b>dns name</b></td>
		</tr>

<?php

$sSQL = "SELECT * FROM User_auth WHERE `timestamp`>='$date1' AND `timestamp`<'$date2' $ip_where ORDER BY timestamp DESC LIMIT $start,$displayed";

$iplog = get_records_sql($db_link, $sSQL);
foreach ($iplog as $row) {
    print "<tr align=center align=center class=\"tr1\" onmouseover=\"className='tr2'\" onmouseout=\"className='tr1'\">\n";
    print "<td class=\"data\">" . $row['id'] . "</td>\n";
    print "<td class=\"data\">" . $row['timestamp'] . "</td>\n";
    print "<td class=\"data\">" . $row['last_found'] . "</td>\n";
    if (isset($row['id']) and $row['id'] > 0) {
        print "<td class=\"data\"><a href=/admin/users/editauth.php?id=".$row['id'].">" . $row['ip'] . "</a></td>\n";
    } else {
        print "<td class=\"data\">" . $row['ip'] . "</td>\n";
    }
    print "<td class=\"data\">" . expand_mac($db_link,mac_dotted($row['mac'])) . "</td>\n";
    print "<td class=\"data\">" . $row['dhcp_hostname'] . "</td>\n";
    print "<td class=\"data\">" . $row['dns_name'] . "</td>\n";
    print "</tr>\n";
}
print "</table>\n";
print_navigation($page_url,$page,$displayed,$count_records[0],$total);
require_once ($_SERVER['DOCUMENT_ROOT']."/inc/footer.php");
?>
