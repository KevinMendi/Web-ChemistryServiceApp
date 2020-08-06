if(isset($_GET['read']))
{
    $uid = $_GET['read'];

    $ch = new Chempo();

    $result = $ch->readChemicalInfo($uid);


    //////////////////
    $ghs = $ch->readGhs($uid);
$ghs1 = (int)$ghs['ghs1'];
$ghs2 = (int)$ghs['ghs2'];
$ghs3 = (int)$ghs['ghs3'];
$ghs4 = (int)$ghs['ghs4'];
$ghs5 = (int)$ghs['ghs5'];
$ghs6 = (int)$ghs['ghs6'];
$ghs7 = (int)$ghs['ghs7'];
$ghs8 = (int)$ghs['ghs8'];
$ghs9 = (int)$ghs['ghs9'];
$path1="";
$path2="";
$path3="";
$path4="";
$path5="";
$path6="";
$path7="";
$path8="";
$path9="";

if($ghs1 == 1)
{
    $path1 = "img/ghs/GHS01.jpg";
}
else
{
    $path1 = "";
}

if($ghs2 == 1)
{
    $path2 = "img/ghs/GHS02.jpg";
}
else
{
    $path2 = "";
}

if($ghs3 == 1)
{
    $path3 = "img/ghs/GHS03.jpg";
}
else
{
    $path3 = "";
}

if($ghs4 == 1)
{
    $path4 = "img/ghs/GHS04.jpg";
}
else
{
    $path4 = "";
}

if($ghs5 == 1)
{
    $path5 = "img/ghs/GHS05.jpg";
}
else
{
    $path5 = "";
}

if($ghs6 == 1)
{
    $path6 = "img/ghs/GHS06.jpg";
}
else
{
    $path6 = "";
}
if($ghs7 == 1)
{
    $path7 = "img/ghs/GHS07.jpg";
}
else
{
   $path7 = ""; 
}
if($ghs8 == 1)
{
    $path8 = "img/ghs/GHS08.jpg";
}
else
{
    $path8 = "";
}
if($ghs9 == 1)
{
    $path9 = "img/ghs/GHS09.jpg";
}
else
{
    $path9 = "";
}

$ghsLabel = array($path1, $path2, $path3, $path4, $path5, $path6, $path7, $path8, $path9);

}

