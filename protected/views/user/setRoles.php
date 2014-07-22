<?php
//global variables

$all = Domain::model()->findAll();
$def = User::model()->findBySql("select * from user where username = 'DEFAULT'");//default user


?>
<head>

    <script>

        function load()
        {
            <?php
              foreach($all as $one)
              {
              print('document.getElementById("'.$one->id.'dmrate").disabled=true;');
              print('document.getElementById("'.$one->id.'dmtier").disabled=true;');
               //print( '$("#'.$one->id.'dmsub").find("*").prop("disabled", true);');
              print('
              var nodes = document.getElementById("'.$one->id.'dmsub").getElementsByTagName(\'*\');
            for(var i = 0; i < nodes.length; i++)
            {
            nodes[i].disabled = true;
            }');

              }

            ?>

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
                    document.getElementById("'.$dm->id.'dmrate").disabled=false;
                    document.getElementById("'.$dm->id.'dmtier").disabled=false;
                    var nodes = document.getElementById("'.$dm->id.'dmsub").getElementsByTagName(\'*\');
                    for(var i = 0; i < nodes.length; i++)
                    {
                    nodes[i].disabled = false;
                    }


                } else
                {
                    document.getElementById("'.$dm->id.'dmrate").disabled=true;
                    document.getElementById("'.$dm->id.'dmtier").disabled=true;
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
<form id="demoForm"   name ="demoForm" method="post"  class="bbq">
<div id="fieldWrapper">

<?php
setcookie('UserID',$model->id);
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

            $projects = Project::model()->findAllBySql("select * from project where project_mentor_user_id = $def->id");

            ?>
            <div  name ="pjmprojects" class="container" style="border:2px solid #ccc; width:auto; height: 300px; overflow-y: scroll;background-color:white">

                <table>

                    <?php
                    $i=0;
                    foreach ($projects as $project)
                    {
                        $mymenids = Mentee::model()->findAllBySql("select * from mentee where project_id =$project->id ");
                        $res ='No mentees for this project';
                        $customer = Project::model()->findBySql("select * from project where id = $project->id");
                        $CUSName='No customer';
                        if($customer!=null)
                        {
                            $CUSName = $customer->customer_fname.' '.$customer->customer_lname;
                        }
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


                                $res .=$t->fname.' '.$t->lname.'/'.$PJMname. '/'.$PERMname.'<br>';


                            }
                        }
                        /*popover div*/
                        echo '<div id="content-myPopOver-'. $project->id.'" style="display: none;">
                           <p>
                           <h4>'.$project->title.'</h4>'.'
                           <h5>Hours Req: X</h5>'.
                            '<h5>Customer Name:'.$CUSName.'</h5>'.
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

                        echo '<input style="vertical-align: middle; margin-top: -1px;"  type="checkbox" name ="'.$project->id .'pjm"/>  '. $project->title .'<br>';
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
                        echo '<option name="'.$i.'">'.$i.'</option>';
                    }

                    ?>
                </select>


            </div>



        </div>


    </div>
<?php }?>


<?php
if($model->isDomMentor==1)
{
    ?>



    <div id="second" class="step">

        <?php //stop here?>
        <h3><span class="font_normal_07em_black">Role: Domain Mentor</span></h3><br />
        <div  class="my-box-container7" style="width: auto; float:left;">
            <h3>Current Domains</h3>
            <br>
            <h4>Select domains:</h4>
            <br>



            <div name ="domain" class="container" style="border:2px solid #ccc; width:auto; height: 400px;margin: auto;overflow-y: scroll">

                <body onload="load()">

                <table  style="width:auto;">
                    <tr>
                        <th>Domain</th>
                        <th>Subdomain (Rating / Tier)</th>
                    </tr>
                    <?php



                    $optionR='';
                    $optionT='';
                    /*rate numbers*/
                    for ($i=1;$i<=10;$i++)
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




                        $selectS ='<div border:1px id = "'.$domain->id.'dmsub" name="'.$domain->id.'dmsub" style="width: 150px;height:100px;overflow-y: scroll;'.$sdcolor.'">';

                        $curPSubdomains = Subdomain::model()->findAllBySql("select * from subdomain where domain_id = $domain->id");
                        /*subdomains*/
                        $optionS='';

                        foreach($curPSubdomains as $subdomain)
                        {
                            $allsubs = UserDomain::model()->findAllBySql("select * from user_domain where subdomain_id = $subdomain->id");

                            $allsubMentors = 'No mentor for this sub-domain';
                            if($allsubs!=null)
                            {
                                $allsubMentors='';
                                foreach($allsubs as $sub)
                                {
                                    $us = User::model()->findByPk($sub->user_id);
                                    $allsubMentors.= $us->fname.' '.$us->lname.'<br>' ;
                                }
                            }
                            echo '<div id="subs-mpppover-'. $subdomain->id.'" style="display: none;">
                                <h3>Current Sub-Domain Mentors</h3>
                                <p>
                                '.$allsubMentors.'
                                </p>
                                </div>';

                            //$optionS.='<a href="#test" id="mpppover-'.$subdomain->id.'" class="mpppover" >'.
                                $optionS.='<a href="#test" id="mpppover-'.$subdomain->id.'" class="mpppover" ><input style="vertical-align: middle; margin-top: -1px;"  type="checkbox" name ="'.$subdomain->id .'ddmsub"/>  '. $subdomain->name .'</a>';
                            $selectR ='<select  id = "'.$subdomain->id.'dmrate" name="'.$domain->id.'-'.$subdomain->id.'dmrate" style="width: 50px";>';
                            $selectR.=$optionR;
                            $optionS.= '  '.$selectR;

                            $selectT = '<select id = "'.$subdomain->id.'dmtier" name="'.$domain->id.'-'.$subdomain->id.'dmtier" style="width: 50px;" >';
                            $selectT.=$optionT;
                            $optionS.='  '.$selectT.'<br>';

                        }
                        $optionS.='</div>';


                        echo'<tr>';
                        echo '<td '.$color.'>'.'<input type="checkbox" id= "'.$domain->id .'"  name ="'.$domain->id .'"/>  '. $domain->name .'</td>';

                        echo '<td '.$color.'style="white-space:nowrap;>'.$selectS.$optionS.'</td>';
                        echo '</tr>';
                    }
                    ?>


                </table>
                </body>



            </div>


        </div>
        <script>

            $('.mpppover').popover({
                placement: 'right',
                trigger: 'hover',
                html: true,
                content: function () {
                    return $("#subs-" + $(this).attr('id')).html();
                }
            });
        </script>

        <div  class="my-box-container7" style="width: 200px;height: auto; float:right">
            <h3>Max Tickets</h3>
            <br>
            <h4>Select max tickets for mentor:</h4>
            <br>
            <h5 style="margin: auto">Max tickets</h5>
            <select name="dmmaxtickets" style=" width: 80px">
                <?php for ($i=0;$i<=20;$i++)
                {
                    echo '<option name="'.$i.'">'.$i.'</option>';
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
    <div id="third" class="step">
        <h3><span class="font_normal_07em_black">Role: Personal Mentor</span></h3><br />
        <div  class="my-box-container7" style="width: auto; float:left;">
            <h3>Current Senior Project Mentees</h3>
            <br>
            <h4>Select mentees for this personal mentor:</h4>
            <br>
            <?php

            $mentees = Mentee::model()->findAllBySql("select * from mentee where personal_mentor_user_id =$def->id or personal_mentor_user_id is null ");

            ?>
            <div name ="pmmentees" class="container" style="border:2px solid #ccc; width:auto; height: 300px; overflow-y: scroll;">


                <table style="width: 330px">

                    <?php
                    $i = 0;
                    foreach ($mentees as $mentee)
                    {



                        $projectdesc = 'No Project selected';
                        $projMentor='';
                        $title = 'No project chosen';
                        $pmName='No mentor assigned';
                        $res ='No mentees for this project';
                        $menteeUser = User::model()->findByPk($mentee->user_id);
                        $CUSNamee = 'No customer';

                        if( $mentee->project_id!=null)
                        {

                            $menteeProj = Project::model()->findBySql("select * from project where id = $mentee->project_id");
                            $projMentor = User::model()->findByPk($menteeProj->project_mentor_user_id);
                            $title = $menteeProj->title;
                            $projectdesc = $menteeProj->description;
                            $mycustomer=null;

                            if($projMentor->username == 'DEFAULT')
                            {
                                $mycustomer = Project::model()->findBySql("select * from project where id = $menteeProj->id");

                            }

                            if($mycustomer!=null)
                            {
                                $CUSName = $mycustomer->customer_fname.' '.$mycustomer->customer_lname;
                            }
                            $pmName=ucfirst($projMentor->fname).' '.ucfirst($projMentor->fname);

                            $mymenids = Mentee::model()->findAllBySql("select * from mentee where project_id =$menteeProj->id ");
                            if($mymenids!=null)
                            {
                                $res = '';

                                foreach($mymenids as $m)
                                {

                                    $pid = $m->user_id;

                                    $t = User::model()->findBySql("select * from user where id = $pid");
                                    $projmid = Project::model()->findBySql("select * from project where id = $m->project_id");
                                    $pjm = User::model()->findBySql("select * from user where id = $projmid->project_mentor_user_id");
                                    $perm = User::model()->findBySql("select * from user where id = $m->personal_mentor_user_id");

                                    $PJMname = $pjm->fname.' '.$pjm->lname;


                                    $PERMname = $perm->fname.' '.$perm->lname;


                                    $res .=$t->fname.' '.$t->lname.'/'.$PJMname. '/'.$PERMname.'<br>';


                                }
                            }



                        }






                        echo '<div id="inside-mpop-'. $mentee->user_id.'" style="display: none;">
                           <p>
                           <h4>'.$title.'</h4>'.'
                           <h5>Hours Req: X</h5>'.
                            '<h5>Customer Name: '.$CUSNamee.'</h5>'.
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
                            echo '<input style="vertical-align: middle; margin-top: -1px;" type="checkbox" name = "'.$mentee->user_id.'pm"/>  '. ucfirst($menteeUser->fname) ." " . ucfirst($menteeUser->lname).'<br /><br>';
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
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }

                    ?>
                </select>



            </div>



        </div>


    </div>
<?php }?>



</div>

<div id="demoNavigation">
    <input class="btn btn-primary" id="back" value="Back" type="reset" />
    <input class="btn btn-primary" name="Roles" id="next" value="Next" type="submit" />
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


