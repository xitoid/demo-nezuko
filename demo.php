<?php
require __DIR__."/vendor/autoload.php";

$target = "agung";
$array  = array(1);

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
    
    $kata = $nezuko -> lihatKata($array);
    if($kata == $target)
    {
        $kataDitemukan = true;
        $akhirTimer    = microtime(true);
    }
    
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
    
    $itemTerakhir = count($array)-1;
    $array[$itemTerakhir]++;
    
    $panjangList = $nezuko -> jumlahList();
    for($i = count($array) - 1; $i > -1; $i-- )
    {
        if($array[$i] > $panjangList)
        {
            if(array_key_exists($i - 1, $array))
            {
                $array[$i - 1]++;
                $array[$i] = 1;
            } else {
                $tambahMatrik = true;
            }
        }
    }
    if($tambahMatrik == true)
    {
        $array= $nezuko -> tambahResetItem($array);
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
