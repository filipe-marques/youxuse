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
require_once ("store.php");

// instantiation of the class Connection
$data_connect = new Connection();
// accessing the connect method
$data_connect->connect();

full();

if (!isset($_GET['lang'])) {
	//require ("lang/uk.php");
	idiom_geoip();
} else {
    $la = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['lang'])), ENT_QUOTES));
    idiom_without_session($la);
}

if (isset($_POST['submit'])) {
    $emai = mysql_real_escape_string(htmlspecialchars(trim($_POST['email']), ENT_QUOTES));
    $pasword = mysql_real_escape_string(htmlspecialchars(trim($_POST['password']), ENT_QUOTES));

    $active = 1;

    $hashpass = hash($has, $pasword);
    $hashpass2 = crypt($hashpass, $hass);

    mysql_query("START TRANSACTION");
    $sql = "SELECT * FROM users WHERE email='$emai' AND password='$hashpass2' AND active='$active' ";
    $consul = mysql_query($sql);

    if (mysql_num_rows($consul) == 1) {
        $ress = mysql_fetch_assoc($consul);
        $_SESSION['id'] = $ress['id'];
        $_SESSION['nivel'] = $ress['nivel'];
        $_SESSION['prinome'] = $ress['primeiro_nome'];
        $_SESSION['ultnome'] = $ress['ultimo_nome'];
        $_SESSION['email'] = $ress['email'];
        $_SESSION['idade'] = $ress['idade'];
        $_SESSION['sexo'] = $ress['sexo'];
        $_SESSION['registado'] = $ress['registado'];
        $_SESSION['pais'] = $ress['pais'];

        if ($_SESSION['nivel'] == $level_zone_acess) {
            mysql_query("COMMIT");
            header("Location: admin/admin.php");
            exit();
        } elseif ($_SESSION['nivel'] == $level_zon_acess) {
            $ip_adr = ip_adress();
            $use_date = date('Y-m-d');
            $sql = "INSERT INTO ip_adress (users_id, ip_adress, data) VALUES ('" . $_SESSION['id'] . "','$ip_adr','$use_date')";
            $consulta = mysql_query($sql);
            mysql_query("COMMIT");
            header("Location: user.php?page=initial");
            exit();
        }
    } else {
        echo ("<div class=\"alert alert-block\">
                <h2>
                    <p class=\"text-center\">" . LABEL_SIGNIN_TEXT1 . "</p>
                    <p class=\"text-center\">" . LABEL_SIGNIN_TEXT2 . "</p>
                    <p class=\"text-center\">" . LABEL_SIGNIN_TEXT3 . "</p>
                </h2>
            </div>
            <div class=\"alert alert-info\">
                <h2>
                    <p class=\"text-center\"><a href=\"signup.php\">" . LABEL_SIGNIN_TEXT4 . "</a>" . LABEL_SIGNIN_TEXT5 . "</p>
                    <p class=\"text-center\">" . LABEL_SIGNIN_TEXT6 . "</p>
                    <p class=\"text-center\">" . LABEL_SIGNIN_TEXT7 . "</p>
                </h2>
            </div>");
        mysql_query("ROLLBACK");
    }
    mysql_free_result($consul);
    mysql_free_result($consulta);
    mysql_close();
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

            .form-signin {
                max-width: 400px;
                padding: 19px 29px 29px;
                margin: 0 auto 20px;
                background-color: #fff;
                border: 1px solid #e5e5e5;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
            }
            .form-signin .form-signin-heading,
            .form-signin .checkbox {
                margin-bottom: 10px;
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
            <div class="container">

                <form class="form-signin" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <?php echo LABEL_SIGNIN_TEXT8; ?> <br><a href="signup.php"><?php echo LABEL_SIGNIN_TEXT9; ?></a> <?php echo LABEL_SIGNIN_TEXT10; ?>
                    <h2 class="form-signin-heading"><p class="text-center"><?php echo LABEL_SIGNIN_TEXT11; ?></p></h2>
                    <input type="email" name="email" id="email" class="input-block-level" placeholder="<?php echo LABEL_SIGNIN_TEXT13; ?>" required />
                    <input type="password" name="password" id="password" class="input-block-level" placeholder="<?php echo LABEL_SIGNIN_TEXT14; ?>" required />
                    <p class="text-center"><button class="btn btn-large btn-success" type="submit" name="submit"><?php echo LABEL_SIGNIN_TEXT12; ?> <i class="icon-user icon-white"></i></button></p>
                </form>

            </div> <!-- /container -->

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
