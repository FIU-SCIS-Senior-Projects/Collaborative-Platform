<div style="width: 1030px;">
    
<div id="left">
<form method="POST" enctype="multipart/form-data" action="userProfile">
    
<div id="container" class="my-box-container3" style="height: 325px;" >   
        <div class="titlebox"><h3><?php echo ucfirst($user->fname) ." " . ucfirst($user->lname)?></h3></div>
        <div id="profileImage">
        <br><img style="width:150px; height:205px;" src="<?php echo $user->pic_url ?>" />
        
        <input type="file" name="photo" style="width:95px;" class="btn btn-primary">
        <br>Role Type(s): <?php if(User::isCurrentUserAdmin()) {?> <b> Administrator </b> <?php }?>
                          <?php if(User::isCurrentUserDomMentor()) {?> <b>Domain Mentor </b> <?php }?>
                          <?php if(User::isCurrentUserPerMentor()) {?> <b>Personal Mentor </b> <?php }?>
                          <?php if(User::isCurrentUserProMentor()) {?> <b>Project Mentor </b> <?php }?>
                          <?php if(User::isCurrentUserMentee()) {?> <b> Mentee </b> <?php }?>        
        </div> 
</div> 

<!-- div for project mentors -->
<?php if(User::isCurrentUserProMentor())
{   $promentor = ProjectMentor::model()->findBySql("SELECT * FROM project_mentor WHERE user_id=$user->id");
    $p = Project::model()->findAllBySql(("SELECT * FROM project WHERE project_mentor_user_id=$user->id"));?>
    <?php if((User::isCurrentUserProMentor() && (count($p) < $promentor->max_projects) || count($p) == 0))
    {?>
    <h4>Current Senior Projects<br><br>
    Check the projects(s) that you are interested in </h4>
    <?php if(empty($promentor->max_projects))
    {   echo" Select the desired amount of projects below and choose a maximum amount on the left"; }
    else
    {   echo "You can add up to ". ($promentor->max_projects - count($p)) ." more projects(s).";    }?>
    <div id="container" class="my-box-container6" 
    style="<?php if(User::isCurrentUserProMentor())
        {     echo 'display:block; '; }
        else
        {     echo 'display:none; ';  } ?> height: 200px; overflow-y: scroll">
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

	<!--<h2>OR</h2>
        
    <h4>Check the project(s) that you are NOT interested in</h4>
    <div id="container" class="my-box-container6"
        style="<?php if(User::isCurrentUserProMentor())
                    {     echo 'display:block; '; }
                    else
                    {     echo 'display:none; ';  } ?> height: 200px; overflow-y: scroll ">
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
    </div>-->
<?php } 
      elseif(User::isCurrentUserProMentor())
      {?>
        <h4>My Current Assigned Senior Projects</h4>
        <h5>***Max Projects Already Assigned***</h5>
        <div id="container" class="my-box-container2" 
        style="<?php if(User::isCurrentUserProMentor())
        {     echo 'display:block; '; }
        else
        {     echo 'display:none; ';  } ?> height: 200px; overflow-y: scroll ">
        <?php
        {?>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="#mytable" width="100%">
            <thread>
                <tr>    
                    <th width="100%">Project Name</th>
                </tr>
            </thread>
            <?php
                $proj = Project::model()->findAllBySql("SELECT title FROM project WHERE project_mentor_user_id=$user->id");
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
<?php } ?>
<!-- end if project mentor -->
        
 <?php if(User::isCurrentUserDomMentor() || User::isCurrentUserProMentor() || User::isCurrentUserPerMentor())
 {?>
    <div id="container" class="my-box-container3" 
         style="<?php if(User::isCurrentUserProMentor() || User::isCurrentUserDomMentor() || User::isCurrentUserPerMentor())
        {     echo 'display:block; '; }
        else
        {     echo 'display:none; ';  } ?> height: 100%">       
        <div class="contactlinks">
        <h4>Availability</h4>
        
	<?php 
        if(User::isCurrentUserDomMentor())
        {
            ?><h6>Domain Mentor Availability</h6><?php
            $dommentor = DomainMentor::model()->findBySql("SELECT max_tickets FROM domain_mentor WHERE user_id=$user->id");
            $userdom = UserDomain::model()->findBySql("SELECT tier_team FROM user_domain WHERE user_id=$user->id");
            
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
        if(User::isCurrentUserPerMentor())
        {
            ?><h6>Personal Mentor Availability</h6> <?php
            $permentor = PersonalMentor::model()->findBySql("SELECT * FROM personal_mentor WHERE user_id=$user->id");
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
        
        <?php }
        if(User::isCurrentUserProMentor())
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
	</div>  <?php } ?>
    </div>  </div><?php } ?>

 <!-- end left div -->
 
<div id="rightup"> 
    <div id="experience">
        <div class="titlebox"><h4>BIOGRAPHY & WORK HISTORY</h4></div><br><br><br>   
            <h8><textarea id="bio" style="width:475px; height:150px;"name="biography"><?php echo $user->biography ?></textarea>
    <br>
    </div>
    
<!-- div to show domains for domain mentors only, unless have other roles as well -->
<?php if(User::isCurrentUserDomMentor())
{?>
    <div id="container" class="my-box-container5" 
       style="<?php if(User::isCurrentUserDomMentor())
        {     echo 'display:block; '; }
        else
        {     echo 'display:none; ';  } ?> height: 300px; ">
       <div class="titlebox"><h4>DOMAINS</h4></div>
       <?php 
               if($userdoms == null)
               {?>
                <div id="container" class="my-box-container" style="height: 225px; overflow-y: scroll ">
                <h7><center>Rating: 1: Basic experience, 5: Moderate exp, 10: Mastered</h7>
           <h6>Add Current Domain(s)
                <select name ="existDoms[]" style="width:100px;">
                <?php $dm = Domain::model()->findAllBySql("SELECT * FROM domain WHERE id NOT IN (SELECT domain_id FROM user_domain WHERE user_id=$user->id)");
                    for($i = 0; $i < count($dm); $i++)
                    {?>
                    <option value="<?php echo $dm[$i]->name; ?>"><?php echo $dm[$i]->name; ?></option>
                    <?php  }
                    ?>
                </select>           
                <select name="ratings" style="width:60px;">
                <?php for ($i = 1; $i <= 10; $i++)
                {?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php }
                ?></select></h6></center></div>
       <?php }
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
                            $userdom = UserDomain::model()->findBySql("SELECT rate FROM user_domain WHERE domain_id=$domain->id AND user_id=$user->id");
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
     </div><h7><center>Rating: 1: Basic experience, 5: Moderate exp, 10: Mastered</h7>
           <h6>Add Current Domain(s)
                <select name ="existDoms[]" style="width:100px;">
                <?php $dm = Domain::model()->findAllBySql("SELECT * FROM domain WHERE id NOT IN (SELECT domain_id FROM user_domain WHERE user_id=$user->id)");
                    for($i = 0; $i < count($dm); $i++)
                    {?>
                    <option value="<?php echo $dm[$i]->name; ?>"><?php echo $dm[$i]->name; ?></option>
                    <?php  }
                    ?>
                </select>           
                <select name="ratings" style="width:60px;">
                <?php for ($i = 1; $i <= 10; $i++)
                {?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php }
                ?></select></h6></center>
       </h6> 
 <?php } ?></div>
<?php }?>  
   
<!-- div for personal mentors -->
<?php if(User::isCurrentUserPerMentor())
{
      $permentor = PersonalMentor::model()->findBySql("SELECT * FROM personal_mentor WHERE user_id=$user->id"); 
      $m = Mentee::model()->findAllBySql("SELECT * FROM mentee WHERE personal_mentor_user_id=$user->id");?>
    <?php if((User::isCurrentUserPerMentor() && ((count($m) < $permentor->max_mentees) || count($m) == 0)))
    {?>
        
    <h4>Current Senior Project Students<br><br>
    Check the student(s) that you are interested in </h4>
    <?php if(empty($permentor->max_mentees))
    {
        echo" Select the desired amount of mentees below and choose a maximum amount on the left";
    }
    else
    {
     echo "You can add up to " . ($permentor->max_mentees - count($m)) . " more mentee(s).";
    }?>
    <div id="container" class="my-box-container2" 
        style="<?php if(User::isCurrentUserPerMentor())
        {     echo 'display:block; '; }
        else
        {     echo 'display:none; ';  } ?>height: 200px; overflow-y: scroll ">
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
            <?php } ?></div>		
    <!--<h2>OR</h2> 
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
     <?php }?></table>
    </div>-->
    <?php } elseif(User::isCurrentUserPerMentor())
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
            $men = Mentee::model()->findAllBySql("SELECT * FROM mentee WHERE personal_mentor_user_id=$user->id");
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
                </table><?php }?>
    </div> 
    <br>
        <?php } ?>
    <?php }?><br>
    <input type="submit" name="submit" value="Save" class="btn btn-primary">
    </form></div>
</div>
