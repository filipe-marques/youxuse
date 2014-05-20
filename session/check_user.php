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

session_start();

function generate_new_session_id() {
    session_regenerate_id();
}

// youxuse.php
function user(){
	if ($_SESSION['sexo'] === 'M') {
        $user = LABEL_USERO1;
    } elseif ($_SESSION['sexo'] === 'F') {
        $user = LABEL_USERO2;
    }
    return $user;
}

// header.php
function sexo() {
    if ($_SESSION['sexo'] === 'M') {
        $sex = LABEL_SEXO1;
    } elseif ($_SESSION['sexo'] === 'F') {
        $sex = LABEL_SEXO2;
    }
    return $sex;
}

function nothing() {
    if (empty($_SESSION['prinome'])) {
        header("Location: ../index.php");
        exit();
    }
}

function full() {
    if (isset($_SESSION['prinome'])) {
        header("Location: user.php?page=initial");
        exit();
    }
}

function is_not_admin() {
    if ($_SESSION['prinome'] != "admin") {
        header("Location: user.php?page=initial");
        exit();
    }
}

function is_admin() {
    if ($_SESSION['prinome'] == "admin") {
        header("Location: admin.php");
        exit();
    }
}

?>
