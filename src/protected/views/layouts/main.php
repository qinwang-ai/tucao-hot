<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name="keywords" content="笑话,吐槽,吐槽网,吐槽热,恶搞段子,搞笑图片,恶搞,tucao-hot"/>
	<meta name="Description" content="新鲜搞笑小短文，恶搞图片，短篇笑话，吐槽图片短文，恶搞趣味，让你无聊生活不再枯燥尽在吐槽热-东京不再热">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<meta property="wb:webmaster" content="dd4a1a814a89dc54" />


	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/semantic/dist/semantic.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" />
	<script src = "<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.11.1.min.js"></script>
	<script src = "<?php echo Yii::app()->request->baseUrl; ?>/semantic/dist/semantic.min.js"></script>
	<script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js" data-appid="101189961" charset="utf-8"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta property="qc:admins" content="17113343231750746375" />
</head>

<body>
<?php
	$ifie8 = false;
	if(strpos($_SERVER['HTTP_USER_AGENT'], "MSIE 8.0")){
		$ifie8 = true;
	}

	if(strpos($_SERVER['HTTP_USER_AGENT'], "MSIE 7.0")||strpos($_SERVER['HTTP_USER_AGENT'], "MSIE 6.0")) {
	echo $_SERVER['HTTP_USER_AGENT'];
		echo '<center>您使用的浏览器已经被淘汰了
		点击下载新版本浏览器访问本站<a href="http://dlsw.baidu.com/sw-search-sp/soft/9d/14744/ChromeStandaloneSetup.1422328105.exe" >下载谷歌浏览器</a>
		</center>
		';
		exit;
	}
?>
<div class = "container">
	<div class = "ui segment logoheader">
		<h2 class="ui header">
			<!-- <i class="settings icon"></i> -->
			<img src = "/images/logo1.png" class = "logo">
			<div class="content">
				吐槽热
				<div class="sub header">东京不再热</div>
			</div>
		</h2>
	</div>

	<div class="ui secondary  <?php if(!$ifie8)echo "menu";?> navbar fixed">
		<a class="active item index" href = "<?php echo $this->createUrl('site/index');?>">
			<i class="home icon"></i>主页
		</a>
		<a class="item create" href = "<?php echo $this->createUrl('item/create')?>">
			<i class="mail icon"></i>
			发布吐槽
		</a>
		<?php if(!Yii::app()->user->isGuest):?>
		<a class="item center" href = "<?php echo $this->createUrl('user/center')?>">
			<i class="user icon"></i> 个人中心
		</a>
		<?php endif;?>
		<div class="right menu">
			<div class="item">
				<div class="ui icon input">
					<input type="text" placeholder="搜索...">
					<i class="search link icon"></i>
				</div>
			</div>
			<?php if(Yii::app()->user->isGuest):?>
				<a class = "ui item login" href =  "<?php echo $this->createUrl('site/login');?>">登录</a>
			<?php else:?>
				<div class="ui image label qqname">
					<img src="">
					<span></span>
					<i class="delete icon" id = "logout"></i>
				</div>
			<?php endif;?>
		</div>
	</div>

<!-- page -->

		<div class="ui horizontal icon divider">
		  <i class="circular bookmark empty icon"></i>
		</div>

		<?php echo $content; ?>

	<div class = "clear"></div>

	<div class="ui segment">
		<p class="rights">
			©2015&nbsp吐槽热版权所有
		</p>
	</div>
</div>
	<script>
		activebutton = "<?php  echo $this->getAction()->getId();?>";
		$(".active").removeClass('active');
		$( "."+activebutton).addClass('active');


		$("#logout").click(function(){
				QC.Login.signOut();
				location.href = "<?php echo $this->createUrl('site/logout')?>";
		});


	</script>
	<script src = "<?php echo Yii::app()->request->baseUrl; ?>/js/index.js"></script>
	 <script type="text/javascript" src="http://tajs.qq.com/stats?sId=42502578" charset="UTF-8"></script>
</body>
</html>
