<?php

// PHP include path settings
//set_include_path(realpath(str_replace('\\', '/', dirname(__FILE__)).'/pear/'));

//debug
$system_mem = false;

include('util.php');

//POSTを精査
if( !empty( $_POST["url_base"] ) ){
    $urlbase = $_POST["url_base"];
}else{
    $urlbase = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"];
}

if( !empty( $_POST["dir_path"] ) ){
    $pathbase = $_POST["dir_path"];
}else{
    $pathbase = $_SERVER['DOCUMENT_ROOT'];
}

if( !empty( $_POST["ext"] ) ){
    $ext = '/(\.)(' . $_POST["ext"] . ')$/i';
    $viewext = str_replace("|",",",$_POST["ext"]);
}else{
    $ext = '/(\.)(html|htm|php)$/i';
    $viewext = 'html,htm,php';
}

if( $_POST["code"] == 'sjis' ){
    $code = 'SJIS';
}else{
    $code = 'UTF-8';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-script-type" content="text/javascript" />
<meta http-equiv="content-language" content="ja" />
<title>ファイル探査結果 | HTML META OGP Editor</title>
<link rel="stylesheet" type="text/css" media="screen,print" href="css/bootstrap.min_custom.css" />
<link rel="stylesheet" type="text/css" media="screen,print" href="css/common.css" />
<!-- <script type="text/javascript" src="js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ajaxQueue.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/edit.js"></script>
</head>
<body>
<div class="wrapper">

<h1 class="mb50">HTML META OGP Editor - ファイル探査結果　<a class="btn" href="#" id="backbtn">戻る</a></h1>



<div class="alert alert-block alert-info">
<h2 class="alert-heading">[INFO]</h2>
<p>トップページURL:
<?php
echo $urlbase;
?>
</p>
<p>ディレクトリpath :
<?php
echo $pathbase;
?>
</p>
<p>探査対象拡張子 :
<?php
echo $viewext;
?>
</p>
<p>指定したHTMLファイルの文字コード :
<?php
echo $code;
?>
</p>
<!-- alert --></div>


<div class="well">
<?php

//指定ディレクトリ以下を再帰的にファイルパス探査
// $dirlist = array_dirlist($pathbase,$ext);
// $fullpath = array_fullpath($pathbase, $dirlist);

$dirfile = get_dir_and_filelist($pathbase,$ext);
$fullpath = array_fullpath($pathbase, $dirfile["file"]);
?>

<ul>
<?php
foreach($dirfile["dir"] as $k => $v){
?>
  <li><form method="post" action="dir.php">
    <input type="hidden" name="dir_path" value="<?php echo $pathbase . "/" . $v; ?>">
    <input type="hidden" name="url_base" value="<?php echo $urlbase . "/" . $v; ?>">
    <input type="hidden" name="ext" value="<?php echo $_POST["ext"]; ?>">
    <input type="hidden" name="code" value="<?php echo $_POST["code"]; ?>">
    <input type="submit" class="btn" name="name" value="<?php echo $pathbase . "/" . $v; ?>">
  </form></li>
<?php
}
?>
</ul>
<div id="result">
<?php
$point1 = memory_get_usage($system_mem); // メモリ使用量計測

//ファイルパス・メタの出力
foreach ($fullpath as $path){
  show_editable_filedata( $urlbase, $pathbase, $path, $code );
}

$point2 = memory_get_usage($system_mem); // メモリ使用量計測

?>
<!-- filelistresult --></div>

<!-- well --></div>


<div>
<?php
echo "memory usage: ";
echo $point2 - $point1;//debug
echo " bytes";
?>
</div>

<!-- wrapper --></div>


<div id="menu" class="floatingMenu">
  <p><button type="button" id="alledit" class="btn btn-info">一括編集</button></p>
  <p><button type="button" id="allwrite" class="btn btn-success">一括適用</button></p>
</div>

<div id="previewShield"></div>
<div id="preview"></div>

</body>
</html>
