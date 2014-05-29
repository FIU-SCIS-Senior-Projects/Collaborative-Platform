<?php
/**
 * Created by PhpStorm.
 * User: lorenzo_mac
 * Date: 4/9/14
 * Time: 2:08 PM
 */
?>

<div><h3><?php echo ucfirst($user->fname); ?> <?php echo ucfirst($user->lname); ?> Dashboard</h3></div>
<br>
<div><h4>Tickets</h4></div>

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
        <!-- </div> -->

        <div class="span2" style="margin-left: 30px">
            <!-- Cancel Button -->
            <table>
                <tr>
                    <td>
                        <h4>Manage</h4>

                    </td>
                </tr>
                <tr>
                    <td>
                        <!-- Profile Button -->
                        <?php $this->widget('bootstrap.widgets.TbButton', array(
                            'buttonType' => 'link', 'id' => 'new-box', 'url' => '/coplat/index.php/user/admin', 'type' => 'primary',
                            'label' => 'Profiles', 'size' => 'medium', 'htmlOptions' => array('style' => 'width: 120px')));
                        ?>

                    </td>
                </tr>
                <tr>
                    <td><br>
                        <!-- Manage Domain Button -->
                        <?php $this->widget('bootstrap.widgets.TbButton', array(
                            'buttonType' => 'link', 'id' => 'new-box', 'url' => '/coplat/index.php/projectMeeting/adminViewMeetings', 'type' => 'primary',
                            'label' => 'Project Mentor', 'size' => 'medium', 'htmlOptions' => array('style' => 'width: 120px')));
                        ?>

                    </td>
                </tr>
            </table>
            <br/>
            <table>
                <tr><?php if (User::isCurrentUserProMentor()) { ?>
                    <td>
                        <h4>Mentoring</h4>

                    </td>
                </tr>
                <tr>
                    <td>
                        <!-- Manage Domain Button -->
                        <?php
                        $this->widget('bootstrap.widgets.TbButton', array(
                            'buttonType' => 'link', 'id' => 'new-box', 'url' => '/coplat/index.php/projectMeeting/pMentorViewMeetings', 'type' => 'primary',
                            'label' => 'Project Mentor', 'size' => 'medium', 'htmlOptions' => array('style' => 'width: 120px')));
                        }?>

                    </td>
                </tr>
                <tr>
                    <td><br>

                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- End FullContent -->

<script>
    $('.triggerTicketClick').on('click', function () {
        window.location = "/coplat/index.php/ticket/view/" + $(this).attr('id');
    });

    //$('.table-fixed-header').fixedHeader();
</script>