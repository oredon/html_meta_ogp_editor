<?php
include('util.php');
header( 'Content-Type: text/javascript; charset=utf-8' );
//sleep(2);
if(isset($_POST["dir"])){
  if(is_writable($_POST["dir"])){
    $code = "UTF-8";
    if(isset($_POST["code"])){
      if($_POST["code"]!="UTF-8"){
        $code = $_POST["code"];
      }
    }
    $buffer = mb_convert_encoding(file_get_contents( $_POST["dir"] ) , "UTF-8", $code);

    //title
    if(isset($_POST["title"])){
      if( preg_match( '/<title>(.*)<\/title>/i', $buffer, $matches ) > 0 ){
        $buffer = preg_replace('/(<title>)(.*)(<\/title>)/i', '$1'.$_POST["title"].'$3', $buffer);
      }
    }

    //keywords
    if(isset($_POST["keywords"])){
      if( preg_match( '/<meta name="keywords".*content="(.*)"/i', $buffer, $matches ) > 0 ){
        $buffer = preg_replace('/(<meta name="keywords".*content=")(.*)(")/i', '$1'.$_POST["keywords"].'$3', $buffer);
      }
    }

    //description
    if(isset($_POST["description"])){
      if( preg_match( '/<meta name="description".*content="(.*)"/i', $buffer, $matches ) > 0 ){
        $buffer = preg_replace('/(<meta name="description".*content=")(.*)(")/i', '$1'.$_POST["description"].'$3', $buffer);
      }
    }

    //og:locale
    if(isset($_POST["og:locale"])){
      if( preg_match( '/<meta property="og:locale".*content="(.*)"/i', $buffer, $matches ) > 0 ){
        $buffer = preg_replace('/(<meta property="og:locale".*content=")(.*)(")/i', '$1'.$_POST["og:locale"].'$3', $buffer);
      }
    }

    //og:type
    if(isset($_POST["og:type"])){
      if( preg_match( '/<meta property="og:type".*content="(.*)"/i', $buffer, $matches ) > 0 ){
        $buffer = preg_replace('/(<meta property="og:type".*content=")(.*)(")/i', '$1'.$_POST["og:type"].'$3', $buffer);
      }
    }

    //og:site_name
    if(isset($_POST["og:site_name"])){
      if( preg_match( '/<meta property="og:site_name".*content="(.*)"/i', $buffer, $matches ) > 0 ){
        $buffer = preg_replace('/(<meta property="og:site_name".*content=")(.*)(")/i', '$1'.$_POST["og:site_name"].'$3', $buffer);
      }
    }

    //og:title
    if(isset($_POST["og:title"])){
      if( preg_match( '/<meta property="og:title".*content="(.*)"/i', $buffer, $matches ) > 0 ){
        $buffer = preg_replace('/(<meta property="og:title".*content=")(.*)(")/i', '$1'.$_POST["og:title"].'$3', $buffer);
      }
    }

    //og:description
    if(isset($_POST["og:description"])){
      if( preg_match( '/<meta property="og:description".*content="(.*)"/i', $buffer, $matches ) > 0 ){
        $buffer = preg_replace('/(<meta property="og:description".*content=")(.*)(")/i', '$1'.$_POST["og:description"].'$3', $buffer);
      }
    }

    //og:image
    if(isset($_POST["og:image"])){
      if( preg_match( '/<meta property="og:image".*content="(.*)"/i', $buffer, $matches ) > 0 ){
        $buffer = preg_replace('/(<meta property="og:image".*content=")(.*)(")/i', '$1'.$_POST["og:image"].'$3', $buffer);
      }
    }

    //og:url
    if(isset($_POST["og:url"])){
      if( preg_match( '/<meta property="og:url".*content="(.*)"/i', $buffer, $matches ) > 0 ){
        $buffer = preg_replace('/(<meta property="og:url".*content=")(.*)(")/i', '$1'.$_POST["og:url"].'$3', $buffer);
      }
    }

    if( file_put_contents( $_POST["dir"], mb_convert_encoding( $buffer, $code, "UTF-8" ) ) ){
//成功
echo <<< EOL
{
  "proc_status":"1"
}
EOL;
    }else{
//書き込み失敗
echo <<< EOL
{
  "proc_status":"0",
  "proc_message": "ファイルへの書き込み処理に失敗しました。"
}
EOL;
    }

  }else{
echo <<< EOL
{
  "proc_status":"0",
  "proc_message": "編集しようとしているファイルに、apacheからの書き込み権限がありません。"
}
EOL;
  }
}else{
echo <<< EOL
{
  "proc_status":"0",
  "proc_message": "不明なエラーが発生しました。"
}
EOL;
}
