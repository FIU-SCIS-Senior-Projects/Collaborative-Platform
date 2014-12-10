<?php
/* @var $this ApplicationController 
 * @var $applciation ApplicationDomainMentor
 * @var $domain Domain[]
 * */

$domains = addslashes(json_encode($domain));

Yii::app()->clientScript->registerScript('register', "

	window.domains = JSON.parse('" . $domains . "');
	window.selectedDomains = [];
	window.selectedSubdomains = [];
			
			
	var domainTemplate = $('#rowtemplate').clone();
	var subTemplate = $('#subrowtemplate').clone();
			
	function pickDom(obj, type){
		var id = obj.find('.domain-id').text();
		var prof = obj.find('.proficiency option:selected').text();
		var flag = true;
		var hidden = (type === 1) ? '#hiddendom' : '#hiddensub';
			
		var searchPicks = $(hidden).val().split(',');
			
		for(var i = 0; i < searchPicks.length; i++){			
			var pick = searchPicks[i].split(':');
			
		 	if(pick[0] === id){
				searchPicks[i] = pick.join(':');
				searchPicks.splice(i, 1);
				break;
			} else searchPicks[i] = pick.join(':');
		}	
		var result = searchPicks.join(',');
		$(hidden).val(result);		
			
		if(prof !== '--' && flag){
			id = id + ':' + prof;
			var currentPicks = $(hidden).val();
			var separator = (currentPicks === '') ? '' : ',';
			$(hidden).val(currentPicks + separator + id);
		}
	}
			
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
			row.children('.domain-name').attr('data-target', '.sub' + dom.id);
			
			row.children('.proficiency').change(function() {
				pickDom($(this).parent(), 1);
			});
			
			
			grid.find('.items-body').append(row);
			
			for(var j = 0; j < dom.subdomains.length; j++){
				var sub = dom.subdomains[j];	
				var subrow = subTemplate.clone();
						
				// fill in all the data here
				subrow.children('.domain-id').text(sub.id);
				subrow.children('.domain-name').text(dom.name);
				subrow.children('.subdomain-name').text(sub.name);
				subrow.children('.description').text(sub.description);
				subrow.children('.need').text(sub.need);
				subrow.addClass('sub' + dom.id);
				subrow.children('.proficiency').change(function() {
					pickDom($(this).parent(), 0);
				});
			
				grid.find('.items-body').append(subrow);
			}
			
		}
	}
	
	function setInvalid(id, errId){
		$(errId).removeClass('hidden');
		$(id).addClass('txt_error');
	}
		
	function setValid(id, errId){
		$(errId).addClass('hidden');
		$(id).removeClass('txt_error');
	}
			
	function validateApp(){
		var valid = true;
		var numReg = /^\d+$/;

		if(!numReg.test($('#max').val())){
			setInvalid($('#max'), $('#max-error'));
			return false;
		} else setValid($('#max'), $('#max-error'));
		
		if($('#hiddendom').val().length === 0 && $('#hiddensub').val().length === 0){
			$('#main-error').removeClass('hidden');
			return false;
		} else $('#main-error').addClass('hidden');
				
		return valid;	
	}
			
	$('.next').click(function(){
		if(validateApp()){
			var grid = $('#verifydom');

			// clear the table
			grid.find('.items-verify').children().remove();
			
			// get a list of current domain selections
			var currentIds = $('#hiddendom').val().split(',');
			
			if(currentIds.length === 0){
				$('#dom_picks_message').text('You have selected NO Domains.');
			} else {
				$('#dom_picks_message').text('You have selected these Domains.');
				for(var i = 0; i < currentIds.length; i++){
					for(var j = 0; j < window.domains.length; j++){
						var dom = window.domains[j];
						var domsplit = currentIds[i].split(':');
						if(dom.id === domsplit[0]){
							// make a row and add it to the verify grid
							var row = domainTemplate.clone();
			
							// fill in all the data here
							row.children('.domain-name').text(dom.name);
							row.children('.domain-name').removeClass('tbl-center');
							row.children('.description').text(dom.description);
							row.children('.description').addClass('width-override');
							row.children('.proficiency').children().remove();
							row.children('.proficiency').text(domsplit[1]);
							row.children('.subdomain-name').remove();
							row.children('.need').remove();
			
							if(i === 0) grid.find('.items-verify').html(row);
							else grid.find('.items-verify .item:last').after(row);
							break;
						}
					}
				}
			}
			
			grid = $('#verifysub');
			
			// get a list of current subdomain selections
			var currentIds = $('#hiddensub').val().split(',');
			var found = false;
			if(currentIds.length === 0){
				$('#sub_picks_message').text('You have selected NO Subdomains.');
			} else {
				$('#sub_picks_message').text('You have selected these Subdomains.');
				for(var i = 0; i < currentIds.length; i++){
					for(var j = 0; j < window.domains.length; j++){
						var dom = window.domains[j];
						for(var k = 0; k < dom.subdomains.length; k++){
							var sub = dom.subdomains[k];
							var subsplit = currentIds[i].split(':');
							if(sub.id === subsplit[0]){
								// make a row and add it to the verify grid
								var row = subTemplate.clone();
								row.removeClass('collapse out');
				
								// fill in all the data here
								row.children('.domain-name').text(sub.name);
								row.children('.domain-name').removeClass('tbl-center');
								row.children('.description').text(sub.description);
								row.children('.description').addClass('width-override');
								row.children('.proficiency').children().remove();
								row.children('.proficiency').text(subsplit[1]);
								row.children('.subdomain-name').remove();
								row.children('.need').remove();
							
								if(i === 0) grid.find('.items-verify').html(row);
								else grid.find('.items-verify .item:last').after(row);
								found = true;
								break;
							}
						}
						if(found) break;
					}
					found = false;
				}
			}
			$('#max_amount_message').text('You have elected to answer ' + $('#max').val() +' tickets per month.');
			
			$('#verify').modal('toggle');
		}
		return false;
	});
			
	generateGrid();
