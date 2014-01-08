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

// The name of the session
session_name("YouXuse");

// required files
require_once ("../session/check_user.php");
require_once("connect.php");

// instantiation of the class Connection
$data_connect = new Connection_ADMIN();
// accessing the connect method
$data_connect->connect();

// functions needed for check the session state
nothing();
is_not_admin();
generate_new_session_id();

// Security reasons
$for_user = mysql_real_escape_string(htmlspecialchars(htmlentities(trim($_GET['uh'])), ENT_QUOTES));

// checking and putting the information in the database
if (isset($_POST['submitmessage'])) {
    $message = mysql_escape_string(htmlspecialchars(trim($_POST['mensa']), ENT_QUOTES));
    if (strlen($message) > 200) {
        echo ("<div class=\"alert alert-error\"><h2>Excedeu 200 caracteres!</h2>");
        echo ("Escreves-te cerca de " . strlen($message) . " caracteres! <br>");
        echo ("<a href=\"operations.php?data=users\">Voltar á página anterior!</a></div>");
    } else {
        $da = date('Y-m-d');
        mysql_query("START TRANSACTION");
        $sql = "INSERT INTO message_from_admin (users_id,for_user,mensagem,data) VALUES ('" . $_SESSION['id'] . "','$for_user','$message','$da')";
        $inser1 = mysql_query($sql);
        if (($inser1)) {
            mysql_query("COMMIT");
            echo ("<p class=\"text-center\">Mensagem enviada com sucesso!</p>");
        }
        mysql_free_result($inser1);
        mysql_close();
    }
}

// determine the name of the user with the id
mysql_query("START TRANSACTION");
$ssql = "SELECT * FROM users WHERE id='$for_user' ";
$qer = mysql_query($ssql);
if (($qer)) {
    $row = mysql_fetch_array($qer);
    $prr_nome = $row['primeiro_nome'];
    $ull_nome = $row['ultimo_nome'];
}
mysql_query("COMMIT");
mysql_free_result($qer);
mysql_close();
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

            <?php // Send message to selected user - the message is see by the selected user in the section of message of the user interface ?>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <textarea name="mensa" id="mensa" tabindex="1" class="input-block-level" placeholder="a tua mensagem para <?php echo $prr_nome . " " . $ull_nome; ?>" required></textarea>      
                <p class="text-center">
                    <input class="btn btn-large btn-success" type="submit" name="submitmessage" value="Enviar mensagem">
                </p>
            </form>

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
