<?php
$this->breadcrumbs=array('Frecuent Mentee Sub-Domains');
?>
<style> 
    .dashItem{ height:100%; width:100%} 
    .chartCont{ overflow:auto; width:100%; height:450px; border:1px solid #666;   }
    
    .panel {background-color: #fff;  border: 1px solid transparent;}
</style>
<?php $form = $this->beginWidget('CActiveForm', 
                                  array('action' => Yii::app()->createUrl($this->route),
                                       'method' => 'post',
                                       'id'=> 'dashboarForm')); ?>

<table class="dashItem">
    <td style="vertical-align:top; width:225px;">
        <div id="filterRegion" style="overflow:auto; padding-right:30px">
            <div>
                <?php 
                echo $form->labelEx($filter,'lowerBoundMinSupport'); 
                echo $form->textField($filter,'lowerBoundMinSupport'); 
                ?>
            </div>
            <div>
                <?php 
                echo $form->labelEx($filter,'uppperBoundMinSupport'); 
                echo $form->textField($filter,'uppperBoundMinSupport'); 
                ?>
            </div>
            <div>
                <?php 
                echo $form->labelEx($filter,'numRulesToFind'); 
                echo $form->textField($filter,'numRulesToFind'); 
	        ?>
            </div>
            <div><?php echo CHtml::submitButton('Refresh'); ?></div>
       </div>
    </td>
    <td style="vertical-align:top;">
        <div id="chartSection" class="chartCont">
            <?php
                function getColumns()
                {

                     $columns = array();  

                     $columns[] =  array('name'  => 'Premise',
                                         'header'=> 'Premise');   

                     $columns[] =  array('name'  => 'Operator',
                                         'header'=> ''); 

                     $columns[] =  array('name'  => 'Consequence',
                                         'header'=> 'Consequence');  

                      return $columns;
                }

                $this->widget('bootstrap.widgets.TbGridView', 
                              array('id'=>'frecuentMenteeSubDomains', 
                                    'ajaxUpdate'=>true,
                                    'type'=>'striped condensed',
                                    'template' => '{items}',
                                    'dataProvider'=> $dataprovider,
                                    'enablePagination' => false,
                                    'columns' =>getColumns()));
                ?>            
        </div>
    </td>
</table>


<?php
$this->endWidget();