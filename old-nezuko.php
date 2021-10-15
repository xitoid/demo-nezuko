<?php
class nezuko
{
    private static function getList()
    {
        $number   = range(0,9);
        $alphabet = range('A', 'z');
        
        return range('a', 'z');
        return array_merge($number, $alphabet);
    }
    
    private static function getChar($position)
    {
        $char     = self::getList();
        $pos = $position - 1;
        
        if($pos < count($char))
        {
            return $char[$pos];
        } else {
            return "";
        }
    }
    
    public static function getLength()
    {
        return count(self::getList());
    }
    
    public static function getWord($array)
    {
        $word = "";
        
        for($i = 0; $i < count($array); $i++)
        {
            $word .= self::getChar($array[$i]);
        }
        
        return $word;
    }
    
    public static function addResetItem($array)
    {
        return array_fill(0, (count($array) + 1), 1);
    }
}
function back($num)
{
    for($i = 0; $i < $num; $i++)
    {
        system("echo -e '\b'");
    }
}
//// CLIENT USAGE////
$target = "agung";
$array  = array(1);

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
    
    $kata = nezuko::getWord($array);
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
    
    $panjangList = nezuko::getLength();
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
        $array= nezuko::addResetItem($array);
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