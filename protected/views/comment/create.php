<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs=array(
	'Comments'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Comment', 'url'=>array('index')),
	//array('label'=>'Manage Comment', 'url'=>array('admin')),
);
?>

<div id = "wrapper" >
	<span><strong>Comment</strong></span>
		<div>
			<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
		</div> 
</div>
