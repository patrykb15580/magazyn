<?php
class PanelController extends ApplicationController
{
    public function show()
    {
    	$login_successful = $_COOKIE['booklet_admin_user_magazyn'] ?? false;
		// Check username and password:
		if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
		  $username = $_SERVER['PHP_AUTH_USER'];
		  $password = $_SERVER['PHP_AUTH_PW'];
		  if ($username == Config::get('admin_login') && $password == Config::get('admin_password')){
		    $login_successful = true;
		    $_SESSION['manage'] = true;
		  }
		}

		// Login passed successful?
		if (!$login_successful){
		  header('WWW-Authenticate: Basic realm="Secret page"');
		  header('HTTP/1.0 401 Unauthorized');
		}
		else {
		  #$_SESSION['booklet_admin_user_naklejki_rowerowe'] = true;
		  setcookie("booklet_admin_user_magazyn",true, time()+60*60*24*31*12); # na rok
		  return $this->render();
		}
    }
    public function addRoll()
    {
    	$router = Config::get('router');

    	$order_id = $this->params['order_id'];
        $start_number = $this->params['start_number'];
        $codes_number = $this->params['codes_number'];

        $roll = new Roll(['order_id'=>$order_id, 'start_number'=>$start_number, 'codes_quantity'=>$codes_number]);

        if ($roll->save()) {
        	$roll->generateCodes();
        }

        $order = Order::find($order_id);

        header('Location: '.$router->generate('panel_show', []).'?page=show-order&order-hash='.$order->hash_id);
    }
    public function changeOrdersStatus()
    {
    	$router = Config::get('router');

    	$status = $this->params['status'];

    	foreach ($this->params['orders'] as $id) {
    		$order = Order::find($id);

    		$order->update(['status'=>$status]);
    	}
    	
    	header('Location: '.$router->generate('panel_show', []));
    }
}
