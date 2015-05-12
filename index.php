<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-script-type" content="text/javascript" />
<meta http-equiv="content-language" content="ja" />
<title>HTML META OGP Editor</title>
<link rel="stylesheet" type="text/css" media="screen,print" href="css/bootstrap.min_custom.css" />
<link rel="stylesheet" type="text/css" media="screen,print" href="css/common.css" />
<!-- <script type="text/javascript" src="js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ajaxQueue.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
</head>
<body>
<div class="wrapper">



<h1 class="mb50">HTML META OGP Editor</h1>

<h2>トップディレクトリを指定して編集を開始</h2>
<p>トップディレクトリとURLトップを指定し、該当する拡張子ファイルを探査します。</p>

<div class="well">
<form method="post" action="dir.php" id="form1" name="filelist-form" class="form-horizontal">

<div class="control-group">
<label class="control-label" for="dir_path">トップディレクトリ</label>
<div class="controls"><input type="text" name="dir_path" value="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>" style="width:80%;" /><br />例）D:\works\xxx\htdocs</div>
<!-- control-group --></div>

<div class="control-group">
<label class="control-label" for="url_base">URLトップ</label>
<div class="controls"><input type="text" name="url_base" value="<?php echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"]; ?>" style="width:80%;" /><br />例）http://localhost.com</div>
<!-- control-group --></div>

<div class="control-group">
<label class="control-label" for="meta">拡張子</label>
<div class="controls"><input type="text" name="ext" value="html|htm|php" style="width:80%;" /><br />例）html|htm|php　|区切り 全てのファイルを対象にリストを作りたい場合は「.*」を入力</div>
<!-- control-group --></div>

<div class="control-group">
<label class="control-label" for="code">HTMLの文字コード</label>
<div class="controls">
<input type="radio" name="code" value="utf8" checked="checked" id="dir_utf8_id" /><label for="dir_utf8_id" class="labelname">UTF8</label><br />
<input type="radio" name="code" value="sjis" id="dir_sjis_id" /><label for="dir_sjis_id" class="labelname">shift-jis</label><br />
※HTMLファイルの文字コードを合わせないと取得結果が文字化けします
</div>
<!-- control-group --></div>

<div class="controls">
<p><input type="submit" value="META OGP 閲覧／編集を開始" class="btn btn-info" /></p>
</div>

</form>

<ul>
<li>指定したディレクトリを探査します</li>
<li>指定ディレクトリ内の該当する拡張子ファイルを読み込み、ファイルリストが出力されると同時にtitle,meta,ogpを抽出して表示します。抽出可能な要素は以下の通りです<br>
title, keywords, description, og:locale, og:type, og:site_name, og:title, og:description, og:image, og:url
</li>
<li>編集ボタンを押すと、出力されているtitle,meta,ogpがinput:textになり、編集可能になります。</li>
<li>適用ボタンを押すと、入力内容が実ファイルに反映されます（AJAXで実行されます）</li>
<li>画面上部のボタンリンクリストをクリックすると更に下の階層へ移動できます。</li>
<li>戻るボタンをクリックするか、ブラウザの戻るボタンを押すと上の階層に移動できます。</li>
</ul>
<!-- well --></div>



<div class="alert alert-block">
<h2 class="alert-heading">注意</h2>
<p>・必ずバックアップをとってから利用してください。不具合、不利益等あっても責任をおいかねますので予めご了承ください。</p>
</div>

</div>
</body>
</html>
