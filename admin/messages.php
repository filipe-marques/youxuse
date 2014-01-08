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

            <h3>
                <p class="text-center">Tabelas: 
                    <a href="messages.php?data=mensagens_emergency">mensagens_emergency</a>, 
                    <a href="messages.php?data=message_from_admin">message_from_admin</a>, 
                </p>
            </h3>

            <?php
            $get = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['data'])), ENT_QUOTES));

            // Tabela: mensagens_emergency
            if ($get === "mensagens_emergency") {
                mysql_query("START TRANSACTION");
                $select = "SELECT * FROM mensagens_emergency";
                $q = mysql_query($select);
                if (($q)) {
                    echo("<table class=\"table\">
                <caption><h3>Tabela: mensagens_emergency</h3></caption>
                <thead>
                    <tr>
                        <td>
                            Id da Mensagem
                        </td>
                        <td>
                            De:
                        </td>
                        <td>
                            Mensagem:
                        </td>
                        <td>
							Data
                        </td>
                        <td>
                            Apagar?
                        </td>
                        </tr>
                </thead>");
                    while ($row = mysql_fetch_array($q)) {
                        $id = $row['id'];
                        $users_id = $row['users_id'];
                        $mensagem = $row['mensagem'];
                        $data = $row['data'];
                        echo("<tbody>
                    <tr>
                        <td>
                            $id
                        </td>
                        <td>
                            <a href=\"operations.php?data=users\">$users_id</a>
                        </td>
                        <td>
                            $mensagem
                        </td>
                        <td>
							$data
                        </td>
                        <td>
                        <a onclick=\"return confirm('Confirma que vai apagar o registo ?')\"
                                href=\"del.php?table=mensagens_emergency&id=$id\">Apagar?</a></td>
                        </tr>");
                    }
                    echo ("</table>");
                } else {
                    echo ("A tabela não tem registos");
                }
                mysql_query("COMMIT");
                mysql_free_result($q);
                mysql_close();
            }

            // Tabela: mensagens_from_admin
            if ($get === "message_from_admin") {
                mysql_query("START TRANSACTION");
                $sel = "SELECT * FROM message_from_admin";
                $qw = mysql_query($sel);
                if (($qw)) {
                    echo("<table class=\"table\">
                <caption><h3>Tabela: message_from_admin</h3></caption>
                <thead>
                    <tr>
                        <td>
                            Id da Mensagem
                        </td>
                        <td>
                            De:
                        </td>
                        <td>
                            Para:
                        </td>
                        <td>
                            Mensagem
                        </td>
                        <td>
							Data
                        </td>
                        <td>
                            Apagar?
                        </td>
                        </tr>
                </thead>");
                    while ($ro = mysql_fetch_array($qw)) {
                        $id = $ro['id'];
                        $for = $ro['for_user'];
                        $mensagem = $ro['mensagem'];
                        $da = $ro['data'];
                        echo("<tbody>
                    <tr>
                        <td>
                            $id
                        </td>
                        <td>
                            Admin
                        </td>
                        <td>
							<a href=\"operations.php?data=users\">$for</a>
                        </td>
                        <td>
                            $mensagem
                        </td>
                        <td>
							$da
                        </td>
                        <td>
                        <a onclick=\"return confirm('Confirma que vai apagar o registo ?')\"
                                href=\"del.php?table=mensagens_from_admin&id=$id\">Apagar?</a></td>
                        </tr>");
                    }
                    echo ("</table>");
                } else {
                    echo ("A tabela não tem registos");
                }
                mysql_query("COMMIT");
                mysql_free_result($qw);
                mysql_close();
            }
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
