<?php $this->widget('bootstrap.widgets.TbTabs', array(
		    'tabs'=> array(
				array(
				'label'=>"Account",
				'active'=> true,
				'content'=>$this->renderPartial('accountInfoForm', array('form'=>$form, 'model'=>$model))),
				array(
				'label'=>"Personal Info",
				'content'=>$this->renderPartial('personalInfoForm', array('form'=>$form, 'model'=>$model))),
			),
		)); ?>