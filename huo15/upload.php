<?php
/**
 * Created by 火一五信息科技有限公司.
 * Tel :15288986891
 * QQ  :3186355915
 * web :http://host.huo15.com
 * User: apple
 * Date: 2017/1/5
 * Time: 上午2:19
 */


$s=dirname(__FILE__); //获的服务器路劲
$time =time();        //获得当前时间戳
$base64files =$_POST['base64files'];

foreach ($base64files as $k => $v) {
	$files1 = substr($v["src"],22);
	$tmp  = base64_decode($files1);
	$fp=$s."/upload/".$v["name"]."__".$time.".jpg";  //确定图片文件位置及名称
	file_put_contents( $fp, $tmp);  //给图片文件写入数据

}

$dir=$s."/upload/";
$file=scandir($dir);
$respone = array(
	"flag" => 1,
	"datas" => $file

);
echo json_encode($respone);

