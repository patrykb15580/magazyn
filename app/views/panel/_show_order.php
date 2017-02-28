<?php
	$order = Order::findBy('hash_id', $params['order-hash']);
	
	$order_id = $order->id;
?>
<div class="row row-eq-height show-order">
	<div class="col-md-4 col-sm-4 col-xs-4 details">
		Oznaczenie klienta:<br />
		<?= $order->customer_name ?>
		<br /><br />
		Status zamówienia:<br />
		<?= Order::STATUSES[$order->status] ?>
	</div>
	<div class="col-md-8 col-sm-8 col-xs-8">
		<h3>Nr zamówienia <?= $order_id ?></h3>
		Ilość rolek: <?= $order->quantity ?>
		<br /><br />
		<table width="100%">
			<tr>
				<td>
					nr rolki
				</td>
				<td>
					nr startowy rolki
				</td>
				<td>
					ostatni nr
				</td>
			</tr>
			<?php
				foreach ($order->rolls() as $roll) { 
					$last_code_number = $roll->lastCodeNumber(); ?>
					<tr>
						<td>
							<?= $roll->id ?> 
						</td>
						<td>
							<?= $roll->start_number ?>
						</td>
						<td>
							<?= $last_code_number ?>
						</td>
					</tr>
				<?php }
			?>
		</table>
		<br />
		<?php
			if (count($order->rolls()) < $order->quantity) { ?>
				<form method="POST" action="<?= $router->generate('panel_add_roll', ['order_id'=>$order->id]) ?>">Nr startowy rolki <input type="text" name="start_number"><input type="hidden" name="codes_number" value="40"> <input type="submit" value="Dodaj"></form>
			<?php }
		?>
	</div>
</div>