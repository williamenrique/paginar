<?php 
include( 'funciones.php' );
$usuarios = buscar( );
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="estilos.css" />
	<title>Listado</title>
</head>
<body>
	<header>
		<h1>Mi listado</h1>
		<form method="get" action="index.php">
			<input type="search" name="buscar" id="buscar" placeholder="buscar" autocomplete="off" />
		</form>
	</header>
	<main>
		<h2>Ultimas publicaciones</h2>
		<ul id="publicaciones">
		<?php 
		foreach( $usuarios['resultados'] as $u ){
			echo <<<HTML
			<li>
				<h3>$u[sitio]</h3>
				<p>$u[url]</p>
			</li>
HTML;
		} ?>
		</ul>
		
		<ul id="paginador">
		<?php 
		for( $i = 1; $i <= $usuarios['paginas']; $i++ ){
			$actual = $i == 1 ? " class='actual'" : '';
			echo "<li><a data-pagina='$i' href='pagina-1.html'$actual>$i</a></li>";
		}
		?>
		</ul>
	</main>
	<script src="function.js"></script>
</body>
</html>