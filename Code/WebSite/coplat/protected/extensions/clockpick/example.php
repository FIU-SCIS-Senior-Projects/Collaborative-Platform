<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
<?php
	$this->widget('ext.clockpick.ClockPick', array(
	'id'=>'name',
	'model'=>$model,
	'name'=>'name',
	'options'=>array(
		'starthour'=>8,
		'endhour'=>18,
		'event'=>'click',
		'showminutes'=>true,
		'minutedivisions'=>4,
		'military' =>false,
		'layout'=>'vertical',
		'hoursopacity'=>1,
		'minutesopacity'=>1,
	),
));?>
</div>