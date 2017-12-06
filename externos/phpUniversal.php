<?php
//Pega as cores da paleta  de cores no banco
$sql = "select * from tbl_paletacor where status = 1";

$select = mysql_query($sql) or die(mysql_error());

if($rs = mysql_fetch_array($select)){
    $corPrimaria =  $rs['cor_primaria']; /*FRACA*/
    $corSecundaria = $rs['cor_secundaria'];
    $corTerciaria = $rs['cor_terciaria']; /*FORTE*/
    $corQuartenaria = $rs['cor_quartenaria']; /*MEDIANA*/
}else{
    $corPrimaria = "#462D19"; /*FRACA*/
    $corSecundaria = "#ffffff";
    $corTerciaria = "#553C27"; /*FORTE*/
    $corQuartenaria = "#886B53"; /*MEDIANA*/
}
?>
