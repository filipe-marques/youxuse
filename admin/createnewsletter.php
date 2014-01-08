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
require_once ("../store.php");
require_once("connect.php");

// instantiation of the class Connection
$data_connect = new Connection_ADMIN();
// accessing the connect method
$data_connect->connect();

nothing();
is_not_admin();
generate_new_session_id();

if (isset($_POST['submitnewsletter'])) {
    mysql_query("START TRANSACTION");
    $select_email = "SELECT * FROM users";
    $qq = mysql_query($select_email);
    if (($qq)) {
        $n = 0;
        while ($ro = mysql_fetch_array($qq)) {
            $prim_nome = $ro['primeiro_nome'];
            $ulti_nome = $ro['ultimo_nome'];
            $utilizador_email = $ro['email'];
            if ($utilizador_email === $admin_email) {
                unset($utilizador_email);
            } else {
                $external_send_mail = exec("python3 $python_mail1 $utilizador_email $prim_nome $ulti_nome");
                if ($external_send_mail) {
                    echo ("<div class=\"alert alert-success\">NewsLetters enviadas com sucesso !</div>");
                } else {
                    echo ("<div class=\"alert alert-error\">Houve uma falha !</div>");
                }
            }
            $n = $n + 1;
        }
    }
    // the admin do not count
    $total = $n - 1;
    // showing the result
    echo ("Foram mandadas newsletters a " . $total . " utilizadores!");

    mysql_query("COMMIT");
    mysql_free_result($qq);
    mysql_close();
}
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
                <p class="text-center">
                    Mandar newsletter por e-mail a todos os utilizadores com as novidades e novos anúncios
                </p>
            </h3>
            <br>
            <form action="<?php $_SERVER['PHP-SELF']; ?>" method="POST">
                <p class="text-center">
                    <input class="btn btn-large btn-success" type="submit" name="submitnewsletter" value="Enviar NewsLetters">
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
