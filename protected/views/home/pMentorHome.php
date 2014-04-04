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

$this->breadcrumbs = array(
    'Project Mentors',
);

$this->menu = array(
    //array('label'=>'Create ProjectMentor', 'url'=>array('create')),
    // array('label'=>'Manage ProjectMentor', 'url'=>array('admin')),
);


?>

<!-- Js for popover -->
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("a.enable-tooltip").tooltip({
            placement: 'right'
        });
    });
</script>
<style type="text/css">
    .bs-example {
        margin: 100px 50px;
    }
</style>
<!-- End Js for popover -->

<div id="fullcontent">
    <div style="color: #0044cc"><h2>Project Mentor Home</h2></div>
    <br>

    <div><h3><?php echo $user->fname; ?> <?php echo $user->lname; ?></h3></div>
    <br>

    <div class="row row-fluid">
        <div class="span4">
            <h3 class="my-box-container-title">Projects</h3>

            <div id="container" class="my-box-container">
                <?php
                /** @var Project $projects */
                if ($projects == null) {
                    echo "No Projects Assigned";
                } else {
                    foreach ($projects as $project) {
                        /** @var $project Project */
                        ?>
                        <p><strong>Title :</strong> <?php echo $project->title; ?>
                            <a href="#" class="enable-tooltip" data-toggle="tooltip"
                               data-original-title="<?php echo $project->description; ?>">More..</a><br>
                            <strong>Start date
                                :</strong> <?php printf(date("M d, Y", strtotime($project->start_date))); ?><br>
                            <strong>End date :</strong> <?php printf(date("M d, Y", strtotime($project->due_date))); ?>
                        </p>
                    <?php
                    }
                } ?>
            </div>
        </div>
        <div class="span4">
            <h3 class="my-box-container-title">Meetings</h3>

            <div id="container" class="my-box-container">
                <?php
                /** @var ProjectMeenting $meeting */
                if ($meetings == null) {
                    echo "No Meetings";
                } else {
                    foreach ($meetings as $id => $meeting) {
                        /** @var $mentee User */
                        $mentee = $mentees[$id];
                        printf("%s at %s<hr/>", $mentee, date("M d, Y h:i A", strtotime($meeting->date)));
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
    <br>
</div>


<!-- Modals -->

<div class="modal fade" id="myModalNewMeeting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">New Meeting</h4>
    </div>
    <div class="modal-body">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'projectMeeting-form',
            //'enableAjaxValidation'=>false,
        )); ?>
        <div style="margin-left:20px">
            <?php $ProjectMeeting = new ProjectMeeting();

            $data = array();

            foreach ($menteeName as $mod) {
            $data[$mod->id] = $mod->fname .' '. $mod->lname;
            }
            ?>
            <?php echo $form->labelEx($ProjectMeeting, 'mentee_user_id'); ?>
            <?php echo $form->dropDownList($ProjectMeeting, 'mentee_user_id', $data ,array('prompt' => 'Select')); ?>

            <?php /*echo $form->textField($ProjectMeeting, 'mentee_user_id', array('size' => 11, 'maxlength' => 11)); */?>

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
    </div>
</div>

<!-- Script for Comment modal -->
<script>
    $('a#submit').on('click', function () {
        $.post('/coplat/index.php/projectMeeting/create/<?php echo $user->id?>', $('#projectMeeting-form').serialize(), function (message) {
            window.location = location;
        });
        return false;
    })
</script>

<!-- End Comment Modal-->


</div> <!-- End Full Content -->