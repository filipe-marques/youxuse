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
require_once ("../session/check_user.php");

$db = new mysqli("localhost", "root", "ff", "store");
if ($db->connect_error){
	die("Erro em aceder a base de dados !");
	//echo "Erro em aceder a base de dados (" . $db->connect_errno . ")" . $db->connect_error;
}

// inserting data in database table
if (isset($_POST['submit_new_app'])){
	
	$name_program = $db->real_escape_string(htmlspecialchars($_POST['name_program'], ENT_QUOTES));
	$features = $db->real_escape_string(htmlspecialchars($_POST['features'], ENT_QUOTES));
	$congui = $db->real_escape_string(htmlspecialchars($_POST['congui'], ENT_QUOTES));
	$arch = $db->real_escape_string(htmlspecialchars($_POST['arch'], ENT_QUOTES));
	$version = $db->real_escape_string(htmlspecialchars($_POST['version'], ENT_QUOTES));
	$sysop = $db->real_escape_string(htmlspecialchars($_POST['sysop'], ENT_QUOTES));
	$name_package_x86 = $db->real_escape_string(htmlspecialchars($_POST['name_package_x86'], ENT_QUOTES));
	$name_package_x64 = $db->real_escape_string(htmlspecialchars($_POST['name_package_x64'], ENT_QUOTES));
	
	$db->query("START TRANSACTION");
	if (!($insert = $db->query("INSERT INTO programs (name,features,consolegui,arch,version,operatingsys,name_package_x86,name_package_x64) VALUES ('{$name_program}','{$features}','{$congui}','{$arch}','{$version}','{$sysop}','{$name_package_x86}','{$name_package_x64}')"))){
		$db->rollback();
		echo "Insert operation failed: (" . $db->errno . ") " . $db->error;
	} else {
		$db->commit();
		echo("Sucess!");
	}
	$db->close();
}

