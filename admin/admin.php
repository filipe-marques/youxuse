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
require_once("connect.php");

// instantiation of the class Connection
$data_connect = new Connection_ADMIN();
// accessing the connect method
$data_connect->connect();

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
            Aqui estão apresentadas contas que ainda não foram activadas por um período de 1 mês:
            <?php
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
            ?>
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

