<?php
session_start(); 
$pasta        = $_SESSION["s_pasta"]; 
$sub_pasta    = $_SESSION["s_sub_pasta"]; 
$nome_inicial = $_SESSION["s_nome_inicial"]."_";

$diretorio = "../".$pasta."/".$sub_pasta;	
$contents = scandir($diretorio);
$total_arquivos_pasta = count($contents);

$remove  = $_REQUEST['remove'];
//print_r($remove);
//die;
$file = "../$pasta/$sub_pasta/$remove";
if ($pasta == "produtos"){
   if (unlink($file)) {   
   echo "O arquivo $file foi excluído\n";
   }else {
   echo "não foi possível excluir $file\n";
}
	
	$tmp_w_ = date("YmdHi");
	for ($_i=1; $_i<=$total_arquivos_pasta; $_i++){
		$old_file = "../$pasta/$sub_pasta/$nome_inicial".$_i.".jpg";  
		//$j = $_i+1;
		$new_file = "../$pasta/$sub_pasta/$tmp_w_".$_i.".jpg";
		@rename($old_file, $new_file);
	}
	
	for ($_i=1; $_i<=$total_arquivos_pasta; $_i++){
		$old_file = "../$pasta/$sub_pasta/$nome_inicial".$_i.".jpg";  
		//$j = $_i+1;
		$new_file = "../$pasta/$sub_pasta/$tmp_w_".$_i.".jpg";
		@rename($old_file, $new_file);
	}
		
	$contents = scandir($diretorio);
	$totala = count($contents);
	for($x=0; $x<$totala; $x++){
		$nome_tmp = $contents[$x];
		$_i = $x + 1;
		$old_file = $nome_tmp;  
		//$j = $_i+1;
		$new_file = "../$pasta/$sub_pasta/$nome_inicial".$_i.".jpg";
		@rename($old_file, $new_file);
	}
	}  else{
 
//tenta excluir $file
if (unlink($file)) {
   //echo "O arquivo '".$_REQUEST["remove"]."' foi excluído\n";
} 
   //echo "não foi possível excluir '".$_REQUEST["remove"]."'\n";

}
	header("Location: envia_arquivo.php");
?>

<?php
exit;

?>