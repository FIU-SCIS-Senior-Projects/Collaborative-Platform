<?php
$user =User::model()->findBySql("select * from user where id = $model->id");//current user
$def = User::model()->findBySql("select * from user where username = 'DEFAULT'");//default user
$all = Domain::model()->findAll(); //all domains


if($user->isProMentor==1 || $user->isDomMentor==1 || $user->isPerMentor==1)
{
?>

<head>

    <script>

        function load()
        {
        }
        <?php
                foreach($all as $dm)
                {
                     print('
                     $(function(){
                    $(\'#'.$dm->id.'\').click(function()
                    {
                        if(document.getElementById("'.$dm->id.'").checked == true)
                        {

                            var nodes = document.getElementById("'.$dm->id.'dmsub").getElementsByTagName(\'*\');
                            for(var i = 0; i < nodes.length; i++)
                            {
                            nodes[i].disabled = false;
                            }


                        } else
                        {

                            var nodes = document.getElementById("'.$dm->id.'dmsub").getElementsByTagName(\'*\');
                            for(var i = 0; i < nodes.length; i++)
                            {
                            nodes[i].disabled = true;
                            nodes[i].checked = false;
                            }



                                        }

                        //alert(\'clicked\');
                    });
                });



                     ');

                }

        ?>





    </script>

    <link rel="stylesheet" type="text/css" href="/coplat/css/ui-lightness/jquery-ui-1.8.2.custom.css" />
    <link rel="stylesheet" type="text/css" href="/coplat/css/Wizard.css" />



</head>
<body >
<div id="demoWrapper"  class="my-box-container7" style="background-color: #ffffff">
<h2>User: <?php echo $model->fname.' '.$model->lname ?></h2>
<ul>
</ul>
<hr />
<h5 id="status"></h5>
<form id="demoForm"   name ="demoForm" method="post" action="/coplat/index.php/user/<?php echo $model->id; ?>" class="bbq">
<div id="fieldWrapper">

<?php

if($model->isProMentor==1)
{

    ?>
    <div class="step" id="first">
        <h3><span class="font_normal_07em_black">Role: Project Mentor</span></h3>.<br />
        <div  class="my-box-container7" style="width: auto; float:left;">
            <h3>Current Senior Projects</h3>
            <br>
            <h4>Select the projects for this project mentor:</h4>
            <br>

            <?php

            $myProjmentor= ProjectMentor::model()->findByPk($model->id);
            $projects = Project::model()->findAllBySql("select * from project where  project_mentor_user_id in ($def->id,$model->id)");
            $myProjects = Project::model()->findAllBySql("select * from project where project_mentor_user_id = $model->id");

            ?>
            <div  name ="pjmprojects" class="container" style="border:2px solid #ccc; width:auto; height: 300px; overflow-y: scroll;background-color:white">

                <table>

                    <?php
                    $i=0;

                    foreach ($projects as $project)
                    {
                        $mymenids = Mentee::model()->findAllBySql("select * from mentee where project_id =$project->id ");
                        $res ='No mentees for this project';
                        if($mymenids!=null)
                        {
                            $res = '';

                            foreach($mymenids as $m)
                            {

                                $pid = $m->user_id;

                                $t = User::model()->findBySql("select * from user where id = $pid");
                                $pjm = User::model()->findBySql("select * from user where id = $project->project_mentor_user_id");
                                $perm = User::model()->findBySql("select * from user where id = $m->personal_mentor_user_id");
                                $customer = User::model()->findBySql("select * from user where id = $project->propose_by_user_id");


                               $PJMname = $pjm->fname.' '.$pjm->lname;


                               $PERMname = $perm->fname.' '.$perm->lname;

                                $CUSName = $customer->fname.' '.$customer->lname;

                                $res .=$t->fname.' '.$t->lname.'/'.$PJMname. '/'.$PERMname.'<br>';


                            }
                        }
                        /*popover div*/
                        echo '<div id="content-myPopOver-'. $project->id.'" style="display: none;">
                           <p>
                           <h4>'.$project->title.'</h4>'.'
                           <h5>Hours Req: X</h5>'.
                            '<h5>Customer Name:'.$customer.'</h5>'.
                            $project->description.
                            '<h5>Member/Project Mentor/Personal Mentor:</h5>'.
                            $res.'
                           </p></div>';





                        $color = '';

                        if ($i++ % 2)
                        {
                            $color = 'style="background: #e8edff;padding: 15px;"';
                        } else
                        {
                            $color = 'style="padding: 15px;"';
                        }
                        echo'<tr><td   '.$color.'  >';


                        echo '<a href="#test" id="myPopOver-'.$project->id.'" class="mypopover" >';

                        $flag=0;
                        foreach($myProjects as $myProject)
                        {
                            if($myProject->id == $project->id)
                            {
                                echo '<input style="vertical-align: middle; margin-top: -1px;"  type="checkbox" name ="'.$project->id .'pjm" checked/>  '. $project->title .'<br>';
                                $flag=1;
                                break;
                            }

                        }
                            if($flag==0)
                            {
                                echo '<input style="vertical-align: middle; margin-top: -1px;"  type="checkbox" name ="'.$project->id .'pjm"/>  '. $project->title .'<br>';

                            }


                        echo '</td></a></tr>';

                    }


                    ?>


                </table>

            </div>

        </div>
        <script>
            $('.mypopover').popover({
                placement: 'right',
                trigger: 'hover',
                html: true,
                content: function () {
                    return $("#content-" + $(this).attr('id')).html();
                }
            });
        </script>

        <div class="my-box-container7" style="width: auto; float:right">

            <h3>Availability</h3>
            <br>
            <h4>Select how many hours are required:</h4>
            <br>

            <div class="container" style="border:2px solid #ccc; width:auto; height: 300px;padding:0 3cm;background: #e8edff">
                <br>
                <h5 style="text-align:center" >Max hours</h5>
                <select  name="pjmhours" style="width: 100px;">
                    <?php for ($i=0;$i<=24;$i++)
                    {

                        if($myProjmentor!=null)
                        {
                            if($myProjmentor->max_hours == $i)
                            {
                                echo '<option name="'.$i.'" selected>'.$i.'</option>';
                            } else
                            {
                                echo '<option name="'.$i.'">'.$i.'</option>';

                            }
                        } else
                        {
                                echo '<option name="'.$i.'">'.$i.'</option>';
                        }
                    }

                    ?>
                </select>


            </div>



        </div>
        <?php /*
                <span class="font_normal_07em_black">First step - Name</span>
                <br />
                <label for="firstname">First name</label>
                <br />
                <input class="input_field_12em" name="firstname" id="firstname" />
                <br />
                <label for="surname">Surname</label><br />
                <input class="input_field_12em" name="surname" id="surname" />
                <br />
                */
        ?>

    </div>
<?php }?>


<?php
if($model->isDomMentor==1)
{
    ?>



    <div id="finland" class="step">

        <?php //stop here?>
        <h3><span class="font_normal_07em_black">Role: Domain Mentor</span></h3><br />
        <div  class="my-box-container7" style="width: auto; float:left;">
            <h3>Current Domains</h3>
            <br>
            <h4>Select domains:</h4>
            <br>

                <?php
                $myDomainMentor = DomainMentor::model()->findByPk($model->id);
                $myUserDomains = UserDomain::model()->findAllBySql("select distinct domain_id from user_domain where user_id = $model->id");
                ?>

            <div name ="domain" class="container" style="border:2px solid #ccc; width:auto; height: 400px;margin: auto;overflow-y: scroll">

                <body onload="load()">

                <table  style="width:auto;">
                    <tr>
                        <th>Domain</th>
                        <th>Subdomain (Rating/Tier)</th>
                    </tr>
                    <?php



                    $optionR='';
                    $optionT='';
                    /*rate numbers*/
                    for ($i=1;$i<=8;$i++)
                    {
                        $optionR.= '<option value="'.$i.'">'.$i.'</option>';
                    }
                    $optionR .='</select>';

                    /*tier numbers*/
                    for ($i=1;$i<=2;$i++)
                    {
                        $optionT .='<option value="'.$i.'">'.$i.'</option>';
                    }
                    $optionT .= '</select>';


                    $i=0;

                    foreach ($all as $domain)
                    {

                        /*row color */

                        $color = '';
                        $sdcolor ='';
                        if ($i++ % 2)
                        {
                            $color = 'style="background: #e8edff;padding: 15px;"';
                            $sdcolor = 'background: #e8edff;padding: 10px';

                        } else
                        {
                            $color = 'style="padding: 15px;"';
                            $sdcolor = 'padding: 10px';
                        }




                        $selectS ='<div border:1px id = "'.$domain->id.'dmsub" name="'.$domain->id.'dmsub" style="width: 150px;height:50px;overflow-y: scroll;'.$sdcolor.'">';

                        $curPSubdomains = Subdomain::model()->findAllBySql("select * from subdomain where domain_id = $domain->id");
                        $mySubdomains = UserDomain::model()->findAllBySql("select  * from user_domain where user_id = $model->id");
                        $optionS='';



                        foreach($curPSubdomains as $subdomain)
                        {
                            $selectR ='<select  id = "'.$domain->id.'dmrate" name="'.$domain->id.'-'.$subdomain->id.'dmrate" style="width: 50px";>';


                            $selectT = '<select id = "'.$domain->id.'dmtier" name="'.$domain->id.'-'.$subdomain->id.'dmtier" style="width: 50px;" >';

                            $flag =0;
                          foreach($mySubdomains as $mySubdomain)
                          {
                              if($mySubdomain->subdomain_id==$subdomain->id)
                              {
                                  $optionRSelected='';
                                  $optionTSelected='';
                                  $flag=1;
                                  $optionS.='<input style="vertical-align: middle; margin-top: -1px;"  type="checkbox" name ="'.$subdomain->id .'ddmsub" checked/>  '. $subdomain->name ;

                                  $selectR ='<select  id = "'.$domain->id.'dmrate" name="'.$domain->id.'-'.$subdomain->id.'dmrate" style="width: 50px"; >';
                                  for ($i=1;$i<=8;$i++)
                                  {

                                          if($mySubdomain->rate == $i)
                                          {
                                              $optionRSelected.= '<option name="'.$i.'" selected>'.$i.'</option>';
                                          } else
                                          {
                                              $optionRSelected.= '<option name="'.$i.'">'.$i.'</option>';

                                          }

                                  }
                                  $optionRSelected .='</select>';


                                  for ($i=1;$i<=2;$i++)
                                  {

                                      if($mySubdomain->tier_team == $i)
                                      {
                                          $optionTSelected.= '<option name="'.$i.'" selected>'.$i.'</option>';
                                      } else
                                      {
                                          $optionTSelected.= '<option name="'.$i.'">'.$i.'</option>';

                                      }

                                  }
                                  $optionTSelected .='</select>';


                                  $selectR.=$optionRSelected;
                                  $optionS.= '   '.$selectR.'   ';

                                  $selectT = '<select id = "'.$domain->id.'dmtier" name="'.$domain->id.'-'.$subdomain->id.'dmtier" style="width: 50px;" >';
                                  $selectT.=$optionTSelected;
                                  $optionS.='  '.$selectT.'<br>';
                                  BREAK;

                              }



                          }
                            if($flag==0)
                            {

                               $optionS.='<input style="vertical-align: middle; margin-top: -1px;"  type="checkbox" name ="'.$subdomain->id .'ddmsub"/>  '. $subdomain->name;
                                $selectR.=$optionR;
                                $optionS.= '   '.$selectR.'   ';
                                $selectT.=$optionT;
                                $optionS.='  '.$selectT.'<br>';
                            }


                        }

                        $optionS.='</div>';


                        echo'<tr>';
                        $flag2=0;
                    foreach($myUserDomains as $myUserDomain)
                    {
                        if($myUserDomain->domain_id == $domain->id)
                        {
                            echo '<td '.$color.'>'.'<input type="checkbox" id= "'.$domain->id .'"  name ="'.$domain->id .'" checked/>  '. $domain->name .'</td>';
                        $flag2=1;
                            break;
                        }

                    }
                            if($flag2==0)
                            {
                            echo '<td '.$color.'>'.'<input type="checkbox" id= "'.$domain->id .'"  name ="'.$domain->id .'"/>  '. $domain->name .'</td>';
                            }

                        //echo '<td '.$color.'>'.$selectR.$optionR.'</td>';
                        //echo '<td '.$color.'>'.$selectT.$optionT.'</td>';
                        echo '<td '.$color.'style="white-space:nowrap;>'.$selectS.$optionS.'<div></td>';
                        echo '</tr>';
                    }

                    ?>


                </table>
                </body>



            </div>
            <?php /*
            <select  name="subdomain" multiple="multiple" size="5" style="width: auto">



                <?php
                foreach ($domains as $domain)
                {

                    echo '<optgroup type ="checkbox "label="'.$domain->name.'">';

                    $sdnames = Subdomain::model()->findAllBySql("select * from subdomain where domain_id = $domain->id");
                    foreach($sdnames as $sub)
                    {

                        echo '<option name=" '.$sub->id .'">'.$sub->name.'</option>';
                    }
                    echo '</optgroup>';

                }


                ?>

            </select> */?>

        </div>

        <div  class="my-box-container7" style="width: 200px;height: auto; float:right">
            <h3>Max Tickets</h3>
            <br>
            <h4>Select max tickets for mentor:</h4>
            <br>

            <h5 style="margin: auto">Max tickets</h5>
            <select name="dmmaxtickets" style=" width: 80px">
                <?php for ($i=0;$i<=20;$i++)
                {
                    if($myDomainMentor!=null)
                    {
                        if($myDomainMentor->max_tickets == $i)
                        {
                            echo '<option name="'.$i.'" selected>'.$i.'</option>';
                        } else
                        {
                            echo '<option name="'.$i.'">'.$i.'</option>';

                        }
                    }else
                    {
                        echo '<option name="'.$i.'" >'.$i.'</option>';


                    }
                }

                ?>
            </select>
        </div>





    </div>

<?php }?>

<?php
if($model->isPerMentor==1)
{

    ?>
    <div id="confirmation" class="step">
        <h3><span class="font_normal_07em_black">Role: Personal Mentor</span></h3><br />
        <div  class="my-box-container7" style="width: auto; float:left;">
            <h3>Current Senior Project Mentees</h3>
            <br>
            <h4>Select mentees for this personal mentor:</h4>
            <br>
            <?php
            $mentees = Mentee::model()->findAllBySql("select * from mentee where personal_mentor_user_id in ($def->id, $model->id) or  personal_mentor_user_id is null");
            $myPerMentor = PersonalMentor::model()->findByPk($model->id);
            $myMentees = Mentee::model()->findAllBySql("select * from mentee where personal_mentor_user_id = $model->id");
            ?>
            <div name ="pmmentees" class="container" style="border:2px solid #ccc; width:auto; height: 300px; overflow-y: scroll;">


                <table style="width: 330px">

                    <?php
                    $i = 0;
                    foreach ($mentees as $mentee)
                    {

                        //if($aMentee->personal_mentor_user_id!=null)



                        $projectdesc = 'No Project selected';
                            $projMentor='';
                            $title = 'No project chosen';
                            $pmName='No mentor assigned';
                        $res ='No mentees for this project';

                        if( $mentee->project_id!=null)
                            {

                                $menteeProj = Project::model()->findBySql("select * from project where id = $mentee->project_id");
                                $projMentor = User::model()->findByPk($menteeProj->project_mentor_user_id);
                                $title = $menteeProj->title;
                                $projectdesc = $menteeProj->description;
                                $mycustomer = User::model()->findBySql("select * from user where id = $menteeProj->propose_by_user_id");
                                $pmName=ucfirst($projMentor->fname).' '.ucfirst($projMentor->fname);

                                $mymenids = Mentee::model()->findAllBySql("select * from mentee where project_id =$menteeProj->id ");
                                if($mymenids!=null)
                                {
                                    $res = '';

                                    foreach($mymenids as $m)
                                    {

                                        $pid = $m->user_id;

                                        $t = User::model()->findBySql("select * from user where id = $pid");
                                        $pjm = User::model()->findBySql("select * from user where id = $project->project_mentor_user_id");
                                        $perm = User::model()->findBySql("select * from user where id = $m->personal_mentor_user_id");

                                        $PJMname = $pjm->fname.' '.$pjm->lname;


                                        $PERMname = $perm->fname.' '.$perm->lname;

                                        $CUSName = $customer->fname.' '.$customer->lname;

                                        $res .=$t->fname.' '.$t->lname.'/'.$PJMname. '/'.$PERMname.'<br>';


                                    }
                                }



                            }



                            echo '<div id="inside-mpop-'. $mentee->user_id.'" style="display: none;">
                           <p>
                           <h4>'.$title.'</h4>'.'
                           <h5>Hours Req: X</h5>'.
                                '<h5>Customer Name: '.$mycustomer.'</h5>'.
                                $projectdesc.
                                '<h5>Member/Project Mentor/Personal Mentor:</h5>'.
                                $res.'
                           </p></div>';

                            $color = '';
                            if ($i++ % 2)
                            {
                                $color = 'style="background: #e8edff;padding: 12px;"';
                            } else
                            {
                                $color = 'style="padding: 12px;"';
                            }
                            echo'<tr><td   '.$color.'  >';
                            echo '<a href="#test" id="mpop-'.$mentee->user_id.'" class="mpop" >';
                        $menteeUser = User::model()->findByPk($mentee->user_id);
                        $flag =0;
                            foreach($myMentees as $myMentee)
                            {
                                if($myMentee->user_id == $mentee->user_id)
                                {
                                    $flag=1;
                                echo '<input style="vertical-align: middle; margin-top: -1px;" type="checkbox" name = "'.$mentee->user_id.'pm" checked/>  '. ucfirst($menteeUser->fname) ." " . ucfirst($menteeUser->lname).'<br /><br>';
                                break;
                                }
                            }
                        if($flag==0)
                        {

                            echo '<input style="vertical-align: middle; margin-top: -1px;" type="checkbox" name = "'.$mentee->user_id.'pm"/>  '. ucfirst($menteeUser->fname) ." " . ucfirst($menteeUser->lname).'<br /><br>';
                        }
                        echo '</td></a></tr>';
                        }


                    ?>

                </table>
            </div>

        </div>
        <script>
            $('.mpop').popover({
                placement: 'right',
                trigger: 'hover',
                html: true,
                content: function () {
                    return $("#inside-" + $(this).attr('id')).html();
                }
            });
        </script>

        <div class="my-box-container7" style="width: auto; float:right">

            <h3>Availability</h3>
            <br>
            <h4>Select how many hours are required:</h4>
            <br>
            <div class="container" style="border:2px solid #ccc; width:auto; height: 300px;padding:0 3cm;background: #e8edff">

                <br>
                <h5 style="text-align:center">Max hours</h5>
                <select name="pmhours" style="width: 100px">
                    <?php for ($i=0;$i<=24;$i++)
                    {

                        if($myPerMentor!=null)
                        {
                            if($myPerMentor->max_hours == $i)
                            {
                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                            }
                            else
                            {
                                echo '<option name="'.$i.'">'.$i.'</option>';

                            }
                        } else
                        {

                        echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                    }

                    ?>
                </select>



            </div>



        </div>
        <?php
        /*
        ?>
        <span class="font_normal_07em_black">Last step - Username</span><br />
        <label for="username">User name</label><br />
        <input class="input_field_12em" name="username" id="username" /><br />
        <label for="password">Password</label><br />
        <input class="input_field_12em" name="password" id="password" type="password" /><br />
        <label for="retypePassword">Retype password</label><br />
        <input class="input_field_12em" name="retypePassword" id="retypePassword" type="password" /><br />
        */
        ?>

    </div>
<?php }?>



</div>

<div id="demoNavigation">
    <input class="btn btn-primary" id="back" value="Back" type="reset" />
    <input class="btn btn-primary" name="updateRoles" id="next" value="Next" type="submit" />
</div>


</form>
<hr />

</div>

<script type="text/javascript" src="/coplat/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/coplat/js/jquery.form.js"></script>
<script type="text/javascript" src="/coplat/js/jquery.validate.js"></script>
<script type="text/javascript" src="/coplat/js/bbq.js"></script>
<script type="text/javascript" src="/coplat/js/jquery-ui-1.8.5.custom.min.js"></script>
<script type="text/javascript" src="/coplat/js/jquery.form.wizard.js"></script>




<script type="text/javascript">



    $(function(){
        $("#demoForm").formwizard({
                validationEnabled: true,
                focusFirstInput : true,
                disableUIStyles : true,
                inAnimation : {height: 'show'},
                outAnimation: {height: 'hide'},
                inDuration : 700,
                outDuration: 700,
                easing: 'easeInOutQuint'



            }
        );
    });


</script>
</body>
<?php } else { ?>
    <?php
    $projects = Project::model()->findAllBySql("SELECT title FROM project WHERE project_mentor_user_id IS NULL");
    $userdoms = UserDomain::model()->findAllBySql("SELECT domain_id FROM user_domain WHERE user_id=$model->id");
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



<?php }?>










