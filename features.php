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

            /* MARKETING CONTENT
            -------------------------------------------------- */

            /* Center align the text within the three columns below the carousel */
            .marketing .span4 {
                text-align: center;
            }
            .marketing h2 {
                font-weight: normal;
            }
            .marketing .span4 p {
                margin-left: 10px;
                margin-right: 10px;
            }


            /* Featurettes
            ------------------------- */

            .featurette-divider {
                margin: 80px 0; /* Space out the Bootstrap <hr> more */
            }
            .featurette {
                padding-top: 120px; /* Vertically center images part 1: add padding above and below text. */
                overflow: hidden; /* Vertically center images part 2: clear their floats. */
            }
            .featurette-image {
                margin-top: -120px; /* Vertically center images part 3: negative margin up the image the same amount of the padding to center it. */
            }

            /* Give some space on the sides of the floated elements so text doesn't run right into it. */
            .featurette-image.pull-left {
                margin-right: 40px;
            }
            .featurette-image.pull-right {
                margin-left: 40px;
            }

            /* Thin out the marketing headings */
            .featurette-heading {
                font-size: 50px;
                font-weight: 300;
                line-height: 1;
                letter-spacing: -1px;
            }



            /* RESPONSIVE CSS
            -------------------------------------------------- */

            @media (max-width: 979px) {

                .container.navbar-wrapper {
                    margin-bottom: 0;
                    width: auto;
                }
                .navbar-inner {
                    border-radius: 0;
                    margin: -20px 0;
                }

                .featurette {
                    height: auto;
                    padding: 0;
                }
                .featurette-image.pull-left,
                .featurette-image.pull-right {
                    display: block;
                    float: none;
                    max-width: 40%;
                    margin: 0 auto 20px;
                }
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
            <div class="featurette" id="facil">
                <img class="featurette-image pull-right" src="resources/img/img_caroussel/a.jpg">
                <h2 class="featurette-heading"><?php echo LABEL_FEATURES_TEXT1; ?> <span class="muted"><?php echo LABEL_FEATURES_TEXT2; ?></span></h2>
                <p class="lead"><?php echo LABEL_FEATURES_TEXT3; ?></p>
            </div>

            <hr class="featurette-divider">

            <div class="featurette" id="rapido">
                <img class="featurette-image pull-left" src="resources/img/img_caroussel/b.jpg">
                <h2 class="featurette-heading"><?php echo LABEL_FEATURES_TEXT4; ?> <span class="muted"><?php echo LABEL_FEATURES_TEXT5; ?></span></h2>
                <p class="lead"><?php echo LABEL_FEATURES_TEXT6; ?></p>
            </div>

            <hr class="featurette-divider">

            <div class="featurette" id="dinheiro">
                <img class="featurette-image pull-right" src="resources/img/img_caroussel/c.jpg">
                <h2 class="featurette-heading"><?php echo LABEL_FEATURES_TEXT7; ?><span class="muted"><?php echo LABEL_FEATURES_TEXT8; ?></span></h2>
                <p class="lead"><?php echo LABEL_FEATURES_TEXT9; ?> <a href="http://localhost/wikiannou.php?search=DM01"><?php echo LABEL_FEATURES_TEXT10; ?></a> 
                    <?php echo LABEL_FEATURES_TEXT11; ?></p>
            </div>
            
			<div>
			<?php 
				require("pub.php");
			?>
			</div>
			
            <hr class="featurette-divider">

            <div class="featurette" id="lucro">
                <img class="featurette-image pull-left" src="resources/img/img_caroussel/d.jpg">
                <h2 class="featurette-heading"><?php echo LABEL_FEATURES_TEXT12; ?> <span class="muted"><?php echo LABEL_FEATURES_TEXT13; ?></span></h2>
                <p class="lead"><?php echo LABEL_FEATURES_TEXT14; ?> <a href="youxuse.php">Filipe Marques</a><?php echo LABEL_FEATURES_TEXT15; ?></p>
            </div>

            <hr class="featurette-divider">

            <div class="featurette" id="opensource">
                <img class="featurette-image pull-right" src="resources/img/img_caroussel/e.jpg">
                <h2 class="featurette-heading"><?php echo LABEL_FEATURES_TEXT16; ?> <span class="muted"><?php echo LABEL_FEATURES_TEXT17; ?></span></h2>
                <p class="lead"><?php echo LABEL_FEATURES_TEXT18; ?> <a href="license.php">GNU AGPL v.3</a>. 
                    <?php echo LABEL_FEATURES_TEXT19; ?> 
                    <?php echo LABEL_FEATURES_TEXT20; ?>
                </p>
            </div>

            <hr class="featurette-divider">

            <div class="featurette" id="voluntario">
                <img class="featurette-image pull-left" src="resources/img/img_caroussel/f.jpg">
                <h2 class="featurette-heading"><?php echo LABEL_FEATURES_TEXT21; ?> <span class="muted"><?php echo LABEL_FEATURES_TEXT22; ?></span></h2>
                <p class="lead"><?php echo LABEL_FEATURES_TEXT23; ?></p>
            </div>
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
