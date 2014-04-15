<div class="titlebox"><h3><?php echo ucfirst($user->fname) . " " . ucfirst($user->lname) ?></h3></div>

<div class="fullcontent">
<div id="left">

    <div id="span2" class="my-box-container3" style="height: 350px;">

        <div id="profileImage">
            <br><img style="width:150px; height:205px;" src="<?php echo $user->pic_url ?>"/>

            <div id="output"></div>

            <?php echo CHtml::submitButton('Edit Photo', array("class" => "btn btn-primary")); ?>
            <?php echo CHtml::submitButton('Sync LinkedIn', array("class" => "btn btn-primary") /*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
            <br>Role Type(s): <?php if (User::isCurrentUserDomMentor()) { ?> <b>Domain Mentor </b> <?php } ?>
            <?php if (User::isCurrentUserPerMentor()) { ?> <b>Personal Mentor </b> <?php } ?>
            <?php if (User::isCurrentUserProMentor()) { ?> <b>Project Mentor </b> <?php } ?>
            <?php if (User::isCurrentUserMentee()) { ?> <b> Mentee </b> <?php } ?>
        </div>
    </div>

    <!-- div for project mentors -->

    <?php if (User::isCurrentUserProMentor()) {
        ?>

        <h4>Current Senior Projects<br><br>
            Check the projects(s) that you are interested in </h4>
        <div id="container" class="my-box-container2" style="height: 200px; overflow-y: scroll ">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="#mytable"
                   width="100%">
                <thread>
                    <tr>
                        <th width="1%"></th>
                        <th width="40%">Project Name</th>
                        <th width="40%">Mentees</th>
                        <th width="19%">Rating</th>
                    </tr>
                </thread>
                <?php foreach ($projects as $project) {
                    //$pmen = Mentee::model()->findBySql("SELECT user_id FROM mentee WHERE projectmentor_project_id=$project->id");
                    $y = Project::model()->findBySql("SELECT id FROM project ORDER BY id DESC LIMIT 1");
                    $x = (int)$y->id;
                    ?>
                    <tbody>
                    <tr>
                        <td><input type="checkbox" value="intersted"></td>
                        <td><?php echo $project->title ?></td>
                        <td><?php echo "Names to be imported" //$puser->fname . " " . $puser->lname; ?></td>
                        <td><select name="rating">">
                                <option value="">Rate...</option>
                                ;
                                <?php for ($i = 0; $i <= $x + 1; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }?>
                            </select></td>
                    </tr>
                    </tbody>
                <?php } ?>
            </table>
        </div>
        <h2>OR</h2>

        <h4>Check the project(s) that you are NOT interested in</h4>
        <div id="container" class="my-box-container2" style="height: 200px; overflow-y: scroll ">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="#mytable"
                   width="100%">
                <thread>
                    <tr>
                        <th width="1%"></th>
                        <th width="40%">Project Name</th>
                        <th width="40%">Mentees</th>
                    </tr>
                </thread>
                <?php if ($projects == null) {
                    echo "No Projects Found";
                } else {
                    ?>
                    <?php foreach ($projects as $project) {

                        //$pmen = Mentee::model()->findBySql("SELECT user_id FROM mentee WHERE projectmentor_project_id=$project->id");
                        //$y = Project::model()->findBySql("SELECT LAST(id) FROM project");

                        ?>
                        <tbody>
                        <tr>
                            <td><input type="checkbox" value="intersted"></td>
                            <td><?php echo $project->title ?></td>
                            <td><?php echo "Names to be imported" //$puser->fname . " " . $puser->lname; ?></td>
                        </tr>
                        </tbody>
                    <?php
                    }
                }?>
            </table>
        </div>
        <h9>Note: Click on projects to see their description</h9>

    <?php } ?>

    <?php if (User::isCurrentUserDomMentor() || User::isCurrentUserPerMentor() || User::isCurrentUserPerMentor())
    {
    ?>
    <div id="container" class="my-box-container3" style="height: 220px">
        <div class="contactlinks">
            <h4>Availability</h4>
            <?php
            if (User::isCurrentUserDomMentor()) {
                $dommentor = DomainMentor::model()->findBySql("SELECT max_tickets FROM domain_mentor WHERE user_id=$user->id");
                echo "Max tickets: " . $dommentor->max_tickets;
            }
            ?><br><br>
            <?php
            if (User::isCurrentUserPerMentor()) {
                $permentor = PersonalMentor::model()->findBySql("SELECT * FROM personal_mentor WHERE user_id=$user->id");
                echo "Max Mentees: " . $permentor->max_mentees;
                ?><br>
                <?php echo "Max hours: " . $permentor->max_hours;
            } ?><br><br>
            <?php
            if (User::isCurrentUserProMentor()) {
                $promentor = ProjectMentor::model()->findBySql("SELECT * FROM project_mentor WHERE user_id=$user->id");
                echo "Max Projects: " . $promentor->max_projects;
                ?><br>
                <?php echo "Max Hours: " . $promentor->max_hours;
            } ?>
        </div>
        <?php
        if (User::isCurrentUserDomMentor()) {
            $userdom = UserDomain::model()->findBySql("SELECT tier_team FROM user_domain WHERE user_id=$user->id");
            echo "Tier Level: " . $userdom->tier_team;
        }
        }?>
    </div>
</div>
<!-- end left div -->

<div id="right">
    <div id="experience">
        <div class="titlebox"><h4>BIOGRAPHY & WORK HISTORY</h4></div>
        <br><br><br>
        <h8><?php echo $user->biography ?></h8>
        <!--<input type="text" name="biography" value="<?php echo $user->biography ?>"/>-->
        <br><?php echo CHtml::submitButton('Edit', array("class" => "btn btn-primary") /*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
    </div>

    <!-- div to show domains for Domain and Personal Mentors ONLY; only included for project mentors if they are also domain or personal -->
    <?php if (User::isCurrentUserDomMentor())
    {
    ?>
    <div id="container" class="my-box-container5" style="height: 250px; overflow-y: scroll; ">
        <div class="titlebox"><h4>DOMAINS</h4></div>
        <?php
        if ($userdoms == null)
        {
            echo "No Assigned Domains";
        }
        else
        {
        ?>
        <div id="container" class="my-box-container" style="height: 200px; overflow-y: scroll ">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="#mytable"
                   width="100%">
                <thead>
                <tr>
                    <th width="50%">Domain Name</th>
                    <th width="50%">Expertise Level</th>
                </tr>
                </thead>
                <?php foreach ($userdoms as $userdom) {
                    $domain = Domain::model()->find("id=:id", array(":id" => $userdom->domain_id));
                   // $userdom = UserDomain::model()->find("id=:id", array(":id" => $domain->id));
                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo $domain->name; ?></td>
                        <td><?php /* echo $userdom->rate;*/?></td>
                    </tr>
                    </tbody>
                <?php
                }
                }
                ?>
            </table>
            <br>

        </div>
        <br><?php echo CHtml::submitButton('Add Domain', array("class" => "btn btn-primary") /*$model->isNewRecord ? 'Create' : 'Save'*/);
        }?>
    </div>

    <!-- div for personal mentors -->
    <?php if (User::isCurrentUserPerMentor()) { ?>
        <h4>Current Senior Project Students<br><br>
            Check the student(s) that you are interested in </h4>
        <div id="container" class="my-box-container2" style="height: 200px; overflow-y: scroll ">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="#mytable"
                   width="100%">
                <thread>
                    <tr>
                        <th width="1%"></th>
                        <th width="40%">Student Name</th>
                    </tr>
                </thread>
                <?php
                foreach ($Mentees as $mentee) {
                    //$mentee = Mentee::model()->findBySql("SELECT * FROM mentee");
                    $usr = User::model()->findBySql("SELECT * FROM user WHERE id=$mentee->user_id");
                    ?>
                    <tbody>
                    <tr>
                        <td><input type="checkbox" value="intersted"></td>
                        <td><?php echo ucfirst($usr->fname) . " " . ucfirst($usr->lname); ?></td>
                    </tr>
                    </tbody>

                <?php } ?>
            </table>
        </div>
        <h2>OR</h2>
        <h4>Check the student(s) that you are NOT interested in</h4>
        <div id="container" class="my-box-container2" style="height: 200px; overflow-y: scroll ">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="#mytable"
                   width="100%">
                <thread>
                    <tr>
                        <th width="1%"></th>
                        <th width="40%">Student Name</th>
                    </tr>
                </thread>
                <?php
                foreach ($Mentees as $mentee) {
                    //$mentee = Mentee::model()->findBySql("SELECT * FROM mentee");
                    $usr = User::model()->findBySql("SELECT * FROM user WHERE id=$mentee->user_id");
                    ?>
                    <tbody>
                    <tr>
                        <td><input type="checkbox" value="intersted"></td>
                        <td><?php echo ucfirst($usr->fname) . " " . ucfirst($usr->lname); ?></td>
                    </tr>
                    </tbody>

                <?php } ?>
            </table>
        </div>
        <h9>Note: Click on students to see their project and description(s)</h9>
    <?php } ?>
    <br><br>

    <div style="float:right">
        <?php echo CHtml::submitButton('Submit', array("class" => "btn btn-primary") /*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
    </div>
</div>
<!--end right-->

</div> <!--end form -->