<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>


<div class = "content_">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
			'class'=>'ui fluid form segment'
		)
)); ?>


	<div class="ui top left attached label">完善您的信息</div>
	<div class="ui header"></div>
	<div class="two fields">
		<div class="field">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username',array('size'=>32,'maxlength'=>32)); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>

		<div class="field">
			<?php echo $form->labelEx($model,'psw'); ?>
			<?php echo $form->textField($model,'psw',array('size'=>40,'maxlength'=>40)); ?>
			<?php echo $form->textField($model,'openid',array('style'=>'display:none')); ?>
			<?php echo $form->textField($model,'accesstoken',array('style'=>'display:none')); ?>
			<?php echo $form->error($model,'psw'); ?>
		</div>
	</div>

	<?php echo CHtml::submitButton($model->isNewRecord ? '提交' : '保存',$htmlOptions=array('class'=>'ui submit button')); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
		var paras = {};
		QC.api("get_user_info", paras)
		.success(function(s){//成功回调
			$("#User_username").val(s.data.nickname);
			$("#User_openid").val("<?php echo $_GET['openid'];?>");
			$("#User_accesstoken").val("<?php echo $_GET['accesstoken'];?>");
		})
		.error(function(f){//失败回调
			alert("获取用户信息失败！");
		})
		.complete(function(c){//完成请求回调
		});
</script>
