<?php
function establishConnection()
{
    $hostname = '{localhost/Maildir:143}INBOX';
    $username = 'fiucoplat@cp-dev.cs.fiu.edu';//<script cf-hash="f9e31" type="text/javascript">
    ///* <![CDATA[ */!function(){try{var t="currentScript"in document?document.currentScript:function(){for(var t=document.getElementsByTagName("script"),e=t.length;e--;)if(t[e].getAttribute("cf-hash"))return t[e]}();if(t&&t.previousSibling){var e,r,n,i,c=t.previousSibling,a=c.getAttribute("data-cfemail");if(a){for(e="",r=parseInt(a.substr(0,2),16),n=2;a.length-n;n+=2)i=parseInt(a.substr(n,2),16)^r,e+=String.fromCharCode(i);e=document.createTextNode(e),c.parentNode.replaceChild(e,c)}}}catch(u){}}();/* ]]> */</script>';
    $password = 'fiuadmin';
    $connection = imap_open($hostname, $username, $password);
    return $connection;
}

$path    = '/home/fiucoplat/Maildir/new';
$files = scandir($path);
foreach ($files as $afile)
{
 $file = fopen($path."/".$afile,"r");
    $from = "";
    $subject = "";
    $body = "";
    $isbody = 0;
    $fromisSet = 0;
    $subjectisSet = 0;
    while($line = fgets($file))
    {
        //echo $line . "\n\n";
        if($isbody == 1)
        {
            $body = $body . $line;
        }

            if(strstr($line,"From: ") && strstr($line,"<") && $fromisSet == 0)
            {
             //   echo $line;
                $from = $line;
                $from = substr($from, stripos($from, ":")+2);
                if(stristr($from, "<"))
                {
                    $from = substr($from, stripos($from, "<"));
                }
                $from = str_replace(array("<", ">"," ","\n","\r"),"", $from);
                $fromisSet = 1;
            }
            if(strstr($line,"Subject: ") && $subjectisSet == 0)
            {
              //  echo $line;
                $subject = $line;
                $subjectisSet =1;
            }
            if(stristr($line,"content-type: "))
            {
                $isbody = 1;
            }


    }
    echo "\n\n\nPARSED INFORMATION \n\n\nfrom:".$from."99\n";
    echo "subject: ".$subject."\n";
    echo "body: ".$body."\n";
    fclose($file);
    if(strlen($body)>5) {
        unlink($path . "/" . $afile);
    }
}
?>
