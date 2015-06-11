<?php
/* @var $this ItemController */
/* @var $model Item */

$this->breadcrumbs=array(
	'Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Item', 'url'=>array('index')),
	array('label'=>'Manage Item', 'url'=>array('admin')),
);
?>
<div class = "content_">
<h1>发布一条吐槽</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
