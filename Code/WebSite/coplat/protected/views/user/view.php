<?php
/* @var $this UserController */
/* @var $model User */

if(User::isCurrentUserAdmin())
{
     $this->breadcrumbs=array(
         'Manage Users'=>array('admin'),
         $model->fname,
     );
}
?>

<div style =" width: 1000px;">

<div id="leftup">
        <div id="container" class="my-box-container3" style="height: 300px;" >
        <div class="titlebox"><h3><?php echo ucfirst($model->fname) ." " . ucfirst($model->lname)?></h3></div>
        <div  id="profileImage">
            <br><img style="width:150px; height:205px;" src="<?php echo $model->pic_url ?>" />
            <br>Role Type(s):<br> <?php if($model->isAdmin) {?> <b> Administrator </b><br> <?php } ?>
            <?php if($model->isDomMentor) {?> <b>Domain Mentor </b><br> <?php }?>
            <?php if($model->isPerMentor) {?> <b>Personal Mentor </b><br> <?php }?>
            <?php if($model->isProMentor) {?> <b>Project Mentor </b><br> <?php }?>
            <?php if($model->isMentee) {?> <b>Mentee</b><br> <?php }?>
        </div>
    </div>

    <!-- div for project mentors -->
    <?php if($model->isProMentor)
    {?>
        <h4>My Current Senior Projects</h4>
        <div id="container" class="my-box-container6"
             style="<?php if($model->isProMentor)
             { echo 'display:block; '; }
             else
             { echo 'display:none; '; }?> height: 200px; overflow-y: scroll ">
            <?php
            if($projects == null)
            {
                echo "No projects registered that you are a mentor of.";
            }
            else
            {?>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="#mytable" width="100%">
                    <thread>
                        <tr>
                            <th width="100%">Project Name</th>
                        </tr>
                    </thread>
                    <?php foreach($projects as $project)
                    {
                        ?>
                        <tbody>
                        <tr>
                            <td><?php echo $project->title?></td>
                        </tr>
                        </tbody>
                    <?php }?>
                </table>
            <?php }
            ?>
        </div>
    <?php } ?>
    <?php if($model->isDomMentor || $model->isProMentor || $model->isPerMentor)
    {?>
    <div id="container" class="my-box-container3"
         style="<?php if($model->isDomMentor || $model->isProMentor || $model->isPerMentor)
         {   echo 'display:block; '; }
         else
         {   echo 'display:none; '; } ?> height: 100%">
        <div class="contactlinks">
            <h4>My Availability</h4>
            <?php
            if($model->isDomMentor)
            {
                ?><h6>Domain Mentor Availability</h6><?php
                $dommentor = DomainMentor::model()->findBySql("SELECT max_tickets FROM domain_mentor WHERE user_id=$model->id");
                $userdom = UserDomain::model()->findBySql("SELECT tier_team FROM user_domain WHERE user_id=$model->id");
                if($dommentor!=null)
                {
                if($dommentor->max_tickets == null)
                {
                    echo "Max tickets: N/A";
                }else
                {
                    echo "Max tickets: " .$dommentor->max_tickets;
                }
                }
                else
                {
                    echo "Max tickets: N/A";
                }
                ?><br>
                <!--<?php
                if($userdom == null)
                {
                    echo "Tier Team: N/A";
                }
                else
                {
                    echo "Tier Level: " . $userdom->tier_team;
                }?>-->
            <?php
            }
            ?>
            <?php
            if($model->isPerMentor)
            {?>
                <h6>Personal Mentor Availability</h6><?php
                $permentor = PersonalMentor::model()->findBySql("SELECT * FROM personal_mentor WHERE user_id=$model->id");
                echo "Max Mentees: " . $permentor->max_mentees;
                ?><br>
                <?php  echo "Max hours: " . $permentor->max_hours; } ?><br>
            <?php
            if($model->isProMentor)
            {
                ?><h6>Project Mentor Availability</h6><?php

                $promentor = ProjectMentor::model()->findBySql("SELECT * FROM project_mentor WHERE user_id=$model->id");
                $max=null;
                $ma_h=null;
                if($promentor!=null)
                {
                    $max = $promentor->max_projects;
                    $ma_h = $promentor->max_hours;
                }
                echo "Max Projects: " . $max;
                ?><br>
                <?php  echo "Max Hours: " . $ma_h; } ?>
        </div>
        <?php
        }?>
    </div>
</div>
<!-- end left div -->

