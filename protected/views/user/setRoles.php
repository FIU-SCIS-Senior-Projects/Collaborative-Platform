
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
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

        }
    </style>

</head>
<body>
<div id="demoWrapper" class="my-box-container3">
<h3>Registration form for <?php echo $model->fname.' '.$model->lname ?></h3>
<ul>
</ul>
<hr />
<h5 id="status"></h5>
<form id="demoForm" method="post" action="json.html" class="bbq">
<div id="fieldWrapper">


<?php
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
            <?php  $projects = Project::model()->findAll();?>
            <div class="container" style="border:2px solid #ccc; width:auto; height: 300px; overflow-y: scroll;">


                <?php foreach ($projects as $project)
                {

                    echo '<input type="checkbox" />' . $project->title .'<br /><br>';

                }

                ?>


            </div>

        </div>

        <div class="my-box-container3" style="width: auto; float:right">

            <h3>Availability</h3>
            <br>
            <h4>Select how many hours are required:</h4>
            <br>
            <div class="container" style="border:2px solid #ccc; width:auto; height: 300px;">
                <br>
                <h5 style="margin: auto">Max hours</h5>
                <select name="mydropdown" style="position: absolute;">
                    <?php for ($i=1;$i<=24;$i++)
                    {
                        echo '<option value="'.$i.'">'.$i.'</option>';
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


        <h3><span class="font_normal_07em_black">Role: Domain Mentor</span></h3><br />
        <div class="my-box-container3" style="width: auto; float:left;">
            <h3>Current Domains</h3>
            <br>
            <h4>Select domains/subdomains:</h4>
            <br>
            <?php
            $domains = Domain::model()->findAll();
            $subdomains = Subdomain::model()->findAll();

            ?>


            <div class="container" style="border:2px solid #ccc; width:auto; height: 100px; overflow-y: scroll;">


                <?php foreach ($domains as $domain)
                {

                    echo '<input type="checkbox" />' . $domain->name .'<br /><br>';

                }

                ?>


            </div>
            <br><br>

            <select  name="domain" multiple="multiple" size="5" style="width: auto">



                <?php
                foreach ($domains as $domain)
                {

                    echo '<optgroup type ="checkbox "label="'.$domain->name.'">';

                    $sdnames = Subdomain::model()->findAllBySql("select * from subdomain where domain_id = $domain->id");
                    foreach($sdnames as $sub)
                    {

                        echo '<option value=" '.$sub->id .'">'.$sub->name.'</option>';
                    }
                    echo '</optgroup>';

                }


                ?>

            </select>


        </div>



        <div class="my-box-container3" style="width: auto; float:right">

            <h3>Rating and Tier</h3>
            <br>
            <h4>Rate mentor, select tier team, and max tickets:</h4>
            <br>
            <div  class="container" style="width:auto; height: 300px;margin-left: auto ;margin-right: auto ;">
                <br>
                <h5 style="margin: auto">Rate mentor</h5>
                <select name="mydropdown" style="position: absolute;">
                    <?php for ($i=1;$i<=10;$i++)
                    {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }

                    ?>
                </select>
                <br><br><br>
                <h5 style="margin: auto">Tier Team</h5>
                <select name="mydropdown" style="position: absolute;">
                    <?php for ($i=1;$i<=2;$i++)
                    {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }

                    ?>
                </select>

                <br><br><br>
                <h5 style="margin: auto">Max Tickets</h5>
                <select name="mydropdown" style="position: absolute;">
                    <?php for ($i=1;$i<=20;$i++)
                    {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }

                    ?>
                </select>


            </div>

            <?php
            /*

            <span class="font_normal_07em_black">Step 2 - Personal information</span><br />
            <label for="day_fi">Social Security Number</label><br />
            <input class="input_field_25em" name="day" id="day_fi" value="DD" />
            <input class="input_field_25em" name="month" id="month_fi" value="MM" />
            <input class="input_field_3em" name="year" id="year_fi" value="YYYY" /> -
            <input class="input_field_3em" name="lastFour" id="lastFour_fi" value="XXXX" /><br />
            <label for="countryPrefix_fi">Phone number</label><br />
            <input class="input_field_35em" name="countryPrefix" id="countryPrefix_fi" value="+358" /> -
            <input class="input_field_3em" name="areaCode" id="areaCode_fi" /> -
            <input class="input_field_12em" name="phoneNumber" id="phoneNumber_fi" /><br />
            <label for="email">*Email</label><br />
            <input class="input_field_12em email required" name="myemail" id="myemail" /><br />
            */
            ?>
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
            <h4>Selec mentees for this personal mentor:</h4>
            <br>
            <?php  $mentees = User::model()->findAllBySql("select * from user where isMentee=1");?>
            <div class="container" style="border:2px solid #ccc; width:auto; height: 300px; overflow-y: scroll;">


                <?php foreach ($mentees as $mentee)
                {
                    echo '<input type="checkbox" />' .  ucfirst($mentee->fname) ." " . ucfirst($mentee->lname).'<br /><br>';

                }

                ?>


            </div>

        </div>

        <div class="my-box-container3" style="width: auto; float:right">

            <h3>Availability</h3>
            <br>
            <h4>Select how many hours are required:</h4>
            <br>
            <div class="container" style="border:2px solid #ccc; width:auto; height: 300px; overflow-y: scroll;">

                <br>
                <h5 style="margin: auto">Max hours</h5>
                <select name="mydropdown" style="position: absolute;">
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
    <input class="btn btn-primary" id="next" value="Next" type="submit" />
</div>

</form>
<hr />

<p id="data"></p>
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
                formPluginEnabled: true,
                validationEnabled: true,
                focusFirstInput : true,
                formOptions :{
                    success: function(data){$("#status").fadeTo(500,1,function(){ $(this).html("You are now registered!").fadeTo(5000, 0); })},
                    beforeSubmit: function(data){$("#data").html("data sent to the server: " + $.param(data));},
                    dataType: 'json',
                    resetForm: true
                },
                disableUIStyles : true
            }
        );
    });
</script>
</body>
</html>
