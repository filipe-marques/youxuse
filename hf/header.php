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
require_once ("gravatar/grav.php");
require_once ("session/check_user.php");
?>
<script src="resources/js/bootstrap-dropdown.js"></script>

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="youxuse.php"><img src="resources/img/youxuse.png">&trade;&copy; <i class="icon-thumbs-up icon-white"></i></a>
            <div class="nav-collapse collapse">
                <ul class="nav"><!-- pôr o domínio do site: http://www.youxuse.com -->
                    <li><a href="index.php"><?php echo LABEL_HEADER_TEXT1; ?> <i class="icon-home icon-white"></i></a></li>
                    <li><a href="annou.php?search=DM01"><?php echo LABEL_HEADER_TEXT2; ?> <i class="icon-shopping-cart icon-white"></i></a></li>
                    <?php
                    if (isset($_SESSION['prinome'])) {
                        echo("<li><a href=\"user.php?user=criaranuncio\">" . LABEL_HEADER_TEXT3 . " <i class=\"icon-upload icon-white\"></i></a></li>");
                        echo("<li class=\"dropdown\">
                            <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">" . LABEL_HEADER_TEXT4 . " 
                            <b class=\"caret\"></b><i class=\"icon-wrench icon-white\"></i></a>
                            <ul class=\"dropdown-menu\">
                            <li>
                            <a href=\"user.php?user=conta\">" . LABEL_HEADER_TEXT5 . "</a>
                            </li>
                            <li>
                            <a href=\"user.php?user=anuncios\">" . LABEL_HEADER_TEXT6 . "</a>
                            </li>
                            <li>
                            <a href=\"user.php?user=leave\">" . LABEL_HEADER_TEXT7 . "</a>
                            </li>
                            </ul>
                            </li>");
                        echo("<li><a href=\"wiki.php\">" . LABEL_HEADER_TEXT8 . " <i class=\"icon-book icon-white\"></i></a></li>");
                        echo("<li><a href=\"donate.php\">" . LABEL_HEADER_TEXT9 . " <i class=\"icon-heart icon-white\"></i></a></li>");
                    } else {
                        echo("<li><a href=\"signup.php\">" . LABEL_HEADER_TEXT10 . " <i class=\"icon-plus-sign icon-white\"></i></a></li>");
                        echo("<li><a href=\"signin.php\">" . LABEL_HEADER_TEXT11 . " <i class=\"icon-play icon-white\"></i></a></li>");
                        echo("<li><a href=\"wiki.php\">" . LABEL_HEADER_TEXT8 . " <i class=\"icon-book icon-white\"></i></a></li>");
                        echo("<li><a href=\"donate.php\">" . LABEL_HEADER_TEXT9 . " <i class=\"icon-heart icon-white\"></i></a></li>");
                        echo("<li><a href=\"contactus.php\">" . LABEL_HEADER_TEXT12 . " <i class=\"icon-envelope icon-white\"></i></a></li>");
                    }

                    $size = 20;
                    $ddd = "identicon";
                    $rr = "g";

                    if (isset($_SESSION['prinome'])) {
						$all_name = ($_SESSION['prinome'] . " " . $_SESSION['ultnome']);
                        echo("<li class=\"dropdown\">
                            <a class=\"dropdown-toggle\" href=\"user.php?page=initial\">
                            " . sexo() . " " . $all_name . " " . get_gravatar($_SESSION['email'], $size, $ddd, $rr, true, '') . "
                            </a>
                            </li>");
                            echo("<li><a href=\"logout.php\">" . LABEL_HEADER_TEXT16 . " <i class=\"icon-user icon-white\"></i></a></li>");
                    }
                    ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>
<div class="container">
	<center>
		<?php // tag like and share?>
		<iframe src="//www.facebook.com/plugins/like.php?href=https://www.facebook.com/youxuse&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=false&amp;share=true&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:25px;" allowTransparency="true"></iframe>
		<?php // tag +1 button ?>
		<div class="g-plusone" data-size="tall" data-annotation="inline" data-width="300" data-href="https://plus.google.com/116778377892072300095"></div>
		<script type="text/javascript">
			(function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			})();
		</script>
	</center>
	<br>
    <?php
    if (!$_SESSION['prinome']) {
        echo ("<h4><p class=\"text-left\">This is not your language, isn't ? <a href=\"#lang\">Change it</a> or <a href=\"signin.php\">sign up</a> !</p></h4>");
    }
    ?>
</div>
