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
require_once ("process/functions.php");
require_once ("store.php");

$db = new mysqli("localhost", "root", "ff", "store");
if ($db->connect_error){
	die("Erro em aceder a base de dados !");
	//echo "Erro em aceder a base de dados (" . $db->connect_errno . ")" . $db->connect_error;
}

// check if it has session created, if yes search for the strings of country, if no do nothing
if (session_start()){
	check_session_idiom();
}

nothing();
is_admin();
generate_new_session_id();

/*if (isset($_POST['submit'])){
	setcookie("buy", "vicky", time()+3600, "youxuse.com/apps.php");
}*/

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
            
            <p class="lead"><?php echo LABEL_APPS_TEXT1; ?></p>
            
			<table class="table">
				<caption><h3><?php echo LABEL_APPS_TEXT2; ?></h3></caption>
				<tbody>
					<tr>
						<td>
							<?php echo LABEL_APPS_TEXT3; ?>
						</td>
						<td>
							<?php echo LABEL_APPS_TEXT4; ?>
						</td>
						<td>
							<?php echo LABEL_APPS_TEXT5; ?>
						</td>
						<td>
							<?php echo LABEL_APPS_TEXT6; ?>
						</td>
						<td>
							<?php echo LABEL_APPS_TEXT7; ?>
						</td>
						<td>
							<?php echo LABEL_APPS_TEXT8; ?>
						</td>
						<td>
							
						</td>
					</tr>
					<?php
						// selecting data in database table
						if (($result = $db->query("SELECT * FROM programs"))){
								while($row = $result->fetch_object()){
									echo ("<tr>
												<td>
													" . $row->name . "
												</td>
												<td>
													" . $row->features . "
												</td>
												<td>
													" . $row->consolegui . "
												</td>
												<td>");
													if (!empty($row->name_package_x86)){
														echo("<a href=\"download/" . $row->name_package_x86 . "\">" . $row->arch . "</a>");
													}
													if (!empty($row->name_package_x64)){
														echo("<a href=\"download/" . $row->name_package_x64 . "\">" . $row->arch . "</a>");
													}
											echo("</td>
												<td>
													" . $row->version . "
												</td>
												<td>
													" . $row->operatingsys . "
												</td>
												<td>
													<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"POST\" target=\"_top\">
														<input type=\"hidden\" name=\"cmd\" value=\"_s-xclick\">
														<input type=\"hidden\" name=\"hosted_button_id\" value=\"" . $id_of_button . "\">
														<input type=\"hidden\" name=\"item_number\" id=\"paypalno\" value=\"001\">
														<input type=\"hidden\" name=\"item_name\" id=\"itemname\" value=\"Vicky\">
														<input type=\"hidden\" name=\"email\" id=\"email\" value=\"" . $_SESSION['email'] . "\">
														<input type=\"image\" src=\"https://www.paypalobjects.com/webstatic/en_US/btn/btn_buynow_cc_171x47.png\" border=\"0\" name=\"submit\" alt=\"PayPal - The safer, easier way to pay online!\">
														<img alt=\"\" border=\"0\" src=\"https://www.paypalobjects.com/pt_PT/i/scr/pixel.gif\" width=\"1\" height=\"1\">
													</form>
												</td>
											</tr>");
								}
								$result->free();
								$result->close();
								$db->close();
						} else {
							echo 'No were found in the table!';
							$db->close();
						}
					?>
					</tbody>
				</table>
				
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
