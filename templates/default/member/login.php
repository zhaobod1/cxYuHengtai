<?php if (!defined('IN_MEMBER')) exit('Request Error!'); ?>


<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- 火一五信息科技 huo15.com -->
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<meta name="format-detection" content="telephone=no; email=no"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<meta name="format-detection" content="telephone=no; email=no"/>
	<title>北京钰恒泰汽车科技服务有限公司</title>
	<link href="style/style.css" type="text/css" rel="stylesheet"/>
	<link href="style/login.css" type="text/css" rel="stylesheet"/>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/member.js"></script>
</head>

<body>
<form id="form" method="post" action="?a=login" onsubmit="return CheckLog();">
	<!--Logo Start-->
	<div id="logo"><img src="images/logo.png"/></div>
	<!--Logo End-->
	<!--Login Start-->

	<div id="login">
		<ul>
			<li><span>用户名：</span><input type="text" name="username" id="username" class="name"/></li>
			<li><span>密&nbsp;&nbsp;&nbsp;&nbsp;码：</span><input type="password" name="password" id="password"
			                                                   class="password"/></li>
		</ul>

		<!--<p><input type="checkbox" title="两周内自动登录" name="autologin" id="autologin" value="1" /> 记住密码</p>-->
		<input type="submit" value="立即登录" class="sub"/>
	</div>
</form>
<!--Login End-->
<!--Footer Start-->
<div id="footer"><?php /*?><?php echo $cfg_copyright; ?><?php */ ?>北京钰恒泰汽车科技服务有限公司</div>
<!--Footer End-->
</body>
<script type="text/javascript">
	function CheckLog() {
		if ($("#username").val() == "") {
			alert("请输入用户名！");
			$("#username").focus();
			return false;
		}


		if ($("#password").val() == "") {
			alert("请输入密码！");
			$("#password").focus();
			return false;
		}


	}
	var ih = window.innerHeight;
	window.onresize = function () {
		var _form = document.getElementById('form');
		if (window.innerHeight < ih) {
			_form.style.marginTop = '-55px';
		} else {
			_form.style.marginTop = '0';
		}
		;
	}
</script>
</html>
