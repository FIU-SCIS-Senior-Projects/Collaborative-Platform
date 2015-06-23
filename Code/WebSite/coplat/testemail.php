<?php
$path    = '/home/mmach059/Maildir/new';
$files = scandir($path);
foreach ($files as $afile)
{
 $file = fopen($path."/".$afile,"r");
    while($line = fgets($file) !== false)
    {
        echo $line;
    }
}
?>
