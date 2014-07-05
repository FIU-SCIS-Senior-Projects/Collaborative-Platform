
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

    <script>

        function load()
        {
            <?php
              $alldm = Domain::model()->findAll();
              foreach($alldm as $one)
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
        $all = Domain::model()->findAll();
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
    <style type="text/css">
        #demoWrapper {
            padding : 1em;
            width : auto;
            border-style: solid;
            height: auto;
            overflow:hidden;

        }

        #fieldWrapper
        {
            height: auto;
            width: auto;
            overflow:hidden;

        }

        #demoNavigation {
            margin-top : 0.5em;
            margin-right : 1em;
            text-align: right;
        }

        #data {
            font-size : 0.7em;
        }

        input {
            margin-right: 0.1em;
            margin-bottom: 0.5em;
        }

        .input_field_25em {
            width: 2.5em;
        }

        .input_field_3em {
            width: 3em;
        }

        .input_field_35em {
            width: 3.5em;
        }

        .input_field_12em {
            width: 12em;
        }

        label {
            margin-bottom: 0.2em;
            font-weight: bold;
            font-size: 0.8em;
        }

        label.error {
            color: red;
            font-size: 0.8em;
            margin-left : 0.5em;
        }

        .step span {
            float: right;
            font-weight: bold;
            padding-right: 0.8em;
        }

        .navigation_button {
            width : 70px;
        }

        #data {
            overflow : auto;
        }

        };





    </style>