nothing();
is_not_admin();
generate_new_session_id();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Bem&dash;vindo <?php echo $_SESSION['prinome']; ?> &dash; YouXuse &dash; Venda &AMP; Compra pe&ccedil;as usadas de tecnologia</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="../resources/css/bootstrap.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
        <link href="../resources/css/bootstrap-responsive.css" rel="stylesheet" type="text/css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="../assets/js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="../resources/img/youxuse-icon.png">
    </head>

    <body>

        <?php include ("head.php"); ?>

        <div class="container">
            Bem-vindo Administrador!
            <br>
            Não se esqueça de visitar estas ligações:
			<br><br>
			Perfil de Filipe Marques
			<br>
				<a href="https://plus.google.com/110434741360705159101"><img src="../resources/img/glyphicons_382_google_plus.png"></a> e 
				<a href="https://www.facebook.com/profile.php?id=100004437103780"><img src="../resources/img/glyphicons_410_facebook.png"></a>
			<br><br>
			Páginas nas redes sociais do projecto YouXuse&trade;&copy;
			<br>
				<a href="https://plus.google.com/116778377892072300095"><img src="../resources/img/glyphicons_382_google_plus.png"></a> e 
				<a href="https://www.facebook.com/youxuse"><img src="../resources/img/glyphicons_410_facebook.png"></a>
			<br><br>
			<a href="">Google Analytics</a> e <a href="">Google AdSense</a>
            <br>
            <br>
            
            <form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="form" id="form">
                <h2 class="form-signin-heading"></h2>
                <legend>Nome do programa: </legend>
                <input type="text" name="name_program" id="name_program" placeholder="nome do programa" required />

                <legend>Features: </legend>
                <input type="text" name="features" id="features" placeholder="features" required />

                <legend>Consola ou G.U.I.</legend>
                <select name="congui" id="congui" required />
                <option value="">Escollhe a opção</option>
                <option value="Console">Console</option>
                <option value="G.U.I.">G.U.I.</option>
                </select>
                
                <legend>Arch</legend>
                <select name="arch" id="arch" required />
                <option value="">Escollhe a opção</option>
                <option value="x86">x86</option>
                <option value="x64">x64</option>
                </select>
                
                <legend>Versão do programa: </legend>
                <input type="text" name="version" id="version" placeholder="versão do programa" required />

                <legend>Sistemas operativos:</legend>
                <select name="sysop" id="sysop" required />
                <option value="">Escollhe a opção</option>
                <option value="LINUX (Debian, Ubuntu, OpenSUSE, Fedora,...)">LINUX (Debian, Ubuntu, OpenSUSE, ...)</option>
                <option value="WINDOWS 7 - VISTA - XP">Windows 7 - VISTA - XP </option>
                <option value="MAC OS X">MAC OS X</option>
                <option value="LINUX e WINDOWS">LINUX e WINDOWS</option>
                <option value="LINUX e MAC">LINUX e MAC</option>
                <option value="MAC e WINDOWS">MAC e WINDOWS</option>
                </select>
                
                <legend>Nome do pacote em formato zip: (programa.zip) (versão x86)</legend>
                <input type="text" name="name_package_x86" id="name_package_x86" placeholder="nome do programa em zip (versão x86)" />
                
                <legend>Nome do pacote em formato zip: (programa.zip) (versão x64)</legend>
                <input type="text" name="name_package_x64" id="name_package_x64" placeholder="nome do programa em zip (versão x64)" />
                <br>
                <br>
                <p class="text-center"><button class="btn btn-large btn-success" type="submit" name="submit_new_app">Registar programa <i class="icon-envelope icon-white"></i></button></p>
            </form>
            
            <?php
            /*
            echo ("Aqui estão apresentadas contas que ainda não foram activadas por um período de 1 mês:");
            mysql_query("START TRANSACTION");
            $select = "SELECT * FROM users WHERE DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND active=0";
            $q = mysql_query($select);
            if (($q)) {
                echo("<table class=\"table\">
                <caption><h3>Tabela: users</h3></caption>
                <thead>
                    <tr>
                        <td>
                            <center>Id do Utilizador</center>
                        </td>
                        <td>
                            <center>Nome do Utilizador</center>
                        </td>
                        <td>
                            <center>E&dash;mail</center>
                        </td>
                        <td>
                            <center>Idade</center>
                        </td>
                        <td>
                            <center>Sexo</center>
                        </td>
                        <td>
                            <center>Registado desde</center>
                        </td>
                        <td>
                            <center>País</center>
                        </td>
                        <td>
                            <center>Activo</center>
                        </td>
                        <td>
                            <center>Apagar?</center>
                        </td>
                    </tr>
                </thead>");
                while ($row = mysql_fetch_array($q)) {
                    $id = $row['id'];
                    $prim_nome = $row['primeiro_nome'];
                    $ultim_nome = $row['ultimo_nome'];
                    $email = $row['email'];
                    $idade = $row['idade'];
                    $sexo = $row['sexo'];
                    $registado = $row['registado'];
                    $pa = $row['pais'];
                    $activo = $row['active'];
                    echo("<tbody>
                    <tr>
                        <td>
                            <center>$id</center>
                        </td>
                        <td>");
                    if ($prim_nome === 'admin') {
                        echo $prim_nome;
                    } else {
                        echo("<a href=\"sendmessage.php?uh=$id\"><center>$prim_nome $ultim_nome</center></a>");
                    }
                    echo("</td>
                        <td>
							<center>$email</center>
                        </td>
                        <td>
                            <center>$idade</center>
                        </td>
                        <td>
                            <center>$sexo</center>
                        </td>
                        <td>
                            <center>$registado</center>
                        </td>
                        <td>
                            <center>$pa</center>
                        </td>
                        <td>
                            <center>$activo</center>
                        </td>
                        <td><center>
								<a onclick=\"return confirm('Confirma que vai apagar o utilizador ?')\"
									href=\"del.php?table=users&id=$id\">Apagar?</a></center></td>");
                }
                echo ("</tr>");
                echo ("</table>");
            } else {
                echo ("A tabela não tem registos");
            }
            mysql_query("COMMIT");
            mysql_free_result($q);
            mysql_close();
            */?>
            
            
        </div> <!-- /container -->
        <?php include ("foot.php"); ?>
        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript" src="./resources/js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-transition.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-alert.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-modal.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-dropdown.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-scrollspy.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-tab.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-tooltip.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-popover.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-button.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-collapse.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-carousel.js"></script>
        <script type="text/javascript" src="./resources/js/bootstrap-typeahead.js"></script>

    </body>
</html>

