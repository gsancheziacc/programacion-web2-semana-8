<?php
use Spipu\Html2Pdf\Html2Pdf;
$xml = simplexml_load_file(__DIR__ . '/data/arrendatarios.xml');

function open() {
    $fp = fopen(__DIR__ . '/data/arrendatarios.xml', "r");
	echo "archivo abierto";
	fclose($fp);
}

function read() {
    $fp = fopen(__DIR__ . '/data/arrendatarios.xml', "r");
	$data = fread($fp, filesize(__DIR__ . '/data/arrendatarios.xml'));
	echo $data;
	fclose($fp);
}

function write() {
    $fp = fopen(__DIR__ . '/data/arrendatarios.xml', "w");
    $xml = simplexml_load_file(__DIR__ . '/data/arrendatarios.xml');
	fwrite($fp, $xml->asXML());
	echo "archivo escrito";
    fclose($fp);
}

function close() {
    $fp = fopen(__DIR__ . '/data/arrendatarios.xml', "r");
	fclose($fp);
}

function printFile() {
    $xml = simplexml_load_file(__DIR__ . '/data/arrendatarios.xml');
    $html2pdf = new Html2Pdf();
    $html2pdf->writeHTML($xml->asXML());
    $html2pdf->output();
}

if(isset($_GET['action'])) {
	$action = $_GET['action'];
	switch ($action) {
		case 'open':
            open();
			break;
		case 'read':
            read();
			break;
		case 'write':
			write();
			break;
		case 'close':
			close();
			break;
		case 'print':
			printFile();
			break;
		default:
			break;
	}
}

?>

<html lang="ES">
<head>
    <title>Arrendatarios</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
	      rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
	      crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
            integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
            integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK"
            crossorigin="anonymous"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">Arrendatarios</a>
			<div class="d-flex">
				<a class="btn btn-secondary mx-2" type="button" href='index.php?action=open'>Abrir</a>
				<a class="btn btn-secondary mx-2" type="button" href='index.php?action=read'>Leer</a>
				<a class="btn btn-secondary mx-2" type="button" href='index.php?action=write'>Escribir</a>
				<a class="btn btn-secondary mx-2" type="button" href='index.php?action=close'>Cerrar</a>
				<a class="btn btn-secondary mx-2" type="button" href='index.php?action=print'>Imprimir</a>
			</div>
		</div>
	</nav>
    <table class="table table-hover">
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>DNI</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Dirección</th>
        </tr>
        <?php
        foreach ($xml->arrendatario as $arrendatario) {
            echo '<tr>';
            echo '<td>' . $arrendatario->nombre . '</td>';
            echo '<td>' . $arrendatario->apellido . '</td>';
            echo '<td>' . $arrendatario->dni . '</td>';
            echo '<td>' . $arrendatario->email . '</td>';
            echo '<td>' . $arrendatario->telefono . '</td>';
            echo '<td>' . $arrendatario->direccion . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
</body>
</html>
