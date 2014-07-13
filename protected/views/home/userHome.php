<?php
if(User::isCurrentUserAdmin())
{
    echo "<script> window.location ='adminHome' </script>";

} else
{
/**
 * Created by PhpStorm.
 * User: lorenzo_mac
 * Date: 4/9/14
 * Time: 2:08 PM
 */
?>

<div><h2><?php echo $user->fname; ?> <?php echo $user->lname; ?> Dashboard</h2></div>
<br>
    <table style="width:auto;">
        <tr>
            <th>Project Mentor</th>
            <th>Domain Mentor</th>
            <th>Personal Mentor</th>
            <th>Mentee</th>

        </tr>
        <tr>
            <?php
            $gray1 = 'style="opacity: 0.4;filter: alpha(opacity=40);" ';
            $gray2 = 'style="opacity: 0.4;filter: alpha(opacity=40);" ';
            $gray3 = 'style="opacity: 0.4;filter: alpha(opacity=40);" ';
            $gray4 = 'style="opacity: 0.4;filter: alpha(opacity=40);" ';

            $linkpjm = '';
            $linkdmm = '';
            $linkperm = '';
            $linkmen = '';

            if ($user->isProMentor())
            {
                $gray1 = '';
                $linkpjm='href="/coplat/index.php/projectMeeting/pMentorViewMeetings"';
            }
            if($user->isDomMentor())
            {
                $gray2 = '';
                $linkdmm ='href="/coplat/index.php/projectMeeting/domainMentorViewMeetings"';

            }
            if($user->isPerMentor())
            {
                $gray3 = '';
                $linkperm = 'href="/coplat/index.php/projectMeeting/personalMentorViewMeetings"';

            }
            if($user->isMentee())
            {
                $gray4 = '';
                $linkmen ='href="/coplat/index.php/projectMeeting/pMenteeViewMeetings"';

            }


            ?>

            <td style="padding:20px;"><a <?php echo $linkpjm; ?>><img  <?php echo $gray1 ?> border="0" src="/coplat/images/roles/project.png" id="pjm" width="200" height="200"></a></td>
            <td style="padding:20px;"><a <?php echo $linkdmm; ?>><img <?php echo $gray2 ?> border="0" src="/coplat/images/roles/domain.png" id="dmm" width="200" height="200"></a></td>
            <td style="padding:20px;"><a <?php echo $linkperm; ?>><img <?php echo $gray3 ?>  border="0" src="/coplat/images/roles/personal.png" id="pm" width="200" height="200"></a></td>
            <td style="padding:20px;"><a <?php echo $linkmen; ?>><img <?php echo $gray4 ?>  border="0" src="/coplat/images/roles/mentee.png" id="men" width="200" height="200"></a></td>

        </tr>
    </table>
<div><h3>My To Do</h3></div>

<!-- <div style="margin-top = 0px; height: 300px; width: 1000px; overflow-y: scroll; border-radius: 5px;"> -->
<div id="fullcontent">

    <div>
        <div class="span4" style="width: 800px; margin-left: 0px">
            <ul class="nav nav-tabs">
                <li><a href="#open" data-toggle="tab">Open</a></li>
                <li><a href="#close" data-toggle="tab">Close</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="open">
                    <table cellpadding="0" cellspacing="0" border="0"
                           class="table table-striped table-bordered table-fixed-header"
                           id="#mytable1" width="100%" style="table-layout:fixed; background-color:  #EEE">

                        <thead class="header">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Creator Name</th>
                            <th width="13%">Domain</th>
                            <th width="42%">Subject</th>
                            <th width="15%">Created Date</th>
                            <th width="10%">Status</th>
                        </tr>
                        </thead>
                        <?php if ($TicketsO == null) {
                            echo "No tickets";
                        } else {
                            ?>
                            <?php foreach ($TicketsO as $Ticket) {
                                $domain = Domain::model()->findBySql("SELECT * FROM domain WHERE id=:id", array(":id" => $Ticket->domain_id));
                                $creator = User::model()->find("id=:id", array(":id" => $Ticket->creator_user_id)); ?>
                                <tbody>
                                <tr id="<?php echo $Ticket->id ?>" class="triggerTicketClick">
                                    <td width="5%"><?php echo $Ticket->id; ?></td>
                                    <td width="15%"><?php echo $creator->fname . ' ' . $creator->lname; ?></td>
                                    <td width="13%"><?php echo $domain->name; ?></td>
                                    <td width="42%"><?php echo $Ticket->subject; ?></td>
                                    <td width="15%"><?php echo date("M d, Y", strtotime($Ticket->created_date)); ?></td>
                                    <td width="10%"><?php echo $Ticket->status ?></td>
                                </tr>
                                </tbody>
                            <?php
                            }
                        }
                        ?>
                    </table>
                </div>
                <div class="tab-pane" id="close">
                    <table cellpadding="0" cellspacing="0" border="0"
                           class="table table-striped table-bordered table-fixed-header"
                           id="#mytable2" width="100%" style="table-layout:fixed; background-color:  #EEE">

                        <thead class="header">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Creator Name</th>
                            <th width="13%">Domain</th>
                            <th width="42%">Subject</th>
                            <th width="15%">Created Date</th>
                            <th width="10%">Status</th>
                        </tr>
                        </thead>
                        <?php if ($TicketsC == null) {
                            echo "No tickets";
                        } else {
                            ?>
                            <?php foreach ($TicketsC as $Ticket) {
                                $domain = Domain::model()->findBySql("SELECT * FROM domain WHERE id=:id", array(":id" => $Ticket->domain_id));
                                $creator = User::model()->find("id=:id", array(":id" => $Ticket->creator_user_id)); ?>
                                <tbody>
                                <tr id="<?php echo $Ticket->id ?>" class="triggerTicketClick">
                                    <td width="5%"><?php echo $Ticket->id; ?></td>
                                    <td width="15%"><?php echo $creator->fname . ' ' . $creator->lname; ?></td>
                                    <td width="13%"><?php echo $domain->name; ?></td>
                                    <td width="42%"><?php echo $Ticket->subject; ?></td>
                                    <td width="15%"><?php echo date("M d, Y", strtotime($Ticket->created_date)); ?></td>
                                    <td width="10%"><?php echo $Ticket->status ?></td>
                                </tr>
                                </tbody>
                            <?php
                            }
                        }
                        ?>
                    </table>

                </div>
            </div>

        </div>

        <div class="span2" style="margin-left: 30px">
            <!-- Cancel Button -->
            <table>
                <tr>

                </tr>
                <tr>
                    <td>
                        <br>
                    </td>
                </tr>
            </table>


        </div>
    </div>
</div>
<!-- End FullContent -->

<script type="text/javascript">
    $('.triggerTicketClick').on('click', function () {
        window.location = "/coplat/index.php/ticket/view/" + $(this).attr('id');
    });


    //$('.table-fixed-header').fixedHeader();
</script>
<?php }?>