<?php
/**
 * 青岛火一五信息科技有限公司
 * www.huo15.com
 * 作者：赵涤生
 * QQ：3186355915
 * tel:18554898815
 */

if (!defined('IN_MEMBER')) exit('Request Error!');
$r_user = $dosql->GetOne("SELECT * FROM `#@__member` WHERE username='$c_uname'");

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
	<meta name="format-detection" content="telephone=no; email=no"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<meta name="format-detection" content="telephone=no; email=no"/>
	<title>北京钰恒泰汽车科技服务有限公司</title>
	<link href="style/style.css" type="text/css" rel="stylesheet"/>
	<link href="style/pates.css" type="text/css" rel="stylesheet"/>
	<link href="style/mobiscroll_003.css" rel="stylesheet" type="text/css">
	<link href="style/mobiscroll_002.css" rel="stylesheet" type="text/css">
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="style/mobiscroll.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="/cordova.js"></script>
	<script src="js/jquery.1.7.2.min.js"></script>
	<script src="js/mobiscroll_002.js" type="text/javascript"></script>
	<script src="js/mobiscroll_004.js" type="text/javascript"></script>
	<script src="js/mobiscroll.js" type="text/javascript"></script>
	<script src="js/mobiscroll_003.js" type="text/javascript"></script>
	<script src="js/mobiscroll_005.js" type="text/javascript"></script>
	<script src="http://static.ydbimg.com/API/YdbOnline.js" type="text/javascript"></script>
	<script type="text/javascript"
	        src="http://api.map.baidu.com/api?type=quick&ak=543d9b510abc9d829fa8a6f675d666a0&v=1.0"></script>

</head>

<body id="box_1">
<input type='hidden' value='' id='newaddress'>
<script type="text/javascript">
	var YDB = new YDBOBJ();
	$(function () {
		/*获取地理位置*/

		YDB.GetGPS("DoWithGPS");

	});
	//地理位置回调方法
	function DoWithGPS(la, lo) {
		//dosomething with la,lo
		//$("#lanlat").text("您当前的经纬度：" + la + "," + lo);

		//alert("您当前的经纬度为：" + la + "," + lo);
		la = Number(la);
		lo = Number(lo);
		var map = new BMap.Map("allmap");
		var point = new BMap.Point(lo, la);
		var gc = new BMap.Geocoder();
		gc.getLocation(point, function (rs) {
			var addComp = rs.addressComponents;
			address = addComp.province + addComp.city + addComp.district + addComp.street + addComp.streetNumber;
			$.post('member.php?a=setaddress', {address: address}, function (data) {
			});
		});
	}
	;

