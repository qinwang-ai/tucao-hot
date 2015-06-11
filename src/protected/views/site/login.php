<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<div class = "content_">
	<div class='ui fluid form segment'>
		<div class="ui top left attached label">使用合作账号登录</div>
		<div class = "ui header"></div>
		<span id="qqLoginBtn" class = "">
			<img class="icon">
		</span>
	</div>
</div><!-- form -->
<script>
		QC.Login({
			btnId:"qqLoginBtn",	//插入按钮的节点id
			size : "A_M",
		});


		QC.Login.getMe(function(openId, accessToken){
			$.post("?r=user/check",{openid:openId,accesstoken:accessToken},function(data){
				if(data==1){
					location.href = "?r=site/index";
				}else{
					location.href = "?r=user/sign&openid="+openId+"&accesstoken="+accessToken;
				}
			});
		});

</script>
