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
        <meta http-equiv="refresh" content="150"/>

        <!-- Le styles -->
        <link href="resources/css/bootstrap.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
            
            span2-right {
                float: right;
                min-height: 1px;
                margin-left: 30px;
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
    <div id="fb-root"></div>
	<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_PT/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

        <?php include ("hf/header.php"); ?>
		
		<?php
				require("pub.php");
		?>
		<hr>
        <div class="container">

            <div class="row">
                <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="span3 bs-docs-sidebar">
                        <ul class="nav nav-list bs-docs-sidenav affix-top">
                            <?php //<li class=\"active\"><a href=\"annou.php?search=Novidades\"><i class=\"icon-chevron-right\"></i> Novidades</a></li>  ?>
                            <li><a href="annou.php?search=DM01"><i class="icon-chevron-right"></i> <?php echo LABEL_DM01; ?></a></li>
                            <li><a href="annou.php?search=DPR02"><i class="icon-chevron-right"></i> <?php echo LABEL_DPR02; ?></a></li>
                            <li><a href="annou.php?search=DRUSBPS203"><i class="icon-chevron-right"></i> <?php echo LABEL_DRUSBPS203; ?></a></li>
                            <li><a href="annou.php?search=DTUSBPS204"><i class="icon-chevron-right"></i> <?php echo LABEL_DTUSBPS204; ?></a></li>
                            <li><a href="annou.php?search=DTR05"><i class="icon-chevron-right"></i> <?php echo LABEL_DTR05; ?></a></li>
                            <li><a href="annou.php?search=DDOSSD06"><i class="icon-chevron-right"></i> <?php echo LABEL_DDOSSD06; ?></a></li>
                            <li><a href="annou.php?search=DDCDDVD07"><i class="icon-chevron-right"></i> <?php echo LABEL_DDCDDVD07; ?></a></li>
                            <li><a href="annou.php?search=DCLBUSBarramentoSATA08"><i class="icon-chevron-right"></i> <?php echo LABEL_DCLBUSBARRAMENTOSATA08; ?></a></li>
                            <li><a href="annou.php?search=DFA09"><i class="icon-chevron-right"></i> <?php echo LABEL_DFA09; ?></a></li>
                            <li><a href="annou.php?search=DRAM010"><i class="icon-chevron-right"></i> <?php echo LABEL_DRAM010; ?></a></li>
                            <li><a href="annou.php?search=DP011"><i class="icon-chevron-right"></i> <?php echo LABEL_DP011; ?></a></li>
                            <li><a href="annou.php?search=DV012"><i class="icon-chevron-right"></i> <?php echo LABEL_DV012; ?></a></li>
                            <li><a href="annou.php?search=DC013"><i class="icon-chevron-right"></i> <?php echo LABEL_DC013; ?></a></li>
                            <li><a href="annou.php?search=DBIOS014"><i class="icon-chevron-right"></i> <?php echo LABEL_DBIOS014; ?></a></li>
                            <li><a href="annou.php?search=DPG015"><i class="icon-chevron-right"></i> <?php echo LABEL_DPG015; ?></a></li>
                            <li><a href="annou.php?search=LE016"><i class="icon-chevron-right"></i> <?php echo LABEL_LE016; ?></a></li>
                            <li><a href="annou.php?search=LT017"><i class="icon-chevron-right"></i> <?php echo LABEL_LT017; ?></a></li>
                            <li><a href="annou.php?search=LDOSSD018"><i class="icon-chevron-right"></i> <?php echo LABEL_LDOSSD018; ?></a></li>
                            <li><a href="annou.php?search=LDDVD019"><i class="icon-chevron-right"></i> <?php echo LABEL_LDDVD019; ?></a></li>
                            <li><a href="annou.php?search=LRAM020"><i class="icon-chevron-right"></i> <?php echo LABEL_LRAM020; ?></a></li>
                            <li><a href="annou.php?search=LP021"><i class="icon-chevron-right"></i> <?php echo LABEL_LP021; ?></a></li>
                            <li><a href="annou.php?search=LV022"><i class="icon-chevron-right"></i> <?php echo LABEL_LV022; ?></a></li>
                            <li><a href="annou.php?search=LM023"><i class="icon-chevron-right"></i> <?php echo LABEL_LM023; ?></a></li>
                            <li><a href="annou.php?search=LC024"><i class="icon-chevron-right"></i> <?php echo LABEL_LC024; ?></a></li>
                            <li><a href="annou.php?search=NE025"><i class="icon-chevron-right"></i> <?php echo LABEL_NE025; ?></a></li>
                            <li><a href="annou.php?search=NT026"><i class="icon-chevron-right"></i> <?php echo LABEL_NT026; ?></a></li>
                            <li><a href="annou.php?search=NDOSSD027"><i class="icon-chevron-right"></i> <?php echo LABEL_NDOSSD027; ?></a></li>
                            <li><a href="annou.php?search=NRAM028"><i class="icon-chevron-right"></i> <?php echo LABEL_NRAM028; ?></a></li>
                            <li><a href="annou.php?search=NP029"><i class="icon-chevron-right"></i> <?php echo LABEL_NP029; ?></a></li>
                            <li><a href="annou.php?search=NV030"><i class="icon-chevron-right"></i> <?php echo LABEL_NV030; ?></a></li>
                            <li><a href="annou.php?search=NDP031"><i class="icon-chevron-right"></i> <?php echo LABEL_NDP031; ?></a></li>
                            <li><a href="annou.php?search=NM032"><i class="icon-chevron-right"></i> <?php echo LABEL_NM032; ?></a></li>
                            <li><a href="annou.php?search=NC033"><i class="icon-chevron-right"></i> <?php echo LABEL_NC033; ?></a></li>
                            <li><a href="annou.php?search=PIM034"><i class="icon-chevron-right"></i> <?php echo LABEL_PIM034; ?></a></li>
                            <li><a href="annou.php?search=PII035"><i class="icon-chevron-right"></i> <?php echo LABEL_PII035; ?></a></li>
                            <li><a href="annou.php?search=PICPB036"><i class="icon-chevron-right"></i> <?php echo LABEL_PICPB036; ?></a></li>
                            <li><a href="annou.php?search=PICS037"><i class="icon-chevron-right"></i> <?php echo LABEL_PICS037; ?></a></li>
                            <li><a href="annou.php?search=TT038"><i class="icon-chevron-right"></i> <?php echo LABEL_TT038; ?></a></li>
                            <li><a href="annou.php?search=TE039"><i class="icon-chevron-right"></i> <?php echo LABEL_TE039; ?></a></li>
                            <li><a href="annou.php?search=TC040"><i class="icon-chevron-right"></i> <?php echo LABEL_TC040; ?></a></li>
                            <li><a href="annou.php?search=TB041"><i class="icon-chevron-right"></i> <?php echo LABEL_TB041; ?></a></li>
                            <li><a href="annou.php?search=TCT042"><i class="icon-chevron-right"></i> <?php echo LABEL_TCT042; ?></a></li>
                            <li><a href="annou.php?search=SAndroidM043"><i class="icon-chevron-right"></i> <?php echo LABEL_SANDROIDM043; ?></a></li>
                            <li><a href="annou.php?search=SAndroidE044"><i class="icon-chevron-right"></i> <?php echo LABEL_SANDROIDE044; ?></a></li>
                            <li><a href="annou.php?search=SAndroidB045"><i class="icon-chevron-right"></i> <?php echo LABEL_SANDROIDB045; ?></a></li>
                            <li><a href="annou.php?search=SAndroidC046"><i class="icon-chevron-right"></i> <?php echo LABEL_SANDROIDC046; ?></a></li>
                            <li><a href="annou.php?search=SAndroidCam047"><i class="icon-chevron-right"></i> <?php echo LABEL_SANDROIDCAM047; ?></a></li>
                            <li><a href="annou.php?search=SAndroidBat048"><i class="icon-chevron-right"></i> <?php echo LABEL_SANDROIDBAT048; ?></a></li>
                            <li><a href="annou.php?search=SAndroidCS049"><i class="icon-chevron-right"></i> <?php echo LABEL_SANDROIDCS049; ?></a></li>
                            <li><a href="annou.php?search=SAndroidROM050"><i class="icon-chevron-right"></i> <?php echo LABEL_SANDROIDROM050; ?></a></li>
                            <li><a href="annou.php?search=SAppleM051"><i class="icon-chevron-right"></i> <?php echo LABEL_SAPPLEM051; ?></a></li>
                            <li><a href="annou.php?search=SAppleE052"><i class="icon-chevron-right"></i> <?php echo LABEL_SAPPLEE052; ?></a></li>
                            <li><a href="annou.php?search=SAppleB053"><i class="icon-chevron-right"></i> <?php echo LABEL_SAPPLEB053; ?></a></li>
                            <li><a href="annou.php?search=SAppleC054"><i class="icon-chevron-right"></i> <?php echo LABEL_SAPPLEC054; ?></a></li>
                            <li><a href="annou.php?search=SAppleCam055"><i class="icon-chevron-right"></i> <?php echo LABEL_SAPPLECAM055; ?></a></li>
                            <li><a href="annou.php?search=SAppleB056"><i class="icon-chevron-right"></i> <?php echo LABEL_SAPPLEB056; ?></a></li>
                            <li><a href="annou.php?search=SAppleCS057"><i class="icon-chevron-right"></i> <?php echo LABEL_SAPPLECS057; ?></a></li>
                            <li><a href="annou.php?search=SAppleROM058"><i class="icon-chevron-right"></i> <?php echo LABEL_SAPPLEROM058; ?></a></li>
                            <li><a href="annou.php?search=SWindowsPhoneM059"><i class="icon-chevron-right"></i> <?php echo LABEL_SWINDOWSPHONEM059; ?></a></li>
                            <li><a href="annou.php?search=SWindowsPhoneE060"><i class="icon-chevron-right"></i> <?php echo LABEL_SWINDOWSPHONEE060; ?></a></li>
                            <li><a href="annou.php?search=SWindowsPhoneB061"><i class="icon-chevron-right"></i> <?php echo LABEL_SWINDOWSPHONEB061; ?></a></li>
                            <li><a href="annou.php?search=SWindowsPhoneC062"><i class="icon-chevron-right"></i> <?php echo LABEL_SWINDOWSPHONEC062; ?></a></li>
                            <li><a href="annou.php?search=SWindowsPhoneCam063"><i class="icon-chevron-right"></i> <?php echo LABEL_SWINDOWSPHONECAM063; ?></a></li>
                            <li><a href="annou.php?search=SWindowsPhoneB064"><i class="icon-chevron-right"></i> <?php echo LABEL_SWINDOWSPHONEB064; ?></a></li>
                            <li><a href="annou.php?search=SWindowsPhoneCS065"><i class="icon-chevron-right"></i> <?php echo LABEL_SWINDOWSPHONECS065; ?></a></li>
                            <li><a href="annou.php?search=SWindowsPhoneROM066"><i class="icon-chevron-right"></i> <?php echo LABEL_SWINDOWSPHONEROM066; ?></a></li>
                            <li><a href="annou.php?search=TAndroidM067"><i class="icon-chevron-right"></i> <?php echo LABEL_TANDROIDM067; ?></a></li>
                            <li><a href="annou.php?search=TAndroidE068"><i class="icon-chevron-right"></i> <?php echo LABEL_TANDROIDE068; ?></a></li>
                            <li><a href="annou.php?search=TAndroidB069"><i class="icon-chevron-right"></i> <?php echo LABEL_TANDROIDB069; ?></a></li>
                            <li><a href="annou.php?search=TAndroidC070"><i class="icon-chevron-right"></i> <?php echo LABEL_TANDROIDC070; ?></a></li>
                            <li><a href="annou.php?search=TAndroidCam071"><i class="icon-chevron-right"></i> <?php echo LABEL_TANDROIDCAM071; ?></a></li>
                            <li><a href="annou.php?search=TAndroidB072"><i class="icon-chevron-right"></i> <?php echo LABEL_TANDROIDB072; ?></a></li>
                            <li><a href="annou.php?search=TAndroidCT073"><i class="icon-chevron-right"></i> <?php echo LABEL_TANDROIDCT073; ?></a></li>
                            <li><a href="annou.php?search=TAndroidROM074"><i class="icon-chevron-right"></i> <?php echo LABEL_TANDROIDROM074; ?></a></li>
                            <li><a href="annou.php?search=TAppleM075"><i class="icon-chevron-right"></i> <?php echo LABEL_TAPPLEM075; ?></a></li>
                            <li><a href="annou.php?search=TAppleE076"><i class="icon-chevron-right"></i> <?php echo LABEL_TAPPLEE076; ?></a></li>
                            <li><a href="annou.php?search=TAppleB077"><i class="icon-chevron-right"></i> <?php echo LABEL_TAPPLEB077; ?></a></li>
                            <li><a href="annou.php?search=TAppleC078"><i class="icon-chevron-right"></i> <?php echo LABEL_TAPPLEC078; ?></a></li>
                            <li><a href="annou.php?search=TAppleCam079"><i class="icon-chevron-right"></i> <?php echo LABEL_TAPPLECAM079; ?></a></li>
                            <li><a href="annou.php?search=TAppleB080"><i class="icon-chevron-right"></i> <?php echo LABEL_TAPPLEB080; ?></a></li>
                            <li><a href="annou.php?search=TAppleCT081"><i class="icon-chevron-right"></i> <?php echo LABEL_TAPPLECT081; ?></a></li>
                            <li><a href="annou.php?search=TAppleROM082"><i class="icon-chevron-right"></i> <?php echo LABEL_TAPPLEROM082; ?></a></li>
                            <li><a href="annou.php?search=TWindowsPhoneM083"><i class="icon-chevron-right"></i> <?php echo LABEL_TWINDOWSPHONEM083; ?></a></li>
                            <li><a href="annou.php?search=TWindowsPhoneE084"><i class="icon-chevron-right"></i> <?php echo LABEL_TWINDOWSPHONEE084; ?></a></li>
                            <li><a href="annou.php?search=TWindowsPhoneB085"><i class="icon-chevron-right"></i> <?php echo LABEL_TWINDOWSPHONEB085; ?></a></li>
                            <li><a href="annou.php?search=TWindowsPhoneC086"><i class="icon-chevron-right"></i> <?php echo LABEL_TWINDOWSPHONEC086; ?></a></li>
                            <li><a href="annou.php?search=TWindowsPhoneCam087"><i class="icon-chevron-right"></i> <?php echo LABEL_TWINDOWSPHONECAM087; ?></a></li>
                            <li><a href="annou.php?search=TWindowsPhoneB088"><i class="icon-chevron-right"></i> <?php echo LABEL_TWINDOWSPHONEB088; ?></a></li>
                            <li><a href="annou.php?search=TWindowsPhoneCT089"><i class="icon-chevron-right"></i> <?php echo LABEL_TWINDOWSPHONECT089; ?></a></li>
                            <li><a href="annou.php?search=TWindowsPhoneROM090"><i class="icon-chevron-right"></i> <?php echo LABEL_TWINDOWSPHONEROM090; ?></a></li>
                            <li><a href="annou.php?search=RRouter091"><i class="icon-chevron-right"></i> <?php echo LABEL_RROUTER091; ?></a></li>
                            <li><a href="annou.php?search=RSwitch092"><i class="icon-chevron-right"></i> <?php echo LABEL_RSWITCH092; ?></a></li>
                            <li><a href="annou.php?search=RaspberryPi93"><i class="icon-chevron-right"></i> <?php echo ("Raspberry Pi"); ?></a></li>
                        </ul>
                    </div>

                    <div class="span9">
                        <?php
							/*
									$_GET variable $id_anun is equal to variable from database $id_anun 
								because of the network social plugins
							*/
							$searchme = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['search'])), ENT_QUOTES));
							$id_anun = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['anuncio'])), ENT_QUOTES));
                        ?>
                        <section id="<?php echo search($searchme); ?>">
                            <div class="page-header">
                                <h1><?php echo search($searchme); ?></h1>
                            </div>
                            <div class="row-fluid">
                                <div class="container-fluid">
									<?php
									if (isset($_GET)) {
										$v = "N";
										mysql_query("START TRANSACTION");
										if (isset($_GET['anuncio'])){
											$select = "SELECT * FROM anuncios WHERE peca='$searchme' AND id='$id_anun' AND vendido='$v'";
										}else{
											$select = "SELECT * FROM anuncios WHERE peca='$searchme' AND vendido='$v'";
										}
										$q = mysql_query($select);
										if (($q)) {
											while ($row = mysql_fetch_array($q)) {
                                                $id_anun = $row['id'];
                                                $id = $row['id_user'];
                                                $image = $row['imagem_nome'];
                                                $nome = $row['nome'];
                                                $estado = $row['estado'];
                                                $preco = $row['preco'];
                                                $descricao = $row['descricao'];
                                                $da = $row['data'];
                                                // to know the name of the user
                                                $sq = "SELECT * FROM users WHERE id='$id'";
                                                $s = mysql_query($sq);
                                                if (($s)) {
                                                    $ro = mysql_fetch_array($s);
                                                }
                                                echo ("<ul class=\"thumbnails\">
                                                <li class=\"span4\">
                                                <div class=\"thumbnail\">
                                                <img src=\"pick.php?id=$image\" alt=\"\">
                                                    <div class=\"caption\">
                                                    <p>" . LABEL_ANNOU_TEXT13 . " #$id_anun</p>
                                                    <h4>" . LABEL_ANNOU_TEXT1 . " $nome</h4>
                                                    <p>" . LABEL_ANNOU_TEXT2 . " $estado</p>
                                                    <p>" . LABEL_ANNOU_TEXT3 . " $preco</p>
                                                    <p>" . LABEL_ANNOU_TEXT4 . " $descricao</p>
                                                    <p>" . LABEL_ANNOU_TEXT5 . " $da</p>
                                                    <p>" . LABEL_ANNOU_TEXT6 . " ");
                                                if ($_SESSION['id'] == $id) {
                                                    echo("<a href=\"user.php?see=information\">" . LABEL_ANNOU_TEXT7 . "</a>");
                                                } else {
                                                    $no = $ro['primeiro_nome'] . " " . $ro['ultimo_nome'];
                                                    echo($no);
                                                }
                                                echo("</p>");
                                                if ($_SESSION['id'] != $id) {
													// facebook e google+ - endereço http://www.youxuse.com/annou.php?search=$searchme&anuncio=$idanun
													// facebook - tag like and share
													// google+ - tag share button
													echo("<p><a href=\"contactar.php?aka=$id_anun&inner=$id&most=" . $ro['primeiro_nome'] . " " . $ro['ultimo_nome'] . "\" class=\"btn btn-info\">" . LABEL_ANNOU_TEXT8 . " $no</a><br><br>
															<iframe src=\"//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fyouxuse.com%2Fannou.php%3Fsearch%3D$searchme%26anuncio%3D$id_anun&amp;width&amp;layout=button_count&amp;action=recommend&amp;show_faces=false&amp;share=true&amp;height=21\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; overflow:hidden; height:21px;\" allowTransparency=\"true\"></iframe>
															<div class=\"g-plusone\" data-href=\"http://youxuse.com/annou.php?search=$searchme&anuncio=$id_anun\"></div>
															<script type=\"text/javascript\">
																(function() {
																	var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
																	po.src = 'https://apis.google.com/js/platform.js';
																	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
																})();
															</script>");
									//if (!isset($_COOKIE['active']) == $id){
									//	echo("");
									//}else{
									//	echo("<img src=\"resources/img/green.png\" alt=\"\">");
									//}
                                                    echo("</p></div>
                                                        </div>
                                                        </li>");
                                                } else {
                                                    echo("<p><a href=\"user.php?user=anuncios\" class=\"btn btn-info\">" . LABEL_ANNOU_TEXT9 . "</a></p>
                                                    <iframe src=\"//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fyouxuse.com%2Fannou.php%3Fsearch%3D$searchme%26anuncio%3D$id_anun&amp;width&amp;layout=button_count&amp;action=recommend&amp;show_faces=false&amp;share=true&amp;height=21\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; overflow:hidden; height:21px;\" allowTransparency=\"true\"></iframe>
															<div class=\"g-plusone\" data-href=\"http://youxuse.com/annou.php?search=$searchme&anuncio=$id_anun\"></div>
															<script type=\"text/javascript\">
																(function() {
																	var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
																	po.src = 'https://apis.google.com/js/platform.js';
																	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
																})();
															</script>
															</div>
															</div>
															</li>");
                                                }
                                            }
                                            if (empty($image) and empty($nome) and empty($estado) and empty($preco) and empty($descricao) and empty($da)) {
                                                echo ("<p class=\"lead\">" . LABEL_ANNOU_TEXT10 . " 
                                                    <a href=\"user.php?user=criaranuncio\">" . LABEL_ANNOU_TEXT11 . "</a> " . LABEL_ANNOU_TEXT12 . "</p>");
                                            }
                                        }
                                        echo ("</ul>");
                                        mysql_query("COMMIT");
                                        mysql_free_result($q);
                                        mysql_free_result($s);
                                        mysql_close();
                                    }
                                    ?>
                                </div>
                            </div>
                        </section>
                    </div>
                </form>
            </div>
        
		<?php
			require("pub.php");
		?>  
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
