<?php

 $cmd = 'firebase.auth:import file.json --hash-algo=scrypt --rounds=8 --mem-cost=14';
//echo exec('firebase login');
/* while (@ ob_end_flush()); // end all output buffers if any

$proc = popen($cmd, 'r');
echo '<pre>';
while (!feof($proc))
{
    echo fread($proc, 4096);
    @ flush();
}
echo '</pre>';
 */
 
echo '<pre>';
 passthru($cmd);
echo '</pre>'; 
?>