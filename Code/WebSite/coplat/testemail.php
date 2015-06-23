<?php
function establishConnection()
{
    $hostname = '{localhost/Maildir:143}INBOX';
    $username = 'fiucoplat@gmail.com';//<script cf-hash="f9e31" type="text/javascript">
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
    while($line = fgets($file))
    {
        echo $line;
    }
}
?>
