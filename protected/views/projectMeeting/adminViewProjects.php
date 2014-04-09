<?php
/**
 * Created by PhpStorm.
 * User: lorenzo_mac
 * Date: 4/2/14
 * Time: 7:28 PM
 */

//$meeting = $model->meetings;

/* @var $this HomeController */
/* @var $dataProvider CActiveDataProvider */
?>


<div id="fullcontent">
    <div><h3><?php echo $user->fname; ?> <?php echo $user->lname; ?></h3></div>
    <br>

    <div class="row row-fluid">
        <div class="span4">
            <h3 class="my-box-container-title">Senior Projects</h3>

            <div id="container" class="my-box-container" style="height: 150px; overflow-y: scroll ">
                <?php
                /** @var Project $projects */
                if ($projects == null) {
                    echo "No Projects Assigned";
                } else {
                    foreach ($projects as $project) {
                        /** @var $project Project */
                        ?>
                        <p><strong>Title :</strong> <?php echo $project->title; ?>
                            <!--<a href="#" class="enable-tooltip" data-toggle="tooltip"
                               data-original-title="<?php /*echo $project->description;*/ ?>">More..</a><br> -->

                            <a href="#test" id="myPopOver-<?= $project->id ?>"
                               class="btn btn-primary btn-mini pull-right mypopover"
                               title="<?php echo $project->title; ?>">more
                            </a><br>

                        <div id="content-myPopOver-<?= $project->id ?>" style="display: none;"><p><?= $project->description ?></p></div>

                        <strong>Start
                            date:</strong> <?php printf(date("M d, Y", strtotime($project->start_date))); ?><br>
                        <strong>End date :</strong> <?php printf(date("M d, Y", strtotime($project->due_date))); ?>
                        </p>
                    <?php
                    }
                } ?>
            </div>
        </div>
        <div class="span4">
            <h3 class="my-box-container-title">Upcoming meetings</h3>

            <div id="container" class="my-box-container" style="height: 150px; overflow-y: scroll ">
                <?php
                /** @var ProjectMeenting $meeting */
                if ($meetings == null) {
                    echo "No Meetings";
                } else {
                    foreach ($meetings as $id => $meeting) {
                        /** @var $mentee User */
                        $mentee = $mentees[$id];
                        //printf("%s @ %s @ %s <hr/>", $mentee, date("M d, Y "), date("h:i A",strtotime($meeting->time)));
                        printf("%s @ %s @ %s<hr/>", $mentee, date("M d, Y", strtotime($meeting->date)), date("h:i A", strtotime($meeting->time)));
                    }
                }?>
            </div>
        </div>
        <br>
        <br>

        <div class="span4">
            <div id="container">
                <!-- Button trigger modal -->
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => 'Set-Up Meeting',
                    'type' => 'primary',
                    'htmlOptions' => array(
                        'data-toggle' => 'modal',
                        'data-target' => '#myModalNewMeeting',
                        'style' => 'width: 100px',
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>


<!-- Modals -->

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModalNewMeeting')); ?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalNewMeeting">New Meeting</h4>
</div>

<div class="modal-body">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'projectMeeting-form',
        //'enableAjaxValidation'=>false,
    )); ?>
    <div style="margin-left:20px">
        <?php $ProjectMeeting = new ProjectMeeting(); ?>

        <?php $data = array();

        foreach ($pmentee as $pm) {
            $data[$pm->id] = $pm->fname . ' ' . $pm->lname;
        }
        ?>
        <?php echo $form->labelEx($ProjectMeeting, 'mentee_user_id'); ?>
        <?php /*echo $form->TextField($ProjectMeeting, 'mentee_user_id'); */ ?>
        <?php echo $form->dropDownList($ProjectMeeting, 'mentee_user_id', $data, array('prompt' => 'Select')); ?>
        <?php /*echo $form->dropDownList($ProjectMeeting, 'mentee_user_id', CHtml::listData(User::model()->findAll(), 'id', 'fname')); */ ?>

        <?php /*echo $form->textField($ProjectMeeting, 'mentee_user_id', array('size' => 11, 'maxlength' => 11)); */ ?>

        <!-- LABEL AND INPUT FOR DATE -->
        <?php echo $form->labelEx($ProjectMeeting, 'date'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'ProjectMeeting[date]',
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
            ),
        ));?>
        (yyyy-mm-dd)

        <!-- LABEL AND INPUT FOR TIME-->
        <?php echo $form->labelEx($ProjectMeeting, 'time'); ?>
        <?php //echo $form->textField($videoInterview,'time'); ?>
        <input name="ProjectMeeting[time]" id="Project_Meeting_time" type="time">
        (eg. 03:28pm or 3:28am)


    </div>

</div>

<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'Submit', 'type' => 'primary', 'label' => 'Submit', 'url' => '#',
        'htmlOptions' => array('id' => 'submit'),
    ));
    ?>

    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'Close', 'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    ));
    ?>

    <?php $this->endWidget() ?>
    <?php $this->endWidget() ?>
</div>


<!-- Script for Comment modal -->
<script>
    $('a#submit').on('click', function () {
        var confirmed = confirm("Do you really want to setup a meeting?");
        if(confirmed) {
            $.post('/coplat/index.php/projectMeeting/create/<?php echo $user->id?>', $('#projectMeeting-form').serialize(), function (message) {
                window.location = location.pathname;
            });
        }
        return false;
    })

    $('.mypopover').popover({
        placement: 'right',
        trigger: 'click',
        html: true,
        content: function () {
            return $("#content-"+$(this).attr('id')).html();
        }
    });
</script>

<!-- End Comment Modal-->
