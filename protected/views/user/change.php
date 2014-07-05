<?php
$projects = Project::model()->findAllBySql("SELECT title FROM project WHERE project_mentor_user_id IS NULL");
$userdoms = UserDomain::model()->findAllBySql("SELECT distinct domain_id FROM user_domain WHERE user_id=$model->id");
$Mentees = Mentee::model()->findAllBySql("SELECT user_id FROM mentee WHERE personal_mentor_user_id IS NULL");
?>
<div style="width: 1030px;">

<div id="left">
<form method="POST" enctype="multipart/form-data" action="/coplat/index.php/user/<?php echo $model->id; ?>">

<div id="container" class="my-box-container3" style="height: 360px;" >
    <div class="titlebox"><h3><?php echo ucfirst($model->fname) ." " . ucfirst($model->lname)?></h3></div>
    <div id="profileImage">
        <br><img style="width:150px; height:205px;" src="<?php echo $model->pic_url ?>" />
        <input type="file" name="photo" style="width:95px;" class="btn-primary">

        <br>Role Type(s): <?php if($model->isAdmin) {?> <b> Administrator </b> <?php }?>
        <?php if($model->isDomMentor) {?> <b>Domain Mentor </b> <?php }?>
        <?php if($model->isPerMentor) {?> <b>Personal Mentor </b> <?php }?>
        <?php if($model->isProMentor) {?> <b>Project Mentor </b> <?php }?>
        <?php if($model->isMentee) {?> <b> Mentee </b> <?php }?>
    </div>
</div>

