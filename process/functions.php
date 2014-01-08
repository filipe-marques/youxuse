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

function translate_country($country){
    switch ($country) {
        case 'pt':
            echo LABEL_TRANSLATE_COUNTRY1;
            break;
        case 'es':
            echo LABEL_TRANSLATE_COUNTRY2;
            break;
        case 'fr':
            echo LABEL_TRANSLATE_COUNTRY3;
            break;
        case 'uk':
            echo LABEL_TRANSLATE_COUNTRY4;
            break;
        case 'us':
            echo LABEL_TRANSLATE_COUNTRY5;
            break;
        case 'br':
            echo LABEL_TRANSLATE_COUNTRY6;
            break;
   }
}
 
function idiom_geoip(){
	$country = geoip_country_code_by_name($_SERVER['REMOTE_ADDR']);
	switch ($country) {
		case 'pt':
			require_once ("lang/pt.php");
			break;
		case 'es':
			require_once ("lang/es.php");
			break;
		case 'fr':
			require_once ("lang/fr.php");
			break;
		case 'uk':
			require_once ("lang/uk.php");
			break;
		case 'us':
			require_once ("lang/us.php");
			break;
		case 'br':
			require_once ("lang/br.php");
			break;
		default:
			require_once ("lang/uk.php");
	}
}
 
function idiom_without_session($id){
	switch ($id) {
		case 'pt':
			require_once ("lang/pt.php");
			break;
		case 'es':
			require_once ("lang/es.php");
			break;
		case 'fr':
			require_once ("lang/fr.php");
			break;
		case 'uk':
			require_once ("lang/uk.php");
			break;
		case 'us':
			require_once ("lang/us.php");
			break;
		case 'br':
			require_once ("lang/br.php");
			break;
	}
}

function check_session_idiom(){
	if (isset($_SESSION['pais'])){
		$pais = $_SESSION['pais'];
		switch ($pais) {
			case 'pt':
				require_once ("lang/pt.php");
				break;
			case 'es':
				require_once ("lang/es.php");
				break;
			case 'fr':
				require_once ("lang/fr.php");
				break;
			case 'uk':
				require_once ("lang/uk.php");
				break;
			case 'us':
				require_once ("lang/us.php");
				break;
			case 'br':
				require_once ("lang/br.php");
				break;
		}
	}
}


function ip_adress(){
	$http_client_ip = $_SERVER['HTTP_CLIENT_IP'];
	$http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote_adress = $_SERVER['REMOTE_ADDR'];
	
	if (!empty($http_client_ip)){
		$ip = $http_client_ip;
	} elseif (!empty($http_x_forwarded_for)){
		$ip = $http_x_forwarded_for;
	}else{
		$ip = $remote_adress;
	}
	return $ip;
}

function venda($termo) {
    if ($termo === 'N') {
        echo (LABEL_VENDA1);
    } elseif ($termo === 'S') {
        echo (LABEL_VENDA2);
    }
}

function resize_image($filename) {
	$newwidth = 300;
	$newheight = 200;
	list($width, $height) = getimagesize($filename);
	$thumb = imagecreatetruecolor($newwidth, $newheight);
	$source = imagecreatefrompng($filename);
	imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	imagepng($thumb);
    imagedestroy($thumb);
}

