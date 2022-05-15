<?php
require_once dirname(__FILE__).'/extend/service/AlipayTradeService.php';
require_once dirname(__FILE__).'/extend/buildermodel/AlipayTradePagePayContentBuilder.php';
require_once "./extend/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php";
require_once "./extend/PHPMailer/class.phpmailer.php";
require_once "./extend/PHPMailer/class.smtp.php";
include_once "autoload.php";//自动加载类机制
$url = explode('?',$_SERVER['REQUEST_URI']);
$request = explode('/',$url[0]);
if($request[1]!= "phpyj293"){
    header("HTTP/1.0 404 Not Found");
    header("Status: 404 Not Found");
    die();
}
if ($request[2]=="file"){
    $request3 = $request[3];
    $a = new ApiController();
    $action = $a->$request3();
}
if ($request[2]=="upload"){
    $a = new ApiController();
    $action = $a->checkFile($request[3]);
}
if ($request[2]=="option") {
    $a = new ApiController();
    if(isset($request[5])){
        $action = $a->option($request[3],$request[4],$request[5],$request[6]);
    }else{
        $action = $a->option($request[3],$request[4]);
    }
}
if ($request[2]=="follow") {
    $a = new ApiController();
    $action = $a->follow($request[3],$request[4]);
}
if ($request[2]=="cal") {
    $a = new ApiController();
    $action = $a->cal($request[3],$request[4]);
}
if ($request[2]=="value") {
    $a = new ApiController();
    $action = $a->value($request[3],$request[4],$request[5],$request[6]);
}
if ($request[2]=="group") {
    $a = new ApiController();
    $action = $a->group($request[3],$request[4]);
}
if ($request[2]=="remind") {
    $a = new ApiController();
    $action = $a->remind($request[3],$request[4],$request[5]);
}
if ($request[2]=="sh") {
    $a = new ApiController();
    $action = $a->sh($request[3]);
}
if ($request[2]=="matchFace") {
    $a = new ApiController();
    $action = $a->matchFace();
}
if ($request[2]=="location") {
    $a = new ApiController();
    $action = $a->location();
}
$request2 = ucwords($request[2])."Controller";//类
$request3 = $request[3];//方法
if ($request[2]=="forum") {
    $a = new ForumController();
	if($request3 =="list"){
		$action = $a->lists($request[4]);
	}
}
if (count($request)<3) {
    header("HTTP/1.0 404 Not Found");
    header("Status: 404 Not Found");
    die();
}

$a = new $request2();//实例化类
if($request3 =="list"){
    $action = $a->lists();
}
if($request3 =="remind"){
    $action = $a->remind($request[4],$request[5]);
}
if ($request3 =="info" || $request3 =="vote" ||$request3 =="detail"||$request3 =="thumbsup"){
    $action = $a->$request3($request[4]);
}
$action = $a->$request3();//调用类方法