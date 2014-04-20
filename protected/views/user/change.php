<?php
    $projects = Project::model()->findAllBySql("SELECT title FROM project WHERE project_mentor_user_id IS NULL");
    $userdoms = UserDomain::model()->findAllBySql("SELECT domain_id FROM user_domain WHERE user_id=$model->id");
    $Mentees = Mentee::model()->findAllBySql("SELECT user_id FROM mentee WHERE personal_mentor_user_id IS NULL");
    $Tickets= Ticket::model()->findAllBySql("SELECT * FROM ticket WHERE assign_user_id=:id", array(":id"=>$model->id));
?>
<div style="width: 1050px; height: 1425px;">
<div id="left">
    
<form method="POST" enctype="multipart/form-data" action="/coplat/index.php/user/<?php echo $model->id; ?>">

<div id="container" class="my-box-container3" style="height: 360px;" >
        <div class="titlebox"><h3><?php echo ucfirst($model->fname) ." " . ucfirst($model->lname)?></h3></div>
        <div id="profileImage">
        <br><img style="width:150px; height:205px;" src="<?php echo $model->pic_url ?>" />
        
        <input type="file" name="photo" style="width:95px;" class="btn-primary">
        
    	<!--<?php echo CHtml::submitButton('Sync LinkedIn', array("class"=>"btn btn-primary")); ?>-->
        <br>Role Type(s): <?php if($model->isAdmin) {?> <b> Administrator </b> <?php }?>
                          <?php if($model->isDomMentor) {?> <b>Domain Mentor </b> <?php }?>
                          <?php if($model->isPerMentor) {?> <b>Personal Mentor </b> <?php }?>
                          <?php if($model->isProMentor) {?> <b>Project Mentor </b> <?php }?>
                          <?php if($model->isMentee) {?> <b> Mentee </b> <?php }?>        
        </div> 
</div> 
<!-- only mentee -->
<?php if($model->isMentee || $model->isAdmin)
    {?> <div id="rightup">
        <div id="experience">
            <div class="titlebox"><h4>BIOGRAPHY & WORK HISTORY</h4></div><br><br><br>
            <h8><textarea id="bio" style="width: 475px; height:150px" name="biography"><?php echo $model->biography; ?></textarea>
                <br></div></div>
<?php } ?>
<!-- div for project mentors -->
<?php $promentor = ProjectMentor::model()->findBySql("SELECT * FROM project_mentor WHERE user_id=$model->id");
      $p = Project::model()->findAllBySql(("SELECT * FROM project WHERE project_mentor_user_id=$model->id"));?>
     
