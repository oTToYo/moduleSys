<?php
//系統帳號密碼規則
//登入時 使用者的帳密  先與POP3作認證 
//在本系統資料庫中的user作認證  確認此個人信箱帳密 有申請單位發送校外郵件權限
//並記錄下使用者的密碼  以作後續批次發信使用
 

//使用 POP3 伺服器作身份認證
$server = '140.116.229.2'; //mail.ncku.edu.tw
$port = '110';


$userid=$_POST['acc'];
$password=$_POST['pwd'];

//$userid ="sdafsd fs7";
//$password  = "p79390P";

//檢查 $server $port 是否可以開啟
$fp = fsockopen ($server, $port, $errno, $errstr, 5);
if(!$fp) die('連線失敗');

//檢查 POP3 伺服器連線是否成功
$msg = fgets($fp, 256);
if(strpos($msg,"+OK")!=0) die('POP3 伺服器連線失敗');

//傳送帳號
fputs($fp, "USER $userid\r\n");
$msg = fgets($fp,256);

if(strpos($msg,"+OK")!=0) die('帳號錯誤');
?>