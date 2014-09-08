<?php
class ClockPick extends CWidget {

	var $uniq;
	var $assets = '';
	var $options;
	var $model;
	var $name;
	
	/**
	 * Initializes the widget.
	 * This method is called by {@link CBaseController::createWidget}
	 * and {@link CBaseController::beginWidget} after the widget's
	 * properties have been initialized.
	 */
	public function init()
	{
		$this->assets = Yii::app()->assetManager->publish(Yii::getPathOfAlias('ext.clockpick.assets'));
		
        Yii::app()->clientScript->registerCssFile( $this->assets.'/css/jquery.clockpick.1.2.9.css' );
        
        Yii::app()->clientScript->registerCoreScript( 'jquery' );

        Yii::app()->clientScript->registerScriptFile( $this->assets.'/js/jquery-ui-1.8.9.custom.min.js' );
        
        Yii::app()->clientScript->registerScriptFile( $this->assets.'/js/jquery.clockpick.1.2.9.js' );
        
        $this->uniq = $this->id.'_'.uniqid();

        $options=empty($this->options) ? '' : CJavaScript::encode($this->options);

		Yii::app()->getClientScript()->registerScript(__CLASS__.'#'.$this->uniq,"jQuery('#{$this->uniq}').clockpick($options);");

        parent::init();
	}

	/**
	 * Executes the widget.
	 * This method is called by {@link CBaseController::endWidget}.
	 */
	public function run()
	{
		$this->render('ClockPick', array('id'=>$this->uniq, 'model'=>$this->model, 'name'=>$this->name));		
	}
	
	
}
?>