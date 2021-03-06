<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/inc/auth.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/inc/languages/" . $language . ".php");

if (isset($_POST["remove"])) {
    $fid = $_POST["f_id"];
    foreach ($fid as $key => $val) {
        if (isset($val) and $val > 0) {
            $new['ou_id'] = 0;
            update_record($db_link, "User_list", "ou_id=" . $val, $new);
            delete_record($db_link, "OU", "id=" . $val);
            }
        }
    header("Location: " . $_SERVER["REQUEST_URI"]);
    }

if (isset($_POST['save'])) {
    $saved = array();
    //button save
    $len = is_array($_POST['save']) ? count($_POST['save']) : 0;
    for ($i = 0; $i < $len; $i ++) {
        $save_id = intval($_POST['save'][$i]);
        if ($save_id == 0) { continue;  }
        array_push($saved,$save_id);
        }
    //select box
    $len = is_array($_POST['f_id']) ? count($_POST['f_id']) : 0;
    if ($len>1) {
        for ($i = 0; $i < $len; $i ++) {
            $save_id = intval($_POST['f_id'][$i]);
            if ($save_id == 0) { continue; }
            if (!in_array($save_id, $saved)) { array_push($saved,$save_id); }
            }
        }
    //save changes
    $len = is_array($saved) ? count($saved) : 0;
    for ($i = 0; $i < $len; $i ++) {
        $save_id = intval($saved[$i]);
        if ($save_id == 0) { continue;  }
        $len_all = is_array($_POST['id']) ? count($_POST['id']) : 0;
        for ($j = 0; $j < $len_all; $j ++) {
            if (intval($_POST['id'][$j]) != $save_id) { continue; }
            $new['ou_name'] = $_POST['f_group_name'][$j];
            $new['nagios_dir'] = $_POST['f_nagios'][$j];
            $new['nagios_host_use'] = $_POST['f_nagios_host'][$j];
            $new['nagios_ping'] = $_POST['f_nagios_ping'][$j];
            $new['nagios_default_service'] = $_POST['f_nagios_service'][$j];
            update_record($db_link, "OU", "id='{$save_id}'", $new);
            }
        }
    header("Location: " . $_SERVER["REQUEST_URI"]);
    }

if (isset($_POST["create"])) {
    $ou_name = $_POST["new_ou"];
    if (isset($ou_name)) {
        $new['ou_name'] = $ou_name;
        insert_record($db_link, "OU", $new);
        }
    header("Location: " . $_SERVER["REQUEST_URI"]);
    }

unset($_POST);
require_once ($_SERVER['DOCUMENT_ROOT']."/inc/header.php");
?>
<div id="cont">
<table>
<tr>
<td><b>Список групп</b><br>
<form name="def" action="index.php" method="post">
<table class="data">
<tr align="center">
<td><input type="checkbox" onClick="checkAll(this.checked);"></td>
<td><b>Id</b></td>
<td><b>Название</b></td>
<td><b>Nagios directory</b></td>
<td><b>Host template</b></td>
<td><b>Ping</b></td>
<td><b>Host service</b></td>
<td><input type="submit" name="remove" value="Удалить"></td>
</tr>
<?
$t_ou = get_records($db_link,'OU','TRUE ORDER BY ou_name');
foreach ($t_ou as $row) {
    print "<tr align=center>\n";
    print "<td class=\"data\" style='padding:0'><input type=checkbox name=f_id[] value='{$row['id']}'></td>\n";
    print "<td class=\"data\"><input type=\"hidden\" name='id[]' value='{$row['id']}'>{$row['id']}</td>\n";
    print "<td class=\"data\"><input type=\"text\" name='f_group_name[]' value='{$row['ou_name']}'></td>\n";
    print "<td class=\"data\"><input type=\"text\" name='f_nagios[]' value='{$row['nagios_dir']}'></td>\n";
    print "<td class=\"data\"><input type=\"text\" name='f_nagios_host[]' value='{$row['nagios_host_use']}'></td>\n";
    print "<td class=\"data\">"; print_qa_select("f_nagios_ping[]",$row['nagios_ping']); print "</td>\n";
    print "<td class=\"data\"><input type=\"text\" name='f_nagios_service[]' value='{$row['nagios_default_service']}'></td>\n";
    print "<td class=\"data\"><button name='save[]' value='{$row['id']}'>Сохранить</button></td>\n";
    print "</tr>\n";
}
?>
</table>
<table>
<tr>
<td><input type=text name=new_ou value="Unknown"></td>
<td><input type="submit" name="create" value="Добавить"></td>
<td align="right"></td>
</tr>
</table>
</form>
<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/inc/footer.php");
?>
