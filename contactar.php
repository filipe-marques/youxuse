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
require_once ("session/check_user.php");
require_once ("database/connect.php");
require_once ("process/functions.php");

// instantiation of the class Connection
$data_connect = new Connection();
// accessing the connect method
$data_connect->connect();

// check if it has session created, if yes search for the strings of country, if no do nothing
if (session_start()){
	check_session_idiom();
}

nothing();

// name of user
$nomeuser = mysql_escape_string(htmlspecialchars(trim($_GET['most']), ENT_QUOTES));

if (isset($_POST['submensa'])) {
    // id of user
    $foruser = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['inner'])), ENT_QUOTES));

    // id of annoucement
    $query = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['aka'])), ENT_QUOTES));

    // the message insert
    $mens = mysql_escape_string(htmlspecialchars(trim($_POST['mensagem']), ENT_QUOTES));

    if (strlen($mens) > 120) {
        echo ("<div class=\"alert alert-error\"><h2>" . LABEL_CONTACTAR_TEXT1 . "</h2>");
        echo ("" . LABEL_CONTACTAR_TEXT2 . " " . strlen($mens) . " " . LABEL_CONTACTAR_TEXT3 . " <br></div>");
    } else {
        // the actual date
        $data = date('Y-m-d');
        mysql_query("START TRANSACTION");
        $sql = "INSERT INTO mensagens (id_anuncios,users_id,for_user,mensagem,data) VALUES ($query,'" . $_SESSION['id'] . "','$foruser','$mens','$data')";
        $inser = mysql_query($sql);
        if (($inser)) {
            echo ("<p class=\"text-center\">" . LABEL_CONTACTAR_TEXT4 . " $nomeuser " . LABEL_CONTACTAR_TEXT5 . "</p>");
            mysql_query("COMMIT");
        }
        mysql_free_result($inser);
        mysql_close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo LABEL_PAGE_TITLE_TEXT; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="resources/css/bootstrap.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
        <link href="resources/css/bootstrap-responsive.css" rel="stylesheet" type="text/css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="../assets/js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="resources/img/youxuse-icon-144.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="resources/img/youxuse-icon-114.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="resources/img/youxuse-icon-72.png">
        <link rel="apple-touch-icon-precomposed" href="resources/img/youxuse-icon-57.png">
        <link rel="shortcut icon" href="resources/img/youxuse-icon.png">
		<?php
			require_once("analytic.php");
		?>
    </head>

    <body>          

        <?php include ("hf/header.php"); ?>

        <div class="container">
            <?php
            if (isset($nomeuser)) {
                echo ("<a class=\"btn\" href=\"annou.php?search=DM01\">" . LABEL_CONTACTAR_TEXT6 . "</a><br><br>");
            }
            ?>
            <form class="form-signin" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <?php
                if (isset($nomeuser)) {
                    echo ("<textarea name=\"mensagem\" id=\"mensagem\" tabindex=\"1\" class=\"input-block-level\" placeholder=\"" . LABEL_CONTACTAR_TEXT8 . " $nomeuser\" required></textarea>
					<p class=\"text-center\"><input class=\"btn btn-large btn-success\" type=\"submit\" name=\"submensa\" value=\"" . LABEL_CONTACTAR_TEXT9 . "\"></p>");
                }
                ?>
            </form>

            <?php include ("hf/footer.php"); ?>

        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript" src="resources/js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-transition.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-alert.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-modal.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-dropdown.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-scrollspy.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-tab.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-tooltip.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-popover.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-button.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-collapse.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-carousel.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-typeahead.js"></script>

    </body>
</html>