<div id="rightup">
    <div id="experience">
        <div class="titlebox"><h4>BIOGRAPHY & WORK HISTORY</h4></div><br><br><br>
        <h8><?php if($model->biography == null)
            {
                echo"Please edit your biography";
            }
            else
            {
                echo $model->biography;
            }?></h8>
        <br>
    </div>
    <?php if($model->isMentee)
    {
        $pmentors = Mentee::model()->findBySql("SELECT * FROM mentee WHERE user_id=$model->id");
        $pmentor = null;
        if($pmentors!=null)
        {
        if($pmentors->personal_mentor_user_id!=null)
        {
            $pmentor = PersonalMentor::model()->findBySql("SELECT * FROM personal_mentor WHERE user_id=$pmentors->personal_mentor_user_id");
        }
        }
        $myproject = Mentee::model()->findBySql("SELECT project_id FROM mentee WHERE user_id=$model->id");
        $proj='';
        if($myproject!=null)
        {
            if($myproject->project_id!=null)
            {
             $proj= Project::model()->findBySql("SELECT * FROM project WHERE id= $myproject->project_id");
            }
        }
        ?>     <h6> My Personal Mentor </h6>
        <div id="container" class="my-box-container6"
             style="<?php if($model->isMentee)
             { echo 'display:block;'; }
             else
             { echo 'display:none;';  } ?> height: 200px; overflow-y: scroll">

            <?php
            if($pmentor == null)
            {
                echo "You do not currently have a personal mentor";
            }
            else
            {?>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="#mytable" width="100%">
                    <thread>
                        <tr>
                            <th width="100%">Personal Mentor Name</th>
                        </tr>
                    </thread>
                    <?php
                    $usr = User::model()->findBySql("SELECT * FROM user WHERE id= $pmentor->user_id");?>
                    <tbody>
                    <tr>
                        <td><?php echo ucfirst($usr->fname) ." ". ucfirst($usr->lname);?></td>
                    </tr>
                    </tbody>
                </table>
            <?php }?>
        </div>
        <h6> My Senior Project </h6>
        <div id="container" class="my-box-container6"
             style="<?php if($model->isMentee)
             { echo 'display:block;'; }
             else
             { echo 'display:none;';  } ?> height: 200px; overflow-y: scroll">

            <?php
            if($pmentor == null)
            {
                echo "You do not currently have a senior project";
            }
            else
            {?>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="#mytable" width="100%">
                    <thread>
                        <tr>
                            <th width="100%">Senior Project</th>
                        </tr>
                    </thread>
                    <?php ?>
                    <tbody>
                    <tr>
                        <td><?php echo $proj->title;?></td>
                    </tr>
                    </tbody>
                </table>
            <?php }?>
        </div>
    <?php
    }?>

    <!-- div to show domains for Domain and Personal Mentors ONLY; only included for project mentors if they are also domain or personal -->
    <?php
    if($model->isDomMentor)
    {?>
    <div id="container" class="my-box-container5"
         style="<?php if($model->isDomMentor)
         {   echo 'display:block; '; }
         else
         {   echo 'display:none; '; } ?> height: 275px; overflow-y: scroll; ">
        <div class="titlebox"><h4>DOMAINS</h4></div>
        <?php
        if ($userdoms == null)
        {?>
        <div id="container" class="my-box-container" style="height: 200px; overflow-y: scroll ">
            <?php echo "No Assigned Domains</div>";
            }
            else
            {?>
            <div id="container" class="my-box-container" style="height: 200px; overflow-y: scroll ">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="#mytable" width="100%">
                    <thead>
                    <tr>
                        <th width="50%">Domain Name</th>
                        <th width="50%">Subdomain/Rating/Tier</th>
                    </tr>
                    </thead>
                    <?php foreach($userdoms as $userdom)
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

                                        $res = $subdm->name.' / '.$udom->rate.' / '.$udom->tier_team.'<br>';

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
            </div></div>
        <?php }?>

        <!-- div for personal mentors -->
        <?php if($model->isPerMentor)
        {?>
            <h4>My Current Personal Mentees </h4>
            <div id="container" class="my-box-container6"
                 style="<?php if($model->isPerMentor)
                 {   echo 'display:block; '; }
                 else
                 {   echo 'display:none; '; } ?> height: 200px; overflow-y: scroll ">
                <?php
                if($Mentees == null)
                {
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
        <?php } ?>

        <!--end right-->
        <br>
        <?php echo CHtml::submitButton('Edit', array('submit' => 'update/'.$model->id, "class"=>"btn btn-primary")); ?>
    </div>
</div>
<!--end right-->

</div>
