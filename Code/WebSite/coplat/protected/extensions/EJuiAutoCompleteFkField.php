<?php
/* 
 * EJuiAutoCompleteFkField class file
 *
 * @author Jeremy Dunn <jeremy.j.dunn@gmail.com>
 * @link http://www.yiiframework.com/
 * @version 1.6
 */

/*
 * The EJuiAutoCompleteFKField extension renders a CJuiAutoComplete field plus supporting form fields for a FK field.
 * Typically it is used for a model with a foreign key field to a child table that has too many records
 * for a drop-down list to be practical.
 *
 * For example it could be used in a Contact table, with a foreign key PostCodeId to a PostCode table
 * with thousands of records, one for each city / postcode combination.  The user would type the city name in the AutoCompleter,
 * and the PostCodeId would be stored in the correct PostCodeId column; while the display attribute (e.g. City, Province) is shown
 * in the form.
 *
 * The extension renders the following form objects:
 * 1) the model field itself, which may optionally be hidden or visible
 * 2) a hidden field that holds the description field of the FK record, for redisplay if the user
 *    fails to choose a value from the autoCompleter
 * 3) the AutoComplete field itself, which also displays the existing value from the related record
 * 4) a 'delete' icon to clear fields 1-3 above
 * 5) javascript to tie everything together
 *
 * Typical usage:
 * 1) unzip the extension into ../extensions/
 *
 * 2) make sure config/main.php has:
 *    <pre>
 *      ...
 *      import=>array(
 *          ...
 *          'application.extensions.*',
 *          ...
 *      ),
 *    </pre>
 *
 * 3) ensure the relationship exists in the model:
 * in Contacts.php (example):
 * <pre>
 * ...
 * 'relations'=>array(
 *      'Postcode'=>array('self::BELONGS_TO, 'PostCodes', 'PostCodeId'),
 * ...
 * </pre>
 *
 * 4) in the related table, optionally create a pseudo-attribute for display purposes
 * in PostCodes.php (model) for example:
 * <pre>
 * ...
 * public function getPostCodeAndProvince() {
 *      return $this->PostCodeId . ', ' . $this->Province;
 * }
 * </pre>
 *
 * 5) in the _form.php for the main record (e.g. Contacts)
 * <pre>
 * ...
 * echo $form->labelEx($model, 'PostCodeId);
 * $this->widget('EJuiAutoCompleteFkField', array(
 *      'model'=>$model, //  e.g. the Contact model (from CJuiInputWidget)
 *      // attribute must have double-quotes if using form "[$i]FieldName" for child-rows
 *      'attribute'=>"PostCodeId",  // the FK field (from CJuiInputWidget)
 *      'sourceUrl'=>'findPostCode', // name of the controller method to return the autoComplete data (see below)  (from CJuiAutoComplete)
 *      'showFKField'=>true, // defaults to false.  set 'true' to display the FK value in the form with 'readonly' attribute.
 *      'FKFieldSize=>15, // display size of the FK field.  only matters if not hidden.  defaults to 10
 *      'relName'=>'Postcode', // the relation name defined above
 *      'displayAttr'=>'PostCodeAndProvince',  // attribute or pseudo-attribute to display
 *      'autoCompleteLength'=>60, // length of the AutoComplete/display field, defaults to 50
 *      // any attributes of CJuiAutoComplete and jQuery JUI AutoComplete widget may also be defined.  read the code and docs for all options
 *      'options'=>array(
 *          'minLength'=>3, // number of characters that must be typed before autoCompleter returns a value, defaults to 2
 *      ),
 * ));
 * echo $form->error($model, 'PostCodeId');
 * ...
 * </pre>
 *
 * 6) in the Controller for the model, create a method to return the autoComplete data.
 *    NOTE: make sure to give users the correct permission to execute this method, according to your security scheme
 * 
 * in ContactsController.php (for example):
 * </pre>
 *   // data provider for EJuiAutoCompleteFkField for PostCodeId field
 *   public function actionFindPostCode() {
 *       $q = $_GET['term'];
 *       if (isset($q)) {
 *           $criteria = new CDbCriteria;
 *           $criteria->condition = '...', //condition to find your data, using q1 as the parameter field
 *           $criteria->order = '...'; // correct order-by field
 *           $criteria->limit = ...; // probably a good idea to limit the results
 *           $criteria->params = array(':q' => trim($q) . '%'); // with trailing wildcard only; probably a good idea for large volumes of data
 *           $PostCodes = PostCodes::model()->findAll($criteria);
 *
 *           if (!empty($PostCodes)) {
 *               $out = array();
 *               foreach ($PostCodes as $p) {
 *                   $out[] = array(
 *                       'label' => $p->PostCodeAndProvince,  // expression to give the string for the autoComplete drop-down
 *                       'value' => $p->PostCodeAndProvince, // probably the same expression as above
 *                       'id' => $p->PostCodeId, // return value from autocomplete
 *                   );
 *               }
 *               echo CJSON::encode($out);
 *               Yii::app()->end();
 *           }
 *       }
 *   }
 * </pre>
 *
 * 7) in the Controller loadModel() method, return the related record
 * in ContactsController.php (for example)
 * <pre>
 * public function loadModel() {
 *      ...
 *      if (isset($_GET['id']))
 *               $this->_model=Contacts::model()->with('Postcode')->findbyPk($_GET['id']);  // <====  NOTE 'with()'
 *      ...
 * }
 * </pre>
 */

