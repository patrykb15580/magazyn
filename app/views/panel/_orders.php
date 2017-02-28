<?php
	if (!isset($params['orders'])) { ?>
		<form method="POST" action="<?= $router->generate('panel_change_orders_status', []) ?>">
			<input type="hidden" name="status" value="in_production">
			<h1>Oczekujące zamówienia</h1>
			<table class="orders-table">
				<tr>
					<td></td>
					<td>
						Nazwa firmy
					</td>
					<td>
						Ilość pakietów
					</td>
					<td>
						Wysyłka
					</td>
					<td>
						Płatność
					</td>
					<td>
						Status
					</td>
					<td></td>
				</tr>
				<?php
					foreach (Order::where('status=?', ['status'=>'waiting']) as $order) { ?>
						<tr>
							<td>
								<input type="checkbox" name="orders[]" value="<?= $order->id ?>">
							</td>
							<td>
								<?= $order->customer_name ?>
							</td>
							<td>
								<?= $order->quantity ?>
							</td>
							<td>
								<?= Config::get('shipping_name')[$order->shipping_type] ?>
							</td>
							<td>
								<?= Order::PAYMENT_TYPES[$order->payment_type] ?>
							</td>
							<td>
								<?= Order::STATUSES[$order->status] ?>
							</td>
							<td>
								<a href="<?= $router->generate('panel_show', []).'?page=show-order&order-hash='.$order->hash_id ?>">Pokaż</a>
							</td>
						</tr>
					<?php }
				?>
			</table>
			<br />
			<input type="submit" value="Przenieś do produkcji">
		</form>
		<form method="POST" action="<?= $router->generate('panel_change_orders_status', []) ?>">
			<input type="hidden" name="status" value="completed">
			<h1>Zamówienia w produkcji</h1>
			<table class="orders-table">
				<tr>
					<td></td>
					<td>
						Nazwa firmy
					</td>
					<td>
						Ilość pakietów
					</td>
					<td>
						Wysyłka
					</td>
					<td>
						Płatność
					</td>
					<td>
						Status
					</td>
					<td></td>
				</tr>
				<?php
					foreach (Order::where('status=?', ['status'=>'in_production']) as $order) { ?>
						<tr>
							<td>
								<input type="checkbox" name="orders[]" value="<?= $order->id ?>">
							</td>
							<td>
								<?= $order->customer_name ?>
							</td>
							<td>
								<?= $order->quantity ?>
							</td>
							<td>
								<?= Config::get('shipping_name')[$order->shipping_type] ?>
							</td>
							<td>
								<?= Order::PAYMENT_TYPES[$order->payment_type] ?>
							</td>
							<td>
								<?= Order::STATUSES[$order->status] ?>
							</td>
							<td>
								<a href="<?= $router->generate('panel_show', []).'?page=show-order&order-hash='.$order->hash_id ?>">Pokaż</a>
							</td>
						</tr>
					<?php }
				?>
			</table>
			<br />
			<input type="submit" value="Przenieś do zrealizowanych">
		</form>
	<?php }
	if (isset($params['orders']) && $params['orders'] == 'done-orders') { ?>
		<input type="hidden" name="status" value="completed">
		<h1>Zrealizowane zamówienia</h1>
		<table class="orders-table">
			<tr>
				<td>
					Nazwa firmy
				</td>
				<td>
					Ilość pakietów
				</td>
				<td>
					Wysyłka
				</td>
				<td>
					Płatność
				</td>
				<td>
					Status
				</td>
				<td></td>
			</tr>
			<?php
				foreach (Order::where('status=?', ['status'=>'completed']) as $order) { ?>
					<tr>
						<td>
							<?= $order->customer_name ?>
						</td>
						<td>
							<?= $order->quantity ?>
						</td>
						<td>
							<?= Config::get('shipping_name')[$order->shipping_type] ?>
						</td>
						<td>
							<?= Order::PAYMENT_TYPES[$order->payment_type] ?>
						</td>
						<td>
							<?= Order::STATUSES[$order->status] ?>
						</td>
						<td>
							<a href="<?= $router->generate('panel_show', []).'?page=show-order&order-hash='.$order->hash_id ?>">Pokaż</a>
						</td>
					</tr>
				<?php }
			?>
		</table>
	<?php }
?>
