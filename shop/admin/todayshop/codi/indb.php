<?

include "../../lib.php";
require_once("../../../lib/qfile.class.php");
@include_once dirname(__FILE__) . "/../../../lib/todayshop.class.php";
$todayShop = &load_class('todayshop', 'todayshop');
$qfile = new qfile();

@include_once dirname(__FILE__) . "/../../../conf/config.php";
@include_once dirname(__FILE__) . "/../../lib.skin.php";
@include_once dirname(__FILE__) . "/../../../conf/design_dir_todayshop.php";
@include_once dirname(__FILE__) . "/../../../conf/design_skinToday_" . $cfg['tplSkinTodayWork'] . ".php";

$mode = ($_POST[mode]) ? $_POST[mode] : $_GET[mode];
unset($_POST[mode]); unset($_POST[x]); unset($_POST[y]);

if (isset($design_skinToday) && is_array($design_skinToday)) { foreach($design_skinToday as $k => $v){
	$v = array_map("stripslashes",$v);
	$v = array_map("addslashes",$v);
	$design_skinToday[$k] = $v;
}}

switch ($mode){

	case "create": // ���ο� ������ �߰��ϱ�

		### �������ڵ����� ����
		## ���������� ����&����
		$tmp = explode( "/", '/' . $_POST['design_file'] );
		$dir = str_replace( $_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'] ) . $cfg['rootDir'] . '/data/skin_today/' . $cfg['tplSkinTodayWork'];

		for ( $i = 0; $i < ( count( $tmp ) - 1 ); $i++ ){

			$dir .= $tmp[ $i ] . '/';
			if ( !@file_exists( $dir ) ) @mkdir( $dir, 0757 );
			@chMod( $dir, 0757 );
		}

		$nowPath = $dir . $tmp[ ( count( $tmp ) - 1 ) ]; # ���ε��� ������

		## ����
		$design_skinToday[ $_POST['design_file'] ]['text'] = $_POST['file_desc'];
		$design_skinToday[ $_POST['design_file'] ]['linkurl'] = "todayshop/html.php?htmid={$_POST['design_file']}";
		$content = "{*** " . $_POST['file_desc'] . " | " . $design_skinToday[ $_POST['design_file'] ]['linkurl'] . " ***}" . "\n";
		if ( ereg("popup/",$_POST['design_file']) === false && ereg("outline/",$_POST['design_file']) === false ) $content .= "{ # header }\n\n{ # footer }";

		## ����
		$qfile->open( $path = $nowPath);
		if (ini_get('magic_quotes_gpc') == 1) $content = stripslashes( $content );
		$qfile->write($content );
		$qfile->close();
		@chMod( $path, 0757 );


		### �����ν�Ų���� ����
		$qfile->open( dirname(__FILE__) . "/../../../conf/design_skinToday_" . $cfg['tplSkinTodayWork'] . ".php");
		$qfile->write("<?\n" );
		$qfile->write("\$design_skinToday = array();\n\n" );

		foreach ( $design_skinToday as $filekey => $property ){

			$qfile->write("\$design_skinToday['" . $filekey . "'] = array(\n" );
			foreach ( $property as $k => $v ) $qfile->write("'$k'\t\t\t=> '$v',\n" );
			$qfile->write(");\n\n" );
		}

		$qfile->write("?>" );
		$qfile->close();


		### ����
		echo "<script>parent.location.href='../codi.php?design_file={$_POST['design_file']}';</script>";
		exit;

		break;

	case "save": // ������ �����ϱ�
	case "saveas": // ���̸����� �����ϱ�
	case "popupConf": // �����˾�â �����ϱ�

		### �˾��ΰ�� ����
		if($mode == "popupConf"){
			if(!$_GET['design_file']){
				$_GET['design_file']	= "popup/".$_POST['name'].".htm";

				# �˾�â ������� ��� ���� �ߺ� üũ
				$tmp	= array_keys( $design_skinToday );
				$keys	= array_ereg( "'^popup/[^/]*$'si", $tmp );
				if(in_array($_GET['design_file'],$keys)){
					msg("������ �˾�â ���ϸ��� �����մϴ�. �ٽ� Ȯ�����ֽʽÿ�!",-1);
					exit();
				}
			}else{
				$_POST['linkurl']		= "todayshop/html.php?htmid=popup/".$_POST['name'].".htm";
			}
			unset($_POST['name']);

			if($_POST['popup_dt2tm'] == "Y"){
				$_POST['popup_sdt']		= $_POST['popup_sdt_tg'];
				$_POST['popup_edt']		= $_POST['popup_edt_tg'];
				$_POST['popup_stime']	= $_POST['popup_stime_tg'];
				$_POST['popup_etime']	= $_POST['popup_etime_tg'];
			}
			unset($_POST['popup_sdt_tg']);
			unset($_POST['popup_edt_tg']);
			unset($_POST['popup_stime_tg']);
			unset($_POST['popup_etime_tg']);

		}


		### �������ڵ����� ����
		if ( isset( $_POST['content'] ) )
		{
			## ���������� ����&����
			$tmp = explode( "/", '/' . $_GET['design_file'] );
			$dir = str_replace( $_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'] ) . $cfg['rootDir'] . '/data/skin_today/' . $cfg['tplSkinTodayWork'];

			for ( $i = 0; $i < ( count( $tmp ) - 1 ); $i++ )
			{
				$dir .= $tmp[ $i ] . '/';
				if ( !@file_exists( $dir ) ) @mkdir( $dir, 0757 );
				@chMod( $dir, 0757 );
			}

			$nowPath = $dir . $tmp[ ( count( $tmp ) - 1 ) ]; # ���ε��� ������

			## ��������
			if ( $_GET['design_file'] != 'proc/_agreement.txt' )
			{
				preg_match("/\{\*\*\*( .*)\*\*\*\}/i", $_POST['content'], $matches);

				if ( $matches[1] ){ // ���ϳ��� �������� �ִ� ���

					$tmp = explode( "|", $matches[1] );
					$tmp[0] = trim( $tmp[0] );
					$tmp[1] = trim( $tmp[1] );

					if ( ($_POST['linkurl'] == '' && ereg("popup/",$_GET['design_file'])) || $mode == 'saveas' ) $_POST['linkurl'] = "todayshop/html.php?htmid={$_GET['design_file']}";
					if ( $tmp[1] == '' && $_POST['linkurl'] == '' ) $_POST['linkurl'] = str_replace( array('.htm', '.txt'), '.php', $_GET['design_file'] );

					if ( $_POST['text'] != '' ) $tmp[0] = $_POST['text'];
					if ( $_POST['linkurl'] != '' ) $tmp[1] = $_POST['linkurl'];

					$matches[1] = "{*** " . implode( " | ", $tmp ) . " ***}";

					$_POST['content'] = str_replace( $matches[0], $matches[1], $_POST['content'] );
				}
				else { // ���ϳ��� �������� ���� ���

					if ( ($_POST['linkurl'] == '' && ereg("popup/",$_GET['design_file'])) || $mode == 'saveas' )
						$_POST['linkurl'] = "todayshop/html.php?htmid={$_GET['design_file']}";
					else
						$_POST['linkurl'] = str_replace( array('.htm', '.txt'), '.php', $_GET['design_file'] );
					$_POST['content'] = "{*** " . $_POST['text'] . " | " . $_POST['linkurl'] . " ***}" . "\n" . $_POST['content'];
				}
			}

			## ����
			$qfile->open( $path = $nowPath);
			if (ini_get('magic_quotes_gpc') == 1) $_POST['content'] = stripslashes( $_POST['content'] );
			$qfile->write($_POST['content'] );
			$qfile->close();
			@chMod( $path, 0757 );
		}


		### ���̸����� �����϶� ��ó��
		if ( $mode == 'saveas' )
		{
			$design_skinToday[ $_GET['design_file'] ]['text'] = $_POST['text'];

			if ( isset( $_POST['outbg_img'] ) ) unset( $_POST['outbg_img'] );
			if ( isset( $_POST['outbg_img_del'] ) ) unset( $_POST['outbg_img_del'] );
			if ( isset( $_POST['inbg_img'] ) ) unset( $_POST['inbg_img'] );
			if ( isset( $_POST['inbg_img_del'] ) ) unset( $_POST['inbg_img_del'] );
			if ( isset( $_POST['spimg'] ) ) unset( $_POST['spimg'] );
			if ( isset( $_POST['spimg_del'] ) ) unset( $_POST['spimg_del'] );
		}


		### ����̹���
		$_BGFILES = array();
		$_BGFILES['outbg_img_up'] = $_FILES['outbg_img_up'];
		$_BGFILES['inbg_img_up'] = $_FILES['inbg_img_up'];

		$filenm = preg_replace( array( "'.htm$'si", "'/'si" ), array( "", "." ), $_GET['design_file'] );

		$userori = array();
		$userori['outbg_img'] = $filenm . '_outbg' . strrChr( $_FILES['outbg_img_up']['name'], "." );
		$userori['inbg_img'] = $filenm . '_inbg' . strrChr( $_FILES['inbg_img_up']['name'], "." );

		include_once dirname(__FILE__) . "/../webftp/webftp.class_outcall.php";
		outcallUpload( $_BGFILES, '/img/codi/', $userori );

		if ( $_POST['outbg_img'] == '' ) unset( $_POST['outbg_img'] );
		if ( $_POST['inbg_img'] == '' ) unset( $_POST['inbg_img'] );


		### �����ν�Ų���� ����
		if ( count( $_POST ) > 0 ){

			$notPostField = array( 'x', 'y', 'codeact', 'content', 'base_content', 'outbg_img_del', 'inbg_img_del', 'spimg_del' );
			foreach ( $_POST as $k => $v ){ // �ʵ� ����
				if ( in_array( $k, $notPostField ) ) unset( $_POST[$k] );
			}

			$design_skinToday[ $_GET['design_file'] ] = array();

			foreach ( $_POST as $k => $v ){
				if ( $v == '' ) continue;
				if ( $k == 'outline_header' && $v == 'default' ) continue;
				if ( $k == 'outline_footer' && $v == 'default' ) continue;
				if ( $k == 'outline_side' && $v == 'default' ) continue;
				if ( $k == 'outline_sidefloat' && $v == 'default' ) continue;

				if ( $v != '' && $v != '' ) $design_skinToday[ $_GET['design_file'] ][ $k ] = $v;
			}

			$qfile->open( $path = dirname(__FILE__) . "/../../../conf/design_skinToday_" . $cfg['tplSkinTodayWork'] . ".php");
			$qfile->write("<?\n" );
			$qfile->write("\$design_skinToday = array();\n\n" );

			foreach ( $design_skinToday as $filekey => $property ){

				$qfile->write("\$design_skinToday['" . $filekey . "'] = array(\n" );
				foreach ( $property as $k => $v ) $qfile->write("'$k'\t\t\t=> '$v',\n" );
				$qfile->write(");\n\n" );
			}

			$qfile->write("?>" );
			$qfile->close();
			@chMod( $path, 0757 );
		}

		// ĳ�� ����
		require_once('../../../lib/todayshop_cache.class.php');
		todayshop_cache::truncate();

		### ����
		if ( ereg("popup/",$_GET['design_file'] ) ){
			//go( '../iframe.popup_list.php' );
			go( $_SERVER[HTTP_REFERER] );
		}else{
			go( preg_replace( "'design_file=[^&].*\.(htm|txt)'si", "design_file=" . $_GET['design_file'], preg_replace('/&tm=[0-9]*/', '', $_SERVER['HTTP_REFERER']) ) . '&tm=' . time() );
		}
		exit;

		break;

	case "del": // ������ �����ϱ�

		@include dirname(__FILE__) . "/code.class.php";
		$codi = new codi;
		$data_file		= $codi->get_fileinfo( $_GET['design_file'] );						# File Data


		### ����̹��� ����
		$_BGFILES = array();
		$_BGFILES['outbg_img'] = $data_file['outbg_img'];
		$_BGFILES['inbg_img'] = $data_file['inbg_img'];

		if ( count( $_BGFILES ) ){ // Webftp Ŭ���� ����

			include_once dirname(__FILE__) . "/../../design/webftp/webftp.class.php";

			$webftp = new webftp;
			$webftp->ftp_path = str_replace( $_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'] ) . $cfg['rootDir'] . '/data/skin_today/' . $cfg['tplSkinTodayWork']; # ��Ų���
		}

		foreach ( $_BGFILES as $key => $file ){ // ����ó��
			if ( trim( $file ) != '' ) @unlink( $webftp->ftp_path . '/img/codi/' . $file );
		}


		### �����ν�Ų���� ����
		unset( $design_skinToday[ $_GET['design_file'] ] ); # �迭����

		$qfile->open( dirname(__FILE__) . "/../../../conf/design_skinToday_" . $cfg['tplSkinTodayWork'] . ".php");
		$qfile->write("<?\n" );
		$qfile->write("\$design_skinToday = array();\n\n" );

		foreach ( $design_skinToday as $filekey => $property ){

			$qfile->write("\$design_skinToday['" . $filekey . "'] = array(\n" );
			foreach ( $property as $k => $v ) $qfile->write("'$k'\t\t\t=> '$v',\n" );
			$qfile->write(");\n\n" );
		}

		$qfile->write("?>" );
		$qfile->close();


		### �������ڵ����� ����
		$dir = str_replace( $_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'] ) . $cfg['rootDir'] . '/data/skin_today/' . $cfg['tplSkinTodayWork'];
		@unlink( $dir . '/' . $_GET['design_file'] ); # ���ϻ���


		### ����
		if ( ereg("popup/",$_GET['design_file'] ) ){
			go( '../../todayshop/codi.php?design_file=popup/', 'parent' );
		}else{
			go( '../../todayshop/codi.php', 'parent' );
		}
		exit;

		break;

	case "batch": // ��������� �ϰ�����

		### Webftp Ŭ���� ����
		include_once dirname(__FILE__) . "/../webftp/webftp.class.php";
		$webftp = new webftp;
		$webftp->ftp_path = str_replace( $_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'] ) . $cfg['rootDir'] . '/data/skin_today/' . $cfg['tplSkinTodayWork']; # ��Ų���


		### �ϰ� ����
		foreach ( $design_skinToday as $filekey => $property ){

			if ( $filekey == 'default' ) continue;

			if ( isset( $property['outline_header'] ) ) unset( $design_skinToday[ $filekey ]['outline_header'] );
			if ( isset( $property['outline_footer'] ) ) unset( $design_skinToday[ $filekey ]['outline_footer'] );
			if ( isset( $property['outline_side'] ) ) unset( $design_skinToday[ $filekey ]['outline_side'] );
			if ( isset( $property['outline_sidefloat'] ) ) unset( $design_skinToday[ $filekey ]['outline_sidefloat'] );
			if ( isset( $property['outbg_color'] ) ) unset( $design_skinToday[ $filekey ]['outbg_color'] );

			if ( isset( $property['outbg_img'] ) ){
				if ( trim( $property['outbg_img'] ) != '' ) @unlink( $webftp->ftp_path . '/img/codi/' . $property['outbg_img'] );
				unset( $design_skinToday[ $filekey ]['outbg_img'] );
			}
		}


		### �����ν�Ų���� ����
		$qfile->open( dirname(__FILE__) . "/../../../conf/design_skinToday_" . $cfg['tplSkinTodayWork'] . ".php");
		$qfile->write("<?\n" );
		$qfile->write("\$design_skinToday = array();\n\n" );

		foreach ( $design_skinToday as $filekey => $property ){

			$qfile->write("\$design_skinToday['" . $filekey . "'] = array(\n" );
			foreach ( $property as $k => $v ) $qfile->write("'$k'\t\t\t=> '$v',\n" );
			$qfile->write(");\n\n" );
		}

		$qfile->write("?>" );
		$qfile->close();

		break;

}

go($_SERVER['HTTP_REFERER']);

?>