Yii::import('zii.widgets.jui.CJuiAutoComplete');
class EJuiAutoCompleteFkField extends CJuiAutoComplete {

	/**
	 * @var boolean whether to show the FK field.
	 */
	public $showFKField = false;

	/**
	 * @var integer length of the FK field if visible
	 */
	public $FKFieldSize = 10;
	/**
	 * @var string the relation name to the FK table
	 */
	public $relName;
        
        /**
         * @var string the relation-name for hover-text under "remove" icon.  
         * defaults to "Remove {relname}".  
         * If present, hover-text is "Remove {relNameLabel}"
         */
        public $relNameLabel;

	/**
	 * @var string the attribute (or pseudo-attribute) to display from the FK table
	 */
	public $displayAttr;

	/**
	 * @var integer width of the AutoComplete field
	 */
	public $autoCompleteLength = 50;

	/**
	 * @var string the ID of the FK field
	 */
	private $_fieldID;
        
	/**
	 * @var string the ID of the hidden field to save the display value
	 */
	private $_saveID;
        
	/**
	 * @var string the ID of the AutoComplete field
	 */
	private $_lookupID;

	/**
	 * @var string the initial display value
	 */
	private $_display;

    public function init() {
        parent::init(); // ensure necessary assets are loaded
        
        // JJD 8/3/11 make EJuiAutoCompleteFkField work for child rows where attribute like [$i]FieldName
        // get the ID which will be created for the actual field when it is rendered.
        // don't let resolveNameID() change $this->attribute which is needed to generate the actual field
        $attr = $this->attribute;
        $tempHtmlOpts = array();
        CHtml::resolveNameID($this->model, $attr, $tempHtmlOpts);
        $id = $tempHtmlOpts['id'];
        $this->_fieldID = $id;
        $this->_saveID = $id . '_save';
        $this->_lookupID = $id .'_lookup';

        $related = $this->model->{$this->relName}; // get the related record
        $value = CHtml::resolveValue($this->model, $this->attribute);
        $this->_display=(!empty($value) ? $related->{$this->displayAttr} : '');
//	$this->_display=($value!==null ? $related->{$this->displayAttr} : ''); // nineinchnick comment #6809 handle zero as valid FK value. not sure works in all cases
        
        if (!isset($this->options['minLength']))
            $this->options['minLength'] = 2;

        if (!isset($this->options['maxHeight']))
            $this->options['maxHeight']='100';

        $this->htmlOptions['size'] = $this->autoCompleteLength;
        // fix problem with Chrome 10 validating maxLength for the auto-complete field
        $this->htmlOptions['maxlength'] = $this->autoCompleteLength;
        
        // setup javascript to do the work
        $this->options['create']="js:function(event, ui){\$(this).val('".addslashes($this->_display)."');}";  // show initial display value
        // after user picks from list, save the ID in model/attr field, and Value in _save field for redisplay
        $this->options['select']="js:function(event, ui){\$('#".$this->_fieldID."').val(ui.item.id);\$('#".$this->_saveID."').val(ui.item.value);}";
        // when the autoComplete field loses focus, refresh the field with current value of _save
        // this is either the previous value if user didn't pick anything; or the new value if they did
        $this->htmlOptions['onblur']="$(this).val($('#".$this->_saveID."').val());";
    }

    public function run() {
        // first render the FK field.  This is the actual data field, populated by autocomplete.select()
        if ($this->showFKField) {
            echo CHtml::activeTextField($this->model, $this->attribute, array('size'=>$this->FKFieldSize, 'readonly'=>'readonly'));
        } else {
            echo CHtml::activeHiddenField($this->model,$this->attribute);
        }
        
        // second, the hidden field used to refresh the display value
        echo CHtml::hiddenField($this->_saveID,$this->_display, array('id'=>$this->_saveID)); 

        // third, the autoComplete field itself
        $this->htmlOptions['id'] = $this->_lookupID;
        $this->htmlOptions['name'] = $this->_lookupID;       
        parent::run();

        // fouth, an image button to empty all three fields
        // JJD 1/2/13 v1.6 use relNameLabel if present
        //$label=Yii::t('DR','Remove '). ucfirst((!empty($this->relNameLabel) ? $this->relNameLabel : $this->relName));
      //  $deleteImageURL = '/images/text_field_remove.png';
      //  echo CHtml::image($deleteImageURL, $label,
        //    array('title'=>$label,
       //         'name' => 'remove'.$this->_fieldID,
        //        'style'=>'margin-left:6px;',
       //         // JJD 4/27/12 #1350 trigger onchange event for display field, in case there's an event attached (e.g. unsaved-changes-warning)
         //       'onclick'=>"$('#".$this->_fieldID."').val('').trigger('change');$('#".$this->_saveID."').val('');$('#".$this->_lookupID."').val('');",
        //    )
      //  );
    }
}
?>
