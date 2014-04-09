<?php
/**
 * Created by PhpStorm.
 * User: lorenzo_mac
 * Date: 4/4/14
 * Time: 11:02 PM
 */

?>

<div><h3><?php echo $user->fname; ?> <?php echo $user->lname; ?> Dashboard</h3></div>
<br>

<div id="fullcontent">

    <div><h4>My Tickets</h4></div>
    <div id="fullcontent">
        <div>

            <!-- <div style="margin-top = 0px; height: 300px; width: 1000px; overflow-y: scroll; border-radius: 5px;"> -->

            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-fixed-header"
                   id="#mytable" width="100%" style= "table-layout:fixed">

                <thead class="header">
                <tr>
                    <th width="5%">No</th>
                    <th width="15%">Creator Name</th>
                    <th width="10%">Domain</th>
                    <th width="50%">Subject</th>
                    <th width="20%">Created Date</th>
                </tr>
                </thead>
                <?php foreach ($Tickets as $Ticket) {
                    $domain = Domain::model()->findBySql("SELECT * FROM domain WHERE id=:id", array(":id" => $Ticket->domain_id));
                    $creator = User::model()->find("id=:id", array(":id" => $Ticket->creator_user_id)); ?>
                    <tbody>
                    <tr id="<?= $Ticket->id ?>" class="triggerTicketClick">
                        <td width="5%"><?php echo $Ticket->id; ?></td>
                        <td width="15%"><?php echo $creator->fname . ' ' . $creator->lname; ?></td>
                        <td width="10%"><?php echo $domain->name; ?></td>
                        <td width="50%"><?php echo $Ticket->subject; ?></td>
                        <td width="20%"><?php echo date("M d, Y", strtotime($Ticket->created_date)); ?></td>
                    </tr>
                    </tbody>
                <?php
                }
                ?>
            </table>
            <!-- </div> -->

            <!-- Cancel Button -->
            <?php /*$this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'link', 'id' => 'new-box', 'url' => '/coplat/index.php', 'type' => 'primary',
                'label' => 'Home',)); */
            ?>
            &nbsp;&nbsp;
            <!-- New Ticket Button -->
            <?php /*$this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'link', 'id' => 'new-box', 'url' => '/coplat/index.php/ticket/create', 'type' => 'primary',
                'label' => '  New Ticket ',)); */
            ?>
        </div>

    </div>
    <!-- End FullContent -->
</div>
<script>
    $('.triggerTicketClick').on('click', function () {
        window.location = "/coplat/index.php/ticket/view/" + $(this).attr('id');
    });

    $('.table-fixed-header').fixedHeader();
</script>