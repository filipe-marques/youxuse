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

require_once("process/functions.php");

// check if it has session created, if yes search for the strings of country, if no do nothing
if (session_start()){
	check_session_idiom();
}

if (!isset($_GET['lang'])) {
    //require ("lang/uk.php");
    idiom_geoip();
} else {
    $la = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['lang'])), ENT_QUOTES));
    idiom_without_session($la);
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

        <div>
			<?php 
				require("pub.php");
			?>
		</div>
		
		<hr>
		
        <div class="container">
            <h3><p class="text-center"><?php echo LABEL_FAQ_TEXT1; ?></p></h3>
            <div>
                <ol>
                    <li>
                        <a href="#criarconta">
                            <?php echo LABEL_FAQ_TEXT2; ?> 
                        </a>
                    </li>
                    <li>
                        <a href="#conta-erro">
                            <?php echo LABEL_FAQ_TEXT3; ?> 
                        </a>
                    </li>
                    <li>
                        <a href="#cla">
                            <?php echo LABEL_FAQ_TEXT4; ?>
                        </a>
                    </li>
                    <li>
                        <a href="#nocla">
                            <?php echo LABEL_FAQ_TEXT5; ?>
                        </a>
                    </li>
                    <li>
                        <a href="#anuncio">
                            <?php echo LABEL_FAQ_TEXT6; ?>
                        </a>
                    </li>
                    <li>
                        <a href="#admin_message">
                            <?php echo LABEL_FAQ_TEXT7; ?>
                        </a>
                    </li>
                    <li>
                        <a href="#interess_anun">
                            <?php echo LABEL_FAQ_TEXT8; ?>
                        </a>
                    </li>
                    <li>
                        <a href="#nego_anun">
                            <?php echo LABEL_FAQ_TEXT9; ?>
                        </a>
                    </li>
                    <li>
                        <a href="#one_anuncio">
                            <?php echo LABEL_FAQ_TEXT10; ?>
                        </a>
                    </li>
                    <!--<li>
                        <a href="#">
                             
                        </a>
                    </li>-->
                </ol>
            </div>
            <dl id="criarconta">
                <dt>
                <strong>
                    <?php echo LABEL_FAQ_TEXT2; ?>
                </strong>
                </dt>
                <dd>
                    <p>
                        <br>
                        <?php echo LABEL_FAQ_TEXT11; ?>
                    </p>
                </dd>
            </dl>
            <dl id="conta-erro">
                <dt>
                <strong>
                    <?php echo LABEL_FAQ_TEXT3; ?>
                </strong>
                </dt>
                <dd>
                    <p>
                        <br>
                        <?php echo LABEL_FAQ_TEXT12; ?>
                    </p>
                </dd>
            </dl>
            <dl id="cla">
                <dt>
                <strong>
                    <?php echo LABEL_FAQ_TEXT4; ?>
                </strong>
                </dt>
                <dd>
                    <p>
                        <br>
                        <?php echo LABEL_FAQ_TEXT13; ?>
                    </p>
                </dd>
            </dl>
            <dl id="nocla">
                <dt>
                <strong>
                    <?php echo LABEL_FAQ_TEXT5; ?>
                </strong>
                </dt>
                <dd>
                    <p>
                        <br>
                        <?php echo LABEL_FAQ_TEXT14; ?>
                    </p>
                </dd>
            </dl>
            <dl id="anuncio">
                <dt>
                <strong>
                    <?php echo LABEL_FAQ_TEXT6; ?>
                </strong>
                </dt>
                <dd>
                    <p>
                        <br>
                        <?php echo LABEL_FAQ_TEXT15; ?>
                    </p>
                </dd>
            </dl>
            <dl id="admin_message">
                <dt>
                <strong>
                    <?php echo LABEL_FAQ_TEXT7; ?>
                </strong>
                </dt>
                <dd>
                    <p>
                        <br>
                        <?php echo LABEL_FAQ_TEXT16; ?> 
                    </p>
                </dd>
            </dl>
            <dl id="interess_anun">
                <dt>
                <strong>
                    <?php echo LABEL_FAQ_TEXT8; ?>
                </strong>
                </dt>
                <dd>
                    <p>
                        <br>
                        <?php echo LABEL_FAQ_TEXT17; ?>
                    </p>
                </dd>
            </dl>
            <dl id="nego_anun">
                <dt>
                <strong>
                    <?php echo LABEL_FAQ_TEXT9; ?>
                </strong>
                </dt>
                <dd>
                    <p>
                        <br>
                        <?php echo LABEL_FAQ_TEXT18; ?>
                    </p>
                </dd>
            </dl>
            <dl id="one_anuncio">
                <dt>
                <strong>
                    <?php echo LABEL_FAQ_TEXT10; ?>
                </strong>
                </dt>
                <dd>
                    <p>
                        <br>
                        <?php echo LABEL_FAQ_TEXT19; ?>
                    </p>
                </dd>
            </dl>
            
		<div>
			<?php 
				require("pub.php");
			?>
		</div>

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
