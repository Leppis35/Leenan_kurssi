<?php  
if(isset($_GET["ktunnus"])) $ktunnus=$_GET["ktunnus"];  

$host ="magnesium";  
$user = "16amikol";  
$pass = "salasana";  
$dbname = "db16amikol";  

try  //yritetään ottaa yhteys  
{   
    $yhteys = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass); //luo PDO-olion  
}   
catch(PDOException $e) // jos ei onnistu (poikkeus)  
{   
    echo $e->getMessage(); //antaa ilmoituksen siitä, missä virhe  
}  

$sql = "SELECT * FROM tuotteet WHERE Ryhma ='$ktunnus' ";  
$vastaus = $yhteys->prepare($sql);  
$vastaus->execute();  
$vastaukset = $vastaus->fetchAll(PDO::FETCH_ASSOC);  

echo json_encode($vastaukset);
?>  
