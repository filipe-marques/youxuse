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
require_once ("connect.php");
require_once ("../process/functions.php");
require_once ("../store.php");
require_once ("../lang/pt.php");

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

            <h3>
                <p class="text-center">Tabelas: 
                    <a href="operations.php?data=users">users</a>, 
                    <a href="operations.php?data=rss_noticias">rss_noticias</a>, 
                    <a href="operations.php?data=mensagens">mensagens</a>, 
                    <?php //<a href="operations.php?data=contactos">contactos</a>,?> 
                    <a href="operations.php?data=anuncios">anuncios</a>,
                    <a href="operations.php?data=wiki">wiki</a>,
                    <a href="operations.php?data=nostress_desabafo">nostress_desabafo</a>
                </p>
            </h3>

            <?php
            $get = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['data'])), ENT_QUOTES));

            // Tabela: users
            if ($get === "users") {
                mysql_query("START TRANSACTION");
                $select = "SELECT * FROM $get";
                $q = mysql_query($select);
                if (($q)) {
                    echo("<table class=\"table\">
                <caption><h3>Tabela: $get</h3></caption>
                <thead>
                    <tr>
                        <td>
                            <center>Id do Utilizador</center>
                        </td>
                        <td>
                            <center>Nickname</center>
                        </td>
                        <td>
                            <center>Nome do Utilizador</center>
                        </td>
                        <td>
                            <center>E&dash;mail</center>
                        </td>
                        <td>
                            <center>Password</center>
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
                            <center>Morada</center>
                        </td>
                        <td>
                            <center>Código Postal</center>
                        </td>
                        <td>
                            <center>Freguesia</center>
                        </td>
                        <td>
                            <center>Concelho</center>
                        </td>
                        <td>
                            <center>País</center>
                        </td>
                        <td>
                            <center>Indicativo</center>
                        </td>
                        <td>
                            <center>Telefone</center>
                        </td>
                        <td>
                            <center>Telemóvel</center>
                        </td>
                        <td>
                            <center>GitHub</center>
                        </td>
                        <td>
                            <center>Signed Date</center>
                        </td>
                        <td>
                            <center>Activo</center>
                        </td>
                        <td>
                            <center>Apagar?</center>
                        </td>
                        <td>
                            <center>Revogar?</center>
                        </td>
                    </tr>
                </thead>");
                    while ($row = mysql_fetch_array($q)) {
                        $id = $row['id'];
                        $nickname = $row['nickname'];
                        $prim_nome = $row['primeiro_nome'];
                        $ultim_nome = $row['ultimo_nome'];
                        $email = $row['email'];
                        $password = $row['password'];
                        $idade = $row['idade'];
                        $sexo = $row['sexo'];
                        $registado = $row['registado'];
                        $mora = $row['morada'];
                        $cod = $row['cod_postal'];
                        $fr = $row['freguesia'];
                        $concc = $row['concelho'];
                        $pa = $row['pais'];
                        $ind = $row['indicativo'];
                        $t = $row['telefone'];
                        $tt = $row['telemovel'];
                        $ugh = $row['username_github'];
                        $sd = $row['signed_date'];
                        $activo = $row['active'];
                        echo("<tbody>
                    <tr>
                        <td>
                            $id
                        </td>
                        <td>
                            $nickname
                        </td>
                        <td>");
                        if ($prim_nome === $admin_nome) {
                            echo $prim_nome;
                        } else {
                            echo("<a href=\"sendmessage.php?uh=$id\">$prim_nome $ultim_nome</a>");
                        }
                        echo("</td>
                        <td>");
                        if ($email === $admin_email) {
                            echo ("");
                        } else {
                            echo $email;
                        }
                        echo ("</td>
                        <td>
                            $password
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
                            <center>$mora</center>
                        </td>
                        <td>
                            <center>$cod</center>
                        </td>
                        <td>
                            <center>$fr</center>
                        </td>
                        <td>
                            <center>$concc</center>
                        </td>
                        <td>
                            <center>$pa</center>
                        </td>
                        <td>
                            <center>$ind</center>
                        </td>
                        <td>
                            <center>$t</center>
                        </td>
                        <td>
                            <center>$tt</center>
                        </td>
                        <td>");
                        if ($email === $admin_email) {
                            echo ("");
                        } else {
                            echo ("<a href=\"https://www.github.com/$ugh\">$ugh</a>
                                <br>ou<br>
                                <a href=\"https://www.github.com/search?q=$ugh+in%3Alocation+in%3Ausername&type=Users&ref=searchresults\">pesquisar se existe</a>
                                </td>");
                        }
                        echo ("<td>
                            <center>$sd</center>
                        </td>
                        <td>
                            <center>$activo</center>
                        </td>");
                        if ($email === $admin_email) {
                            echo ("");
                        } else {
                            echo ("<td><a onclick=\"return confirm('Confirma que vai apagar o utilizador ?')\"
                                href=\"del.php?table=$get&id=$id\">Apagar?</a></td>
                                    <td><a onclick=\"return confirm('Confirma que vai revogar o utilizador de contribuir ?')\"
                                href=\"rev.php?table=$get&id=$id\">Revogar?</a></td>");
                        }
                        echo ("</tr>");
                    }
                    echo ("</table>");
                } else {
                    echo ("A tabela não tem registos");
                }
                mysql_query("COMMIT");
                mysql_free_result($q);
                mysql_close();
            }

            // Tabela: rss_noticias
            if ($get === "rss_noticias") {
                mysql_query("START TRANSACTION");
                $select = "SELECT * FROM $get";
                $q = mysql_query($select);
                if (($q)) {
                    echo("<table class=\"table\">
                <caption><h3>Tabela: $get</h3></caption>
                <thead>
                    <tr>
                        <td>
                            Id
                        </td>
                        <td>
                            Título
                        </td>
                        <td>
                            Apagar?
                        </td>
                    </tr>
                </thead>");
                    while ($row = mysql_fetch_array($q)) {
                        $id = $row['id'];
                        $titulo = $row['titulo'];
                        echo("<tbody>
                            <tr>
                        <td>
                            $id
                        </td>
                        <td>
                            $titulo
                        </td>
                        <td><a onclick=\"return confirm('Confirma que vai apagar o registo ?')\"
                                href=\"del.php?table=$get&id=$id\">Apagar?</a></td>
                        </tr>");
                    }
                    echo ("</table>");
                } else {
                    echo ("A tabela não tem registos");
                }
                mysql_query("COMMIT");
                mysql_free_result($q);
                mysql_close();
            }

            // Tabela: mensagens
            if ($get === "mensagens") {
                mysql_query("START TRANSACTION");
                $select = "SELECT * FROM $get";
                $q = mysql_query($select);
                if (($q)) {
                    echo("<table class=\"table\">
                <caption><h3>Tabela: $get</h3></caption>
                <thead>
                    <tr>
                        <td>
                            Id da Mensagem
                        </td>
                        <td>
                            Id dos Anúncios
                        </td>
                        <td>
                            Id do Utilizador
                        </td>
                        <td>
                            Para o Utilizador
                        </td>
                        <td>
                            Mensagem
                        </td>
                        <td>
                            Apagar?
                        </td>
                        </tr>
                </thead>");
                    while ($row = mysql_fetch_array($q)) {
                        $id = $row['id'];
                        $id_anuncios = $row['id_anuncios'];
                        $users_id = $row['users_id'];
                        $for = $row['for_user'];
                        $mensagem = $row['mensagem'];
                        echo("<tbody>
                    <tr>
                        <td>
                            $id
                        </td>
                        <td>
                            $id_anuncios
                        </td>
                        <td>
                            $users_id
                        </td>
                        <td>
                            $for
                        </td>
                        <td>
                            $mensagem
                        </td>
                        <td>
                        <a onclick=\"return confirm('Confirma que vai apagar o registo ?')\"
                                href=\"del.php?table=$get&id=$id\">Apagar?</a></td>
                        </tr>");
                    }
                    echo ("</table>");
                } else {
                    echo ("A tabela não tem registos");
                }
                mysql_query("COMMIT");
                mysql_free_result($q);
                mysql_close();
            }

            // Tabela: contactos
            /*if ($get === "contactos") {
                mysql_query("START TRANSACTION");
                $select = "SELECT * FROM $get";
                $q = mysql_query($select);
                if (($q)) {
                    echo("<table class=\"table\">
                <caption><h3>Tabela: $get</h3></caption>
                <thead>
                    <tr>
                        <td>
                            Id Mensagem
                        </td>
                        <td>
                            Nome
                        </td>
                        <td>
                            Assunto
                        </td>
                        <td>
                            E&dash;mail
                        </td>
                        <td>
                            Mensagem
                        </td>
                        <td>
                            Apagar?
                        </td>
                        </tr>
                </thead>");
                    while ($row = mysql_fetch_array($q)) {
                        $id_mensagem = $row['id_mensagem'];
                        $nome = $row['nome'];
                        $assunto = $row['assunto'];
                        $email = $row['email'];
                        $mensagem = $row['mensagem'];
                        echo("<tbody>
                    <tr>
                        <td>
                            $id_mensagem
                        </td>
                        <td>
                            $nome
                        </td>
                        <td>
                            $assunto
                        </td>
                        <td>
                            $email
                        </td>
                        <td>
                            $mensagem
                        </td>
                        <td>
                        <a onclick=\"return confirm('Confirma que vai apagar o registo ?')\"
                                href=\"del.php?table=$get&id=$id\">Apagar?</a></td>
                        </tr>");
                    }
                    echo ("</table>");
                } else {
                    echo ("A tabela não tem registos");
                }
                mysql_query("COMMIT");
                mysql_free_result($q);
                mysql_close();
            }*/

            // Tabela: anuncios
            if ($get === "anuncios") {
                mysql_query("START TRANSACTION");
                $select = "SELECT * FROM $get";
                $q = mysql_query($select);
                if (($q)) {
                    echo("<table class=\"table\">
                <caption><h3>Tabela: $get</h3></caption>
                <thead>
                    <tr>
                        <td>
                            Id do Anúncio
                        </td>
                        <td>
                            Id do Utilizador
                        </td>
                        <td>
                            Imagem
                        </td>
                        <td>
                            Nome do Anúncio
                        </td>
                        <td>
                            Estado da Peça
                        </td>
                        <td>
                            Preço da Peça
                        </td>
                        <td>
                            Categoria da Peça
                        </td>
                        <td>
                            Descrição do Anúncio
                        </td>
                        <td>
                            Vendido
                        </td>
                        <td>
                            Apagar?
                        </td>
                    </tr>
                </thead>");
                    while ($row = mysql_fetch_array($q)) {
                        $id = $row['id'];
                        $id_user = $row['id_user'];
                        $imagem = $row['imagem_nome'];
                        $nome = $row['nome'];
                        $estado = $row['estado'];
                        $preco = $row['preco'];
                        $peca = $row['peca'];
                        $descricao = $row['descricao'];
                        $vendido = $row['vendido'];
                        echo("<tbody>
                    <tr>
                        <td>
                            $id
                        </td>
                        <td>
                            <a href=\"operations.php?data=users\">$id_user</a>
                        </td>
                        <td>
                            <a href=\"see.php?id=$imagem\"><img src=\"see.php?id=$imagem\" alt=\"\"></a>
                        </td>
                        <td>
                            $nome
                        </td>
                        <td>
                            $estado
                        </td>
                        <td>
                            $preco
                        </td>
                        <td>");
                        search($peca);
                        echo ("</td>
                        <td>
                            $descricao
                        </td>
                        <td>");
                        venda($vendido);
                        echo ("</td>
                        <td>
                        <a onclick=\"return confirm('Confirma que vai apagar o registo ?')\"
                                href=\"del.php?table=$get&id=$id&imagem=$imagem\">Apagar?</a></td>
                   </tr>");
                    }
                    echo ("</table>");
                } else {
                    echo ("A tabela não tem registos");
                }
                mysql_query("COMMIT");
                mysql_free_result($q);
                mysql_close();
            }

            // Tabela: wiki
            if ($get === "wiki") {
                mysql_query("START TRANSACTION");
                $select = "SELECT * FROM $get";
                $q = mysql_query($select);
                if (($q)) {               
				while ($row = mysql_fetch_array($q)) {
					$id_wiki = $row['id'];
					$id = $row['users_id'];
					$peca = $row['peca'];
					$image = $row['imagem_nome'];
					$texto = $row['texto'];
					$date = $row['data'];
					// para obter o id e o nome do utilizador
					$sq = "SELECT * FROM users WHERE id='$id'";
					$s = mysql_query($sq);
					if (($s)) {
						$ro = mysql_fetch_array($s);
					}
					echo ("<center><img src=\"see.php?id=$image\"></center>
					<div class=\"caption\">
					<br>");
					echo("<p>Texto: ".$texto."</p>");
					echo("<p>Registado por: <a href=\"operations.php?data=users\">".$id." - " . $ro['primeiro_nome'] . " " . $ro['ultimo_nome'] . "</a></p>");
					echo("<p>Categoria: ");
						search($peca);
					echo("</p>");
					echo("<p>Em: ".$date."</p>");
					echo("<p><a onclick=\"return confirm('Confirma que vai apagar o registo ?')\"
								href=\"del.php?table=$get&id=$id_wiki&imagem=$image\">Apagar?</a></p>");
				}
				if (empty($image) and empty($texto)) {
					echo ("Não há registos!");
				}
				}
			mysql_query("COMMIT");
			mysql_free_result($q);
			mysql_free_result($s);
			mysql_close();
			}
			
			// Tabela: nostress-desabafo
			if ($get === "nostress_desabafo") {
				mysql_query("START TRANSACTION");
				$select = "SELECT * FROM $get";
				$q = mysql_query($select);
				if (($q)) {               
					while ($row = mysql_fetch_array($q)) {
						$id_nostress = $row['id'];
						$id_users = $row['users_id1'];
						$texto = $row['text'];
						$date = $row['date'];
						// para obter o id e o nome do utilizador
						$sq = "SELECT * FROM users WHERE id='$id_users'";
						$s = mysql_query($sq);
						if (($s)) {
							$ro = mysql_fetch_array($s);
						}
						echo("<p>Registado por: (id) <a href=\"operations.php?data=users\">".$id_users." - " . $ro['primeiro_nome'] . " " . $ro['ultimo_nome'] . "</a></p>");
						echo("<p>Texto: ".$texto."</p>");
						echo("<p>Em: ".$date."</p>");
						echo("<p><a onclick=\"return confirm('Confirma que vai apagar o registo ?')\"
									href=\"del.php?table=$get&id=$id_nostress\">Apagar?</a></p>");
					}
					if (empty($date) and empty($texto)) {
						echo ("Não há registos!");
					}
				}
			mysql_query("COMMIT");
			mysql_free_result($q);
			mysql_free_result($s);
			mysql_close();
			}
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
