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
// DEVELOPMENT PURPOSES - DO NOT USE THIS IN PRODUCTION ENVIRONMENT
//error_reporting(E_ALL);
//ini_set('display_errors', true);
//ini_set('html_errors', false);
//--------------------------------------------------------

session_name("YouXuse");

require_once ("store.php");

require_once ("session/check_user.php");
require_once ("database/connect.php");
require_once ("process/functions.php");
require_once ("store.php");

// instantiation of the class Connection
$data_connect = new Connection();
// accessing the connect method
$data_connect->connect();

// check if it has session created, if yes search for the strings of country, if no do nothing
if (session_start()){
	check_session_idiom();
}

nothing();
is_admin();
generate_new_session_id();

//$complete_id = $_SESSION['id'];

//setcookie("active", $complete_id, time()+3600, "/");

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo (sexo() . " " . $_SESSION['prinome'] . " " . $_SESSION['ultnome']); ?> &dash; <?php echo LABEL_PAGE_TITLE_TEXT;?></title>
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
                max-width: 600px;
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
            <?php
            $query1 = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['user'])), ENT_QUOTES));
            $query2 = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['contribute'])), ENT_QUOTES));
            //$query3 = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['create'])), ENT_QUOTES));
            $query4 = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['see'])), ENT_QUOTES));
            $query5 = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['page'])), ENT_QUOTES));
            $query6 = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['wiki'])), ENT_QUOTES));
            $query7 = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['klrt'])), ENT_QUOTES));
            $query8 = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['update'])), ENT_QUOTES));

            if ($query1 === 'criaranuncio') { // $query1 == user
                if (isset($_POST['submiti'])) {
					$imagem_nome = mysql_escape_string(htmlspecialchars(trim($_FILES['imagem']['name']), ENT_QUOTES));
					$imagem_type = $_FILES['imagem']['type'];
					$imagem_size = $_FILES['imagem']['size'];
					$imagem_tmp = $_FILES['imagem']['tmp_name'];
					//$imagem_error = $_FILES['imagem']['error'];

					$nomepeca = mysql_escape_string(htmlspecialchars(trim($_POST['nomepeca']), ENT_QUOTES));
					$estado = trim($_POST['estado']);
					$preco = trim($_POST['preco']);
					$peca = trim($_POST['peca']);
					$descricao = trim($_POST['descricao']);

					$imagem_sizin = round($imagem_size / 1000);

					if (empty($imagem_nome) or empty($nomepeca) or empty($estado) or empty($preco) or empty($peca) or (strlen($descricao) > 50) or (strlen($nomepeca) > 20)) {
						echo ("<div class=\"alert alert-error\"><h2>" . LABEL_USER_TEXT1 . "</h2></div>");
						exit();
					}

					$imagem_code_name = rand() . rand() . rand() . rand() . rand() . rand() . rand() . rand() . rand();

					$final_local = $folder_image . $imagem_code_name;
					
					// check the size of the image and the extension
					if ($imagem_sizin < 350 && ($imagem_type == "image/png")) {
						mysql_query("START TRANSACTION");
						(move_uploaded_file($imagem_tmp, $final_local));
						$regis_date = date('Y-m-d');
						$sql = "INSERT INTO anuncios (id_user, imagem_nome, nome, estado, preco, peca, descricao, data, vendido) VALUES ('" . $_SESSION['id'] . "','$imagem_code_name','$nomepeca','$estado','$preco','$peca','$descricao','$regis_date','N')";
						$consul = mysql_query($sql);
						if (($consul)) {
							echo ("<div class=\"alert alert-success\"><h2><p class=\"text-center\">" . LABEL_USER_TEXT2 . "</div>");
							mysql_query("COMMIT");
						} else {
							echo ("<div class=\"alert alert-error\"><h2>" . LABEL_USER_TEXT3 . "</h2></div>");
							mysql_query("ROLLBACK");
						}
						mysql_free_result($consul);
						mysql_close();
					} else {
						echo("<div class=\"alert alert-error\"><h2>" . LABEL_USER_TEXT4 . "</h2></div>");
					}
				} else {
					echo ("<a class=\"btn\" href=\"user.php?page=initial\">" . LABEL_USER_TEXT5 . "</a>");
					echo ("<form class=\"form-signin\" action=\"user.php?user=criaranuncio\" method=\"POST\" enctype=\"multipart/form-data\">
							<h2 class=\"form-signin-heading\"><p class=\"text-center\">" . LABEL_USER_TEXT6 . "</p></h2>
							<legend>" . LABEL_USER_TEXT7 . "</legend>
							<input type=\"file\" name=\"imagem\" id=\"imagem\" class=\"input-block-level\" placeholder=\"" . LABEL_USER_TEXT8 . "\" required />
							<legend>" . LABEL_USER_TEXT9 . "</legend>
							<input type=\"text\" name=\"nomepeca\" id=\"nomepeca\" class=\"input-block-level\" placeholder=\"" . LABEL_USER_TEXT10 . "\" required />
							<legend>" . LABEL_USER_TEXT11 . "</legend>
							<select name=\"estado\" id=\"estado\" required />
								<option value=\"\">" . LABEL_USER_TEXT12 . "</option>
								<option value=\"" . LABEL_USER_TEXT13 . "\">" . LABEL_USER_TEXT13 . "</option>
								<option value=\"" . LABEL_USER_TEXT14 . "\">" . LABEL_USER_TEXT14 . "</option>
								<option value=\"" . LABEL_USER_TEXT15 . "\">" . LABEL_USER_TEXT15 . "</option>
							</select>
							<legend>" . LABEL_USER_TEXT16 . "</legend>
							<select name=\"preco\" id=\"preco\" required />
								<option value=\"\" selected>" . LABEL_USER_TEXT17 . "</option>
								<option value=\"10\">10</option>
								<option value=\"11\">11</option>
								<option value=\"12\">12</option>
								<option value=\"13\">13</option>
								<option value=\"14\">14</option>
								<option value=\"15\">15</option>
								<option value=\"16\">16</option>
								<option value=\"17\">17</option>
								<option value=\"18\">18</option>
								<option value=\"19\">19</option>
								<option value=\"20\">20</option>
								<option value=\"21\">21</option>
								<option value=\"22\">22</option>
								<option value=\"23\">23</option>
								<option value=\"24\">24</option>
								<option value=\"25\">25</option>
								<option value=\"26\">26</option>
								<option value=\"27\">27</option>
								<option value=\"28\">28</option>
								<option value=\"29\">29</option>
								<option value=\"30\">30</option>
								<option value=\"31\">31</option>
								<option value=\"32\">32</option>
								<option value=\"33\">33</option>
								<option value=\"34\">34</option>
								<option value=\"35\">35</option>
								<option value=\"36\">36</option>
								<option value=\"37\">37</option>
								<option value=\"38\">38</option>
								<option value=\"39\">39</option>
								<option value=\"40\">40</option>
								<option value=\"41\">41</option>
								<option value=\"42\">42</option>
								<option value=\"43\">43</option>
								<option value=\"44\">44</option>
								<option value=\"45\">45</option>
								<option value=\"46\">46</option>
								<option value=\"47\">47</option>
								<option value=\"48\">48</option>
								<option value=\"49\">49</option>
								<option value=\"50\">50</option>
								<option value=\"51\">51</option>
								<option value=\"52\">52</option>
								<option value=\"53\">53</option>
								<option value=\"54\">54</option>
								<option value=\"55\">55</option>
								<option value=\"56\">56</option>
								<option value=\"57\">57</option>
								<option value=\"58\">58</option>
								<option value=\"59\">59</option>
								<option value=\"60\">60</option>
								<option value=\"61\">61</option>
								<option value=\"62\">62</option>
								<option value=\"63\">63</option>                        
								<option value=\"64\">64</option>
								<option value=\"65\">65</option>
								<option value=\"66\">66</option>
								<option value=\"67\">67</option>
								<option value=\"68\">68</option>
								<option value=\"69\">69</option>
								<option value=\"70\">70</option>
								<option value=\"71\">71</option>
								<option value=\"72\">72</option>
								<option value=\"73\">73</option>
								<option value=\"74\">74</option>
								<option value=\"75\">75</option>
								<option value=\"76\">76</option>
								<option value=\"77\">77</option>
								<option value=\"78\">78</option>
								<option value=\"79\">79</option>
								<option value=\"80\">80</option>
								<option value=\"81\">81</option>
								<option value=\"82\">82</option>
								<option value=\"83\">83</option>
								<option value=\"84\">84</option>
								<option value=\"85\">85</option>
								<option value=\"86\">86</option>
								<option value=\"87\">87</option>
								<option value=\"88\">88</option>
								<option value=\"89\">89</option>
								<option value=\"90\">90</option>
								<option value=\"91\">91</option>
								<option value=\"92\">92</option>
								<option value=\"93\">93</option>
								<option value=\"94\">94</option>
								<option value=\"95\">95</option>
								<option value=\"96\">96</option>
								<option value=\"97\">97</option>
								<option value=\"98\">98</option>
								<option value=\"99\">99</option>
								<option value=\"100\">100</option>
							</select>
							<legend>" . LABEL_USER_TEXT18 . "</legend>
							<select name=\"peca\" id=\"peca\" required />
								<option value=\"\" selected>" . LABEL_USER_TEXT19 . "</option>
								<option value=\"DM01\">" . LABEL_DM01 . "</option>
								<option value=\"DPR02\">" . LABEL_DPR02 . "</option>
								<option value=\"DRUSBPS203\">" . LABEL_DRUSBPS203 . "</option>
								<option value=\"DTUSBPS204\">" . LABEL_DTUSBPS204 . "</option>
								<option value=\"DTR05\">" . LABEL_DTR05 . "</option>
								<option value=\"DDOSSD06\">" . LABEL_DDOSSD06 . "</option>
								<option value=\"DDCDDVD07\">" . LABEL_DDCDDVD07 . "</option>
								<option value=\"DCLBUSBarramentoSATA08\">" . LABEL_DCLBUSBARRAMENTOSATA08 . "</option>
								<option value=\"DFA09\">" . LABEL_DFA09 . "</option>
								<option value=\"DRAM010\">" . LABEL_DRAM010 . "</option>
								<option value=\"DP011\">" . LABEL_DP011 . "</option>
								<option value=\"DV012\">" . LABEL_DV012 . "</option>
								<option value=\"DC013\">" . LABEL_DC013 . "</option>
								<option value=\"DBIOS014\">" . LABEL_DBIOS014 . "</option>
								<option value=\"DPG015\">" . LABEL_DPG015 . "</option>
								<option value=\"LE016\">" . LABEL_LE016 . "</option>
								<option value=\"LT017\">" . LABEL_LT017 . "</option>
								<option value=\"LDOSSD018\">" . LABEL_LDOSSD018 . "</option>
								<option value=\"LDDVD019\">" . LABEL_LDDVD019 . "</option>
								<option value=\"LRAM020\">" . LABEL_LRAM020 . "</option>
								<option value=\"LP021\">" . LABEL_LP021 . "</option>
								<option value=\"LV022\">" . LABEL_LV022 . "</option>
								<option value=\"LM023\">" . LABEL_LM023 . "</option>
								<option value=\"LC024\">" . LABEL_LC024 . "</option>
								<option value=\"NE025\">" . LABEL_NE025 . "</option>
								<option value=\"NT026\">" . LABEL_NT026 . "</option>
								<option value=\"NDOSSD027\">" . LABEL_NDOSSD027 . "</option>
								<option value=\"NRAM028\">" . LABEL_NRAM028 . "</option>
								<option value=\"NP029\">" . LABEL_NP029 . "</option>
								<option value=\"NV030\">" . LABEL_NV030 . "</option>
								<option value=\"NDP031\">" . LABEL_NDP031 . "</option>
								<option value=\"NM032\">" . LABEL_NM032 . "</option>
								<option value=\"NC033\">" . LABEL_NC033 . "</option>
								<option value=\"PIM034\">" . LABEL_PIM034 . "</option>
								<option value=\"PII035\">" . LABEL_PII035 . "</option>
								<option value=\"PICPB036\">" . LABEL_PICPB036 . "</option>
								<option value=\"PICS037\">" . LABEL_PICS037 . "</option>
								<option value=\"TT038\">" . LABEL_TT038 . "</option>
								<option value=\"TE039\">" . LABEL_TE039 . "</option>
								<option value=\"TC040\">" . LABEL_TC040 . "</option>
								<option value=\"TB041\">" . LABEL_TB041 . "</option>
								<option value=\"TCT042\">" . LABEL_TCT042 . "</option>
								<option value=\"SAndroidM043\">" . LABEL_SANDROIDM043 . "</option>
								<option value=\"SAndroidE044\">" . LABEL_SANDROIDE044 . "</option>
								<option value=\"SAndroidB045\">" . LABEL_SANDROIDB045 . "</option>
								<option value=\"SAndroidC046\">" . LABEL_SANDROIDC046 . "</option>
								<option value=\"SAndroidCam047\">" . LABEL_SANDROIDCAM047 . "</option>
								<option value=\"SAndroidBat048\">" . LABEL_SANDROIDBAT048 . "</option>
								<option value=\"SAndroidCS049\">" . LABEL_SANDROIDCS049 . "</option>
								<option value=\"SAndroidROM050\">" . LABEL_SANDROIDROM050 . "</option>
								<option value=\"SAppleM051\">" . LABEL_SAPPLEM051 . "</option>
								<option value=\"SAppleE052\">" . LABEL_SAPPLEE052 . "</option>
								<option value=\"SAppleB053\">" . LABEL_SAPPLEB053 . "</option>
								<option value=\"SAppleC054\">" . LABEL_SAPPLEC054 . "</option>
								<option value=\"SAppleCam055\">" . LABEL_SAPPLECAM055 . "</option>
								<option value=\"SAppleB056\">" . LABEL_SAPPLEB056 . "</option>
								<option value=\"SAppleCS057\">" . LABEL_SAPPLECS057 . "</option>
								<option value=\"SAppleROM058\">" . LABEL_SAPPLEROM058 . "</option>
								<option value=\"SWindowsPhoneM059\">" . LABEL_SWINDOWSPHONEM059 . "</option>
								<option value=\"SWindowsPhoneE060\">" . LABEL_SWINDOWSPHONEE060 . "</option>
								<option value=\"SWindowsPhoneB061\">" . LABEL_SWINDOWSPHONEB061 . "</option>
								<option value=\"SWindowsPhoneC062\">" . LABEL_SWINDOWSPHONEC062 . "</option>
								<option value=\"SWindowsPhoneCam063\">" . LABEL_SWINDOWSPHONECAM063 . "</option>
								<option value=\"SWindowsPhoneB064\">" . LABEL_SWINDOWSPHONEB064 . "</option>
								<option value=\"SWindowsPhoneCS065\">" . LABEL_SWINDOWSPHONECS065 . "</option>
								<option value=\"SWindowsPhoneROM066\">" . LABEL_SWINDOWSPHONEROM066 . "</option>
								<option value=\"TAndroidM067\">" . LABEL_TANDROIDM067 . "</option>
								<option value=\"TAndroidE068\">" . LABEL_TANDROIDE068 . "</option>
								<option value=\"TAndroidB069\">" . LABEL_TANDROIDB069 . "</option>
								<option value=\"TAndroidC070\">" . LABEL_TANDROIDC070 . "</option>
								<option value=\"TAndroidCam071\">" . LABEL_TANDROIDCAM071 . "</option>
								<option value=\"TAndroidB072\">" . LABEL_TANDROIDB072 . "</option>
								<option value=\"TAndroidCT073\">" . LABEL_TANDROIDCT073 . "</option>
								<option value=\"TAndroidROM074\">" . LABEL_TANDROIDROM074 . "</option>
								<option value=\"TAppleM075\">" . LABEL_TAPPLEM075 . "</option>
								<option value=\"TAppleE076\">" . LABEL_TAPPLEE076 . "</option>
								<option value=\"TAppleB077\">" . LABEL_TAPPLEB077 . "</option>
								<option value=\"TAppleC078\">" . LABEL_TAPPLEC078 . "</option>
								<option value=\"TAppleCam079\">" . LABEL_TAPPLECAM079 . "</option>
								<option value=\"TAppleB080\">" . LABEL_TAPPLEB080 . "</option>
								<option value=\"TAppleCT081\">" . LABEL_TAPPLECT081 . "</option>
								<option value=\"TAppleROM082\">" . LABEL_TAPPLEROM082 . "</option>
								<option value=\"TWindowsPhoneM083\">" . LABEL_TWINDOWSPHONEM083 . "</option>
								<option value=\"TWindowsPhoneE084\">" . LABEL_TWINDOWSPHONEE084 . "</option>
								<option value=\"TWindowsPhoneB085\">" . LABEL_TWINDOWSPHONEB085 . "</option>
								<option value=\"TWindowsPhoneC086\">" . LABEL_TWINDOWSPHONEC086 . "</option>
								<option value=\"TWindowsPhoneCam087\">" . LABEL_TWINDOWSPHONECAM087 . "</option>
								<option value=\"TWindowsPhoneB088\">" . LABEL_TWINDOWSPHONEB088 . "</option>
								<option value=\"TWindowsPhoneCT089\">" . LABEL_TWINDOWSPHONECT089 . "</option>
								<option value=\"TWindowsPhoneROM090\">" . LABEL_TWINDOWSPHONEROM090 . "</option>
								<option value=\"RRouter091\">" . LABEL_RROUTER091 . "</option>
								<option value=\"RSwitch092\">" . LABEL_RSWITCH092 . "</option>
								<option value=\"RaspberryPi93\">Raspberry Pi</option>
							</select>
							<legend>" . LABEL_USER_TEXT20 . "</legend>
							<textarea name=\"descricao\" id=\"descricao\" tabindex=\"1\" class=\"input-block-level\" placeholder=\"" . LABEL_USER_TEXT21 . "\"></textarea>
							<p class=\"text-center\"><button class=\"btn btn-large btn-success\" type=\"submit\" name=\"submiti\">" . LABEL_USER_TEXT22 . "<i class=\"icon-upload icon-white\"></i></button></p>
							</form>");
				}
			}

			if ($query1 === 'conta') { // $query1 == user
				if (isset($_POST['subm'])) {
					$passw = mysql_escape_string(htmlspecialchars(trim($_POST['pass']), ENT_QUOTES));
					$passwo = mysql_escape_string(htmlspecialchars(trim($_POST['word']), ENT_QUOTES));

					$hashpass = hash($has, $passw);
					$pw1 = crypt($hashpass, $has2);

					$hashpass1 = hash($has, $passwo);
					$pawo1 = crypt($hashpass1, $has2);

					if (strlen($passw) < 10 or strlen($passwo) < 10) {
						echo ("<div class=\"alert alert-error\"><h2>" . LABEL_USER_TEXT23 . "</h2>
								<a href=\"user.php?user=conta\">" . LABEL_USER_TEXT24 . "</a></div>");
					} else {
						mysql_query("START TRANSACTION");
						$sql = "UPDATE users SET password='$pawo1' WHERE password='$pw1'";
						$consul = mysql_query($sql);
						$num = mysql_affected_rows();
						if (($consul)) {
							echo ("<div class=\"alert alert-success\"><h2><p class=\"text-center\">" . LABEL_USER_TEXT25 . "$num" . LABEL_USER_TEXT26 . "</div>");
							mysql_query("COMMIT");
						} else {
							echo ("<div class=\"alert alert-error\"><h2>" . LABEL_USER_TEXT27 . "</h2></div>");
							mysql_query("ROLLBACK");
						}
						mysql_free_result($consul);
						mysql_close();
					}
				} else {
					echo ("<a class=\"btn\" href=\"user.php?page=initial\">" . LABEL_USER_TEXT28 . "</a><br><br>");
					echo ("<h3><p class=\"text-center\">" . LABEL_USER_TEXT29 . "</p></h3>");
					echo ("<form action=\"user.php?user=conta\" method=\"POST\">
							<legend>" . LABEL_USER_TEXT30 . "</legend>
							<input type=\"password\" name=\"pass\" id=\"pass\" class=\"input-block-level\" placeholder=\"" . LABEL_USER_TEXT31 . "\" required />
							<legend>" . LABEL_USER_TEXT32 . "</legend>
							<input type=\"password\" name=\"word\" id=\"word\" class=\"input-block-level\" placeholder=\"" . LABEL_USER_TEXT33 . "\" required />
							<p class=\"text-center\"><button class=\"btn btn-large btn-success\" type=\"submit\" name=\"subm\">" . LABEL_USER_TEXT34 ."<i class=\"icon-upload icon-white\"></i></button></p>
							</form>");
						}
			}

			if ($query1 === 'anuncios') { // $query1 == user
				echo ("<meta http-equiv=\"refresh\" content=\"150\"/>");
				echo ("<a class=\"btn\" href=\"user.php?page=initial\">" . LABEL_USER_TEXT35 . "</a>");
				echo ("<div class=\"container-fluid\">
						<div class=\"row-fluid\">
						<center><h3>" . LABEL_USER_TEXT36 . "</h3></center>
						<center><h4>" . LABEL_USER_TEXT37 . "</h4></center>");
				mysql_query("START TRANSACTION");
				$sele = "SELECT * FROM anuncios WHERE id_user='" . $_SESSION['id'] . "' ORDER BY data DESC";
				$q = mysql_query($sele);
				if (($q)) {
					while ($row = mysql_fetch_array($q)) {
						$idi = $row['id'];
						$image = $row['imagem_nome'];
						$peca = $row['peca'];
						$nome = $row['nome'];
						$estado = $row['estado'];
						$preco = $row['preco'];
						$descricao = $row['descricao'];
						$date = $row['data'];
						$vendi = $row['vendido'];
						echo ("<ul class=\"thumbnails\">
							<li class=\"span4\">
								<div class=\"thumbnail\">
								<a href=\"pick.php?id=$image\"><img src=\"pick.php?id=$image\" alt=\"\"></a>
								<div class=\"caption\">");
								if ($vendi === 'N'){
									echo ("<p>" . LABEL_USER_TEXT149 . " <a href=\"annou.php?search=$peca&anuncio=$idi\">link</a></p>");
								}else{
									echo ("");
								}
								echo ("<h4>" . LABEL_USER_TEXT38 . "");
								search($peca);
								echo ("</h4>
									<p>Id: #$idi</p>
									<h5>" . LABEL_USER_TEXT39 . "$nome</h5>
									<p>" . LABEL_USER_TEXT40 . "$estado</p>
									<p>" . LABEL_USER_TEXT41 . "$preco</p>
									<p>" . LABEL_USER_TEXT42 . "$descricao</p>
									<p>" . LABEL_USER_TEXT43 . "$date</p>
									<p>" . LABEL_USER_TEXT44 . "");
								venda($vendi);
								echo ("</p>
										<p>" . LABEL_USER_TEXT45 . "<a href=\"user.php?see=information\">" . LABEL_USER_TEXT46 . "</a></p>");
							if ($vendi === 'S') {
								echo ("<p>" . LABEL_USER_TEXT47 . "</p>");
							} else {
								echo ("<a onclick=\"return confirm('" . LABEL_USER_TEXT48 . "')\" href=\"alter.php?kbkb=$idi\" class=\"btn btn-large btn-primary\">" . LABEL_USER_TEXT49 . "</a>");
							}
							echo ("</div>
								</div>
								</li>");
					}
					if (empty($image) and empty($nome) and empty($estado) and empty($preco) and empty($descricao) and empty($date)) {
						echo ("<h4><p class=\"text-center\">" . LABEL_USER_TEXT50 . "<a href=\"user.php?user=criaranuncio\">" . LABEL_USER_TEXT51 . "</a></p></h4>");
					}
				}
				echo ("</ul>");
				mysql_query("COMMIT");
				mysql_free_result($q);
				mysql_close();
				echo("</div>
					</div>");
			}

            //if ($query3 === 'publicidade') { // $query3 == create
            //    echo ("<a class=\"btn\" href=\"user.php?page=initial\">Voltar á página inicial</a>");
            //    echo ("Criar Publicidade");
            //}

			if ($query4 === 'mensagem') { // Aqui faz o cruzamento de informação com outras tabelas, 
				// lê as tabelas da base de dados e escreve os dados numa tabela
				echo ("<meta http-equiv=\"refresh\" content=\"150\"/>");
				echo ("<a class=\"btn\" href=\"user.php?page=initial\">" . LABEL_USER_TEXT52 . "</a>");
				echo ("<div class=\"container-fluid\">
					<div class=\"row-fluid\">
					<center><h3>" . LABEL_USER_TEXT53 . "</h3></center>");
					// para obter as mensagens com destinário igual a $_SESSION['id']
				mysql_query("START TRANSACTION");
				$sele = "SELECT * FROM mensagens WHERE for_user='" . $_SESSION['id'] . "' ORDER BY data DESC";
				$q = mysql_query($sele);
				if (($q)) {
					while ($row = mysql_fetch_array($q)) {
						//$idie = $row['id'];
						$id_anunc = $row['id_anuncios'];
						$users = $row['users_id'];
						$mensa = $row['mensagem'];
						$dat = $row['data'];
							/*para obter o nome do anuncio e verificar se o id_user 
							* que está na tabela anuncios é igual ao $_SESSION['id'] actual
							*/
						$sq1 = "SELECT * FROM anuncios WHERE id='$id_anunc' AND id_user='" . $_SESSION['id'] . "'";
						$ss = mysql_query($sq1);
						if (($ss)) {
							$roww = mysql_fetch_array($ss);
							$nome_anuncio = $roww['nome'];
							$iduser = $roww['id_user'];
						}
						// para obter o nome do utilizador
						$sq2 = "SELECT * FROM users WHERE id='$users'";
						$sss = mysql_query($sq2);
						if (($sss)) {
							$rowww = mysql_fetch_array($sss);
							$nome_utilizador = $rowww['primeiro_nome'] . " " . $rowww['ultimo_nome'];
						}
						echo ("<ul class=\"thumbnails\">
								<li class=\"span4\">
								<div class=\"thumbnail\">
								<div class=\"caption\">");
						//se o id_user que está na tabela anuncios é igual ao $_SESSION['id'] actual
						if ($iduser == $_SESSION['id']) {
							echo ("<h4>" . LABEL_USER_TEXT54 . "<a href=\"user.php?user=anuncios\">$nome_anuncio</a></h4>
									<p>Id: #$id_anunc</p>");
						} else {
								/* se o id_user que está na tabela anuncios
								* não é igual ao $_SESSION['id'] actual, só apresenta o nome do anuncio
								*
								* para obter o nome do anuncio
								*/
							$sq1 = "SELECT * FROM anuncios WHERE id='$id_anunc'";
							$ssk = mysql_query($sq1);
							if (($ssk)) {
								$roww = mysql_fetch_array($ssk);
								$nome_anun = $roww['nome'];
							}
							echo ("<h4>" . LABEL_USER_TEXT55 . "$nome_anun </h4>
									<p>Id: #$id_anunc</p>");
						}
						echo ("<h5>" . LABEL_USER_TEXT56 . "$nome_utilizador</h5>
								<h5>" . LABEL_USER_TEXT57 . "<a href=\"reply.php?user=$nome_utilizador&hut=$id_anunc&ddk=$users\">$nome_utilizador</a></h5>
								<p>" . LABEL_USER_TEXT58 . "$mensa</p>
								<p>" . LABEL_USER_TEXT59 . "$dat</p>
								</div>
								</div>
								</li>");
						}
					if (empty($nome_anuncio) and empty($nome_utilizador) and empty($mensa) and empty($dat)) {
						echo ("<h4><p class=\"text-center\">" . LABEL_USER_TEXT60 . "</p></h4>");
					}
				}
				echo ("</ul>");
				mysql_query("COMMIT");
				mysql_free_result($q);
				mysql_free_result($ss);
				mysql_free_result($sss);
				mysql_free_result($ssk);
				mysql_close();
				echo("</div>
					</div>");
			}

			if ($query4 === 'information') { // $query4 == see
				echo ("<a class=\"btn\" href=\"user.php?page=initial\">" . LABEL_USER_TEXT61 . "</a>");
				echo ("<table class=\"table\">
						<caption><h3>" . LABEL_USER_TEXT62 . "</h3></caption>
						<thead>
							<tr>
								<th>
									" . LABEL_USER_TEXT63 . "
								</th>
								<th>
									" . LABEL_USER_TEXT64 . "
								</th>
								<th>
									" . LABEL_USER_TEXT65 . "
								</th>
								<th>
									" . LABEL_USER_TEXT66 . "
								</th>
								<th>
									" . LABEL_USER_TEXT67 . "
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									" . $_SESSION['prinome'] . " " . $_SESSION['ultnome'] . "
								</td>
								<td>
									" . $_SESSION['email'] . "
								</td>
								<td>
									" . $_SESSION['idade'] . "
								</td>
								<td>
									" . $_SESSION['registado'] . "
								</td>
								<td>");
									$pais = $_SESSION['pais'];
									echo translate_country($pais);
									echo("</td>
							</tr>
						</table>");
			}

			if ($query5 === 'initial') { // $query5 == page
				echo ("<table class=\"table\">
				<caption><h3>" . LABEL_USER_TEXT68 . "</h3></caption>
				<tbody>
					<tr>
						<td>
							<a class=\"btn btn-success\" href=\"user.php?user=criaranuncio\">" . LABEL_USER_TEXT69 . "</a>
						</td>
						<td>
							<a class=\"btn btn-success\" href=\"user.php?user=conta\">" . LABEL_USER_TEXT70 . "</a>
						</td>
						<td>
							<a class=\"btn btn-success\" href=\"user.php?wiki=new\">" . LABEL_USER_TEXT71 . "</a>
						</td>
						<td>
							<a class=\"btn btn-success\" href=\"user.php?user=developer&contribute=yes\">" . LABEL_USER_TEXT72 . "</a>
						</td>
						<td>
							<a class=\"btn btn-primary\" href=\"user.php?user=anuncios\">" . LABEL_USER_TEXT73 . "</a>
						</td>
						<td>
							<a class=\"btn btn-primary\" href=\"user.php?see=mensagem\">" . LABEL_USER_TEXT74 . "</a>
						</td>
						<td>
							<a class=\"btn btn-primary\" href=\"user.php?see=information\">" . LABEL_USER_TEXT75 . "</a>
						</td>
						<td>
							<a class=\"btn btn-primary\" href=\"user.php?see=admin\">" . LABEL_HEADER_TEXT14 . "</a>
						</td>
						<td>
							<a class=\"btn btn-danger\" href=\"user.php?klrt=message\">" . LABEL_USER_TEXT76 . "</a>
						</td>
						<td>
							<a class=\"btn btn-danger\" href=\"user.php?user=leave\">" . LABEL_HEADER_TEXT7 . "</a>
						</td>
					</tr>
					</tbody>
				</table><br><br>");
			}

			if ($query1 === 'developer' and $query2 === 'yes') { // $query1 == user  $query2 == contribute
				echo ("<a class=\"btn\" href=\"user.php?page=initial\">" . LABEL_USER_TEXT77 . "</a>");
				echo ("<br><br>" . LABEL_USER_TEXT78 . "
						<br><br>" . LABEL_USER_TEXT79 . "<br>
						<code>git clone (" . LABEL_USER_TEXT80 . ")</code><br>
						<code>cd youxuse</code><br>
						<code>git checkout experimental</code>
						<br><br>" . LABEL_USER_TEXT81 . "<br>
						" . LABEL_USER_TEXT82 . "<br>
						<br>" . LABEL_USER_TEXT83 . "
						<br>" . LABEL_USER_TEXT84 . "
						<br>" . LABEL_USER_TEXT85 . "
						<br><br>
						<code>git commit -m \"" . LABEL_USER_TEXT86 . "\"</code><br>
						<br>" . LABEL_USER_TEXT87 . "
						<br><code>git push myfork experimental</code>
						<br><br>" . LABEL_USER_TEXT88 . "<br><br>
						" . LABEL_USER_TEXT89 . "<br><br>");
						
				mysql_query("START TRANSACTION");
				$sele = "SELECT * FROM users WHERE email='" . $_SESSION['email'] . "'";
				$q = mysql_query($sele);
				if (($q)) {
					while ($row = mysql_fetch_array($q)) {
						$morada = $row['morada'];
						$postal = $row['cod_postal'];
						$freg = $row['freguesia'];
						$conc = $row['concelho'];
						$indicativo = $row['indicativo'];
						$telefone = $row['telefone'];
						$telemovel = $row['telemovel'];
						$github = $row['username_github'];
						$datein = $row['signed_date'];
						if (empty($morada) and empty($postal) and empty($indicativo) and empty($telefone) and empty($telemovel) and empty($github)) {
							echo("<a href=\"contribute.php\">" . LABEL_USER_TEXT90 . "</a>");
						} else {
							echo ("<div class=\"thumbnail\">
									<h4>" . LABEL_USER_TEXT91 . "</h4>
									<div class=\"caption\">
									<p>" . LABEL_USER_TEXT92 . "$morada</p>
									<p>" . LABEL_USER_TEXT93 . "$postal</p>");
							if ($_SESSION['pais'] == 'Portugal') {
								echo ("<p>" . LABEL_USER_TEXT94 . "$freg</p>
										<p>" . LABEL_USER_TEXT95 . "$conc</p>");
							}else{
								echo ("<p>" . LABEL_USER_TEXT94 . "$freg</p>
										<p>" . LABEL_USER_TEXT95 . "$conc</p>");
							}
							echo ("<p>" . LABEL_USER_TEXT96 . "$indicativo</p>
									<p>" . LABEL_USER_TEXT97 . "$telefone</p>
									<p>" . LABEL_USER_TEXT98 . "$telemovel</p>
									<p>" . LABEL_USER_TEXT99 . "<a href=\"https://www.github.com/$github\">$github</a></p>
									<p>" . LABEL_USER_TEXT100 . "$datein</p>
									</div>
									</div>
									</li>");
						}
					}
				}
				mysql_query("COMMIT");
				mysql_free_result($q);
				mysql_close();
			}

			if ($query6 === 'new') { // NEW TUTORIAL
				if (isset($_POST['submitcreatetutorial'])) {
						// primeiro compara o nome da peça
						// com a base de dados com a instrução SELECT e se encontrar um registo na tabela
						// não insere este registo com a instrução INSERT, mas actualiza esse campo da tabela
						// com a instrução UPDATE. Se não encontrar um registo insere os dados com a instrução
						// INSERT.
						// upload the image to the folder and save the address in database
						// INSERT

					$imagem_no = mysql_escape_string(htmlspecialchars(trim($_FILES['imagem']['name']), ENT_QUOTES));
					$imagem_type = $_FILES['imagem']['type'];
					$imagem_size = $_FILES['imagem']['size'];
					$imagem_tmp = $_FILES['imagem']['tmp_name'];
					//$imagem_error = $_FILES['imagem']['error'];
					//$peca = trim($_POST['peca']);
					$text = trim($_POST['descricao']);
					$date = date('Y-m-d');

					$imagem_sizin = round($imagem_size / 1000);

					if (empty($imagem_no) or empty($text) or (strlen($text) > 1000)) {
						echo ("<div class=\"alert alert-error\"><h2>" . LABEL_USER_TEXT101 . "</h2></div>");
						exit;
					}
					
					if (empty($_SESSION['code_peca'])){
						echo ("<div class=\"alert alert-error\"><h2>" . LABEL_USER_TEXT150 . "</h2></div>");
						exit();
					}

					$imagem_code_name = rand() . rand() . rand() . rand() . rand() . rand() . rand() . rand() . rand();

					$final_local = $folder_image . $imagem_code_name;
					
					// check the size of the image and the extension
					if ($imagem_sizin < 350 && ($imagem_type == "image/png")) {
						mysql_query("START TRANSACTION");
						(move_uploaded_file($imagem_tmp, $final_local));
						$sql = "INSERT INTO wiki (users_id, peca, imagem_nome, texto, data) VALUES ('" . $_SESSION['id'] . "','" . $_SESSION['code_peca'] ."', '$imagem_code_name','$text','$date')";
						$wikinsert = mysql_query($sql);
						if (($wikinsert)) {
							echo ("<div class=\"alert alert-success\"><h2><p class=\"text-center\"><a href=\"wikiannou.php?search=" . $_SESSION['code_peca'] . "\">" . LABEL_USER_TEXT102 . "</a></div>");
							mysql_query("COMMIT");
						} else {
							echo ("<div class=\"alert alert-error\"><h2>" . LABEL_USER_TEXT103 . "</h2></div>");
							mysql_query("ROLLBACK");
						}
					} else {
						echo("<div class=\"alert alert-error\"><h2>" . LABEL_USER_TEXT104 . "</h2></div>");
						mysql_query("ROLLBACK");
					}
					mysql_free_result($wikinsert);
					mysql_close();
				} else {
					echo ("<a class=\"btn\" href=\"user.php?page=initial\">" . LABEL_USER_TEXT105 . "</a>");
					echo (" <a class=\"btn\" href=\"wikiannou.php?search=DM01\">" . LABEL_USER_TEXT106 . "</a>");
					echo ("<p></p>");
					echo ("<p class=\"lead\">" . LABEL_USER_TEXT107 . " <br> " . LABEL_USER_TEXT148 . " </p>
							<form class=\"form-signin\" action=\"user.php?wiki=new\" method=\"POST\" enctype=\"multipart/form-data\">
							<h2 class=\"form-signin-heading\"><p class=\"text-center\">" . LABEL_USER_TEXT108 . "</p></h2>");
					$bb = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['blos'])), ENT_QUOTES));
					$_SESSION['code_peca'] = $bb;
					echo("" . LABEL_USER_TEXT109 . "");
					echo search($bb);
					echo ("<legend>" . LABEL_USER_TEXT110 . "</legend>
							<input type=\"file\" name=\"imagem\" id=\"imagem\" class=\"input-block-level\" placeholder=\"" . LABEL_USER_TEXT111 . "\" required />
							<legend>" . LABEL_USER_TEXT112 . "</legend>
							<textarea name=\"descricao\" id=\"descricao\" tabindex=\"1\" class=\"input-block-level\" placeholder=\"" . LABEL_USER_TEXT113 . "\" required></textarea>
							<p class=\"text-center\"><button class=\"btn btn-large btn-success\" type=\"submit\" name=\"submitcreatetutorial\">" . LABEL_USER_TEXT114 . "<i class=\"icon-upload icon-white\"></i></button></p>
							</form>");
				}
			}

            if ($query8 === 'yes') { // UPDATE TUTORIAL
                if (isset($_POST['submitupdatetutorial'])) {
					mysql_query("START TRANSACTION");
					$sele = "SELECT * FROM wiki";
					$q = mysql_query($sele);
					if (($q)) {
						$row = mysql_fetch_array($q);
						$bl = $row['peca'];
						$idm = $row['imagem_nome'];
						
						// POST
						$imagem_nome = mysql_escape_string(htmlspecialchars(trim($_FILES['imagem']['name']), ENT_QUOTES));
						$imagem_type = $_FILES['imagem']['type'];
						$imagem_size = $_FILES['imagem']['size'];
						$imagem_tmp = $_FILES['imagem']['tmp_name'];
						//$imagem_error = $_FILES['imagem']['error'];

						$text = trim($_POST['descricao']);
						$date = date('Y-m-d');

						$imagem_sizin = round($imagem_size / 1000);

						if (empty($text) or (strlen($text) > 1000)) {
							echo ("<div class=\"alert alert-error\"><h2>" . LABEL_USER_TEXT115 . "</h2></div>");
							exit;
						}

						$imagem_code_name = rand() . rand() . rand() . rand() . rand() . rand() . rand() . rand() . rand();

						$final_local = $folder_image . $imagem_code_name;
						
						// check the size of the image and the extension
						if ($imagem_sizin < 350 && ($imagem_type == "image/png")) {
							$path = $folder_image . $idm;
							if (file_exists($path)) {
								unlink($folder_image . $idm);
							}
						}
						(move_uploaded_file($imagem_tmp, $final_local));
						$sql = "UPDATE wiki SET users_id='" . $_SESSION['id'] . "',imagem_nome='$imagem_code_name',texto='$text',data='$date' WHERE peca='$bl'";
						$consul = mysql_query($sql);
						$num = mysql_affected_rows();
						if (($consul)) {
							echo ("<div class=\"alert alert-success\"><h2><p class=\"text-center\">" . LABEL_USER_TEXT116 . "$num" . LABEL_USER_TEXT117 . "</div>");
							mysql_query("COMMIT");
						} else {
							echo ("<div class=\"alert alert-error\"><h2>" . LABEL_USER_TEXT118 . "</h2></div>");
							mysql_query("ROLLBACK");
						}
					} else {
						echo("<div class=\"alert alert-error\"><h2>" . LABEL_USER_TEXT119 . "</h2></div>");
						mysql_query("ROLLBACK");
					}
					mysql_free_result($consul);
					mysql_close();
				} else {
					echo ("<a class=\"btn\" href=\"user.php?page=initial\">" . LABEL_USER_TEXT120 . "</a>");
					echo (" <a class=\"btn\" href=\"wikiannou.php?search=DM01\">" . LABEL_USER_TEXT121 . "</a>");
					echo ("<p></p>");
					echo ("<p class=\"lead\">" . LABEL_USER_TEXT122 . " <br> " . LABEL_USER_TEXT148 . " </p>
							<form class=\"form-signin\" action=\"user.php?update=yes\" method=\"POST\" enctype=\"multipart/form-data\">
							<h2 class=\"form-signin-heading\"><p class=\"text-center\">" . LABEL_USER_TEXT123 . "</p></h2>");
					$bb = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['block'])), ENT_QUOTES));
					echo("" . LABEL_USER_TEXT124 . "");
					echo search($bb);
					echo("<legend>" . LABEL_USER_TEXT125 . "</legend>
							<input type=\"file\" name=\"imagem\" id=\"imagem\" class=\"input-block-level\" placeholder=\"" . LABEL_USER_TEXT126 . "\" required />
							<legend>" . LABEL_USER_TEXT127 . "</legend>
							<textarea name=\"descricao\" id=\"descricao\" tabindex=\"1\" class=\"input-block-level\" placeholder=\"" . LABEL_USER_TEXT128 . "\" required></textarea>
							<p class=\"text-center\"><button class=\"btn btn-large btn-success\" type=\"submit\" name=\"submitupdatetutorial\">" . LABEL_USER_TEXT129 . "<i class=\"icon-upload icon-white\"></i></button></p>
							</form>");
				}
			}

			if ($query4 === 'admin') { // Aqui não faz qualquer cruzamento de informação com outras tabelas, 
				//só lê a tabela da base de dados e escreve os dados numa tabela
				echo ("<meta http-equiv=\"refresh\" content=\"150\"/>");
				echo ("<a class=\"btn\" href=\"user.php?page=initial\">" . LABEL_USER_TEXT130 . "</a>");
				echo ("<div class=\"container-fluid\">
						<div class=\"row-fluid\">
						<center><h3>" . LABEL_USER_TEXT131 . "</h3></center>");
				mysql_query("START TRANSACTION");
				$sele = "SELECT * FROM message_from_admin WHERE for_user='" . $_SESSION['id'] . "'";
				$q = mysql_query($sele);
				if (($q)) {
					while ($row = mysql_fetch_array($q)) {
						//$id = $row['id'];
						$mensa = $row['mensagem'];
						$da = $row['data'];
						echo ("<ul class=\"thumbnails\">
								<li class=\"span4\">
								<div class=\"thumbnail\">
								<div class=\"caption\">
								<h5>" . LABEL_USER_TEXT132 . "</h5>
								<p>" . LABEL_USER_TEXT133 . "$mensa</p>
								<p>" . LABEL_USER_TEXT134 . "$da</p>
								</div>
								</div>
								</li>");
					}
				}
				if (empty($mensa) and empty($da)) {
					echo ("<h4><p class=\"text-center\">" . LABEL_USER_TEXT135 . "</p></h4>");
				}
				echo ("</ul>");
				mysql_query("COMMIT");
				mysql_free_result($q);
				mysql_close();
				echo ("</div>
						</div>");
			}

			if ($query7 === 'message') {
				if (isset($_POST['submitmessageforadmin'])) {
					$message = mysql_escape_string(htmlspecialchars(trim($_POST['mensa']), ENT_QUOTES));
					if (strlen($message) > 200) {
						echo ("<div class=\"alert alert-error\"><h2>" . LABEL_USER_TEXT136 . "</h2>");
						echo ("" . LABEL_USER_TEXT137 . "" . strlen($message) . "" . LABEL_USER_TEXT138 . "<br>");
						echo ("<a href=\"users.php?klrt=message\">" . LABEL_USER_TEXT139 . "</a></div>");
					} else {
						$da = date('Y-m-d');
						mysql_query("START TRANSACTION");
						$sql = "INSERT INTO mensagens_emergency (users_id,mensagem,data) VALUES ('" . $_SESSION['id'] . "','$message','$da')";
						$inser1 = mysql_query($sql);
						if (($inser1)) {
							echo ("<p class=\"text-center\">" . LABEL_USER_TEXT140 . "</p>");
							mysql_query("COMMIT");
						}
						mysql_free_result($inser1);
						mysql_close();
					}
				} else {
					echo ("<a class=\"btn\" href=\"user.php?page=initial\">" . LABEL_USER_TEXT141 . "</a><br><br>
							<form action=\"\" method=\"POST\">
								<textarea name=\"mensa\" id=\"mensa\" tabindex=\"1\" class=\"input-block-level\" placeholder=\"" . LABEL_USER_TEXT142 . "\" required></textarea>
								<p class=\"text-center\">
									<button class=\"btn btn-large btn-success\" type=\"submit\" name=\"submitmessageforadmin\">" . LABEL_USER_TEXT143 . "<i class=\"icon-user icon-white\"></i></button>
								</p>
							</form>");
				}
			}

			if ($query1 === 'leave') {
				if (isset($_POST['submitapagaraconta'])) {
					mysql_query("START TRANSACTION");
					$sql = "DELETE FROM users WHERE id='" . $_SESSION['id'] . "'";
					$dele1 = mysql_query($sql);
					if ($dele1 != 1) {
						echo ("" . LABEL_USER_TEXT144 . "");
						mysql_query("ROLLBACK");
					} else {
						mysql_query("COMMIT");
						session_destroy();
						echo ("<meta http-equiv=\"refresh\" content=\"0\"/>");
						//header("Location: index.php");
						//exit();
					}
					mysql_free_result($dele1);
					mysql_close();
				} else {
					echo ("<a class=\"btn\" href=\"user.php?page=initial\">" . LABEL_USER_TEXT145 . "</a><br><br>
							<form action=\"user.php?user=leave\" method=\"POST\">
								<div class=\"alert alert-error\">
									" . LABEL_USER_TEXT146 . "
								</div>
								<p class=\"text-center\">
									<button class=\"btn btn-large btn-danger\" type=\"submit\" name=\"submitapagaraconta\">" . LABEL_USER_TEXT147 . "<i class=\"icon-user icon-white\"></i></button>
								</p>
							</form>");
				}
			}
            ?>

			<?php include ("hf/footer.php"); ?>

		</div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
		<script type="text/javascript" src="resources/js/jquery-1.9.1.min.js"></script>
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