<?php if($model->isProMentor && count($p) < $promentor->max_projects )
{?>
    <h4>Current Senior Projects<br><br>
    Check the projects(s) that you are interested in </h4>
    <?php echo ucfirst($model->fname);?> can add up to <?php echo $promentor->max_projects-count($p); ?> more project(s).
    <div id="container" class="my-box-container2" style="height: 200px; overflow-y: scroll ">
        <?php
        if($projects == null)
        {
            echo "No registered projects available";
        }
        else
        {?>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="#mytable" width="100%">
            <thread>
                <tr>    
                    <th width="1%"></th>
                    <th width="40%">Project Name</th>
                </tr>
            </thread>
            <?php foreach($projects as $project)
            { ?>
            <tbody>
                <tr>
                    <td><input type="checkbox" name="proj[]" value="<?php echo $project->title; ?>"> </td>
                    <td><?php echo $project->title?></td>
                </tr>
            </tbody> 
            <?php 
            } ?>
        </table>
        <?php }?>
    </div>

	<h2>OR</h2>
        
    <h4>Check the project(s) that you are NOT interested in</h4>
    <div id="container" class="my-box-container2" style="height: 200px; overflow-y: scroll ">
           <table cellpadding="0" vecllspacing="0" border="0" class="table table-striped table-bordered" id="#mytable" width="100%">
            <thread>
                <tr>
                    <th width="1%"></th>
                    <th width="40%">Project Name</th>
                </tr>
            </thread>
            <?php if($projects == null)
            {
                echo "No Projects Found";
            }
            else
            {?>
            <?php foreach($projects as $project)
            { ?>
            <tbody>
                <tr>
                    <td><input type="checkbox" name="nwproj[]" value="<?php echo $project->title; ?>"></td>
                    <td><?php echo $project->title?></td>
                    
                </tr>
            </tbody>
            <?php }
            }?>
        </table>
    </div>
    <h9>Note: Click on projects to see their description</h9>
 
<?php } 
      elseif($model->isProMentor)
      {?>
        <h4>My Current Assigned Senior Projects</h4>
        <h5>***Max Projects Already Assigned***</h5>
        <div id="container" class="my-box-container2" style="height: 200px; overflow-y: scroll ">
        <?php
        {?>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="#mytable" width="100%">
            <thread>
                <tr>    
                    <th width="40%">Project Name</th>
                </tr>
            </thread>
            <?php
                $proj = Project::model()->findAllBySql("SELECT title FROM project WHERE project_mentor_user_id=$model->id");
                foreach($proj as $project)
                {   
                ?>
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

 <?php if($model->isDomMentor || $model->isProMentor || $model->isPerMentor)
 {?>
    <div id="container" class="my-box-container3" style="height: 350px">       
        <div class="contactlinks">
        <h4>Availability</h4>
        
	<?php 
        if($model->isDomMentor)
        {
            ?><h6>Domain Mentor Availability</h6><?php
            $dommentor = DomainMentor::model()->findBySql("SELECT max_tickets FROM domain_mentor WHERE user_id=$model->id");
            $userdom = UserDomain::model()->findBySql("SELECT tier_team FROM user_domain WHERE user_id=$model->id");
            
            if($dommentor->max_tickets == null)
            {
                echo "Max tickets: ";?>
                <select name="numTickets" style="width:60px;">
                    <option selected value="<?php echo $dommentor->max_tickets;?>"><?php echo $dommentor->max_tickets;?></option>
                <?php for ($i = 1; $i <= 25; $i++)
                {?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php }?>
                </select><br>
                <?php
            }
            else
            {?>
            <?php 
                echo "Max tickets: ";?>
                <select name="numTickets" style="width:60px;">
                    <option selected value="<?php echo $dommentor->max_tickets;?>"><?php echo $dommentor->max_tickets;?></option>
                <?php for ($i = 1; $i <= 25; $i++)
                {?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php }?>
                </select><br>
            <?php
            }
            ?><?php
        } 
        ?>
        <?php
        if($model->isPerMentor)
        {
            ?><h6>Personal Mentor Availability</h6> <?php
            $permentor = PersonalMentor::model()->findBySql("SELECT * FROM personal_mentor WHERE user_id=$model->id");
            echo "Max Mentees: " ?>
            <select name="numMentees" style="width:60px;">
                <option selected value="<?php echo $permentor->max_mentees;?>"><?php echo $permentor->max_mentees;?></option>
            <?php for ($i = 1; $i <= 3; $i++)
            {?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php }?>
            </select><br>
        <?php  echo "Max hours: " ?>
            <select name="pmenHours" style="width:60px;">
                <option selected value="<?php echo $permentor->max_hours;?>"><?php echo $permentor->max_hours;?></option>
            <?php for ($i = 1; $i <= 25; $i++)
            {?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php }?>
            </select><br>
        <?php
        }
        if($model->isProMentor)
        {
            ?><h6>Project Mentor Availability</h6><?php
            //$promentor = ProjectMentor::model()->findBySql("SELECT * FROM project_mentor WHERE user_id=$user->id");
            echo "Max Projects: " ?>
            <select name="numProjects" style="width:60px;">
                <option selected value="<?php echo $promentor->max_projects;?>"><?php echo $promentor->max_projects;?></option>
            <?php for ($i = 1; $i <= 3; $i++)
            {?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php }?>
            </select><br>
        <?php  echo "Max Hours: " ?>
            <select name="proHours" style="width:60px;">
                <option selected value="<?php echo $promentor->max_hours;?>"><?php echo $promentor->max_hours;?></option>
            <?php for ($i = 1; $i <= 25; $i++)
            {?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php }?>
            </select><br>
	</div>
        <?php } ?>
    <?php } ?>      
    </div>
</div>  <!-- end left div -->

<?php if(!$model->isMentee && !$model->isAdmin)
{?>
<div id="right">    
    <div id="experience">
        <div class="titlebox"><h4>BIOGRAPHY & WORK HISTORY</h4></div><br><br><br>   
            <h8><textarea id="bio" style="width:475px; height:150px;"name="biography"><?php echo $model->biography ?></textarea>
    <!--<input type="text" name="biography" value="<?php echo $model->biography ?>"/>-->
    <br><!--<?php echo CHtml::submitButton('Edit', array("class"=>"btn btn-primary")/*$model->isNewRecord ? 'Create' : 'Save'*/); ?>-->
    </div>
     
<!-- div to show domains for Domain and Personal Mentors ONLY; only included for project mentors if they are also domain or personal --> 
<?php if($model->isDomMentor)
{?>
    <div id="container" class="my-box-container5" style="height: 300px; ">
       <div class="titlebox"><h4>DOMAINS</h4></div>
     <?php 
               if($userdoms == null)
               {?>
                <div id="container" class="my-box-container" style="height: 200px; overflow-y: scroll ">
                <?php
                    echo "<h7>Rating: 1 : low: < 2yrs experience, 5 : moderate2-5yrs exp, 10 : > 5yrs exp</h7>"
                        . "<h6>Add new domain:";?>
                <input type="text" style ="width:100px;" name="domainName">
                <select name="ratings" style="width:60px;">
                <?php for ($i = 1; $i <= 10; $i++)
                {?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php }
                ?></select></h6><br>
 
           Add Current Domain(s)<select multiple name ="existDoms[]" style="width:100px;">
            <?php $dm = Domain::model()->findAllBySql("SELECT * FROM domain WHERE id NOT IN (SELECT domain_id FROM user_domain WHERE user_id=$model->id)");
                    for($i = 0; $i < count($dm); $i++)
                    {?>
               <option value="<?php echo $dm[$i]->name; ?>"><?php echo $dm[$i]->name; ?></option>
                  <?php  }
               ?>
           </select></h6></div>
       <?php }
               else
               { ?>
     <div id="container" class="my-box-container" style="height: 175px; overflow-y: scroll ">
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
                            $userdom = UserDomain::model()->findBySql("SELECT rate FROM user_domain WHERE domain_id=$domain->id AND user_id=$model->id");
                            ?>
                            <tbody>
                            <tr>
                                <td><?php echo $domain->name; ?></td>
                                <td><?php  
                                if($userdom->rate == null)
                                {?>
                                <select name="unrated[]" style="width:60px;">
                                <?php for ($i = 1; $i <= 10; $i++)
                                {?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php }?></select> 
                                <?php
                                }
                                else
                                {
                                    echo $userdom->rate;
                                }?></td>
                            </tr>
                            </tbody>
                        <?php
                        }
               ?>
            </table><br>
     </div><h7>Rating: 1:low: < 2yrs experience, 5:moderate2-5yrs exp, 10: > 5yrs exp</h7>
       <h6>Add Domain <input type="text" style ="width:100px;" name="domainName">
           <select name="ratings" style="width:60px;">
                <?php for ($i = 1; $i <= 10; $i++)
                {?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php }
                ?></select>
           Add Current Domain(s)<select multiple name ="existDoms[]" style="width:100px;">
            <?php $dm = Domain::model()->findAllBySql("SELECT * FROM domain WHERE id NOT IN (SELECT domain_id FROM user_domain WHERE user_id=$model->id)");
                    for($i = 0; $i < count($dm); $i++)
                    {?>
               <option value="<?php echo $dm[$i]->name; ?>"><?php echo $dm[$i]->name; ?></option>
                  <?php  }
               ?>
          </select></h6>  
       <?php }}?></div> 
 
<!-- div for personal mentors -->
<?php $permentor = PersonalMentor::model()->findBySql("SELECT * FROM personal_mentor WHERE user_id=$model->id");
      $m = Mentee::model()->findAllBySql("SELECT * FROM mentee WHERE personal_mentor_user_id=$model->id");?>
<?php if($model->isPerMentor && count($m) < $permentor->max_mentees) 
    {?>
    <h4>Current Senior Project Students<br><br>
    Check the student(s) that you are interested in </h4>
     You can add up to <?php echo $permentor->max_mentees - count($m); ?> more mentee(s).
    <div id="container" class="my-box-container2" style="height: 200px; overflow-y: scroll ">
            
        <?php 
        if($Mentees == null)
        {
            echo "No Registered Mentees are available";
        }
        else
        {?>
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="#mytable" width="100%">
            <thread>
                <tr>
                    <th width="1%"></th>
                    <th width="40%">Student Name</th>
                </tr>
            </thread>
            <?php
            foreach($Mentees as $mentee)
            {
                $usr = User::model()->findBySql("SELECT * FROM user WHERE id=$mentee->user_id");
                ?>
                <tbody>
                <tr>
                    <td><input type="checkbox" name="mentees[]" value="<?php echo $mentee->user_id; ?>"</td>
                    <td><?php echo ucfirst($usr->fname) ." ". ucfirst($usr->lname);?></td>
                </tr>
                </tbody>
            
     <?php }?>
                </table>
     <?php } ?>
	</div>		
    <h2>OR</h2> 
    <h4>Check the student(s) that you are NOT interested in</h4>
    <div id="container" class="my-box-container2" style="height: 200px; overflow-y: scroll ">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="#mytable" width="100%">
            <thread>
                <tr>
                    <th width="1%"></th>
                    <th width="40%">Student Name</th>
                </tr>
            </thread>
            <?php
            foreach($Mentees as $mentee)
            {
                $usr = User::model()->findBySql("SELECT * FROM user WHERE id=$mentee->user_id");
                ?>
                <tbody>
                <tr>
                    <td><input type="checkbox" name="nmentees[]" value="<?php echo $mentee->user_id; ?>"</td>
                    <td><?php echo ucfirst($usr->fname) ." ". ucfirst($usr->lname);?></td>
                </tr>
                </tbody>
            
     <?php }?>
                </table>
    </div>
    <h9>Note: Click on students to see their project and description(s)</h9>
 <?php } elseif($model->isPerMentor)
      {?>
        <h4>My Current Assigned Mentees</h4>
        <h5>***Max Mentees Already Assigned***</h5>
        <div id="container" class="my-box-container2" style="height: 200px; overflow-y: scroll ">
        <?php
        {?>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="#mytable" width="100%">
            <thread>
                <tr>
                    <th width="40%">Student Name</th>
                </tr>
            </thread>
            <?php
            $men = Mentee::model()->findAllBySql("SELECT * FROM mentee WHERE personal_mentor_user_id=$model->id");
            foreach($men as $mentee)
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
      <?php }?>
    <br><br>
<?php } ?>
</div>
<div style="float:right">
    <!--<?php echo CHtml::submitButton('Submit', array("class"=>"btn btn-primary")); ?>-->
    <input type="submit" name="submit" value="Save" class="btn btn-primary">
   
    </div> 
    </form>
<!--end right-->
    </div><!--end form-->

