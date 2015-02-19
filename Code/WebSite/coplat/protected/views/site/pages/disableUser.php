<h2 style="text-align:center">Your user has been disabled. Please contact the administrator(s) in order to regain access to the collaborative platform.</h2>
<?php
$administrators =   User::model()->findall("isAdmin=1 AND disable = 0 and email <> ''" );
?>
<br />
<br />
<br />
<h1>Administrator(s) contacts</h1>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-fixed-header"
     id="#mytable1" width="100%" style="table-layout:fixed; background-color:  #EEE">
        <tr class="header">
            <th width="50%">Administrator Name</th>
            <th width="50%">Email</th>   
        </tr>
    <?php foreach ($administrators as $admin) { ?>
        <tr class="triggerTicketClick">
            <td><?php echo $admin->fname . ' ' . $admin->lname; ?></td>
            <td> <a href="mailto:<?php echo $admin->email; ?>">  <?php echo $admin->email; ?></a></td>
        </tr>        
    <?php } ?>
</table>

<br />
<br />
<p>Return to login <a href="/coplat/index.php">here</a></p>



