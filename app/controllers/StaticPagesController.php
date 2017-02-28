<?php
class StaticPagesController extends ApplicationController
{
    public function start()
    {
        return $this->render();
    }
    public function getCode()
    {
    	$router = Config::get('router');

    	$code_number = intval($this->params['code']);

        $code = Code::findBy('code', $code_number);

        if (empty($code)) {
        	header('Location: '.$router->generate('root_path', []).'?code=not-found');
        } else {
        	$workshop = $code->workshop();

        	header('Location: '.$router->generate('show_workshop', ['workshop_id'=>$workshop->id]));
        }
    }
    public function showWorkshop()
    {
        return $this->render();
    }
    public function cart()
    {
        return $this->render();
    }
    public function changeQuantity()
    {
        $router = Config::get('router');

        $quantity = $this->params['quantity'];

        if ($quantity == 0) {
        	$quantity = 1;
        }
        if ($quantity == 6) {
        	$quantity = 5;
        }

        $_SESSION['quantity'] = $quantity;

        header('Location: '.$router->generate('cart', []));
    }
    public function newOrder()
    {
        return $this->render();
    }
    public function createOrder()
    {
        $router = Config::get('router');

        $workshop = Workshop::findBy('email', $this->params['order']['email']);

    	if (empty($workshop)) {
    		$workshop_data = ['name'=>$this->params['order']['name'],
    					  	  'street'=>$this->params['order']['street'],
    					  	  'post_code'=>$this->params['order']['post_code'],
    					 	  'city'=>$this->params['order']['city'],
    						  'email'=>$this->params['order']['email'],
    						  'phone'=>$this->params['order']['phone'],
    						  'nip'=>$this->params['order']['nip']];

    		$workshop = new Workshop($workshop_data);

    		$workshop->save();
    	}

        if (!empty($workshop)) {
        	$value = ($_SESSION['quantity'] * Config::get('package_price')) + Config::get('shipping_prices')[$this->params['order']['shipping']];
	        $payment_type = getPaymentType($this->params['order']['shipping']);

	        $data = ['hash_id'=>md5(uniqid('', true)),
	        		 'workshop_id'=>$workshop->id,
	                 'customer_phone'=>$this->params['order']['phone'],
	                 'customer_nip'=>$this->params['order']['nip'],
	                 'email'=>$this->params['order']['email'],
	                 'shipping_type'=>$this->params['order']['shipping'],
	                 'payment_type'=>$payment_type,
	                 'value'=>$value,
	                 'quantity'=>$_SESSION['quantity']];
	       
	        if ($payment_type == 'cod' || $payment_type == 'cash') {
	            $data['payment_status'] = 'completed';
	        }

	        $shipping = ['customer_name'=> $this->params['order']['name'],
	        			 'customer_street'=> $this->params['order']['street'],
	        			 'customer_post_code'=> $this->params['order']['post_code'],
	        			 'customer_city'=> $this->params['order']['city']];

	        $custom_shipping = ['custom_shipping_name'=> $this->params['order']['name'],
	        					'custom_shipping_street'=> $this->params['order']['street'],
	        					'custom_shipping_post_code'=> $this->params['order']['post_code'],
	        					'custom_shipping_city'=> $this->params['order']['city']];

	    	

	        $order_data = array_merge($data, $shipping, $custom_shipping);
	        
	        $order = new Order($order_data);

	        if ($order->save()) {
	        	header('Location: '.$router->generate('root_path', []).'?order=done');
	        } else {
	        	header('Location: '.$router->generate('cart', []).'?order=error');
	        }
        }
    }
}
