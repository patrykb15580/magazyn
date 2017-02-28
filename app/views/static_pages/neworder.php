<?php

?>
<form method="POST" action="<?= $router->generate('create_order', []) ?>" id="new-order" class="container">
	<div class="left-col">
		<img src="/public/assets/images/logo_big.png">
	</div><div class="right-col">
		<h1>Dane zamawiającego</h1>
		<table>
			<tr>
				<td>
					<input type="text" name="order[name]" placeholder="Nazwa firmy" required>
				</td>
			</tr>
			<tr>
				<td>
					<input type="text" name="order[street]" placeholder="Adres" required>
				</td>
			</tr>
			<tr>
				<td>
					<input class="post-code" type="text" name="order[post_code]" placeholder="Kod" required><input class="city" type="text" name="order[city]" placeholder="Miasto" required>
				</td>
			</tr>
			<tr>
				<td>
					<input type="text" name="order[email]" placeholder="Adres e-mail" required>
				</td>
			</tr>
			<tr>
				<td>
					<input type="text" name="order[phone]" placeholder="Numer telefonu" required>
				</td>
			</tr>
			<tr>
				<td>
					<input type="text" name="order[nip]" placeholder="NIP" required>
				</td>
			</tr>
			<tr>
				<td>
					Sposób odbioru i płatności:<br />
					<select class="shipping" name="order[shipping]">
						<option value="poczta_polska_cod">Poczta Polska Kurier 48 - pobranie (<?= to_pln(Config::get('shipping_prices')['poczta_polska_cod']) ?>)</option>
						<option value="personal_collection">Odbiór osobisty (<?= to_pln(Config::get('shipping_prices')['personal_collection']) ?>)</option>
					</select>
				</td>
			</tr>
		</table>
		<br />
		<input type="checkbox" name="rights" value="1" required><span class="note">Akceptuję <a href="">regulamin</a> oraz <a href="">politykę prywatności</a> sklepu magazyn.info</span>
		<br />
		<input type="submit" value="ZAMAWIAM Z OBOWIĄZKIEM ZAPŁATY">
		<br /><br /><br />
	</div>
</form>
