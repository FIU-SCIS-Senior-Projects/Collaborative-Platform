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

<div style =" width: 1050px;">
<div id="leftup">
<div id="container" class="my-box-container3" style="height: 350px;" >  
        <div class="titlebox"><h3><?php echo ucfirst($model->fname) ." " . ucfirst($model->lname)?></h3></div>
        <div  id="profileImage">
        <br><img style="width:150px; height:205px;" src="<?php echo $model->pic_url ?>" />
 
        <!--<?php echo CHtml::submitButton('Edit Photo', array('submit' => 'editProfile', "class"=>"btn btn-primary"));?>-->
    	<!--<?php echo CHtml::submitButton('Sync LinkedIn', array("class"=>"btn btn-primary")); ?>-->
        <br>Role Type(s): <?php if($model->isAdmin) {?> <b>Domain Mentor </b> <?php }?>
                          <?php if($model->isPerMentor) {?> <b>Personal Mentor </b> <?php }?>
                          <?php if($model->isProMentor) {?> <b>Project Mentor </b> <?php }?>
                          <?php if($model->isMentee) {?> <b>Mentee</b> <?php }?>        
       </div>
</div> 

<!-- div for project mentors -->
<?php if($model->isProMentor)
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
                    <th width="50%">Project Name</th>
                    <!--<th width="50%">Mentees</th>-->
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
                    <!--<td><?php echo"Names to be imported" ?></td>-->
                </tr>
            </tbody> 
            <?php }?>
        </table>
<?php }
        ?>
    </div>
    <h9>***Note: Click on projects to see their description</h9>
 
<?php } ?>
 <?php if($model->isDomMentor || $model->isProMentor || $model->isPerMentor)
 {?>
    <div id="container" class="my-box-container3" style="height: 275px">
        <div class="contactlinks">
        <h4>My Availability</h4>
	<?php 
        
        if($model->isDomMentor)
        {
            ?><h6>Domain Mentor Availability</h6><?php
            $dommentor = DomainMentor::model()->findBySql("SELECT max_tickets FROM domain_mentor WHERE user_id=$model->id");
            $userdom = UserDomain::model()->findBySql("SELECT tier_team FROM user_domain WHERE user_id=$model->id");
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
        if($model->isPerMentor)
        {
            ?><h6>Personal Mentor Availability</h6><?php
            $permentor = PersonalMentor::model()->findBySql("SELECT * FROM personal_mentor WHERE user_id=$model->id");
            echo "Max Mentees: " . $permentor->max_mentees;
        ?><br>
        <?php  echo "Max hours: " . $permentor->max_hours; } ?><br>
        <?php
        if($model->isProMentor)
        {
            ?><h6>Project Mentor Availability</h6><?php
            $promentor = ProjectMentor::model()->findBySql("SELECT * FROM project_mentor WHERE user_id=$model->id");
            echo "Max Projects: " . $promentor->max_projects;
        ?><br>
        <?php  echo "Max Hours: " . $promentor->max_hours; } ?>
	</div>
	<?php 
        if($model->isDomMentor)
        {

        }
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
   
<!-- div to show domains for Domain and Personal Mentors ONLY; only included for project mentors if they are also domain or personal --> 
<?php if($model->isDomMentor)
{?>

    <div id="container" class="my-box-container5" style="height: 250px; overflow-y: scroll; ">
       <div class="titlebox"><h4>DOMAINS</h4></div>
     <?php 
               if($userdoms == null)
               { 
                    echo "No Assigned Domains";
               }
               else
               { ?>
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
                            $userdom = UserDomain::model()->find("id=:id", array(":id"=>$domain->id));
                            ?>
                            <tbody>
                            <tr>
                                <td><?php echo $domain->name; ?></td>
                                <td><?php //echo $userdom->rate;?></td>
                            </tr>
                            </tbody>
                        <?php
                        }
               }
                        ?>
            </table><br>
     </div>
     <br>
    </div>
   <?php }?>

<!-- div for personal mentors -->
<?php if($model->isPerMentor) 
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
                //$mentee = Mentee::model()->findBySql("SELECT * FROM mentee");
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

    <br><br>
    <div style="float:right"><br><br>
    <?php echo CHtml::submitButton('Edit', array('submit' => 'update/'.$model->id, "class"=>"btn btn-primary")); ?>
    </div>
</div>
<!--end right-->
</div>