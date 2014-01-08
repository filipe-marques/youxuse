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
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Bem&dash;vindo <?php echo $_SESSION['prinome']; ?> &dash; YouXuse &dash; Venda &AMP; Compra pe&ccedil;as usadas de tecnologia</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="../resources/css/bootstrap.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
        <link href="../resources/css/bootstrap-responsive.css" rel="stylesheet" type="text/css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="../assets/js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="../resources/img/youxuse-icon.png">
    </head>

    <body>
        <?php include ("head.php"); ?>
        <div class="container">
            <?php
            mysql_query("START TRANSACTION");
            $select = "SELECT * FROM ip_adress";
            $q = mysql_query($select);
            if (($q)) {
                echo("<table class=\"table\">
                <caption><h3>Tabela: ip_adress</h3></caption>
                <thead>
                    <tr>
                        <td>
                            <center>Id</center>
                        </td>
                        <td>
                            <center>Id do Utilizador</center>
                        </td>
                        <td>
                            <center>Endereço IP</center>
                        </td>
                        <td>
                            <center>Data da Utilização</center>
                        </td>
                        <td>
                            <center>Apagar?</center>
                        </td>
                    </tr>
                </thead>");
                while ($row = mysql_fetch_array($q)) {
                    $id = $row['id'];
                    $users_id = $row['users_id'];
                    $ip_adress = $row['ip_adress'];
                    $data = $row['data'];
                    if ($users_id == 1){
                        unset($id);
                        unset($users_id);
                        unset($ip_adress);
                    }
                    echo("<tbody>
                    <tr>
                        <td>
                            <center>$id</center>
                        </td>
                        <td>
							<center><a href=\"operations.php?data=users\">$users_id</a></center>
                        </td>
                        <td>
							<center>" . geoip_country_name_by_name($ip_adress) . " - " . "$ip_adress</center>
                        </td>
                        <td>
							<center>$data</center>
                        </td>
                        <td>
                        <center>
                        <a onclick=\"return confirm('Confirma que vai apagar o registo ?')\"
                                href=\"del.php?table=ip_adress&id=$id\">Apagar?</a>
                                </center></td>
                   </tr>");
                }
                echo ("</table>");
            } else {
                echo ("A tabela não tem registos");
            }
            mysql_query("COMMIT");
            mysql_free_result($q);
            mysql_close();
            ?>

        </div> <!-- /container -->
        <?php include ("foot.php"); ?>
        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript" src="./resources/js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-transition.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-alert.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-modal.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-dropdown.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-scrollspy.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-tab.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-tooltip.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-popover.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-button.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-collapse.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-carousel.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-typeahead.js"></script>

    </body>
</html>
