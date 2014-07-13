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

    <div><h2><?php echo 'Domain Mentor: '.$user->fname; ?> <?php echo $user->lname; ?></h2></div>
    <br>


    <br/>
    <h4>My Tickets</h4>
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
        <?php if ($tickets == null) {
            echo "No tickets";
        } else {
            ?>
            <?php
            foreach ($tickets as $myTicket) {
                if ($myTicket == null) {
                    continue;
                }
                $domain = Domain::model()->findBySql("SELECT * FROM domain WHERE id=:id", array(":id" => $myTicket->domain_id));
                $creator = User::model()->find("id=:id", array(":id" => $myTicket->creator_user_id));
                $sub = Subdomain::model()->findByPk($myTicket->subdomain_id);
                ?>

                <tbody>
                <tr id="<?php echo $myTicket->id ?>" class="triggerTicketClick">
                    <td width="5%"><?php echo $myTicket->id; ?></td>
                    <td width="15%"><?php echo $creator->fname . ' ' . $creator->lname; ?></td>
                    <td width="13%"><?php echo $domain->name; ?></td>
                    <td width="42%"><?php echo $myTicket->subject; ?></td>
                    <td width="15%"><?php echo date("M d, Y", strtotime($myTicket->created_date)); ?></td>
                    <td width="15%"><?php echo $sub->name; ?></td>
                    <td width="10%"><?php echo $myTicket->status; ?></td>
                </tr>
                </tbody>
            <?php
            }
        }
        ?>
    </table>


</div>










<!-- End Comment Modal-->
<script type="text/javascript">
    $('.triggerTicketClick').on('click', function () {
        window.location = "/coplat/index.php/ticket/view/" + $(this).attr('id');
    });


    //$('.table-fixed-header').fixedHeader();
</script>