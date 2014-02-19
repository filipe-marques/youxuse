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

session_start();

if (!isset($_SESSION['conta'])) {
    $_SESSION['conta'] = 1;
} else {
    $_SESSION['conta']++;
}

?>
<hr>

<div class="container">
    <footer>
        <?php
            if (!$_SESSION['prinome']){
                echo ("<p class=\"text-left\" id=\"lang\"><a href=\"" . $_SERVER['PHP_SELF'] . "?lang=pt\"><img src=\"./resources/img/portugal.png\"></a><a href=\"" . $_SERVER['PHP_SELF'] . "?lang=es\"><img src=\"./resources/img/spain.png\"></a><a href=\"" . $_SERVER['PHP_SELF'] . "?lang=fr\"><img src=\"./resources/img/france.png\"></a><a href=\"" . $_SERVER['PHP_SELF'] . "?lang=uk\"><img src=\"./resources/img/united_kingdom.png\"></a><a href=\"" . $_SERVER['PHP_SELF'] . "?lang=us\"><img src=\"./resources/img/usa.png\"></a><a href=\"" . $_SERVER['PHP_SELF'] . "?lang=br\"><img src=\"./resources/img/brazil.png\"></a></p>");
            }
            ?>
        <p class="text-center"><a href="freeopensoft.php"><?php echo LABEL_FOOTER_TEXT1;?></a> - <a href="terms.php"><?php echo LABEL_FOOTER_TEXT2;?></a> - <a href="conduta.php"><?php echo LABEL_FOOTER_TEXT3;?></a> - <a data-toggle="tooltip" title="<?php echo LABEL_FOOTER_TEXT15; ?>" href="user.php?user=developer&contribute=yes"><?php echo LABEL_FOOTER_TEXT4;?><i class="icon-question-sign"></i></a> - <a href="faq.php"><?php echo LABEL_FOOTER_TEXT5;?></a> - <a data-toggle="tooltip" title="<?php echo LABEL_FOOTER_TEXT15; ?>" href="apps.php"><?php echo LABEL_FOOTER_TEXT14;?><i class="icon-question-sign"></i></a></p>
        <p class="text-left">YouXuse&trade; &copy; 2013 v. 2.0.1 - Codename: Vitoria</p>
        <p class="text-left"><?php echo LABEL_FOOTER_TEXT6;?> <a href="https://plus.google.com/110434741360705159101"><img src="resources/img/glyphicons_382_google_plus.png"></a> <?php echo LABEL_FOOTER_TEXT7;?> <a href="https://www.facebook.com/profile.php?id=100004437103780"><img src="resources/img/glyphicons_410_facebook.png"></a>.</p>
        <p class="text-left"><?php echo LABEL_FOOTER_TEXT8;?> <a href="license.php">GNU Affero GPL version 3</a></p>
        <p class="text-left"><?php echo LABEL_FOOTER_TEXT9;?> <a href="http://www.glyphicons.com">Glyphicons</a> <?php echo LABEL_FOOTER_TEXT10;?> <a href="freeopensoft.php"><?php echo LABEL_FOOTER_TEXT11;?></a></p>
        <p class="text-left"><a href="humans.txt"><img src="resources/img/humanstxt.gif"></a></p>
        <p class="text-left"><?php echo LABEL_FOOTER_TEXT12;?> <?php echo $_SESSION['conta'] ?> <?php echo LABEL_FOOTER_TEXT13;?></p>
    </footer>
    
</div>
