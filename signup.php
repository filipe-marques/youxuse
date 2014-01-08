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

if (isset($_POST['submitsignup'])) {
    $pri_nome = mysql_real_escape_string(htmlspecialchars(trim($_POST['prinome']), ENT_QUOTES));
    $ult_nome = mysql_real_escape_string(htmlspecialchars(trim($_POST['ultnome']), ENT_QUOTES));
    $email = mysql_real_escape_string(htmlspecialchars(htmlentities(trim($_POST['email'])), ENT_QUOTES));
    $password = mysql_real_escape_string(htmlspecialchars(htmlentities(trim($_POST['password'])), ENT_QUOTES));
    $idade = trim($_POST['idade']);
    $genero = trim($_POST['genero']);
    $pais = trim($_POST['pais']);
    $regis = date('Y-m-d');

    $hashpass = hash($has, $password);
    $hashpass2 = crypt($hashpass, $hass);
    
    $active = 1;

    if (spam_out($email) == FALSE) {
        header("Location: signup.php");
        exit();
    }

    if (strlen($password) < 10) {
        echo ("<div class=\"alert alert-error\"><h2>" . LABEL_SIGNUP_TEXT1 . "</h2>
            <a href=\"signup.php\">" . LABEL_SIGNUP_TEXT2 . "</a></div>");
    } else {
        mysql_query("START TRANSACTION");
        $sql = "INSERT INTO users (primeiro_nome, ultimo_nome, email, password, idade, sexo, registado, pais, active) VALUES ('$pri_nome','$ult_nome','$email','$hashpass2','$idade','$genero','$regis','$pais','$active')";
        $consulta = mysql_query($sql);
        if (($consulta)) {
            //exec("python3 signup_mail.pyc $email $pri_nome $ult_nome $hashpass");
            echo ("<div class=\"alert alert-success\">
                	<h2>
                    <p class=\"text-center\">" . LABEL_SIGNUP_TEXT3 . "</p>
                    <!--<p class=\"text-center\">" . LABEL_SIGNUP_TEXT4 . "</p>
                    <p class=\"text-center\">" . LABEL_SIGNUP_TEXT5 . "</p>
                    <p class=\"text-center\">" . LABEL_SIGNUP_TEXT6 . "</p>-->
                </h2>
            </div>");
            mysql_query("COMMIT");
        } else {
            mysql_query("ROLLBACK");
            header("Location: signup.php");
            exit();
        }
        mysql_free_result($consulta);
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

        <h2><p class="text-center"><?php echo LABEL_SIGNUP_TEXT7; ?></p></h2>

        <div class="container">

            <form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="form" id="form">
                <h2 class="form-signin-heading"><?php echo LABEL_SIGNUP_TEXT8; ?></h2>
                <legend><?php echo LABEL_SIGNUP_TEXT9; ?><a data-toggle="tooltip" title="<?php echo LABEL_SIGNUP_TEXT10; ?> Filipe Marques">
                        <i class="icon-question-sign"></i></a></legend>
                <input type="text" name="prinome" id="prinome" placeholder="<?php echo LABEL_SIGNUP_TEXT32; ?>" required />
                <input type="text" name="ultnome" id="ultnome" placeholder="<?php echo LABEL_SIGNUP_TEXT33; ?>" required />

                <legend><?php echo LABEL_SIGNUP_TEXT11; ?> <a data-toggle="tooltip" title="<?php echo LABEL_SIGNUP_TEXT12; ?> anA231.$&#.qWxSWdfTvg:,;-_?=)(/&%$#! - <?php echo LABEL_SIGNUP_TEXT34; ?>">
                        <i class="icon-question-sign"></i></a></legend>
                <input type="password" name="password" id="password" placeholder="<?php echo LABEL_SIGNUP_TEXT11; ?>" required />

                <legend><?php echo LABEL_SIGNUP_TEXT13; ?> <a data-toggle="tooltip" title="<?php echo LABEL_SIGNUP_TEXT14; ?> exemplo@mailman.com">
                        <i class="icon-question-sign"></i></a></legend>
                <input type="email" name="email" id="email" placeholder="<?php echo LABEL_SIGNUP_TEXT13; ?>" required />

                <legend><?php echo LABEL_SIGNUP_TEXT15; ?></legend>
                <select name="idade" id="idade" required />
                <option value=""><?php echo LABEL_SIGNUP_TEXT16; ?></option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
                <option value="32">32</option>
                <option value="33">33</option>
                <option value="34">34</option>
                <option value="35">35</option>
                <option value="36">36</option>
                <option value="37">37</option>
                <option value="38">38</option>
                <option value="39">39</option>
                <option value="40">40</option>
                <option value="41">41</option>
                <option value="42">42</option>
                <option value="43">43</option>
                <option value="44">44</option>
                <option value="45">45</option>
                <option value="46">46</option>
                <option value="47">47</option>
                <option value="48">48</option>
                <option value="49">49</option>
                <option value="50">50</option>
                <option value="51">51</option>
                <option value="52">52</option>
                <option value="53">53</option>
                <option value="54">54</option>
                <option value="55">55</option>
                <option value="56">56</option>
                <option value="57">57</option>
                <option value="58">58</option>
                <option value="59">59</option>
                <option value="60">60</option>
                <option value="61">61</option>
                <option value="62">62</option>
                <option value="63">63</option>
                <option value="64">64</option>
                <option value="65">65</option>
                <option value="66">66</option>
                <option value="67">67</option>
                <option value="68">68</option>
                <option value="69">69</option>
                <option value="70">70</option>
                <option value="71">71</option>
                <option value="72">72</option>
                <option value="73">73</option>
                <option value="74">74</option>
                <option value="75">75</option>
                <option value="76">76</option>
                <option value="77">77</option>
                <option value="78">78</option>
                <option value="79">79</option>
                <option value="80">80</option>
                <option value="81">81</option>
                <option value="82">82</option>
                <option value="83">83</option>
                <option value="84">84</option>
                <option value="85">85</option>
                <option value="86">86</option>
                <option value="87">87</option>
                <option value="88">88</option>
                <option value="89">89</option>
                <option value="90">90</option>
                <option value="91">91</option>
                <option value="92">92</option>
                <option value="93">93</option>
                <option value="94">94</option>
                <option value="95">95</option>
                <option value="96">96</option>
                <option value="97">97</option>
                <option value="98">98</option>
                <option value="99">99</option>
                <option value="100">100</option>     
                </select>

                <legend><?php echo LABEL_SIGNUP_TEXT17; ?> <a data-toggle="tooltip" title="<?php echo LABEL_SIGNUP_TEXT18; ?>">
                        <i class="icon-question-sign"></i></a></legend>
                <select name="genero" id="genero" required />
                <option value=""><?php echo LABEL_SIGNUP_TEXT19; ?></option>
                <option value="M"><?php echo LABEL_SIGNUP_TEXT20; ?></option>
                <option value="F"><?php echo LABEL_SIGNUP_TEXT21; ?></option>
                </select>

                <legend><?php echo LABEL_SIGNUP_TEXT22; ?> <a data-toggle="tooltip" title="<?php echo LABEL_SIGNUP_TEXT23; ?>">
                        <i class="icon-question-sign"></i></a></legend>
                <select name="pais" id="pais" required />
                <option value=""><?php echo LABEL_SIGNUP_TEXT24; ?></option>
                <option value="pt"><?php echo LABEL_SIGNUP_TEXT25; ?></option>
                <option value="es"><?php echo LABEL_SIGNUP_TEXT26; ?></option>
                <option value="fr"><?php echo LABEL_SIGNUP_TEXT27; ?></option>
                <option value="uk"><?php echo LABEL_SIGNUP_TEXT28; ?></option>
                <option value="us"><?php echo LABEL_SIGNUP_TEXT29; ?></option>
                <option value="br"><?php echo LABEL_SIGNUP_TEXT30; ?></option>
                </select>
                <br>
                <br>
                <p class="text-center"><a href="terms.php"><?php echo LABEL_SIGNUP_TEXT35; ?></a></p>
                <br>
                <p class="text-center"><button class="btn btn-large btn-success" type="submit" name="submitsignup"><?php echo LABEL_SIGNUP_TEXT31; ?> <i class="icon-user icon-white"></i></button></p>
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