</script>
<?php
$id = (int)$id;
$huo15_auth = AuthCode($_COOKIE['user_id']);
@$user_id = !empty($huo15_auth) ? (int)AuthCode($_COOKIE['user_id']) : 0;
$row = $dosql->GetOne("SELECT * FROM `#@__infoimg` WHERE id=$id and user_id=$user_id");
if (@$row) {
	if ($row['ouid'] == 0) {
		$ms = $row['istate'] >= 1 ? '完成' : '待处理';
	} else {
		$ms = $row['ostate'] >= 1 ? '完成' : '待处理';
	}
	?>
	<!--Header Start-->
	<div id="header">
		<p class="fh"><a href="JavaScript:window.history.back(-1);"><i class="fa fa-chevron-left"></i> 返回</a></p>
		<h2><?php echo $ms; ?>详情</h2>
		<p class="tel"><a href="/"><i class="fa fa-home"></i></a></p>
	</div>

	<!--Header End-->
	<!--Details Start-->
	<div id="Details">
		<div class="xq_list">
			<ul>
				<li><span>事故号：<?php echo $row['accident']; ?></span><span class="xh"></span></li>
				<li><span>被保险人：<?php echo $row['recognizee']; ?></span></li>
				<li><span>车牌号：<?php echo $row['plate_number']; ?></span></li>
				<li><span>车型：<?php echo $row['models']; ?></span></li>
				<li><span>损失车辆：<?php echo $row['task_car']; ?></span></li>
				<li><span>保单号：<?php echo $row['insurancenum']; ?></span><span class="xh"></span></li>
			</ul>
		</div>
		<div class="xq_list xiuli">
			<ul>
				<li><span>修理厂：</span><em><?php echo $row['repair_depot']; ?></em></li>
				<li><span>地址：</span><em><input id='addressy' value="<?php echo $row['address']; ?>"></em></li>
				<li><span>联系人：</span><em><?php echo $row['contacts']; ?></em></li>
				<li><span>电话：</span><a href="tel:<?php echo $row['phone']; ?>"><em><?php echo $row['phone']; ?></em></a>
				</li>
				<?php
				if ($row['isold_part'] != 1) {
					?>
					<li class="y_time"><em style="line-height:28px;">预约时间：</em><input
							value="<?php if ($row['appointment'] != 0) echo date('Y-m-d', $row['appointment']); ?>"
							class="" readonly name="appointment" placeholder="选择您要预约的时间" id="appDate" type="text">
						<!--<input name="" id='buts' type="submit" class="sub" value="确定">--><a id="buts" class="sub">确定预约</a>
					</li>
				<?php } ?>
				<li>复勘时间：<?php echo date('Y-m-d', $row['investigationtime']); ?></li>
			</ul>
			<dl>
				<dt><a href="?c=img&id=<?php echo $_GET['id']; ?>">定损单照片</a></dt>
				<dd><a href="?c=imgs&id=<?php echo $_GET['id']; ?>">车损照片</a></dd>
			</dl>
		</div>
		<!--转交弹出框-->
		<div id="popDiv" class="mydiv" style="display:none">
			<div class="xuanze">
				<dl>
					<dt><select class="sele" id='sele'>
							<option value=0>请选择</option>

						</select></dt>
					<dd>
						<a href="javascript:;" id='Choiceuser'>确定</a>
						<a href="javascript:closeDivFun();" class="zx">取消</a>
					</dd>
				</dl>
			</div>
		</div>
		<!--转交弹出框-->
		<div id="popDivs" class="mydiv" style="display:none">
			<div class="xuanze">
				<dl>
					<dt><select class="seles" id='seles'>
							<option value=0>请选择</option>

						</select></dt>
					<dd>
						<a href="javascript:;" id='Choiceusers'>确定</a>
						<a href="javascript:closeDivFuns();" class="zx">取消</a>
					</dd>
				</dl>
			</div>
		</div>

		<div id="popm" class="mydiv" style="display:none">
			<div class="xuanze">
				<dl>
					<dt>是否完成</dt>
					<dd>
						<a href="javascript:;" id='popms'>确定</a>
						<a href="javascript:closeDivFunpopm();" class="zx">取消</a>
					</dd>
				</dl>
			</div>
		</div>
		<div class="z_pic">
			<dl class="pic">
				<dt>相册/拍照即可上传</dt>
				<?php
				if ($row['isold_part'] != 1) {
					?>
					<dd><a href="javascript:showDivFun()">转交案件</a></dd>
				<?php } ?>
			</dl>
			<!--上传图片-->
			<div id="uploader">
				<div class="queueList">
					<div id="dndArea" class="placeholder">
						<div id="filePicker"></div>
						<p>点击上传照片，单次最多可选20张</p>
					</div>
				</div>
				<div class="statusBar" style="display:none;">
					<div class="progress">
						<span class="text">0%</span>
						<span class="percentage"></span>
					</div>
					<div class="info"></div>
					<div class="btns">
						<div class="uploadBtn">开始上传</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 火一五信息科技 huo15.com Created by apple on 2017/1/4. -->
		<style>
			.comment a.huo15-a {
				color: #fff;
				display: block;
				height:50px;
				line-height:50px;
				text-align: center;
				font-size: 13px;
				background-color: #056aa5;
				border-radius: 3px;
			}
		</style>
		<div class="comment">
			<?php $randHuo15 = mt_rand(0,10000); ?>
			<a class="huo15-a" href="./galleryMultiple.html?x=<?php echo $randHuo15; ?>">火一五图片上传插件</a>
		</div>
		<!-- 火一五信息科技 huo15.com Created by apple on 2017/1/4. end -->
		<!--留言表单-->
		<div class="comment">
			<h3>审核意见</h3>
			<dl>
				<dt>
				<p id='contacts'>复勘员：<?php echo $r_user['cnname']; ?></p>
				<p id='phone'>手机号：<?php echo $r_user['mobile']; ?></p>
				<input id='address' type='hidden' value='地址：<?php echo $row['address']; ?>'>
				</dt>
				<dd>
					<textarea id='remarks' name="" cols="" rows="" placeholder="点击输入您的审核意见！" class="text"></textarea>
				</dd>
			</dl>
		</div>

	</div>
	<div id="Button">
		<?php
		$img = '';
		$picarr = unserialize($row['staff_picarrs']);
		foreach ($picarr as $_k => $_v) {
			$img .= $_v . ',';
		}
		?>
		<input type='hidden' id='staff_picarrs' value='<?php echo $img; ?>'>

		<ul>

			<?php
			if ($row['isold_part'] != 1) {
				?>
				<li <?php echo $row['isold_part'] == '1' ? "class='cx_nav'" : ""; ?> ><a href="javascript:;"
				                                                                         id='complete'>完成</a></li>
				<li><a href="javascript:;" id='oldcase'><span>提交旧件</span></a></li>
			<?php } else { ?>
				<li <?php echo $row['isold_part'] == '1' ? "class='cx_nav'" : ""; ?> ><a href="javascript:;"
				                                                                         id='oldcasecomplete'>完成</a>
				</li>
			<?php } ?>
		</ul>
	</div>

<?php } else { ?>
	<div id="popDiv" class="mydiv">
		<div class="xuanze shuaxin">
			<dl>
				<dt>案件不存在</dt>
				<dd><a href="member.php?c=investigation;" class="zx">返回</a></dd>
			</dl>
		</div>
	</div>
<?php } ?>
<!--Button End-->
<script type="text/javascript">
	$(function () {
		var currYear = (new Date()).getFullYear();
		var opt = {};
		opt.date = {preset: 'date'};
		opt.datetime = {preset: 'datetime'};
		opt.time = {preset: 'time'};
		opt.default = {
			theme: 'android-ics light', //皮肤样式
			display: 'modal', //显示方式
			mode: 'scroller', //日期选择模式
			dateFormat: 'yyyy-mm-dd',
			lang: 'zh',
			showNow: true,
			nowText: "今天",
			startYear: currYear, //开始年份
			endYear: currYear + 10 //结束年份
		};

		$("#appDate").mobiscroll($.extend(opt['date'], opt['default']));
		var optDateTime = $.extend(opt['datetime'], opt['default']);
		var optTime = $.extend(opt['time'], opt['default']);
		$("#appDateTime").mobiscroll(optDateTime).datetime(optDateTime);
		$("#appTime").mobiscroll(optTime).time(optTime);
	});