");
?>

<h1 class="centerTxt">Domain Mentor</h1>
<br>
<p class="centerTxt">From here you may select which domains you wish to mentor. For any domain you wish to mentor assign it a proficiency based on your knowledge of that domain. Click on a domain to view subdomains. Hover over a domain to learn more.</p>
<br>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'project-mentor-app',
	'enableAjaxValidation'=>false,
)); ?>
<style>
.item div {display: inline-block; float: left; padding: 0.3em; font-size: 0.9em; line-height: 1em; cursor: pointer}
.items-header {background: url("/coplat/assets/f769f9db/gridview/bg.gif") repeat-x scroll left top white; padding-top: 5px; color:white; min-height: 30px}
.items-body {height: 400px; overflow-y: scroll; background: #F8F8F8;}
.header-pad {padding-left: 5px}
.domain-name {width: 20%}
.subdomain-name {width: 20%}
.description {width: 45%; padding: 0}
.need {width: 5%}
.proficiency {width: 5%}
.width-override{width: 70% !important}
.domain-id {display: none !important;}
.selectwidthauto{width:auto !important;}
.superRow{background-color: #DFF0D8};
</style>
<div id="mygrid" class="grid-view">
	<div class="items">
		<div class="items-header rowfluid">
			<div class="domain-name span2 lightMarginL">Domain</div>
			<div class="subdomain-name span2 lightMarginL">Subdomain</div>
			<div class="description span5 lightMarginL">Description</div>
			<div class="need span1 lightMarginL">Need</div>
			<div class="proficiency span1 lightMarginL">Proficiency</div>
		</div>
		<div class="items-body row-fluid">
			<div class="item row-fluid tbl-row superRow" id="rowtemplate">
				<div class="domain-id"></div>
				<div class="domain-name tbl-center" data-toggle="collapse" data-target="">Domain</div>
				<div class="subdomain-name tbl-center"></div>
				<div class="description">Description</div>
				<div class="need tbl-center">5</div>
				<div class="proficiency">
					<select class="selectwidthauto">
						<option>--</option>
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
				</div>
			</div>
			<div id="subrowtemplate" class="item row-fluid tbl-row subrow collapse out">
				<div class="domain-id"></div>
				<div class="domain-name tbl-center">Domain</div>
				<div class="subdomain-name tbl-center"></div>
				<div class="description">Description</div>
				<div class="need tbl-center">5</div>
				<div class="proficiency">
					<select class="selectwidthauto">
						<option>--</option>
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
				</div>
			</div>
		</div>
	</div>
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
<?php echo $form->textField($application,'max_amount',array('size'=>2,'maxlength'=>2, 'id'=>'max')); ?>
<p id='max-error' class="note errMsg hidden">The amount entered is invalid.</p>


<?php echo CHtml::hiddenField('domPicks', '', array('id'=>'hiddendom'));?>	
<?php echo CHtml::hiddenField('subPicks', '', array('id'=>'hiddensub'));?>	

<br/>
<div class="text-center">
	<a href="#verify" role="button" class="btn btn-large btn-primary next" data-toggle="modal">Next</a>
	<a style="text-decoration:none" href="/coplat/index.php/application/portal">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
	                'buttonType'=>'button',
	                'type'=>'danger',
					'size'=>'large',
	                'label'=>'Cancel',
	            )); ?>
	</a>
	<h4 id='main-error' class="note errMsg hidden">Must reccomend or set proficiency of at least one domain/subdomain.</h4>
</div>
<div id="verify" class="modal hide fade text-center" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<br/>
		<h3 id="myModalLabel">Summary</h3>
		<br/>
		<p>Please verify that the entered information is correct</p>
	</div>
	<div class="modal-body">
		<h4 id="domhead">Domains</h4>
		<p id="dom_picks_message"></p>
		<div id="verifydom" class="grid-view">
			<div class="items">
				<div class="items-verify row-fluid">
				</div>
			</div>
		</div>
		</br>
		<h4 id="subhead">Subdomains</h4>
		<p id="sub_picks_message"></p>
		<div id="verifysub" class="grid-view">
			<div class="items">
				<div class="items-verify row-fluid">
				</div>
			</div>
		</div>
		</br>
		</br>
		<p id="max_amount_message"></p>
	</div>
	<div class="modal-footer">
		<button class="btn btn-large" data-dismiss="modal" aria-hidden="true">Back</button>
		<?php echo CHtml::submitButton('Submit', array("class"=>"btn btn-large btn-primary")); ?>
	</div>
</div>
<?php $this->endWidget()?>