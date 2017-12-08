<?php
	function checaPagina($pagina, $qtd_pag){
		//checa se está na primeira pagina
		if($pagina == 1){
	 		$class['F'] = 'class="disabled" style="pointer-events: none;"';
	 	} else {
	 		$class['F'] = "";
	 	}
	 	//checa se está na ultima pagina
	 	if($pagina == $qtd_pag){
	 		$class['L'] = 'class="disabled" style="pointer-events: none;"';
	 	} else {
	 		$class['L'] = "";
	 	}
	 	// checa se é possivel avançar 10 páginas
	 	if($pagina + 10 > $qtd_pag){
	 		$class['NT'] = 'class="disabled" style="pointer-events: none;"';
	 	} else {
	 		$class['NT'] = "";
	 	}
	 	// checa se é possivel voltar 10 páginas
	 	if($pagina - 10 < 1){
	 		$class['BT'] = 'class="disabled" style="pointer-events: none;"';
	 	} else {
	 		$class['BT'] = "";
	 	}
	 	return $class;
	}	
?>