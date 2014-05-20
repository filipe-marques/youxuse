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
require ("database/connect.php");
require_once("process/functions.php");

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

if (isset($_POST['submitindividual'])) {
    $mo = mysql_escape_string(htmlspecialchars(trim($_POST['morada']), ENT_QUOTES));
    $po = mysql_escape_string(htmlspecialchars(trim($_POST['postal']), ENT_QUOTES));
    $fre = mysql_escape_string(htmlspecialchars(trim($_POST['freguesia']), ENT_QUOTES));
    $con = mysql_escape_string(htmlspecialchars(trim($_POST['concelho']), ENT_QUOTES));
    $in = mysql_escape_string(htmlspecialchars(trim($_POST['indicativo']), ENT_QUOTES));
    $tel = mysql_escape_string(htmlspecialchars(trim($_POST['telefone']), ENT_QUOTES));
    $tele = mysql_escape_string(htmlspecialchars(trim($_POST['telemovel']), ENT_QUOTES));
    $git = mysql_escape_string(htmlspecialchars(trim($_POST['github']), ENT_QUOTES));
    $datq = date('Y-m-d');

    if (strlen($mo) > 60 or strlen($po) > 10 or strlen($fre) > 20 or strlen($con) > 20 or strlen($in) > 10 or strlen($tel) > 9 or strlen($tele) > 9 or strlen($git) > 40 or (!is_numeric($tel)) or (!is_numeric($tele)) or (strlen($tel) < 9) or (strlen($tele) < 9)) {
        echo ("<br><br><br><div class=\"alert alert-error\"><h2><p class=\"text-center\">" . LABEL_CONTRIBUTE_TEXT1 . "</p></div>");
        echo ("<div class=\"alert alert-error\"><h2><p class=\"text-center\">" . LABEL_CONTRIBUTE_TEXT2 . "</p></div>");
        echo ("<div class=\"alert alert-error\"><h2><p class=\"text-center\">" . LABEL_CONTRIBUTE_TEXT3 . "</p></div>");
    } else {
        mysql_query("START TRANSACTION");
        $sql = "UPDATE users SET morada='$mo',cod_postal='$po',freguesia='$fre',concelho='$con',indicativo='$in',telefone='$tel',telemovel='$tele',username_github='$git',signed_date='$datq' WHERE email='" . $_SESSION['email'] . "'";
        $consul = mysql_query($sql);
        $num = mysql_affected_rows();
        if (($consul)) {
            echo ("<br><br><br><div class=\"alert alert-success\"><h2><p class=\"text-center\">" . LABEL_CONTRIBUTE_TEXT4 . " $num " . LABEL_CONTRIBUTE_TEXT5 . "<br>
				<a href=\"https://www.github.com/filipe-marques/youxuse\">" . LABEL_CONTRIBUTE_TEXT6 . "</a>
				<br> " . LABEL_CONTRIBUTE_TEXT7 . " <a href=\"user.php?user=developer&contribute=yes\">" . LABEL_CONTRIBUTE_TEXT8 . "</a></p></div>");
            mysql_query("COMMIT");
        } else {
            echo ("<br><br><br><div class=\"alert alert-error\"><h2>" . LABEL_CONTRIBUTE_TEXT9 . "</h2></div>");
            mysql_query("ROLLBACK");
        }
        mysql_free_result($consul);
        mysql_close();
    }
}
/*
	if (isset($_POST['submitenterprise'])) {
		
		// fazer uma tabela com ligação á tabela users de relação 1 para 1 com o nome enterprise
		
		$mo = mysql_escape_string(htmlspecialchars(trim($_POST['morada']), ENT_QUOTES));
		$po = mysql_escape_string(htmlspecialchars(trim($_POST['postal']), ENT_QUOTES));
		$fre = mysql_escape_string(htmlspecialchars(trim($_POST['freguesia']), ENT_QUOTES));
		$con = mysql_escape_string(htmlspecialchars(trim($_POST['concelho']), ENT_QUOTES));
		$in = mysql_escape_string(htmlspecialchars(trim($_POST['indicativo']), ENT_QUOTES));
		$tel = mysql_escape_string(htmlspecialchars(trim($_POST['telefone']), ENT_QUOTES));
		$tele = mysql_escape_string(htmlspecialchars(trim($_POST['telemovel']), ENT_QUOTES));
		$git = mysql_escape_string(htmlspecialchars(trim($_POST['github']), ENT_QUOTES));
		$datq = date('Y-m-d');

		$sql = "UPDATE  SET morada='$mo',cod_postal='$po',freguesia='$fre',concelho='$con',indicativo='$in',telefone='$tel',telemovel='$tele',username_github='$git',signed_date='$datq' WHERE email='" . $_SESSION['email'] . "'";
		$co = mysql_query($sql);
		$num = mysql_affected_rows();
		if (($co)) {
			echo ("<div class=\"alert alert-success\"><h2><p class=\"text-center\">Operação efectuada com sucesso, em que foi alterado $num registo!<br>
				<a href=\"https://www.github.com/filipe-marques/youxuse\">Podes Contribuir!</a>
				<br> Voltar á <a href=\"user.php?user=developer&contribute=yes\">página anterior</a></p></div>");
		} else {
			echo ("<div class=\"alert alert-error\"><h2>Aconteceu um erro nos dados fornecidos!</h2></div>");
		}
	mysql_free_result($co);
	mysql_close();
	}*/
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo (sexo() . " " . $_SESSION['nome']); ?> &dash; YouXuse &dash; Venda &AMP; Compra pe&ccedil;as usadas de tecnologia</title>
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

            <a href="contribute.php?cla=individual"><?php echo LABEL_CONTRIBUTE_TEXT25; ?></a><!-- ou <a href="contribute.php?cla=enterprise">Desenvolvedor que trabalha numa empresa</a>-->

            <?php
				$cl = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['cla'])), ENT_QUOTES));
				if ($cl == 'individual') {
					echo("<form action=\"contribute.php\" method=\"POST\">
					<br>
					<h3><p class=\"text-center\">YouXuse Individual Contributor License Agreement</p></h3><br>
					Thank you for your interest in contributing to YouXuse (\"We\" or \"Us\").
					<br><br>This contributor agreement (\"Agreement\") documents the rights granted by contributors to Us. <br><br>To
					make this document effective, please sign it.<br><br> This is a legally binding document, so please read it carefully before agreeing to it.
					<br><br>The Agreement may cover more than one software project managed by Us.
					<br><br>
					1. Definitions<br><br>
					\"You\" means the individual who Submits a Contribution to Us.<br><br>
					\"Contribution\" means any work of authorship that is Submitted by You to Us in which You own
					or assert ownership of the Copyright. If You do not own the Copyright in the entire work of
					authorship, please <a href=\"contactus.php\">contact us</a>.
					<br><br>
					\"Copyright\" means all rights protecting works of authorship owned or controlled by You,
					including copyright, moral and neighboring rights, as appropriate, for the full term of their
					existence including any extensions by You.
					<br><br>
					\"Material\" means the work of authorship which is made available by Us to third parties. When
					this Agreement covers more than one software project, the Material means the work of authorship
					to which the Contribution was Submitted. After You Submit the Contribution, it may be included
					in the Material.
					<br><br>
					\"Submit\" means any form of electronic, verbal, or written communication sent to Us or our
					representatives, including but not limited to electronic mailing lists, source code control systems,
					and issue tracking systems that are managed by, or on behalf of, Us for the purpose of discussing
					and improving the Material, but excluding communication that is conspicuously marked or
					otherwise designated in writing by You as \"Not a Contribution.\"
					<br><br>
					\"Submission Date\" means the date on which You Submit a Contribution to Us.
					<br><br>
					\"Effective Date\" means the date You execute this Agreement or the date You first Submit a
					Contribution to Us, whichever is earlier.
					<br><br>
					\"Media\" means any portion of a Contribution which is not software.
					<br><br>
					2. Grant of Rights
					<br><br>
					2.1 Copyright License
					<br><br>
					(a) You retain ownership of the Copyright in Your Contribution and have the same rights to use or
					license the Contribution which You would have had without entering into the Agreement.
					(b) To the maximum extent permitted by the relevant law, You grant to Us a perpetual, worldwide,
					non-exclusive, transferable, royalty-free, irrevocable license under the Copyright covering the
					Contribution, with the right to sublicense such rights through multiple tiers of sublicensees, to
					reproduce, modify, display, perform and distribute the Contribution as part of the Material; provided
					that this license is conditioned upon compliance with Section 2.3.
					<br><br>
					2.2 Patent License
					<br><br>
					For patent claims including, without limitation, method, process, and apparatus claims which You
					own, control or have the right to grant, now or in the future, You grant to Us a perpetual, worldwide,
					non-exclusive, transferable, royalty-free, irrevocable patent license, with the right to sublicense these
					rights to multiple tiers of sublicensees, to make, have made, use, sell, offer for sale, import and
					otherwise transfer the Contribution and the Contribution in combination with the Material (and
					portions of such combination). This license is granted only to the extent that the exercise of the
					licensed rights infringes such patent claims; and provided that this license is conditioned upon
					compliance with Section 2.3.
					<br><br>
					2.3 Outbound License
					<br><br>
					As a condition on the grant of rights in Sections 2.1 and 2.2, We agree to license the Contribution 
					under the terms of the license <a href=\"license.php\">GNU Affero General Public License version 3</a> (including any right to
					adopt any future version of this license) on the Submission Date for the Material.
					In addition, We use the following license for Media in the Contribution: <a href=\"license.php#freedocumentation\">GNU Free Documentation License version 1.3</a>
					(including any right to adopt any future version of this license).
					<br><br>
					2.4 Moral Rights. If moral rights apply to the Contribution, to the maximum extent permitted by law,
					You waive and agree not to assert such moral rights against Us or our successors in interest, or any of
					our licensees, either direct or indirect.
					<br><br>
					2.5 Our Rights. You acknowledge that We are not obligated to use Your Contribution as part of the
					Material and may decide to include any Contribution We consider appropriate.
					<br><br>
					2.6 Reservation of Rights. Any rights not expressly assigned or licensed under this section are
					expressly reserved by You.
					<br><br>
					3. Agreement
					<br><br>
					You confirm that:<br>
					(a) You have the legal authority to enter into this Agreement.<br>
					(b) You own the Copyright and patent claims covering the Contribution which are required to grant
					the rights under Section 2.<br>
					(c) The grant of rights under Section 2 does not violate any grant of rights which You have made to
					third parties, including Your employer. If You are an employee, You have had Your employer approve
					this Agreement or sign the Entity version of this document. If You are less than eighteen years old,
					please have Your parents or guardian sign the Agreement.<br>
					(d) You have followed the instructions in , if You do not own the Copyright in the entire work of
					authorship Submitted.<br><br>
					4. Disclaimer<br><br>
					EXCEPT FOR THE EXPRESS WARRANTIES IN SECTION 3, THE CONTRIBUTION IS
					PROVIDED \"AS IS\". MORE PARTICULARLY, ALL EXPRESS OR IMPLIED WARRANTIES
					INCLUDING, WITHOUT LIMITATION, ANY IMPLIED WARRANTY OF MERCHANTABILITY,
					FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT ARE EXPRESSLY
					DISCLAIMED BY YOU TO US AND BY US TO YOU. TO THE EXTENT THAT ANY SUCH
					WARRANTIES CANNOT BE DISCLAIMED, SUCH WARRANTY IS LIMITED IN DURATION
					TO THE MINIMUM PERIOD PERMITTED BY LAW.<br><br>
					5. Consequential Damage Waiver<br><br>
					TO THE MAXIMUM EXTENT PERMITTED BY APPLICABLE LAW, IN NO EVENT WILL
					YOU OR US BE LIABLE FOR ANY LOSS OF PROFITS, LOSS OF ANTICIPATED SAVINGS,
					LOSS OF DATA, INDIRECT, SPECIAL, INCIDENTAL, CONSEQUENTIAL AND EXEMPLARY
					DAMAGES ARISING OUT OF THIS AGREEMENT REGARDLESS OF THE LEGAL OR
					EQUITABLE THEORY (CONTRACT, TORT OR OTHERWISE) UPON WHICH THE CLAIM IS
					BASED.<br><br>
					6. Miscellaneous<br><br>
					6.1 This Agreement will be governed by and construed in accordance with the laws of excluding its
					conflicts of law provisions. Under certain circumstances, the governing law in this section might be
					superseded by the United Nations Convention on Contracts for the International Sale of Goods (\"UN
					Convention\") and the parties intend to avoid the application of the UN Convention to this Agreement
					and, thus, exclude the application of the UN Convention in its entirety to this Agreement.<br><br>
					6.2 This Agreement sets out the entire agreement between You and Us for Your Contributions to Us
					and overrides all other agreements or understandings.<br><br>
					6.3 If You or We assign the rights or obligations received through this Agreement to a third party, as a
					condition of the assignment, that third party must agree in writing to abide by all the rights and
					obligations in the Agreement.<br><br>
					6.4 The failure of either party to require performance by the other party of any provision of this
					Agreement in one situation shall not affect the right of a party to require such performance at any time
					in the future. A waiver of performance under a provision in one situation shall not be considered a
					waiver of the performance of the provision in the future or a waiver of the provision in its entirety.<br><br>
					6.5 If any provision of this Agreement is found void and unenforceable, such provision will be 
					replaced to the extent possible with a provision that comes closest to the meaning of the original
					provision and which is enforceable. The terms and conditions set forth in this Agreement shall apply
					notwithstanding any failure of essential purpose of this Agreement or any limited remedy to the
					maximum extent possible under law.<br><br>
					
					<h3><p class=\"text-center\">" . LABEL_CONTRIBUTE_TEXT28 . "</p></h3><br><br>");

					echo ("<label class=\"label label-success\"><h4>" . LABEL_CONTRIBUTE_TEXT10 . " " . $_SESSION['prinome'] . " " . $_SESSION['ultnome'] . "</h4></label><br>
					<label class=\"label label-success\"><h4>" . LABEL_CONTRIBUTE_TEXT11 . " " . $_SESSION['email'] . "</h4></label><br>
					<label class=\"label label-success\"><h4>" . LABEL_CONTRIBUTE_TEXT12 . " " . $_SESSION['idade'] . " anos</h4></label><br>
					<label class=\"label label-success\"><h4>" . LABEL_CONTRIBUTE_TEXT13 . " " . $_SESSION['registado'] . "</h4></label><br>
					<label class=\"label label-success\"><h4>" . LABEL_CONTRIBUTE_TEXT14 . " ");
					translate_country($_SESSION['pais']);
					echo("</h4></label>");
					echo("<legend>" . LABEL_CONTRIBUTE_TEXT26 . "</legend>
					<input type=\"text\" name=\"morada\" id=\"morada\" class=\"input-block-level\" placeholder=\"" . LABEL_CONTRIBUTE_TEXT26 . "\" required />
					<legend>" . LABEL_CONTRIBUTE_TEXT27 . "</legend>
					<input type=\"text\" name=\"postal\" id=\"postal\" class=\"input-block-level\" placeholder=\"" . LABEL_CONTRIBUTE_TEXT27 . "\" required />");
					if ($_SESSION['pais'] == 'Portugal') {
						echo ("<legend>a freguesia onde moras</legend>
							<input type=\"text\" name=\"freguesia\" id=\"freguesia\" class=\"input-block-level\" placeholder=\"a freguesia onde moras\" required />
							<legend>o concelho onde moras</legend>
							<input type=\"text\" name=\"concelho\" id=\"concelho\" class=\"input-block-level\" placeholder=\"o concelho onde moras\" required />");
					}
					if ($_SESSION['pais'] == 'França') {
						echo ("<legend>o nome do departamento</legend>
					<input type=\"text\" name=\"departamento\" id=\"departamento\" class=\"input-block-level\" placeholder=\"o nome do departamento\" required />");
					}
					if ($_SESSION['pais'] == 'USA') {
						echo ("<legend>the name of the state</legend>
					<input type=\"text\" name=\"estado\" id=\"estado\" class=\"input-block-level\" placeholder=\"o nome do estado\" required />");
					}
					echo ("<legend>" . LABEL_CONTRIBUTE_TEXT15 . "</legend>
					<input type=\"tel\" name=\"indicativo\" id=\"indicativo\" class=\"input-block-level\" placeholder=\"" . LABEL_CONTRIBUTE_TEXT16 . "\" required />
					<legend>" . LABEL_CONTRIBUTE_TEXT17 . "</legend>
					<input type=\"tel\" name=\"telefone\" id=\"telefone\" class=\"input-block-level\" placeholder=\"" . LABEL_CONTRIBUTE_TEXT18 . "\" required />
					<legend>" . LABEL_CONTRIBUTE_TEXT19 . "</legend>
					<input type=\"tel\" name=\"telemovel\" id=\"telemovel\" class=\"input-block-level\" placeholder=\"" . LABEL_CONTRIBUTE_TEXT20 . "\" required />
					<legend>" . LABEL_CONTRIBUTE_TEXT21 . "</legend>
					<input type=\"text\" name=\"github\" id=\"github\" class=\"input-block-level\" placeholder=\"" . LABEL_CONTRIBUTE_TEXT22 . "\" required />
					<br>
					<p class=\"text-center\"><button class=\"btn btn-large btn-success\" type=\"submit\" name=\"submitindividual\">" . LABEL_CONTRIBUTE_TEXT23 . " <i class=\"icon-ok icon-white\"></i></button>
						<button class=\"btn btn-large btn-danger\" type=\"reset\">" . LABEL_CONTRIBUTE_TEXT24 . " <i class=\"icon-remove icon-white\"></i></button></p>
				</form>");
				}
/*
				$cla = $_GET['cla'];
				if ($cla == 'enterprise') {
					echo ("<form action=\"contribute.php\" method=\"POST\"><br>
						<h3><p class=\"text-center\">YouXuse Entity Contributor License Agreement<p></h3><br>
						Thank you for your interest in contributing to YouXuse (\"We\" or \"Us\").
						<br><br>This contributor agreement (\"Agreement\") documents the rights granted by contributors to Us. <br><br>To
						make this document effective, please sign it. <br><br>This is a legally binding document, so please read it carefully before agreeing to it.
						<br><br>The Agreement may cover more than one software project managed by Us.<br><br>
						1. Definitions<br><br>
						\"You\" means any Legal Entity on behalf of whom a Contribution has been received by Us.<br><br>
						\"Legal Entity\" means an entity which is not a natural person.<br><br>
						\"Affiliates\" means other Legal Entities that control, are controlled by, or under common control with that Legal Entity. For the purposes of
						this definition,<br><br>
						\"control\" means (i) the power, direct or indirect, to cause the direction or
						management of such Legal Entity, whether by contract or otherwise, (ii) ownership of fifty
						percent (50%) or more of the outstanding shares or securities which vote to elect the management
						or other persons who direct such Legal Entity or (iii) beneficial ownership of such entity.
						<br><br>
						\"Contribution\" means any work of authorship that is Submitted by You to Us in which You own
						or assert ownership of the Copyright. If You do not own the Copyright in the entire work of
						authorship, please <a href=\"contactus.php\">contact us</a>.
						<br><br>
						\"Copyright\" means all rights protecting works of authorship owned or controlled by You or Your
						Affiliates, including copyright, moral and neighboring rights, as appropriate, for the full term of
						their existence including any extensions by You.
						<br><br>
						\"Material\" means the work of authorship which is made available by Us to third parties. When
						this Agreement covers more than one software project, the Material means the work of authorship
						to which the Contribution was Submitted. After You Submit the Contribution, it may be included
						in the Material.
						<br><br>
						\"Submit\" means any form of electronic, verbal, or written communication sent to Us or our
						representatives, including but not limited to electronic mailing lists, source code control systems,
						and issue tracking systems that are managed by, or on behalf of, Us for the purpose of discussing
						and improving the Material, but excluding communication that is conspicuously marked or
						otherwise designated in writing by You as \"Not a Contribution.\"
						<br><br>
						\"Submission Date\" means the date on which You Submit a Contribution to Us.
						<br><br>
						\"Effective Date\" means the date You execute this Agreement or the date You first Submit a
						Contribution to Us, whichever is earlier.
						<br><br>
						\"Media\" means any portion of a Contribution which is not software.
						<br><br>
						2. Grant of Rights<br><br>
						2.1 Copyright License
						<br><br>
						(a) You retain ownership of the Copyright in Your Contribution and have the same rights to use or
						license the Contribution which You would have had without entering into the Agreement.
						<br><br>
						(b) To the maximum extent permitted by the relevant law, You grant to Us a perpetual, worldwide,
						non-exclusive, transferable, royalty-free, irrevocable license under the Copyright covering the
						Contribution, with the right to sublicense such rights through multiple tiers of sublicensees, to
						reproduce, modify, display, perform and distribute the Contribution as part of the Material; provided
						that this license is conditioned upon compliance with Section 2.3.
						<br><br>
						2.2 Patent License<br><br>
						For patent claims including, without limitation, method, process, and apparatus claims which You or
						Your Affiliates own, control or have the right to grant, now or in the future, You grant to Us a
						perpetual, worldwide, non-exclusive, transferable, royalty-free, irrevocable patent license, with the
						right to sublicense these rights to multiple tiers of sublicensees, to make, have made, use, sell, offer
						for sale, import and otherwise transfer the Contribution and the Contribution in combination with the
						Material (and portions of such combination). This license is granted only to the extent that the
						exercise of the licensed rights infringes such patent claims; and provided that this license is
						conditioned upon compliance with Section 2.3.
						<br><br>
						2.3 Outbound License<br><br>
						As a condition on the grant of rights in Sections 2.1 and 2.2, We agree to license the Contribution
						under the terms of the license <a href=\"license.php\">GNU Affero General Public License v3</a> (including any right to
						adopt any future version of this license) on the Submission Date for the Material.
						In addition, We use the following license for Media in the Contribution: <a href=\"license.php\">GNU Affero General Public License v3</a>
						(including any right to adopt any future version of this license).<br><br>
						2.4 Moral Rights. If moral rights apply to the Contribution, to the maximum extent permitted by law,
						You waive and agree not to assert such moral rights against Us or our successors in interest, or any of
						our licensees, either direct or indirect.<br><br>
						2.5 Our Rights. You acknowledge that We are not obligated to use Your Contribution as part of the
						Material and may decide to include any Contribution We consider appropriate.<br><br>
						2.6 Reservation of Rights. Any rights not expressly assigned or licensed under this section are
						expressly reserved by You.<br><br>
						3. Agreement<br><br>
						You confirm that:<br>
						(a) You have the legal authority to enter into this Agreement.<br>
						(b) You or Your Affiliates own the Copyright and patent claims covering the Contribution which are
						required to grant the rights under Section 2.<br>
						(c) The grant of rights under Section 2 does not violate any grant of rights which You or Your
						Affiliates have made to third parties.<br>
						(d) You have followed the instructions in , if You do not own the Copyright in the entire work of
						authorship Submitted.<br><br>
						4. Disclaimer<br><br>
						EXCEPT FOR THE EXPRESS WARRANTIES IN SECTION 3, THE CONTRIBUTION IS
						PROVIDED \"AS IS\". MORE PARTICULARLY, ALL EXPRESS OR IMPLIED WARRANTIES
						INCLUDING, WITHOUT LIMITATION, ANY IMPLIED WARRANTY OF MERCHANTABILITY,
						FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT ARE EXPRESSLY
						DISCLAIMED BY YOU TO US AND BY US TO YOU. TO THE EXTENT THAT ANY SUCH
						WARRANTIES CANNOT BE DISCLAIMED, SUCH WARRANTY IS LIMITED IN DURATION
						TO THE MINIMUM PERIOD PERMITTED BY LAW.<br><br>
						5. Consequential Damage Waiver<br><br>
						TO THE MAXIMUM EXTENT PERMITTED BY APPLICABLE LAW, IN NO EVENT WILL
						YOU OR US BE LIABLE FOR ANY LOSS OF PROFITS, LOSS OF ANTICIPATED SAVINGS,
						LOSS OF DATA, INDIRECT, SPECIAL, INCIDENTAL, CONSEQUENTIAL AND EXEMPLARY
						DAMAGES ARISING OUT OF THIS AGREEMENT REGARDLESS OF THE LEGAL OR
						EQUITABLE THEORY (CONTRACT, TORT OR OTHERWISE) UPON WHICH THE CLAIM IS
						BASED.<br><br>
						6. Miscellaneous<br><br>
						6.1 This Agreement will be governed by and construed in accordance with the laws of excluding its
						conflicts of law provisions. Under certain circumstances, the governing law in this section might be
						superseded by the United Nations Convention on Contracts for the International Sale of Goods (\"UN
						Convention\") and the parties intend to avoid the application of the UN Convention to this Agreement
						and, thus, exclude the application of the UN Convention in its entirety to this Agreement.<br><br>
						6.2 This Agreement sets out the entire agreement between You and Us for Your Contributions to Us
						and overrides all other agreements or understandings.<br><br>
						6.3 If You or We assign the rights or obligations received through this Agreement to a third party, as a
						condition of the assignment, that third party must agree in writing to abide by all the rights and
						obligations in the Agreement.<br><br>
						6.4 The failure of either party to require performance by the other party of any provision of this
						Agreement in one situation shall not affect the right of a party to require such performance at any time
						in the future. A waiver of performance under a provision in one situation shall not be considered a
						waiver of the performance of the provision in the future or a waiver of the provision in its entirety.<br><br>
						6.5 If any provision of this Agreement is found void and unenforceable, such provision will be
						replaced to the extent possible with a provision that comes closest to the meaning of the original
						provision and which is enforceable. The terms and conditions set forth in this Agreement shall apply
						notwithstanding any failure of essential purpose of this Agreement or any limited remedy to the
						maximum extent possible under law.<br><br>

						<h3><p class=\"text-center\">Preenche este formulário:</p></h3><br><br>
						<legend>o nome da empresa onde trabalhas</legend>
						<input type=\"text\" name=\"empresa\" id=\"empresa\" class=\"input-block-level\" placeholder=\"o nome da empresa onde trabalhas\" required />
						<br>
						<legend>o email geral da empresa</legend>
						<input type=\"text\" name=\"emailempresa\" id=\"emailempresa\" class=\"input-block-level\" placeholder=\"o email geral da empresa\" required />
						<br>
						<legend>o nome do funcionário encarregado</legend>
						<input type=\"text\" name=\"funcempresa\" id=\"funcempresa\" class=\"input-block-level\" placeholder=\"o nome do funcionário encarregado\" required />");
						
						if ($_SESSION['pais'] == 'pt') {
							echo ("<legend>a morada da empresa (código postal, ...)</legend>
								<input type=\"text\" name=\"freguesia\" id=\"freguesia\" class=\"input-block-level\" placeholder=\"a morada da empresa (código postal, ...)\" required />");
						}
						if ($_SESSION['pais'] == 'fr') {
							echo ("<legend>a morada da empresa (código postal, ...)</legend>
								<input type=\"text\" name=\"freguesia\" id=\"freguesia\" class=\"input-block-level\" placeholder=\"a morada da empresa (código postal, ...)\" required />");
						}
						if ($_SESSION['pais'] == 'us') {
							echo ("<legend>a morada da empresa (código postal, ...)</legend>
								<input type=\"text\" name=\"freguesia\" id=\"freguesia\" class=\"input-block-level\" placeholder=\"a morada da empresa (código postal, ...)\" required />");
						}
						echo ("<!--<legend>O teu código postal (exemplo: 3450-206)</legend>
						<input type=\"text\" name=\"postal\" id=\"postal\" class=\"input-block-level\" placeholder=\"o teu código postal\" required />
						<legend>O indicativo (telefone, telemóvel) do país</legend>
						<input type=\"text\" name=\"indicativo\" id=\"indicativo\" class=\"input-block-level\" placeholder=\"o indicativo do país\" required />
						<legend>O teu número de telefone</legend>
						<input type=\"text\" name=\"telefone\" id=\"telefone\" class=\"input-block-level\" placeholder=\"o número de telefone\" required />
						<legend>O teu número de telemóvel</legend>
						<input type=\"text\" name=\"telemovel\" id=\"telemovel\" class=\"input-block-level\" placeholder=\"o número de telemóvel\" required />
						<legend>O teu nome de utilizador no GitHub</legend>
						<input type=\"text\" name=\"github\" id=\"github\" class=\"input-block-level\" placeholder=\"nome de utilizador no GitHub\" required />
						<label for=\"checkbox\">Concordas com o Contributor License Agreement acima descrito ? </label><input id=\"checkbox\" type=\"checkbox\" />
						<br>-->
						<p class=\"text-center\"><button class=\"btn btn-large btn-success\" type=\"submit\" name=\"submitenterprise\">Contribuir <i class=\"icon-ok icon-white\"></i></button>
						<button class=\"btn btn-large btn-danger\" type=\"reset\">Apagar <i class=\"icon-remove icon-white\"></i></button></p>
						</form>");
				}*/
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
