<?php 
$cnx = mysqli_connect( 'localhost', 'root', '', 'db_personal');
$cant_por_pagina = 10;

function buscar( $que = NULL, $pagina = 1 ){
	global $cnx, $cant_por_pagina;
	
	$where = is_null( $que ) ? '' : " WHERE sitio LIKE '%$que%' ";
	$inicio = ( $pagina - 1 ) * $cant_por_pagina;
	$consulta = "SELECT * FROM table_sitio $where ORDER BY sitio LIMIT $inicio, $cant_por_pagina";
	
	$registros = [ ];
	$filas = mysqli_query( $cnx, $consulta );
	while( $r = mysqli_fetch_assoc( $filas ) ){
		$registros[] = $r;
	}

	$consulta2 = "SELECT COUNT(*) AS CANTIDAD FROM table_sitio $where";
	$filas2 = mysqli_query($cnx, $consulta2 );
	$array = mysqli_fetch_assoc($filas2);
	$paginas = ceil( $array['CANTIDAD'] / $cant_por_pagina );

	return [ 'resultados' => $registros, 'paginas' => $paginas, 'actual' => $pagina ];
}




