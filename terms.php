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
	if (!isset($_COOKIE['lang'])){
		require ("lang/uk.php");
	} else {
		//idiom_geoip();
		idiom_without_session($_COOKIE['lang']);
	}
} else {
	$la = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['lang'])), ENT_QUOTES));
	idiom_without_session($la);
	setcookie("lang", $la, time()+3600, "youxuse.com");
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

            <h3><?php echo LABEL_TERMS_TEXT1; ?><br></h3>
            <p class="lead">
                <?php echo LABEL_TERMS_TEXT2; ?><br><br>

                <?php echo LABEL_TERMS_TEXT3; ?><br><br>

                <?php echo LABEL_TERMS_TEXT4; ?><br><br>

                <?php echo LABEL_TERMS_TEXT5; ?><br><br>

                <strong><?php echo LABEL_TERMS_TEXT6; ?></strong><br><br>

                <?php echo LABEL_TERMS_TEXT7; ?><br><br>
                <?php echo LABEL_TERMS_TEXT8; ?><br><br>

                <strong><?php echo LABEL_TERMS_TEXT9; ?></strong><br><br>

                <?php echo LABEL_TERMS_TEXT10; ?>
            <ol>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT11; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT12; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT13; ?>
                    </p>
                </li>
            </ol>
            <br>
            <p class="lead"><strong><?php echo LABEL_TERMS_TEXT14; ?></strong></p>

            <p class="lead"><?php echo LABEL_TERMS_TEXT15; ?></p>
            <ol>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT16; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT17; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT18; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT19; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT20; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT21; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT22; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT23; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT24; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT25; ?>
                    </p>
                </li>
            </ol>
            <br>
            
            <div>
			<?php 
				require("pub.php");
			?>
		</div>
			
		<hr>
        
        <br>
        
            <p class="lead"><strong><?php echo LABEL_TERMS_TEXT26; ?></strong></p>

            <p class="lead"><?php echo LABEL_TERMS_TEXT27; ?></p>
            <ol>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT28; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT29; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT30; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT31; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT32; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT33; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT34; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT35; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT36; ?>
                    </p>
                </li>
            </ol>
            <br>
            <p class="lead"><strong><?php echo LABEL_TERMS_TEXT37; ?></strong></p>

            <p class="lead"><?php echo LABEL_TERMS_TEXT38; ?></p>
            <ol>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT39; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT40; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT41; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT42; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT43; ?>
                    </p>
                </li>
                <li>
                    <p class="lead">
                        <?php echo LABEL_TERMS_TEXT44; ?>
                    </p>
                </li>
            </ol>
            <br>
            <p class="lead"><strong><?php echo LABEL_TERMS_TEXT45; ?></strong></p>

            <p class="lead"><?php echo LABEL_TERMS_TEXT46; ?>
            </p>
            <p class="lead"><strong><?php echo LABEL_TERMS_TEXT47; ?></strong></p>
            <p class="lead"><?php echo LABEL_TERMS_TEXT48; ?></p>
            <br> 
            <p class="lead"><strong><?php echo LABEL_TERMS_TEXT49; ?></strong></p>
            <p class="lead"><?php echo LABEL_TERMS_TEXT50; ?><br> 
                <?php echo LABEL_TERMS_TEXT51; ?><br>
                <?php echo LABEL_TERMS_TEXT52; ?><br>
                <?php echo LABEL_TERMS_TEXT53; ?></p>
            <p class="lead">
                <br><?php echo LABEL_TERMS_TEXT54; ?>
                <br><br><?php echo LABEL_TERMS_TEXT55; ?> 
                <br><br><?php echo LABEL_TERMS_TEXT56; ?> 
                <br><br><?php echo LABEL_TERMS_TEXT57; ?>
            </p>
            
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
