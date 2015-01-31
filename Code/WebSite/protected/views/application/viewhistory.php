<?php
/* @var $model Application */
?>

<?php if(User::isCurrentUserAdmin()) {
	$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'application-closed-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
					//'id',
					'user',
					'date',
					'app_domain_mentor_id',
					'app_personal_mentor_id',
					'app_project_mentor_id',
					array(
							'header'=>'Options',
							'class'=>'bootstrap.widgets.TbButtonColumn',
							'template'=> '{view}',
							'buttons'=>array(
									'view'=>
									array(
											'url'=>'Yii::app()->createUrl("application/history", array("id"=>$data->id))',
					
									),
							),
					),
			),
	));
} else {
			
			$this->widget('zii.widgets.grid.CGridView', array( 
		    'id'=>'application-closed-grid', 
		    'dataProvider'=>$model->search(), 
		    //'filter'=>$model, 
		    'columns'=>array( 
		        //'id',
		        //'user_id',
		        'date',
		        'app_domain_mentor_id',
		        'app_personal_mentor_id',
		        'app_project_mentor_id',
		    		array(
		    				'header'=>'Options',
		    				'class'=>'bootstrap.widgets.TbButtonColumn',
		    				'template'=> '{view}',
		    				'buttons'=>array(
		    						'view'=>
		    						array(
		    								'url'=>'Yii::app()->createUrl("application/history", array("id"=>$data->id))',
		    		
		    						),
		    				),
		    		),
		        
		    ), 
		)); 
}?> 

