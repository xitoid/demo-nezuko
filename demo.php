<?php
require __DIR__."/vendor/autoload.php";

$target = "agung";

$nezuko = new Nezuko\GenerateKata();

echo "Sedang mencari\n";
echo "     • • • \r";
$awalTimer     = microtime(true);
$jumlahKata    = 0;
$kataDitemukan = false;
$load          = 1;

while($kataDitemukan != true)
{
    $jumlahKata++;
    $tambahMatrik = false;
    
    $kata = $nezuko -> lihatKata();
    if($kata == $target)
    {
        $kataDitemukan = true;
        $akhirTimer    = microtime(true);
    }
    
    $nezuko -> tambahItemAkhir();
    
    if(($jumlahKata % 10000) == 0 )
    {
        $load++;
        if(($load % 2) == 0)
        {
            echo "      ••• \r";
        } else {
            echo "     • • • \r";
        }
    }
}

echo "     •\r";     usleep(500000);
echo "       •\r";   usleep(500000);
echo "         •\r"; usleep(200000);
echo "       •\r";   usleep(100000);
echo "     •\r";     usleep( 50000);
echo "   •\r";       usleep( 50000);
echo "•\r";          usleep(100000);

echo "\033[0m=== Kata yg dicek  : ".number_format($jumlahKata, 0, ",", ".");
echo "\n=== Kata ditemukan : ".$kata." (";
        
$waktuDiperlukan = $akhirTimer-$awalTimer;
$waktu  = round($waktuDiperlukan);
$jam    = floor($waktu / 36000);
$menit  = (floor($waktu / 60))%60;
$second = $waktu % 60;

if($jam != 0)
{
    echo $jam."h ";
}
if($menit != 0)
{
    echo $menit."m ";
}
if($second != 0)
{
    echo $second."s";
} else {
    echo "";
}
if($jam == 0 && $menit == 0 && $second < 1)
{
    echo "<1s";
}
echo ")\n";