<!-- div for project mentors -->
<?php if($model->isProMentor)
{
    $promentor = ProjectMentor::model()->findBySql("SELECT * FROM project_mentor WHERE user_id=$model->id");
    $p = Project::model()->findAllBySql(("SELECT * FROM project WHERE project_mentor_user_id=$model->id"));
    if(is_null($promentor->max_projects))
    {
        $promentor->max_projects = 0; $promentor->save();
    }
}?>
<?php if(($model->isProMentor && ((count($p) < $promentor->max_projects) || count($p) == 0)))
{?>
    <h4><?php echo ucfirst($model->fname) . "'s "?>Current Senior Projects<br><br>
        Check the projects(s) that you are interested in </h4>
    <?php if(empty($promentor->max_projects))
{
    echo" Select the desired amount of projects below and choose a maximum amount on the left";
}
else
{
    echo "You can add up to ". ($promentor->max_projects - count($p)) ." more projects(s).";
}?>
    <div id="container" class="my-box-container6"
         style="<?php if($model->isProMentor)
         {   echo 'display:block; '; }
         else
         {   echo 'display:none; '; } ?> height: 200px; overflow-y: scroll ">
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
    <div id="container" class="my-box-container6" style="height: 200px; overflow-y: scroll ">
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
elseif($model->isProMentor)
{?>
    <h4><?php echo ucfirst($model->fname) . "'s "?>Current Assigned Senior Projects</h4>
    <h5>***Max Projects Already Assigned***</h5>
    <div id="container" class="my-box-container2"
         style="<?php if($model->isProMentor)
         {   echo 'display:block; '; }
         else
         {   echo 'display:none; ';  }?> height: 200px; overflow-y: scroll ">
        <?php
        {?>
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="#mytable" width="100%">
                <thread>
                    <tr>
                        <th width="100%">Project Name</th>
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
<div id="container" class="my-box-container3"
     style="<?php if($model->isDomMentor || $model->isProMentor || $model->isPerMentor)
     {   echo 'display:block; '; }
     else
     {   echo 'dispaly:none; '; } ?>height: 100%;">
    <div class="contactlinks">
        <h4>Availability</h4>
        <?php
        if($model->isDomMentor)
        {
            ?><h6>Domain Mentor Availability</h6><?php
            $dommentor = DomainMentor::model()->findBySql("SELECT max_tickets FROM domain_mentor WHERE user_id=$model->id");
            $userdom = UserDomain::model()->findBySql("SELECT tier_team FROM user_domain WHERE user_id=$model->id");
            if(is_null($dommentor->max_tickets))
            {
                $dommentor->max_tickets = 0; $dommentor->save();
            }
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
            }?>

        <?php
        }
        ?>
        <?php
        if($model->isPerMentor)
        {
            ?><h6>Personal Mentor Availability</h6> <?php
            $permentor = PersonalMentor::model()->findBySql("SELECT * FROM personal_mentor WHERE user_id=$model->id");
            echo "Max Mentees: "; ?>
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

</div>
</div>  <!-- end left div -->
<?php } ?>

<div id="right">
    <div id="experience">
        <div class="titlebox"><h4>BIOGRAPHY & WORK HISTORY</h4></div><br><br><br>
        <h8><textarea id="bio" style="width:475px; height:150px;"name="biography"><?php echo $model->biography ?></textarea>
            <br>
    </div>

    <!-- div to show domains for Domain and Personal Mentors ONLY; only included for project mentors if they are also domain or personal -->
    <?php if($model->isDomMentor)
    {?>
    <div id="container" class="my-box-container5"
         style="<?php if($model->isDomMentor)
         {   echo 'display:block; '; }
         else
         {   echo 'display:none; ';}?> height: 300px; ">
        <div class="titlebox"><h4>DOMAINS</h4></div>
        <?php

        if($userdoms == null)
        {?>
            <div id="container" class="my-box-container" style="height: 225px; overflow-y: scroll ">
                <h7><center>Rating: 1: Basic experience, 5: Moderate exp, 10: Mastered</h7>
                <h6>Add Current Domain(s)
                    <select name ="existDoms[]" style="width:100px;">
                        <?php $dm = Domain::model()->findAllBySql("SELECT * FROM domain WHERE id NOT IN (SELECT domain_id FROM user_domain WHERE user_id=$model->id)");
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
            </div>              <h7><center>Rating: 1: Basic experience, 5: Moderate exp, 10: Mastered</h7>
            <h6>Add Current Domain(s)
                <select name ="existDoms[]" style="width:100px;">
                    <?php $dm = Domain::model()->findAllBySql("SELECT * FROM domain WHERE id NOT IN (SELECT domain_id FROM user_domain WHERE user_id=$model->id)");
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
        <?php }
        }?></div>

    <!-- div for personal mentors -->
    <?php if($model->isPerMentor)
    {
        $permentor = PersonalMentor::model()->findBySql("SELECT * FROM personal_mentor WHERE user_id=$model->id");
        $m = Mentee::model()->findAllBySql("SELECT * FROM mentee WHERE personal_mentor_user_id=$model->id");?>
        <?php if(($model->isPerMentor && ((count($m) < $permentor->max_mentees) || count($m) == 0)))
    {?>
        <h4><?php echo ucfirst($model->fname). "'s ";?>Current Assigned Mentees<br><br>
            Check the student(s) that you are interested in </h4>
        <?php if(empty($permentor->max_mentees))
    {
        echo" Select the desired amount of mentees below and choose a maximum amount on the left";
    }
    else
    {
        echo "You can add up to " . ($permentor->max_mentees - count($m)) . " more mentee(s).";
    }?>
        <div id="container" class="my-box-container6" style="height: 200px; overflow-y: scroll ">
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
        <!--<h2>OR</h2>
    <h4>Check the student(s) that you are NOT interested in</h4>
    <div id="container" class="my-box-container6" style="height: 200px; overflow-y: scroll ">
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
    </div>-->
    <?php } elseif($model->isPerMentor)
    {?>
        <h4><?php echo ucfirst($model->fname) . "'s "?>Current Assigned Mentees</h4>
        <h5>***Max Mentees Already Assigned***</h5>
        <div id="container" class="my-box-container6" style="height: 200px; overflow-y: scroll ">
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
                </table><?php }?>
        </div>
    <?php }
    }?>
    <br><br>  <input type="submit" name="submit" value="Save" class="btn btn-primary">

</div>
<!--end right-->
</form>
</div>
<!--end form-->

