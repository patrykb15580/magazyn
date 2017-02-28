<?php
	$workshop = Workshop::find($params['workshop_id']);

	$street = explode(' ', $workshop->street);

	$street_url = '';
	foreach ($street as $key => $string) {
		$street_url .= $string.'+';
	}
	$path = $street_url.$workshop->post_code.'+'.$workshop->city;
?>
<div id="find-workshop" class="container">
	<div class="left-col">
		<img src="/public/assets/images/logo_big.png">
	</div><div class="right-col workshop-details">
		<h1>Dane magazynu opon</h1>
		<h3><?= $workshop->name ?></h3>
		<?= $workshop->street ?>
		<br />
		<?= $workshop->post_code ?> <?= $workshop->city ?>
		<br />
		<?= $workshop->email ?>
		<br />
		<?= $workshop->phone ?>
		<br /><br />
		<a href="https://www.google.pl/maps?q=<?= $path ?>" target="_blank">Pokaż na mapie <i class="fa fa-map-marker fa-lg" aria-hidden="true"></i></a>
		<br /><br />
		<a href="">Regulamin</a> | <a href="">Polityka prywatności</a>
	</div>
</div>