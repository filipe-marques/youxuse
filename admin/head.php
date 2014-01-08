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

require_once ("../session/check_user.php");

nothing();
is_not_admin();
?>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand"><img src="../resources/img/youxuse.png">&trade;&copy;<i class="icon-thumbs-up icon-white"></i></a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <?php
                    if ($_SESSION['prinome'] == "admin") {
                        echo("<li><a href=\"createnewsletter.php\">Criar NewsLetter <i class=\"icon-tag icon-white\"></i></a></li>");
                        echo("<li><a href=\"operations.php?data=users\">Opera&ccedil;&otilde;es <i class=\"icon-eye-open icon-white\"></i></a></li>");
                        echo("<li><a href=\"messages.php\">Ver Mensagens <i class=\"icon-envelope icon-white\"></i></a></li>");
                        echo("<li><a href=\"ip.php\">Ver Endereços IP <i class=\"icon-globe icon-white\"></i></a></li>");
                        echo("<li><a href=\"sendrss.php\">Mandar RSS FEED <i class=\"icon-bell icon-white\"></i></a></li>");
                        echo("<li><a href=\"admin.php\">Bem&dash;vindo " . $_SESSION['prinome'] . " " . $_SESSION['ultnome'] . "</a></li>");
                        echo("<li><a href=\"../logout.php\">Sair! <i class=\"icon-user icon-white\"></i></a></li>");
                    }
                    ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>
