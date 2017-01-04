<?php 
/**
 * Created by iMac
 * 火一五信息科技有限公司
 * 联系方式:15288986891
 * QQ:3186355915
 * web:http://host.huo15.com
 * 日期：2017/1/4
 */
 

if(!defined('IN_MEMBER')) exit('Request Error!'); 
$is_list     = AuthCode($_COOKIE['is_list']);
$user_id     = AuthCode($_COOKIE['user_id']);
$is_list = $dosql->GetOne("SELECT is_list FROM `#@__member` WHERE `id`='$user_id'"); 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="format-detection" content="telephone=no; email=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no; email=no" />
<title>北京钰恒泰汽车科技服务有限公司</title>
<link href="style/style.css" type="text/css" rel="stylesheet" />
<link href="style/pates.css" type="text/css" rel="stylesheet" />
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
<script type="text/javascript" src="templates/default/js/jquery.min.js"></script>
</head>

<body id="box">
<!--Header Start-->
<div id="header">
	<?php $rand = mt_rand(0, 1000000); ?>
	<a class="btn-block" href="galleryMultiple.html?x=<?php echo $rand; ?>">测试多图片上传功能</a>
   <!--<p class="fh"><a href="JavaScript:window.history.back(-1);"><i class="fa fa-chevron-left"></i> 返回</a></p>-->
   <h2>（<?php echo $dataname; ?>）-  项目选择</h2>
   <!--<p class="tel"><a href="/"><i class="fa fa-home"></i></a></p>-->
</div>
<!--Header End-->
<!--Banner Start-->
<div id="banner"><img src="images/01.jpg" /></div>
<!--Banner End-->
<!--Layout Start-->
<div id="layout">
    <ul>
		<?php
		$link='javascript:c();';
		$links ='javascript:c();';
		if($is_list['is_list']==0 || $is_list['is_list']==2){
			$link = '?c=investigation';
		}
		if($is_list['is_list']==1 || $is_list['is_list']==2){
			$links = '?c=oldparts';
		} ?>
		<li class="fk"><a href="<?php echo $link; ?>"><em><img src="images/fk.png" /></em><b>复勘任务</b><span></span></a></li>
		 <li class="cx"><a href="?c=case"><em><img src="images/cx.png" /></em><b>案件查询</b></a></li>
       <li class="hs"><a href="<?php echo $links; ?>"><em><img src="images/jk.png" /></em><b>旧件任务</b><span></span></a></li>
       <li class="tx"><a href="?c=communication"><em><img src="images/tx.png" /></em><b>通讯录</b></a></li>
    </ul>
</div>
<!--Layout End-->
<!--Bottom_pic Start-->
<div id="Bootom_pic"><img src="images/bottom_pic.jpg" /></div>
<!--Bootom_pic End-->
<!--Footer Start-->
<div id="footer">
   <ul>
   <?php
	$hover2='';
	$hover='';
	$dosql->Execute("SELECT * FROM `#@__cascadedata` WHERE `datagroup`='insurance'  ORDER BY orderid ASC, datavalue ASC");
	while($row2 = $dosql->GetArray())
	{
		 $hover ='';
		if($row2['datavalue']==$datavalue){
		  $hover = ' hover';
		}
		echo '<li class="'.$hover.'" data-datavalue='.$row2['datavalue'].'><a href="javascript:;"><span></span>'.$row2['dataname'].'</a></li>';
		
	}
   ?>
	<li  data-datavalue='0'><a href="member.php?c=edit"  ><span></span>我的</a></li>

   </ul>
</div>
<!--Footer End-->
</body>
<script>
$(function(){
	var ulWhdth=null;
	var countLi =null;
	var liHeight=null;
	var ulWhdth = $('#footer').width()
	var liCount=$('#footer ul li');
	var countLi=liCount.length;
	var liFoot=$('#footer ul li');
	 liFoot.each(function(){
		$(this).on('click',function(){
			liCount.removeClass("hover");
			$(this).addClass("hover");
			datavalue = $(this).data('datavalue');
			if(datavalue!='0'){
				$.post('member.php?a=set_insurance', { datavalues:datavalue}, function (data) { 
					 javascript:location.reload();
		  		})
			}else{
			 window.location.href="member.php?c=edit";
			}
		})
	});
	if(countLi<3){
		liHeight = ulWhdth/countLi;
		liFoot.css('width',liHeight-countLi*2)
	}else{
		 liHeight = ulWhdth/3;
		liFoot.css('width',liHeight)
	}
})
function c(){
	$('body').prepend("<div id='popDiv'  class='mydiv' > <div class='xuanze shuaxin'>  <dl><dt>你没有该权限访问</dt><dd><a href=javascript:document.getElementById('popDiv').style.display=none; onclick='g()' class='zx'>确定</a></dd> </dl> </div>  </div>");
	
}
function g(){
	document.getElementById('popDiv').style.display='none';
}
</script>
</html>