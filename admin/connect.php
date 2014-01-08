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

// this file connect.php is required in other files
require_once("../store.php");

// class definition
class Connection_ADMIN{
    
    // the public properties of the class definition
    public $mensagem = "N&atilde;o foi poss&iacute;vel ligar &aacute; base de dados !";
    public $environ = ENVIRON;
    public $uses = USES;
    public $password = PASSWORD;
    public $datastore = DATASTORE;
    
    public function connect(){
        $ligacao = mysql_connect($this->environ,  $this->uses,  $this->password) or die($this->mensagem);
        mysql_select_db($this->datastore, $ligacao) or die($this->mensagem);
    }
}

?>
