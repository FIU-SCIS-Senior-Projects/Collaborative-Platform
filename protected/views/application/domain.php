<?php
/* @var $this ApplicationController 
 * @var $applciation ApplicationDomainMentor
 * @var $domain Domain[]
 * */

$domains = addslashes(json_encode($domain));

Yii::app()->clientScript->registerScript('register', "

	window.domains = JSON.parse('" . $domains . "');
			
	var domainTemplate = $('#rowtemplate').clone();
			
			
	function generateGrid(){
		var grid = $('#mygrid');		
		grid.find('.items-body').children().remove();		
			
		for (var i = 0; i < domains.length; i++){
			var dom = domains[i];	
			var row = domainTemplate.clone();
			
			// fill in all the data here
			row.children('.domain-id').text(dom.id);
			row.children('.domain-name').text(dom.name);
			row.children('.description').text(dom.description);
			row.children('.need').text(dom.need);
			
			grid.find('.items-body').append(row);
		}
	}
			
	generateGrid();
");
?>

<h1 class="centerTxt">Domain Mentor</h1>
<br>
<p class="centerTxt">From here you may select which domains you wish to mentor. For any domain you wish to mentor assign it a proficiency based on your knowledge of that domain. Hover over a domain to learn more.</p>
<br>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'project-mentor-app',
	'enableAjaxValidation'=>false,
)); ?>
<style>
.items-header {background: url("/coplat/assets/f769f9db/gridview/bg.gif") repeat-x scroll left top white; color: white; padding-top: 5px}
.domain-id {display: none !important;}
.selectwidthauto{width:auto !important;}
</style>
<div id="mygrid">
	<table class="table table-striped table-bordered">
		<thead class="items-header row-fluid">
			<tr>
				<th class="domain-name">Domain</th>
				<th class="subdomain-name">Subdomain</th>
				<th class="description">Description</th>
				<th class="need">Need</th>
				<th class="proficiency">Proficiency</th>
			</tr>
		</thead>
		<tbody class="items-body">
			<tr id="rowtemplate" data-toggle="collapse" data-target=".subrow" class="accordion-toggle">
				<div class="domain-id"></div>
				<td class="domain-name">Domain</td>
				<td class="subdomain-name"></td>
				<td class="description">Description</td>
				<td class="need">5</td>
				<td class="proficiency">
					<select class="selectwidthauto">
						<option>0</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
						<option>9</option>
						<option>10</option>
					</select>
				</td>
			</tr>
			<tr id="subrowtemplate">
				<div class="domain-id"></div>
				<td class="domain-name">Domain</td>
				<td class="subdomain-name"></td>
				<td class="description">Description</td>
				<td class="need">5</td>
				<td class="proficiency">
				<select class="selectwidthauto">
						<option>0</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
						<option>9</option>
						<option>10</option>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<br/>
<p>Don't see your area of expertise?</p>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'button',
                'type'=>'success',
				'size'=>'medium',
                'label'=>'Recommend a new Domain +',
            )); ?>
<br/> <br/>
<?php echo $form->labelEx($application,'max_amount'); ?>
<?php echo $form->textField($application,'max_amount',array('size'=>2,'maxlength'=>2)); ?>
<?php echo $form->error($application,'max_amount'); ?>

<br/>
<div class="text-center">
	<?php echo CHtml::submitButton('Submit', array("class"=>"btn btn-large btn-primary")/*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
	<a style="text-decoration:none" href="/coplat/index.php/application/portal">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
	                'buttonType'=>'button',
	                'type'=>'danger',
					'size'=>'large',
	                'label'=>'Cancel',
	            )); ?>
	</a>
</div>

<?php $this->endWidget()?>