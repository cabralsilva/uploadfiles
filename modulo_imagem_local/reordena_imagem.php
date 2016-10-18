<?php	
	/************************/
	session_start(); 
	$pasta        = $_SESSION["s_pasta"];
	
	function tirarAcentosER($string){
    return preg_replace(array("/(Ã¡|Ã |Ã£|Ã¢|Ã¤)/","/(Ã|Ã€|Ãƒ|Ã‚|Ã„)/","/(Ã©|Ã¨|Ãª|Ã«)/","/(Ã‰|Ãˆ|ÃŠ|Ã‹)/","/(Ã­|Ã¬|Ã®|Ã¯)/","/(Ã|ÃŒ|ÃŽ|Ã)/","/(Ã³|Ã²|Ãµ|Ã´|Ã¶)/","/(Ã“|Ã’|Ã•|Ã”|Ã–)/","/(Ãº|Ã¹|Ã»|Ã¼)/","/(Ãš|Ã™|Ã›|Ãœ)/","/(Ã±)/","/(Ã‘)/","/(Ã§)/"),
	explode(" ","a A e E i I o O u U n N c"),$string);
    }

	$sub_pasta = $_SESSION["s_sub_pasta"]; 
	$nome_inicial = $_SESSION["s_nome_inicial"]."_";

	//mostra o array de altea‡?o
	//print_r($_SESSION);
	
	//Caminho da pasta 
	if($pasta == "produtos"){
		$caminho = "../".$pasta."/".$sub_pasta;
		$_SESSION['s_caminho'] = $caminho;
	}elseif($pasta == "banners"){
		$caminho = "../".$pasta."/".$sub_pasta;
		$_SESSION['s_caminho'] = $caminho;
	}
	
	if($pasta == "produtos"){
		$caminho = "../".$pasta."/".$sub_pasta;
	}elseif($pasta == "banners"){
		$caminho = "../".$pasta."/".$sub_pasta."/";
	}	
	
	$diretorio = "../".$pasta."/".$sub_pasta."/";
	$_arquivo = scandir($diretorio);
	
	//Ordena um array
	@sort($_arquivo);
	
	//conta o total de arquivo no diretorio	
	// count($_arquivo)- 2  ---> scandir passa por todas as pastas, assim só conta as imagens
	 $total = count($_arquivo);
	//print_r($_arquivo );
	//print_r($total);
	//die;
	//exit;
	//quando for produto entra nessas condicoes
	if($pasta == "produtos"){
		for($_i=0; $_i<$total; $_i++){
			$cont_img = $_i;
			
			// print_r($_REQUEST['ordem']);
			// die;
			//nome inicial que foi definido + o contador que com isso vai ser o nome da nova imagem
			$_images2[$cont_img] = "$nome_inicial" . $_i . ".jpg";
			
			//lista o arquivo antigo para ser alterado
			$contents = scandir($diretorio);	
			$old_file = $caminho."/".$_REQUEST['ordem'][$_i];
			$new_file = $caminho."/temp_".$_i.".jpg";
			
			 //echo "<p>".$old_file;
			 //echo "<br>".$new_file;
			 //print_r($_REQUEST['ordem']);
			 //die;	
			rename($old_file, $new_file);		
		}
	// echo "<hr>";
		//renomeia os temporarios
		for ($_iii=0; $_iii<$total; $_iii++){
			$old_files = "$caminho/temp_".$_iii.".jpg";  
			$jjj = $_iii;//+1;
			$new_files = "$caminho/{$nome_inicial}".$jjj.".jpg";  
			
			$new_files = tirarAcentosER($new_files);
			
		// echo "<p>".$old_files;
		// echo "<br>".$new_files;
			//die;	
			rename($old_files, $new_files);				
		}
	}
	
	//quando for banner entra nessa condicao	
	if($pasta == "banners"){
		//echo "<pre>";
		//print_r($_REQUEST);
		$contents = scandir($caminho);
		$total = count($contents);
		for ($_i=0; $_i<$total; $_i++){			
			
			$old_files = $_REQUEST['ordem'][$_i];	

			$old_files = str_replace($caminho, '', $old_files); 			
			
			$under = substr($old_files, 1, 1);
			
			if($under == "_"){
				$new_files = $caminho.$_i."_".substr($old_files, 2);
			}else{
				$new_files = $caminho.$_i."_".$old_files;  
			}
			
			$old_files = $caminho.$old_files;
			
			$new_files = tirarAcentosER($new_files);
			rename($old_files, $new_files);		
		}
	}

?>  
<script>
	window.location.reload(true);
</script>