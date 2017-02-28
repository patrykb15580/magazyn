<?php
	if (!isset($params['page'])) {
		$title = 'Zamówienia';
		$file = 'orders';
	}
	if (isset($params['page']) && $params['page'] == 'show-order') {
		$title = 'Zamówienie klienta';
		$file = 'show_order';
	}
?>
<div id="panel" class="container">
	<div class="menu">
		<a href="<?= $router->generate('panel_show', []) ?>">Nowe/W produkcji</a> | <a href="<?= $router->generate('panel_show', []).'?orders=done-orders' ?>">Wysłane</a>
	</div>
	<h1 class="page-title"><?= $title ?></h1>
	<?php include '_'.$file.'.php'; ?>
</div>