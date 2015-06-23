<?php
$path    = '/home/fiucoplat/Maildir/cur';
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
