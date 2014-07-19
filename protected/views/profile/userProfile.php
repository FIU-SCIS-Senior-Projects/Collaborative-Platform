<div class="container"  >
<div class="column-center">
<?php if(User::isCurrentUserMentee())
{

    $pmentors = Mentee::model()->findBySql("SELECT * FROM mentee WHERE user_id=$user->id");
    $pmentor = null;
    $proj = null;
    if($pmentors->personal_mentor_user_id!=null)
    {
        $pmentor = PersonalMentor::model()->findBySql("SELECT * FROM personal_mentor WHERE user_id=$pmentors->personal_mentor_user_id");
    }


    $myproject = Mentee::model()->findBySql("SELECT project_id FROM mentee WHERE user_id=$user->id");
    if($myproject->project_id!=null)
    {
        $proj= Project::model()->findBySql("SELECT * FROM project WHERE id=$myproject->project_id");
    }
    ?>
    <div class="titlebox" style="width: auto" align="center"><h3>Mentee</h3></div>
    <br>
    <br>
    <div id="contain" class ="my-box-container6">
        <h4> My Personal Mentor </h4>
        <div id="container" class="my-box-container6"
             style="<?php if(User::isCurrentUserMentee())
             { echo 'display:block;'; }
             else
             { echo 'display:none;';  } ?> height: auto; overflow-y: scroll;width: 400px">

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
                    $usr = User::model()->findBySql("SELECT * FROM user WHERE id='$pmentor->user_id'");?>
                    <tbody>
                    <tr>
                        <td><?php echo ucfirst($usr->fname) ." ". ucfirst($usr->lname);?></td>
                    </tr>
                    </tbody>
                </table>
            <?php }?>
        </div>
        <h4> My Senior Project </h4>
        <div id="container" class="my-box-container6"
             style="<?php if(User::isCurrentUserMentee())
             { echo 'display:block;'; }
             else
             { echo 'display:none;';  } ?> height: auto; overflow-y: scroll;width: 400px">

            <?php
            if($proj== null)
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
    </div>
    <br>
    <br>
<?php
} else?>
<?php  if(User::isCurrentUserProMentor())
{?>
    <div class="titlebox" style="width: auto" align="center"><h3>Project Mentor</h3></div>
    <br>
    <br>




    <div id="container" class="my-box-container5" style="width: auto"
         style="<?php if(User::isCurrentUserProMentor())
         {     echo 'display:block; '; }
         else
         {     echo 'display:none; ';  } ?> height: auto; overflow-y: scroll ;width:auto">
        <h4>Current Senior Projects</h4>

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
                { ?>
                    <tbody>
                    <tr>
                        <td><?php echo $project->title?></td>
                    </tr>
                    </tbody>
                <?php }?>
            </table>
        <?php }?>
        <br>
        <h4>Project Mentor Availability</h4>
        <?php

        $promentor = ProjectMentor::model()->findBySql("SELECT * FROM project_mentor WHERE user_id=$user->id");
        $max_projects=null;
        $max_h=null;
        if($promentor!=null)
        {
            $max_projects = $promentor->max_projects;
            $max_h = $promentor->max_hours;
        }
        // $promentor = ProjectMentor::model()->findBySql("SELECT * FROM project_mentor WHERE user_id=$user->id");
        echo "Max Projects: " . $max_projects;
        ?>
        <br>
        <?php  echo "Max Hours: " . $max_h;?>


    </div>

    <br>
    <br>
    <br>

<?php }

?>


<?php if(User::isCurrentUserPerMentor())
{?>
<div class="titlebox" style="width: auto" align="center"><h3>Personal Mentor</h3></div>
<br>
<br>


<div id="container" class="my-box-container5" style="width: auto"
     style="<?php if(User::isCurrentUserProMentor())
     {     echo 'display:block; '; }
     else
     {     echo 'display:none; ';  } ?> height: auto; overflow-y: scroll ;width:auto">
    <h4>Current Personal Mentees </h4>


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
                    <th width="100%">Mentees Names</th>
                </tr>
            </thread>
            <?php foreach($Mentees as $mentee)
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
    <?php }?>
    <br>
    <h4>Personal Mentor Availability</h4><?php

    $permentor = PersonalMentor::model()->findBySql("SELECT * FROM personal_mentor WHERE user_id=$user->id");
    $max_mentees=0;
    $max_hours=0;
    if($permentor!=null)
    {
        $max_mentees = $permentor->max_mentees;
        $max_hours = $permentor->max_hours;
    }

    //$permentor = PersonalMentor::model()->findBySql("SELECT * FROM personal_mentor WHERE user_id=$user->id");
    echo "Max Mentees: " . $max_mentees;
    ?><br>
    <?php  echo "Max hours: " . $max_hours; } ?>




    <br>



