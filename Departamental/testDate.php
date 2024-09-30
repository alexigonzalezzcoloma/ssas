<?php 
$firstDate  = new DateTime("2022-05-1");
$secondDate = new DateTime("2023-03-1");
$intvl = $firstDate->diff($secondDate);
$year=$intvl->y;
$months=$intvl->m;

if($year>0){
    $yearToMonths=$year*12;
    $months=$months+$yearToMonths;
}
echo $months;

?>