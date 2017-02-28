<?php
	if (isset($params['order'])) { ?>
		<div class="alert info">Dziękujemy za złożenie zamówienia</div>
	<?php }
	if (isset($params['code']) && $params['code'] == 'not-found') { ?>
		<div class="alert error">Nie znaleziono podanego kodu</div>
	<?php }
?>
<form method="POST" action="<?= $router->generate('get_code', []) ?>" id="find-workshop" class="container">
	<div class="left-col">
		<img src="/public/assets/images/logo_big.png">
	</div><div class="right-col">
		<h1>Podaj numer kwita magazynowego</h1>
		<input type="text" name="code">
		<input type="submit" value="DALEJ">
	</div>
</form>