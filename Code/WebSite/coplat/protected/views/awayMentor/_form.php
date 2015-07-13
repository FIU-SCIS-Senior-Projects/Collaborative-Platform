<?php
/* @var $this AwayMentorController */
/* @var $model AwayMentor */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'away-mentor-form',
        'enableAjaxValidation'=>true,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo "Last-Name, First-Name "; ?><font color="red">*</font><br/>

        <?php
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name'=>'name_search',
            'value'=>$model->name_search,

            'source'=>Yii::app()->createUrl('/AwayMentor/MikeFindUserName'),// <- path to controller which returns dynamic data
            // additional javascript options for the autocomplete plugin
            'options'=>array(
                'minLength'=>'1', // min chars to start search
                'select'=>"js: function(event, data) {
                                                $('#name_search').val(data.item.value);
                                                $(this).data('id',data.item.id);
                                                return false;
                                                            }",
                'focus' => "js: function(event,data){
                                                    $(this).val(data.item.value);
                                                    return false;
                                                        }"
            ),
            'htmlOptions'=>array(
                'id'=>'name_search',
                'rel'=>'val',
            ),
        ));
        echo $form->error($model,'name_search');
        //    Yii::app()->clientScript->registerScript('autocomplete', "
        //jQuery('#name_search').data('autocomplete')._renderItem = function( ul, item ) {
        //return $('<li></li>')
        // .data('item.autocomplete', item)
        //.append('<a>' + item.value + '<br><i>' + item.id + '</i></a>')
        //.appendTo(ul);
        //};",
        //        CClientScript::POS_READY
        //);
        ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>
    <html lang="en">

    <body>
    <form action="AwayMentor/Create">


        <script>
            $( "#name_search" ).autocomplete({
                source: './MikeFindUserName'
            });
        </script>

    </form>
    </body>
    </html>
</div><!-- form -->

<style>
        .error-message {
            background-color: #f2dede;
            border-radius: 3px;
            padding: 10px;
        }
        div.mbox {
            width: 500px;
            padding: 15px;
            margin-bottom: 15px;
            margin-top:30px;
            border-radius: 4px;
        }
        .mbox p {
            margin: 0px 0px 0px;
        }
        a.mbox {
            color: #31708f;
        }
        .mbox span {
            font-weight: bold;
            margin-right: 6px;
        }
        .mbox ul {
            margin: 0;
        }
        .mbox hr {
            border-top: 1px solid #19536c;
            border-bottom: 0px;
            margin: 5px 0px;
        }
        .ui-tooltip {
            padding: 3px;
            font-size: smaller;
        }
        .mbox button, .mbox .btn{
            padding: 2px 4px;
            font-size: small;
            margin-right: 4px;
        }
        .cancelled{
            background-color: #f4ffbc;
        }
    </style>