</div>

<?php if(User::isCurrentUserPerMentor())
{
    echo "</div>";
}?>
<div class="column-left" >

    <div  id="profileImage" style="width: auto">
        <div class="titlebox" style="width: auto;background:#000000;" align="center"><h3><?php echo ucfirst($user->fname) ." " . ucfirst($user->lname)?></h3></div>
        <br>
        <br>
        <img style="width:150px; height:205px; " src="<?php echo $user->pic_url ?>" />
        <br>
        Role Type(s):<br>
        <?php if(User::isCurrentUserAdmin()) {?> <b> Administrator </b><br> <?php }?>
        <?php if(User::isCurrentUserDomMentor()) {?> <b>Domain Mentor </b><br> <?php }?>
        <?php if(User::isCurrentUserPerMentor()) {?> <b>Personal Mentor </b><br> <?php }?>
        <?php if(User::isCurrentUserProMentor()) {?> <b>Project Mentor </b> <br><?php }?>
        <?php if(User::isCurrentUserMentee()) {?> <b>Mentee</b> <br><?php }?>

        <br>
        <br>
        <br>

        <div id="experience" style="width:auto;height: auto;overflow-y: scroll; " >
            <div class="titlebox"><h4>BIOGRAPHY & WORK HISTORY</h4></div><br><br><br>
            <h8><?php if($user->biography == null)
                {
                    echo"Please edit your biography";
                }
                else
                {
                    echo $user->biography;
                }?></h8>
            <br>
        </div>



        <div><br><?php echo CHtml::submitButton('Edit', array('submit' => 'editProfile', "class"=>"btn btn-primary")); ?></div>


    </div>


</div>
<div class="column-right">

    <?php if(User::isCurrentUserDomMentor())
    {

        ?>
        <div class="titlebox" style="width: auto" align="center"><h3>Domain Mentor</h3></div>
        <br>
        <br>
        <!-- div to show domains for Domain Mentors ONLY; only included for project or personal mentors if they are also domain -->
        <div id="container" class="my-box-container5"
             style="<?php if(User::isCurrentUserDomMentor())
             { echo 'display:block; '; }
             else
             { echo 'display:none; ';  }?> height: auto; overflow-y: scroll; width: auto">
            <h4> Domains </h4>
            <?php
            if ($userdoms == null)
            {?>
                <?php echo "No Assigned Domains";
            }
            else
            {?>
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
                    $userdom = UserDomain::model()->findAllBySql("SELECT  subdomain_id,rate,tier_team FROM user_domain WHERE domain_id=$domain->id AND user_id=$user->id");
                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo $domain->name; ?></td>

                        <td>
                           <?php
                            $res = '';
                           foreach($userdom as $udom )
                           {
                               if($udom->subdomain_id!=null)
                               {                               $subdm = Subdomain::model()->findBySql("select * from subdomain where id = $udom->subdomain_id");
                               $res =  $subdm->name.' / '.$udom->rate.' / '.$udom->tier_team.'<br>';
                               }
                           }
                           echo $res;

                        ?>


                        </td>
                    </tr>
                    </tbody>
                <?php
                }
                }?>
            </table>
            <br>
            <h4>Domain Mentor Availability</h4><?php
            $dommentor = DomainMentor::model()->findBySql("SELECT max_tickets FROM domain_mentor WHERE user_id=$user->id");
            $userdom = UserDomain::model()->findBySql("SELECT tier_team FROM user_domain WHERE user_id=$user->id");
            if($dommentor->max_tickets == null)
            {
                echo "Max tickets: N/A";
            }
            else
            {
                echo "Max tickets: " .$dommentor->max_tickets;
            }?>
        </div>


    <?php }?>





</div>
</div>