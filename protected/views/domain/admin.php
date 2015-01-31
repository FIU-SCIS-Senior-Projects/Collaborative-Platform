<?php
/* @var $this DomainController */
/* @var $model Domain */

$this->breadcrumbs=array(
	'Manage Domains',
);

?>

<h2>Manage Domains</h2>

<a href=../domain/create>
<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'button',
		'label'=>'Add New Domain / Sub-Domain',
		'icon'=>'plus white',
		'size'=>'small',
		'type'=> 'success',
		//'htmlOptions'=>array('class'=>'pull-right')
		//'url'=>'user/create',
		// button for ADD NEW DOMAIN/SUBDOMAIN
		// FIX HREF
));?>
</a>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'domain-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		'description',
		//'validator',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
