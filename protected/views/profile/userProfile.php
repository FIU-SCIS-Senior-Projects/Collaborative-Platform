<div style =" width: 1050px;">
<div id="leftup">
<div id="container" class="my-box-container3" style="height: 350px;" >  
        <div class="titlebox"><h3><?php echo ucfirst($user->fname) ." " . ucfirst($user->lname)?></h3></div>
        <div  id="profileImage">
        <br><img style="width:150px; height:205px;" src="<?php echo $user->pic_url ?>" />
 
        <?php echo CHtml::submitButton('Edit Photo', array('editProfile', "class"=>"btn btn-primary"));?>
    	<!--<?php echo CHtml::submitButton('Sync LinkedIn', array("class"=>"btn btn-primary")); ?>-->
        <br>Role Type(s): <?php if(User::isCurrentUserDomMentor()) {?> <b>Domain Mentor </b> <?php }?>
                          <?php if(User::isCurrentUserPerMentor()) {?> <b>Personal Mentor </b> <?php }?>
                          <?php if(User::isCurrentUserProMentor()) {?> <b>Project Mentor </b> <?php }?>
                          <?php if(User::isCurrentUserMentee()) {?> <b>Mentee</b> <?php }?>        
       </div>
</div> 
<!--only mentee 
<?php if(User::isCurrentUserMentee())
    {?>     </div><div id="right">
        <div id="experience">
        <div class="titlebox"><h4>BIOGRAPHY & WORK HISTORY</h4></div><br><br><br>   
        <h8><?php if($user->biography == null)
        {
            echo"Please edit your biography";
        }
        else
        {
            echo $user->biography;
            }?></h8></div></div></div>
<?php }?>-->
<!-- div for project mentors -->
<?php if(User::isCurrentUserProMentor())
{?>

    <h4>My Current Senior Projects</h4>
    <div id="container" class="my-box-container2" style="height: 200px; overflow-y: scroll ">
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
                //$pmen = Mentee::model()->findAllBySql("SELECT user_id FROM mentee WHERE projectmentor_project_id=$project->id");
                
                /*foreach($pmen as $pm)
                {
                   $m = User::model()->findBySql("SELECT id FROM user WHERE id=$pm->user_id");
                   echo $m->fname. " " . $m->lname;
                }
                //$ment = User::model()->findbysql("SELECT * FROM user WHERE id=$pmen->user_id");
                 * 
                 */
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
    <h9>***Note: Click on projects to see their description</h9>
 
<?php } ?>
 <?php if(User::isCurrentUserDomMentor() || User::isCurrentUserProMentor() || User::isCurrentUserPerMentor())
 {?>
    <div id="container" class="my-box-container3" style="height: 275px">
        <div class="contactlinks">
        <h4>My Availability</h4>
	<?php 
        
        if(User::isCurrentUserDomMentor())
        {
            ?><h6>Domain Mentor Availability</h6><?php
            $dommentor = DomainMentor::model()->findBySql("SELECT max_tickets FROM domain_mentor WHERE user_id=$user->id");
            $userdom = UserDomain::model()->findBySql("SELECT tier_team FROM user_domain WHERE user_id=$user->id");
            if($dommentor->max_tickets == null)
            {
                echo "Max tickets: N/A";
            }
            else
            {
                echo "Max tickets: " .$dommentor->max_tickets;
            }
            ?><br><?php 
            if($userdom == null)
            {
                echo "Tier Team: N/A";
            }
            else
            {
                echo "Tier Level: " . $userdom->tier_team;
            }
        } 
        ?><br>
        <?php
        if(User::isCurrentUserPerMentor())
        {
            ?><h6>Personal Mentor Availability</h6><?php
            $permentor = PersonalMentor::model()->findBySql("SELECT * FROM personal_mentor WHERE user_id=$user->id");
            echo "Max Mentees: " . $permentor->max_mentees;
        ?><br>
        <?php  echo "Max hours: " . $permentor->max_hours; } ?><br>
        <?php
        if(User::isCurrentUserProMentor())
        {
            ?><h6>Project Mentor Availability</h6><?php
            $promentor = ProjectMentor::model()->findBySql("SELECT * FROM project_mentor WHERE user_id=$user->id");
            echo "Max Projects: " . $promentor->max_projects;
        ?><br>
        <?php  echo "Max Hours: " . $promentor->max_hours; } ?>
	</div>
	<?php 

}?>
    </div>
</div>
<!-- end left div -->
<?php if(!User::isCurrentUserMentee())
{?>
<div id="rightup">
    <div id="experience">
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
   
<!-- div to show domains for Domain and Personal Mentors ONLY; only included for project mentors if they are also domain or personal --> 
<?php 
if(User::isCurrentUserDomMentor())
{?>

    <div id="container" class="my-box-container5" style="height: 275px; overflow-y: scroll; ">
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
                            <th width="50%">Expertise Level</th>
                        </tr>
                        </thead>
                        <?php foreach($userdoms as $userdom)
                        { 
                            $domain = Domain::model()->find("id=:id", array(":id"=>$userdom->domain_id));
                            $userdom = UserDomain::model()->findBySql("SELECT rate FROM user_domain WHERE domain_id=$domain->id AND user_id=$user->id");
                            ?>
                            <tbody>
                            <tr>
                                <td><?php echo $domain->name; ?></td>
                                <td><?php echo $userdom->rate;?></td>
                            </tr>
                            </tbody>
                        <?php
                        }
               }?>
            </table><br>
        </div><br> </div>
 <?php }?>


   
<!-- div for personal mentors -->
<?php if(User::isCurrentUserPerMentor()) 
    {?>
<h4>My Current Personal Mentees </h4>
    <div id="container" class="my-box-container2" style="height: 200px; overflow-y: scroll ">
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

    <h9>***Note: Click on students to see their project and description(s)</h9>
 <?php } ?>
<?php }?>
    <br><br>
    
</div>
<!--end right-->
</div>
<div style="float:right; padding:1px;"><br><br>
    <?php echo CHtml::submitButton('Edit', array('submit' => 'editProfile', "class"=>"btn btn-primary")); ?>
    </div>


