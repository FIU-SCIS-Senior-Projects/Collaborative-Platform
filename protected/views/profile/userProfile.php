<div style ="width: 1050px;">
    
<div id="leftup">
    
<div id="container" class="my-box-container3" style="height: 300px;" >  
        <div class="titlebox"><h3><?php echo ucfirst($user->fname) ." " . ucfirst($user->lname)?></h3></div>
        <div  id="profileImage">
        <br><img style="width:150px; height:205px;" src="<?php echo $user->pic_url ?>" />
 
        <!--<?php echo CHtml::submitButton('Edit Photo', array('editProfile', "class"=>"btn btn-primary"));?>-->
    	<!--<?php echo CHtml::submitButton('Sync LinkedIn', array("class"=>"btn btn-primary")); ?>-->
        <br>Role Type(s): <?php if(User::isCurrentUserAdmin()) {?> <b> Administrator </b> <?php }?>
                          <?php if(User::isCurrentUserDomMentor()) {?> <b>Domain Mentor </b> <?php }?>
                          <?php if(User::isCurrentUserPerMentor()) {?> <b>Personal Mentor </b> <?php }?>
                          <?php if(User::isCurrentUserProMentor()) {?> <b>Project Mentor </b> <?php }?>
                          <?php if(User::isCurrentUserMentee()) {?> <b>Mentee</b> <?php }?>        
       </div>
</div> 

 <?php if(User::isCurrentUserProMentor())
    {?>
    <div id="container" class="my-box-container5" 
        style="<?php if(User::isCurrentUserProMentor())
        {     echo 'display:block; '; }
        else
        {     echo 'display:none; ';  } ?> height: 200px; overflow-y: scroll ">
        <h4>My Current Senior Projects</h4>
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
    
    </div>
<?php }?>

<?php if(User::isCurrentUserProMentor() || User::isCurrentUserDomMentor() || User::isCurrentUserPerMentor()) 
{?>
    <div id="container" class="my-box-container3"
        style="<?php if(User::isCurrentUserProMentor() || User::isCurrentUserDomMentor() || User::isCurrentUserPerMentor())
               {     echo 'display:block; '; }
               else
               {     echo 'display:none; ';  } ?> height: 100%">
        <div class="contactlinks">
        <h4>My Availability</h4>
	<?php 
        
        if(User::isCurrentUserDomMentor())
        {?>
            <h6>Domain Mentor Availability</h6><?php
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
        }?>           
        <?php
        if(User::isCurrentUserPerMentor())
        {?>
            <h6>Personal Mentor Availability</h6><?php
            $permentor = PersonalMentor::model()->findBySql("SELECT * FROM personal_mentor WHERE user_id=$user->id");
            echo "Max Mentees: " . $permentor->max_mentees;
        ?><br>
        <?php  echo "Max hours: " . $permentor->max_hours; } ?><br>
        <?php
        if(User::isCurrentUserProMentor())
        {?>
            <h6>Project Mentor Availability</h6><?php
            $promentor = ProjectMentor::model()->findBySql("SELECT * FROM project_mentor WHERE user_id=$user->id");
            echo "Max Projects: " . $promentor->max_projects; ?><br>
        <?php  echo "Max Hours: " . $promentor->max_hours; 
        }?>
<?php }?>	</div>
    </div>
</div>
    
<!-- end left div -->

<div id="rightup">
<!-- begin right div -->

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

<?php if(User::isCurrentUserDomMentor()) 
    { ?>
<!-- div to show domains for Domain Mentors ONLY; only included for project or personal mentors if they are also domain --> 
    <div id="container" class="my-box-container5" 
        style="<?php if(User::isCurrentUserDomMentor())
            { echo 'display:block; '; }
            else
            { echo 'display:none; ';  }?> height: 275px; overflow-y: scroll;">
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
            </table>
        </div>
        </div>  
    
<?php }?>

<?php if(User::isCurrentUserPerMentor()) 
{ ?>
<!-- div for personal mentors -->
    <div id="container" class="my-box-container2"    
    style="<?php if(User::isCurrentUserPerMentor())
        { echo 'display:block;'; }
        else
        { echo 'display:none;';  } ?> height: 200px; overflow-y: scroll">
        <h4>My Current Personal Mentees </h4>
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
     <?php }?>
    </div>

<!--end right-->

<?php } ?>
<br><br><?php echo CHtml::submitButton('Edit', array('submit' => 'editProfile', "class"=>"btn btn-primary")); ?>
    
</div>
</div>
</div>