<?php
$path    = '/home/fiucoplat/Maildir/cur';
$files = scandir($path);
foreach ($files as $afile)
{
 echo $afile;
}
?>
