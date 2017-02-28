<?php
	if (isset($_SESSION['quantity'])) {
		$quantity = $_SESSION['quantity'];
	} else {
		$quantity = 1;
	}
	$increase = $quantity + 1;
	$decrease = $quantity - 1;
	$price = $quantity * 100;

?>
<div id="cart" class="container">
	<div class="left-col">
		<img src="/public/assets/images/logo_big.png">
	</div><div class="right-col">
		<h1>Dane zamawiającego</h1>
		<table>
			<tr>
				<td>
					Pakiet naklejek na opony<br />(40 kompletów) <i class="fa fa-info-circle" aria-hidden="true"></i>
				</td>
				<td>
					Cena:<br />
					<?= to_pln(100) ?>
				</td>
			</tr>
			<tr>
				<td>
					Zamawiana ilość:
				</td>
				<td>
					<div class="change-quantity"><a class="act-btn decrease" href="<?= $router->generate('change_quantity', ['quantity'=>$decrease]) ?>">-</a><span class="quantity"><?= $quantity ?></span><a class="act-btn increase" href="<?= $router->generate('change_quantity', ['quantity'=>$increase]) ?>">+</a></div>
				</td>
			</tr>
			<tr>
				<td>
					Do zapłaty:
				</td>
				<td>
					<?= to_pln($price) ?>
				</td>
			</tr>
		</table>
		<a class="btn" href="<?= $router->generate('new_order', []) ?>">DALEJ</a>
	</div>
</div>

<script type="text/javascript">

</script>