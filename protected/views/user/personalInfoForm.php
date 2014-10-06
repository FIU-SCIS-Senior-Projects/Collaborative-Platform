<fieldset>
		<?php echo $form->labelEx($model,'employer'); ?>
        <?php echo $form->textField($model,'employer',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'employer'); ?>
        
        <?php echo $form->labelEx($model,'position'); ?>
        <?php echo $form->textField($model,'position',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'position'); ?>
         
        <?php echo $form->labelEx($model,'start_year'); ?>
        <?php echo $form->textField($model,'start_year',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'start_year'); ?>
		
        <?php echo $form->dropDownListRow($model,'degree',array('Select', 'Bachelors', 'Masters', 'PhD')); ?>
		<?php echo $form->error($model,'degree'); ?>
		
		<?php echo $form->labelEx($model,'field_of_study'); ?>
        <?php echo $form->textField($model,'field_of_study',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'field_of_study'); ?>
		
		<?php echo $form->labelEx($model,'school'); ?>
        <?php echo $form->textField($model,'school',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'school'); ?>
		
		<?php echo $form->labelEx($model,'graduation_year'); ?>
        <?php echo $form->textField($model,'graduation_year',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'graduation_year'); ?>
</fieldset>