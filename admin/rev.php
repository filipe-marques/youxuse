<?php
/* This file is part of YouXuse
 * 
 * <YouXuse - web application to sell & buy componnents of tecnology>
 * Copyright (C) <2013>  <Filipe Marques> <eagle.software3@gmail.com>
 *
 * YouXuse is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * YouXuse is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * 
 * For full reading of the license see the folder "license" 
 * 
 */
session_name("YouXuse");
require_once ("../session/check_user.php");
require_once ("../process/functions.php");
require_once("connect.php");

// instantiation of the class Connection
$data_connect = new Connection_ADMIN();
// accessing the connect method
$data_connect->connect();

nothing();
is_not_admin();
generate_new_session_id();

// Security reasons
$tabl = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['table'])), ENT_QUOTES));
$id = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['id'])), ENT_QUOTES));

// Update the selected table with empty values to deny permissions of contributing when a user has bad behavior in follow the terms of cla and software license 
mysql_query("START TRANSACTION");
$sqldel = "UPDATE $tabl SET morada='',cod_postal='',freguesia='',concelho='',indicativo='',telefone='',telemovel='',username_github='',signed_date='' WHERE id='$id'";
$cons = mysql_query($sqldel);
if ($cons != 1) {
    echo ("Aconteceu um erro! Tente outra vez!");
    mysql_query("ROLLBACK");
} else {
    mysql_query("COMMIT");
    header("Location: operations.php?data=users");
    exit();
}
mysql_free_result($cons);
mysql_close();
?>
