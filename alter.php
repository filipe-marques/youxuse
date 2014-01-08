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

nothing();
is_admin();
generate_new_session_id();

// check if it has session created, if yes search for the strings of country, if no do nothing
if (session_start()){
	check_session_idiom();
}

$g = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['kbkb'])), ENT_QUOTES));

if (isset($_POST['submitalteraranuncio'])) {
    $preco = trim($_POST['preco']);
    $venda = trim($_POST['venda']);

    // UPDATE tabela anuncios com base no id do anuncio e no id_user da $_SESSION[id] presente na sessão actual
    // se for com sucesso redirecciona para a página anterior que apresenta os anuncios registados pelo 
    // utilizador

    mysql_query("START TRANSACTION");
    $sql = "UPDATE anuncios SET preco='$preco',vendido='$venda' WHERE id='$g' AND id_user='" . $_SESSION['id'] . "'";
    $consul = mysql_query($sql);
    $num = mysql_affected_rows();
    if (($consul)) {
        echo ("<div class=\"alert alert-success\"><h2><p class=\"text-center\">" . LABEL_ALTER_TEXT1 . " $num " . LABEL_ALTER_TEXT2 . "<br>");
        echo ("<a href=\"user.php?user=anuncios\">" . LABEL_ALTER_TEXT3 . "</a></div>");
        mysql_query("COMMIT");
    } else {
        echo ("<div class=\"alert alert-error\"><h2>" . LABEL_ALTER_TEXT4 . "</h2></div>");
        mysql_query("ROLLBACK");
    }
    mysql_free_result($consul);
    mysql_close();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo (sexo() . " " . $_SESSION['prinome'] . " " . $_SESSION['ultnome']); ?> &dash; YouXuse &dash; Venda &AMP; Compra pe&ccedil;as usadas de tecnologia</title>
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
            echo ("<div class=\"container-fluid\">
                    <div class=\"row-fluid\">
                     <center><h3>" . LABEL_ALTER_TEXT5 . "</h3></center>
                     <center><h4>" . LABEL_ALTER_TEXT6 . "</h4></center>");

            mysql_query("START TRANSACTION");
            $sele = "SELECT * FROM anuncios WHERE id='$g' AND id_user='" . $_SESSION['id'] . "'";
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

                    echo ("<form action=\"alter.php?kbkb=$g\" method=\"POST\">
							<ul class=\"thumbnails\">
                            <li class=\"span4\">
                            <div class=\"thumbnail\">
                            <a href=\"pick.php?id=$image\"><img src=\"pick.php?id=$image\" alt=\"\"></a>
                            <div class=\"caption\">
                            <h4>" . LABEL_ALTER_TEXT16 . " ");
                    search($peca);
                    echo ("</h4>
							<p>Id: #$idi</p>
							<h5>" . LABEL_ALTER_TEXT7 . " $nome</h5>
							<p>" . LABEL_ALTER_TEXT8 . " $estado</p>
							<p>" . LABEL_ALTER_TEXT9 . " 
								<select name=\"preco\" id=\"preco\" required />
									<option value=\"\" selected>" . LABEL_ALTER_TEXT10 . "</option>
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
							</p>
                            <p>" . LABEL_ALTER_TEXT11 . " $descricao</p>
                            <p>" . LABEL_ALTER_TEXT12 . " $date</p>
                            <p>" . LABEL_ALTER_TEXT17 . " <select name=\"venda\" id=\"venda\" required />
									<option value=\"\" selected>" . LABEL_ALTER_TEXT13 . "</option>
									<option value=\"S\">" . LABEL_VENDA2 . "</option>
									<option value=\"N\">" . LABEL_VENDA1 . "</option>
									</select>
														<a data-toggle=\"tooltip\" title=\"" . LABEL_ALTER_TEXT14 . "\">
																<i class=\"icon-question-sign\"></i></a>
							<p class=\"text-center\"><button class=\"btn btn-large btn-primary\" type=\"submit\" name=\"submitalteraranuncio\">" . LABEL_ALTER_TEXT15 . " <i class=\"icon-upload icon-white\"></i></button></p>
							</form>");
                    echo ("</div>
                            </div>
                            </li>");
                }
            }
            echo ("</ul>");
            mysql_query("COMMIT");
            mysql_free_result($q);
            mysql_close();
            echo("</div>
                    </div>");
            ?>
            <?php include ("hf/footer.php"); ?>

        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript" src="resources/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="resources/js/txtdescricao.js"></script>
        <script type="text/javascript" src="resources/js/txtpeca.js"></script>
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
