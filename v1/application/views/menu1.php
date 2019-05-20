<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div class='content'>
			<form action="<?php echo base_url()?>/index.php/ControllerDados/recebeXML" method="post" enctype="multipart/form-data">
				<input type="file" name="arquivo" id="nomeArquivo" accept="text/xml">
				<input type="submit" id="enviar">
			</form>
		</div>
	</body>
</html>