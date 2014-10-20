<?php
/* @var $this UserController */
/* @var $model User */
/* @var $Mentees Mentee */
/* @var $UserDomain UserDomain */


?>

<div class='well'>
	<?php echo CHtml::image($model->pic_url, $model->fname, array('style'=>'width:60px; height:60px;')); ?>
	<?php echo ($model->fname . ' ' . $model->lname);?>
</div>

<!-- <div class='well'> -->
	<?php //echo $model->biography; ?>
<!-- </div> -->

	<?php if($model->isMentee) {?>
<div class='well'>	
	<?php echo 'Mentee';?>
</div>
	<?php }?>
	
	
	<?php if($model->isProMentor) {?>
<div class='well'>
	<?php echo 'Project Mentor';?>
</div>
	<?php }?>

	
	
	<?php if($model->isPerMentor) {?>
<div class='well'>	
	<?php 	echo 'Personal Mentor';?>
	<?php if($Mentees == null)
                {
                	?> <br/> <?php
                    echo "You are not a personal mentor to any mentee";
                }
                else
                {?>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="#mytable" width="100%">
                        <thread>
                            <tr>
                                <th width="100%">Student Name</th>
                            </tr>
                        </thread>
                        <?php
                        foreach($Mentees as $mentee)
                        {
                            $usr = User::model()->findBySql("SELECT * FROM user WHERE id=$mentee->user_id");
                            ?>
                            <tbody>
                            <tr>
                                <td><?php echo ucfirst($usr->fname) ." ". ucfirst($usr->lname);?></td>
                            </tr>
                            </tbody>

                        <?php }?>
                    </table>
                <?php } ?>
</div>
	<?php }?>

	
	
	<?php if($model->isDomMentor) {?>
<div class='well'>	
	<?php 	echo 'Domain Mentor'; ?><br/>
	<?php
        if ($UserDomain == null)
        {?>
            <?php echo "No Assigned Domains";
            }
            else
            {?>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="#mytable" width="100%">
                    <thead>
                    <tr>
                        <th width="50%">Domain Name</th>
                        <th width="50%">Subdomain</th>
                    </tr>
                    </thead>
                    <?php foreach($UserDomain as $userdom)
                    {
                        $domain = Domain::model()->find("id=:id", array(":id"=>$userdom->domain_id));
                        $userdom = UserDomain::model()->findAllBySql("SELECT  subdomain_id,rate,tier_team FROM user_domain WHERE domain_id=$domain->id AND user_id=$model->id");
                        ?>
                        <tbody>
                        <tr>
                            <td><?php echo $domain->name; ?></td>
                            <td>
                                <?php
                                /*the table user_domain needs to be normalized!*/
                                foreach($userdom as $udom )
                                {
                                    $res='';
                                    if($udom->subdomain_id!=null)
                                    {
                                        $subdm = Subdomain::model()->findBySql("select * from subdomain where id = $udom->subdomain_id");

                                        $res = $subdm->name . '<br/>';//.' / '.$udom->rate.' / '.$udom->tier_team.'<br>';

                                    }
                                    echo $res;
                                }

                                ?>
                            </td>
                        </tr>
                        </tbody>
                    <?php
                    }
                    }?>
                </table><br>
</div>
	<?php }?>