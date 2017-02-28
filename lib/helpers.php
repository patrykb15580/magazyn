<?php
function to_pln($liczba) {
  return number_format($liczba, 2, ',', '&nbsp;') . '&nbsp;zł';
}
function to_pln_pln($liczba) {
  return number_format($liczba, 2, ',', '&nbsp;') . '&nbsp;PLN';
}
# pluralize
function pluralize($val, $word)  {
  if ($word == 'pakiet') {
    if ($val == 1) {
      return 'pakiet';
    } elseif ($val >= 2 and $val <= 4) {
      return 'pakiety';
    } elseif ($val > 4) {
      return 'pakietów';
    }
  } else if ($word == 'zestaw') {
    if ($val == 1) {
      return 'zestaw';
    } elseif ($val >= 2 and $val <= 4) {
      return 'zestawy';
    } elseif ($val > 4) {
      return 'zestawów';
    }
  } else if ($word == 'fotomagnesów') {
    if ($val == 1) {
      return 'fotomagnes';
    } elseif ($val >= 2 and $val <= 4) {
      return 'fotomagnesy';
    } elseif ($val > 4) {
      return 'fotomagnesów';
    }
  } else {
    return $word;
  }
}
function orderValue()
{
  $value = fullOrderValue();

  if (isset($_SESSION['promotion_code'])) {
    $value = orderValueWithPromoCode($value);
  }

  return $value;
}
function fullOrderValue()
{
  $value = 0;
  if (isset($_SESSION['items']) && !empty($_SESSION['items'])) {
    foreach ($_SESSION['items'] as $item) { 
      $album = Album::findBy('hash_id', $item['album_hash_id']); 
         
      $album_price = Config::get('album_type_'.$album->type.'_price');
        
      $value = $value + ($item['count'] * $album_price); 
    }
  }

  if (isset($_SESSION['shipping'])) {
    $shipping_price = Config::get($_SESSION['shipping'].'_shipping_price');

    $value = $value + $shipping_price;
  } else {
    $value = $value + Config::get('poczta_polska_shipping_price');
  }

  return $value;
}
function bruttoToNetto($brutto_price)
{
  $netto_price = $brutto_price / 1.23;
  return number_format($netto_price, 2, '.', ' ');
}
function nettoToBrutto($netto_price)
{
  $brutto_price = $netto_price + ($brutto_price * 0.23);
  return number_format($brutto_price, 2, '.', ' ');
}
function orderValueWithPromoCode($value)
{
  if (isset($_SESSION['promotion_code'])) {
    $code = PromotionCode::findBy('code', $_SESSION['promotion_code']);

    if (!empty($code)) {
      $result = $code->orderValue($value);

      return $result;
    } else {
      return $value;
    }
  } else {
    return $value;
  }
}
function getPaymentType($shipping)
{
  $payu = ['poczta_polska', 'ups'];
  $cod = ['poczta_polska_cod', 'ups_cod'];
  $cash = ['personal_collection'];

  $payment_type = 'payu';

  if (in_array($shipping, $cod)) {
    $payment_type = 'cod';
  }
  if (in_array($shipping, $cash)) {
    $payment_type = 'cash';
  }

  return $payment_type;
}
function setPromotionCode($params)
{
  $code = PromotionCode::findBy('code', $params['promotion_code']);

  if (!empty($code)) {
    if ($code->type == 'normal') {
      if ($code->used == null) {
        $code->update(['used'=>date(Config::get('mysqltime'))]);
        $_SESSION['promotion_code'] = $params['promotion_code'];
      }
    } else {
      $_SESSION['promotion_code'] = $params['promotion_code']; 
    }        
  }
}