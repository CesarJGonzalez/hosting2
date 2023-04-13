
<html>
<head>
    <title>Formulario de Pedidos</title>
</head>
<body>
	<h1>Formulario de Pedidos</h1>
	<form method="POST" action="">
		<input type="text" name="numero_pedido" placeholder="Número de pedido" >
		<input type="text" name="cedula_cliente" placeholder="Cédula del cliente" ><br><br>
		<label for="hamburguesa">Hamburguesas $10.000 c/u:</label>
		<input type="number" name="hamburguesas" id="hamburguesa" value="0"><br>
		<label for="bebida">Bebidas $5.000 c/u:</label>
		<input type="number" name="bebidas" id="bebida" value="0"><br>
		<label for="acompanante">Acompañantes $5.000 c/u:</label>
		<input type="number" name="acompanantes" id="acompanante" value="0"><br><br>
		<button name="agregar">Agregar Pedido</button>
		<button name="listar">Listar Pedidos</button>
	</form>
	
	<?php
session_start();

if (isset($_POST['agregar'])) {
    $pedido = array(
        'numero_pedido' => $_POST['numero_pedido'],
        'cedula_cliente' => $_POST['cedula_cliente'],
        'hamburguesas' => $_POST['hamburguesas'],
        'bebidas' => $_POST['bebidas'],
        'acompanantes' => $_POST['acompanantes']
    );

    if (!isset($_SESSION['pedidos'])) {
        $_SESSION['pedidos'] = array();
    }
    $_SESSION['pedidos'][] = $pedido;
}

if (isset($_POST['eliminar'])) {
    $indice = $_POST['ind'];
    unset($_SESSION['pedidos'][$indice]);
}

if (isset($_POST['listar'])) {
    if(isset($_SESSION['pedidos'])){
    echo "<h2>Listado de Pedidos:</h2>";
    foreach($_SESSION['pedidos'] as $indice=>$pedido){
        $total = $pedido['hamburguesas']*10000 + $pedido['bebidas']*5000 + $pedido['acompanantes']*5000;
        echo "<table>";
        echo "<tr><th>Número de pedido</th><td>".$pedido['numero_pedido']."</td></tr>";
        echo "<tr><th>Cédula del cliente</th><td>".$pedido['cedula_cliente']."</td></tr>";
        echo "<tr><th>Hamburguesas</th><td>".$pedido['hamburguesas']."</td></tr>";
        echo "<tr><th>Bebidas</th><td>".$pedido['bebidas']."</td></tr>";
        echo "<tr><th>Acompañantes</th><td>".$pedido['acompanantes']."</td></tr>";
        echo "<tr><th>Total</th><td>".$total."</td></tr>";
        echo "<tr><th>Delete Check</th><td><form method='POST' action=''><input type='hidden' name='ind' value='".$indice."'><button name='eliminar'>Eliminar</button></form></td></tr>";
        echo "</table><br>";
    }
} 
}
?>

</body>
</html>