function spam_out($emai) {

    $emai = filter_var($emai, FILTER_SANITIZE_EMAIL);

    if (filter_var($emai, FILTER_VALIDATE_EMAIL)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function search($sear) {
    switch ($sear) {
        case 'DM01':
            echo LABEL_DM01;
            break;
        case 'DPR02':
            echo LABEL_DPR02;
            break;
        case 'DRUSBPS203':
            echo LABEL_DRUSBPS203;
            break;
        case 'DTUSBPS204':
            echo LABEL_DTUSBPS204;
            break;
        case 'DTR05':
            echo LABEL_DTR05;
            break;
        case 'DDOSSD06':
            echo LABEL_DDOSSD06;
            break;
        case 'DDCDDVD07':
            echo LABEL_DDCDDVD07;
            break;
        case 'DCLBUSBarramentoSATA08':
            echo LABEL_DCLBUSBARRAMENTOSATA08;
            break;
        case 'DFA09':
            echo LABEL_DFA09;
            break;
        case 'DRAM010':
            echo LABEL_DRAM010;
            break;
        case 'DP011':
            echo LABEL_DP011;
            break;
        case 'DV012':
            echo LABEL_DV012;
            break;
        case 'DC013':
            echo LABEL_DC013;
            break;
        case 'DBIOS014':
            echo LABEL_DBIOS014;
            break;
        case 'DPG015':
            echo LABEL_DPG015;
            break;
        case 'LE016':
            echo LABEL_LE016;
            break;
        case 'LT017':
            echo LABEL_LT017;
            break;
        case 'LDOSSD018':
            echo LABEL_LDOSSD018;
            break;
        case 'LDDVD019':
            echo LABEL_LDDVD019;
            break;
        case 'LRAM020':
            echo LABEL_LRAM020;
            break;
        case 'LP021':
            echo LABEL_LP021;
            break;
        case 'LV022':
            echo LABEL_LV022;
            break;
        case 'LM023':
            echo LABEL_LM023;
            break;
        case 'LC024':
            echo LABEL_LC024;
            break;
        case 'NE025':
            echo LABEL_NE025;
            break;
        case 'NT026':
            echo LABEL_NT026;
            break;
        case 'NDOSSD027':
            echo LABEL_NDOSSD027;
            break;
        case 'NRAM028':
            echo LABEL_NRAM028;
            break;
        case 'NP029':
            echo LABEL_NP029;
            break;
        case 'NV030':
            echo LABEL_NV030;
            break;
        case 'NDP031':
            echo LABEL_NDP031;
            break;
        case 'NM032':
            echo LABEL_NM032;
            break;
        case 'NC033':
            echo LABEL_NC033;
            break;
        case 'PIM034':
            echo LABEL_PIM034;
            break;
        case 'PII035':
            echo LABEL_PII035;
            break;
        case 'PICPB036':
            echo LABEL_PICPB036;
            break;
        case 'PICS037':
            echo LABEL_PICS037;
            break;
        case 'TT038':
            echo LABEL_TT038;
            break;
        case 'TE039':
            echo LABEL_TE039;
            break;
        case 'TC040':
            echo LABEL_TC040;
            break;
        case 'TB041':
            echo LABEL_TB041;
            break;
        case 'TCT042':
            echo LABEL_TCT042;
            break;
        case 'SAndroidM043':
            echo LABEL_SANDROIDM043;
            break;
        case 'SAndroidE044':
            echo LABEL_SANDROIDE044;
            break;
        case 'SAndroidB045':
            echo LABEL_SANDROIDB045;
            break;
        case 'SAndroidC046':
            echo LABEL_SANDROIDC046;
            break;
        case 'SAndroidCam047':
            echo LABEL_SANDROIDCAM047;
            break;
        case 'SAndroidBat048':
            echo LABEL_SANDROIDBAT048;
            break;
        case 'SAndroidCS049':
            echo LABEL_SANDROIDCS049;
            break;
        case 'SAndroidROM050':
            echo LABEL_SANDROIDROM050;
            break;
        case 'SAppleM051':
            echo LABEL_SAPPLEM051;
            break;
        case 'SAppleE052':
            echo LABEL_SAPPLEE052;
            break;
        case 'SAppleB053':
            echo LABEL_SAPPLEB053;
            break;
        case 'SAppleC054':
            echo LABEL_SAPPLEC054;
            break;
        case 'SAppleCam055':
            echo LABEL_SAPPLECAM055;
            break;
        case 'SAppleB056':
            echo LABEL_SAPPLEB056;
            break;
        case 'SAppleCS057':
            echo LABEL_SAPPLECS057;
            break;
        case 'SAppleROM058':
            echo LABEL_SAPPLEROM058;
            break;
        case 'SWindowsPhoneM059':
            echo LABEL_SWINDOWSPHONEM059;
            break;
        case 'SWindowsPhoneE060':
            echo LABEL_SWINDOWSPHONEE060;
            break;
        case 'SWindowsPhoneB061':
            echo LABEL_SWINDOWSPHONEB061;
            break;
        case 'SWindowsPhoneC062':
            echo LABEL_SWINDOWSPHONEC062;
            break;
        case 'SWindowsPhoneCam063':
            echo LABEL_SWINDOWSPHONECAM063;
            break;
        case 'SWindowsPhoneB064':
            echo LABEL_SWINDOWSPHONEB064;
            break;
        case 'SWindowsPhoneCS065':
            echo LABEL_SWINDOWSPHONECS065;
            break;
        case 'SWindowsPhoneROM066':
            echo LABEL_SWINDOWSPHONEROM066;
            break;
        case 'TAndroidM067':
            echo LABEL_TANDROIDM067;
            break;
        case 'TAndroidE068':
            echo LABEL_TANDROIDE068;
            break;
        case 'TAndroidB069':
            echo LABEL_TANDROIDB069;
            break;
        case 'TAndroidC070':
            echo LABEL_TANDROIDC070;
            break;
        case 'TAndroidCam071':
            echo LABEL_TANDROIDCAM071;
            break;
        case 'TAndroidB072':
            echo LABEL_TANDROIDB072;
            break;
        case 'TAndroidCT073':
            echo LABEL_TANDROIDCT073;
            break;
        case 'TAndroidROM074':
            echo LABEL_TANDROIDROM074;
            break;
        case 'TAppleM075':
            echo LABEL_TAPPLEM075;
            break;
        case 'TAppleE076':
            echo LABEL_TAPPLEE076;
            break;
        case 'TAppleB077':
            echo LABEL_TAPPLEB077;
            break;
        case 'TAppleC078':
            echo LABEL_TAPPLEC078;
            break;
        case 'TAppleCam079':
            echo LABEL_TAPPLECAM079;
            break;
        case 'TAppleB080':
            echo LABEL_TAPPLEB080;
            break;
        case 'TAppleCT081':
            echo LABEL_TAPPLECT081;
            break;
        case 'TAppleROM082':
            echo LABEL_TAPPLEROM082;
            break;
        case 'TWindowsPhoneM083':
            echo LABEL_TWINDOWSPHONEM083;
            break;
        case 'TWindowsPhoneE084':
            echo LABEL_TWINDOWSPHONEE084;
            break;
        case 'TWindowsPhoneB085':
            echo LABEL_TWINDOWSPHONEB085;
            break;
        case 'TWindowsPhoneC086':
            echo LABEL_TWINDOWSPHONEC086;
            break;
        case 'TWindowsPhoneCam087':
            echo LABEL_TWINDOWSPHONECAM087;
            break;
        case 'TWindowsPhoneB088':
            echo LABEL_TWINDOWSPHONEB088;
            break;
        case 'TWindowsPhoneCT089':
            echo LABEL_TWINDOWSPHONECT089;
            break;
        case 'TWindowsPhoneROM090':
            echo LABEL_TWINDOWSPHONEROM090;
            break;
        case 'RRouter091':
            echo LABEL_RROUTER091;
            break;
        case 'RSwitch092':
            echo LABEL_RSWITCH092;
            break;
        case 'RaspberryPi93':
            echo ("Raspberry Pi");
            break;
    }
}

?>