</head>
<body >
<div id="demoWrapper" class="my-box-container3">
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
        <div  class="my-box-container3" style="width: auto; float:left;">
            <h3>Current Senior Projects</h3>
            <br>
            <h4>Select the projects for this project mentor:</h4>
            <br>

            <?php

            $projects = Project::model()->findAll();

            ?>
            <div name ="pjmprojects" class="container" style="border:2px solid #ccc; width:auto; height: 300px; overflow-y: scroll;">

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
                                $res .=$t->fname.' '.$t->lname.'<br>';


                            }
                        }
                        /*popover div*/
                        echo '<div id="content-myPopOver-'. $project->id.'" style="display: none;">
                           <p>
                           <h4>
                           '.$project->title.'
                           </h4>'.'<h5>Hours Req: X</h5>'.$project->description.'
                            <h5>Mentees:</h5>'.
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

                        echo '<input style="vertical-align: middle; margin-top: -1px;"  type="checkbox" name ="'.$project->id .'"/>  '. $project->title .'<br>';
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

        <div class="my-box-container3" style="width: auto; float:right">

            <h3>Availability</h3>
            <br>
            <h4>Select how many hours are required:</h4>
            <br>

            <div class="container" style="border:2px solid #ccc; width:auto; height: 300px;padding:0 3cm;background: #e8edff">
                <br>
                <h5 style="text-align:center" >Max hours</h5>
                <select  name="pjmhours" style="width: 100px;">
                    <?php for ($i=1;$i<=24;$i++)
                    {
                        echo '<option name="'.$i.'">'.$i.'</option>';
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
        <div  class="my-box-container3" style="width: auto; float:left;">
            <h3>Current Domains</h3>
            <br>
            <h4>Select domains:</h4>
            <br>



            <div name ="domain" class="container" style="border:2px solid #ccc; width:auto; height: 400px;margin: auto;overflow-y: scroll">

                <body onload="load()">

                <table  style="width:auto;">
                    <tr>
                        <th>Domain</th>
                        <th>Rate</th>
                        <th>Tier</th>
                        <th>Subdomain</th>
                    </tr>
                    <?php
                    $domains = Domain::model()->findAll();



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
                    foreach ($domains as $domain)
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


                        $selectR ='<select  id = "'.$domain->id.'dmrate" name="'.$domain->id.'dmrate" style="width: 50px";>';


                        $selectT = '<select id = "'.$domain->id.'dmtier" name="'.$domain->id.'dmtier" style="width: 50px;" >';

                        $selectS ='<div border:1px id = "'.$domain->id.'dmsub" name="'.$domain->id.'dmsub" style="width: 150px;height:100px;overflow-y: scroll;'.$sdcolor.'">';

                        $curPSubdomains = Subdomain::model()->findAllBySql("select * from subdomain where domain_id = $domain->id");
                        /*subdomains*/
                        $optionS='';
                        foreach($curPSubdomains as $subdomain)
                        {
                            $optionS.='<input style="vertical-align: middle; margin-top: -1px;"  type="checkbox" name ="'.$subdomain->id .'ddmsub"/>  '. $subdomain->name .'<br>';
                        }
                        $optionS.='</div>';


                        echo'<tr>';
                        echo '<td '.$color.'>'.'<input type="checkbox" id= "'.$domain->id .'"  name ="'.$domain->id .'"/>  '. $domain->name .'</td>';
                        echo '<td '.$color.'>'.$selectR.$optionR.'</td>';
                        echo '<td '.$color.'>'.$selectT.$optionT.'</td>';
                        echo '<td>'.$selectS.$optionS.'</td>';
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

        <div  class="my-box-container3" style="width: 200px;height: auto; float:right">
            <h3>Max Tickets</h3>
            <br>
            <h4>Select max tickets for mentor:</h4>
            <br>
            <h5 style="margin: auto">Max tickets</h5>
            <select name="dmmaxtickets" style=" width: 80px">
                <?php for ($i=1;$i<=20;$i++)
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
<div id="confirmation" class="step">
    <h3><span class="font_normal_07em_black">Role: Personal Mentor</span></h3><br />
    <div  class="my-box-container3" style="width: auto; float:left;">
        <h3>Current Senior Project Mentees</h3>
        <br>
        <h4>Select mentees for this personal mentor:</h4>
        <br>
        <?php  $mentees = User::model()->findAllBySql("select * from user where isMentee=1");?>
        <div name ="pmmentees" class="container" style="border:2px solid #ccc; width:auto; height: 300px; overflow-y: scroll;">


            <table style="width: 330px">

                <?php
                $i = 0;
                foreach ($mentees as $mentee)
                {


                    $menteeProj='';
                    $projMentor='';
                    $title = 'No project chosen';
                    $pmName='No mentor assigned';
                    $aMentee = Mentee::model()->findBySql("select * from mentee where user_id = $mentee->id");
                    if($aMentee->project_id!=null)
                    {
                        $menteeProj = Project::model()->findBySql("select * from project where id = $aMentee->project_id");
                        $projMentor = User::model()->findByPk($menteeProj->project_mentor_user_id);
                        $title = $menteeProj->title;
                        $pmName=ucfirst($projMentor->fname).' '.ucfirst($projMentor->fname);
                    }

                    echo '<div id="inside-mpop-'. $mentee->id.'" style="display: none;">
                           <p>
                           <h4>Project: </h4>'.$title.'
                            <h4>Project Mentor:</h4>'. $pmName.'
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
                    echo '<a href="#test" id="mpop-'.$mentee->id.'" class="mpop" >';
                    echo '<input style="vertical-align: middle; margin-top: -1px;" type="checkbox" name = "'.$mentee->id.'"/>  '. ucfirst($mentee->fname) ." " . ucfirst($mentee->lname).'<br /><br>';
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

    <div class="my-box-container3" style="width: auto; float:right">

        <h3>Availability</h3>
        <br>
        <h4>Select how many hours are required:</h4>
        <br>
        <div class="container" style="border:2px solid #ccc; width:auto; height: 300px;padding:0 3cm;background: #e8edff">

            <br>
            <h5 style="text-align:center">Max hours</h5>
            <select name="pmhours" style="width: 100px">
            <?php for ($i=1;$i<=24;$i++)
            {
                echo '<option value="'.$i.'">'.$i.'</option>';
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
</html>