</script>
<script type="text/javascript" src="js/webuploader.min.js"></script>
<script type="text/javascript" src="js/upload.js"></script>

<script>
	//弹出调用的方法
	function showDivFun() {
		document.getElementById('popDiv').style.display = 'block';
		$.post('member.php?a=upuser', {'isold_part':<?php echo $row['isold_part']; ?>}, function (data) {
			$('#sele').html(data);
		});
	}
	//关闭事件
	function closeDivFunpopm() {
		document.getElementById('popm').style.display = 'none';
	}
	function closeDivFun() {
		document.getElementById('popDiv').style.display = 'none';
	}
	function closeDivFuns() {
		document.getElementById('popDivs').style.display = 'none';
	}
	$('#Choiceuser')
		.on('click', function () {
			closeDivFun();
			use = $("#sele").find("option:selected").val();
			$.post('member.php?a=choiceuser', {uid: use, id:<?php echo $_GET['id']; ?>}, function (data) {
				$('body').prepend(' <div id="popDiv" class="mydiv" > <div class="xuanze shuaxin">  <dl><dt>' + data + '</dt><dd><a href="member.php?c=investigation;" class="zx">确定</a></dd> </dl> </div>  </div>');
			});
		})
	$('#complete')
		.on('click', function () {

			document.getElementById('popm').style.display = 'block';

		})
	$('#popms')
		.on('click', function () {

			document.getElementById('popm').style.display = 'none';
			img = $("#staff_picarrs").val();
			remarks = $("#remarks").val();
			address = $("#addressy").val();
			$.post('member.php?a=complete', {
				staff_picarrs: img,
				id:<?php echo $_GET['id']; ?>,
				remarks: remarks,
				address: address
			}, function (data) {
				$('body').prepend(' <div id="popDiv" class="mydiv" > <div class="xuanze shuaxin">  <dl><dt>' + data + '</dt><dd><a href="member.php?c=investigation;" class="zx">确定</a></dd> </dl> </div>  </div>');
			});

		})
	$('#oldcasecomplete')
		.on('click', function () {

			img = $("#staff_picarrs").val();
			remarks = $("#remarks").val();
			address = $("#addressy").val();
			$.post('member.php?a=oldcasecomplete', {
				staff_picarrs: img,
				id:<?php echo $_GET['id']; ?>,
				remarks: remarks,
				address: address
			}, function (data) {
				$('body').prepend(' <div id="popDiv" class="mydiv" > <div class="xuanze shuaxin">  <dl><dt>' + data + '</dt><dd><a href="member.php?c=investigation;" class="zx">确定</a></dd> </dl> </div>  </div>');
			});
		})

	$('#oldcase')
		.on('click', function () {
			document.getElementById('popDivs').style.display = 'block';
			$.post('member.php?a=upusers', {}, function (data) {
				$('#seles').html(data);
			});
		})

	$("#Choiceusers").on('click', function () {
		document.getElementById('popDivs').style.display = 'none';
		img = $("#staff_picarrs").val();
		remarks = $("#remarks").val();
		address = $("#addressy").val();
		use = $("#seles").find("option:selected").val();
		if (use == '0') {

			alert('请选择转交人');
			return false;

		}
		$.post('member.php?a=oldcase', {
			staff_picarrs: img,
			id:<?php echo $_GET['id']; ?>,
			remarks: remarks,
			useid: use,
			address: address
		}, function (data) {
			$('body').prepend(' <div id="popDiv" class="mydiv" > <div class="xuanze shuaxin">  <dl><dt>' + data + '</dt><dd><a href="member.php?c=investigation;" class="zx">确定</a></dd> </dl> </div>  </div>');
		});

	})
	$("#buts")
		.on('click', function () {
			var appDate = $("#appDate").val();
			if (appDate == '') {
				$('body').prepend(' <div id="popDiv" class="mydiv" > <div class="xuanze">  <dl><dt>没有选择预约时间</dt><dd><a href="javascript:closeDivFun()" class="zx">确定</a></dd> </dl> </div>  </div>');
				return;
			}
			$.post('member.php?a=appdate', {appointment: appDate, id:<?php echo $_GET['id']; ?>}, function (data) {
				$('body').prepend(' <div id="popDiv" class="mydiv" > <div class="xuanze shuaxin">  <dl><dt>' + data + '</dt><dd><a href="member.php?c=investigation;" class="zx">确定</a></dd></dl></div></div>');
			});
		})

</script>

<a href="/cx/test.html">test</a>
</body>
</html>

