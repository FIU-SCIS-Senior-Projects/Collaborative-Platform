<?php
/**
 * Created by PhpStorm.
 * User: lorenzo_mac
 * Date: 4/19/14
 * Time: 3:50 PM
 */

?>

<div id="fullcontent">
    <div><h3><?php echo $user->fname; ?> <?php echo $user->lname; ?></h3></div>
    <br>

    <div class="row row-fluid">
        <div class="span6">
            <h3 class="my-box-container-title">Senior Projects</h3>

            <div class="my-box-container" style="height: 400px; overflow-y: scroll ">
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

                        <div id="content-myPopOver-<?= $project->id ?>" style="display: none;">
                            <p><?php echo $project->description ?></p></div>
                        <strong>Start
                            date:</strong> <?php printf(date("M d, Y", strtotime($project->start_date))); ?><br>
                        <strong>End date :</strong> <?php printf(date("M d, Y", strtotime($project->due_date))); ?>
                        <a href="#test" id="myPopOver-<?= $project->id ?>"
                           class="btn btn-primary btn-mini pull-right mypopover"
                           title="<?php echo $project->title; ?>">more
                        </a><br>
                        <hr/>
                        </p>
                    <?php
                    }
                } ?>
            </div>
        </div>
        <div class="span6">
            <h3 class="my-box-container-title">Upcoming meetings</h3>

            <div class="my-box-container" style="height: 400px;overflow-y: scroll ">
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
    </div>
</div>

<script>
    $('.mypopover').popover({
        placement: 'right',
        trigger: 'click',
        html: true,
        content: function () {
            return $("#content-" + $(this).attr('id')).html();
        }
    });
</script>

<!-- End Comment Modal-->
