<?php
/* @var $this ItemController */
/* @var $model Item */
/* @var $form CActiveForm */
?>

<div class="ui form segment" style = "width:600px">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="field">
		<?php echo $form->labelEx($model,'item_title'); ?>
		<?php echo $form->textField($model,'item_title'); ?>
		<?php echo $form->error($model,'item_title'); ?>
	</div>

	<div class="field">
		<?php echo $form->labelEx($model,'item_detail'); ?>
		<?php echo $form->textArea($model,'item_detail'); ?>
		<?php echo $form->error($model,'item_detail'); ?>
	</div>

	<div class="field ">
		<?php echo $form->labelEx($model,'item_picture'); ?>
		<div class="ui action left icon input fileupload">
			<?php echo $form->fileField($model,'item_picture',array('style'=>'display:none','id'=>'loadinput','onchange' =>'$("#track").val(this.value)')); ?>
			<input type="text" placeholder="" id = "track" name = "track" readonly='readonly'>
			<div class="ui teal button" onclick = "$('#loadinput').click()">选择文件</div>
		</div>

		<?php echo $form->textField($model,'user_id',array('style'=>'display:none','value'=>Yii::app()->user->user_id)); ?>
		<?php echo $form->error($model,'item_picture'); ?>
	</div>

		<?php echo $form->textField($model,'publisher',array('style'=>'display:none')); ?>

	<div class="field buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存',array('class'=>'ui button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
		var paras = {};
		QC.api("get_user_info", paras)
		.success(function(s){//成功回调
			$("#Item_publisher").val(s.data.nickname);
		})
		.error(function(f){//失败回调
			alert("获取用户信息失败！");
		})
		.complete(function(c){//完成请求回调
		});
</script>
