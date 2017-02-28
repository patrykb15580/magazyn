<?php
/**
* 
*/
class Order extends Model
{
	public $id;
	public $hash_id;
  public $workshop_id;
	public $customer_name;
	public $customer_street;
	public $customer_post_code;
	public $customer_city;
  public $email;
	public $customer_phone;
	public $customer_nip;
	public $custom_shipping_name;
	public $custom_shipping_street;
	public $custom_shipping_post_code;
	public $custom_shipping_city;
	public $shipping_type;
  public $payment_type;
	public $payment_status;
	public $status;
	public $value;
  public $quantity;
  public $download_invoice;
	public $created_at;
	public $updated_at;	

	const STATUSES = ['waiting'=>'Oczekujące',
	                  'in_production'=>'W produkcji',
	                  'completed'=>'Zrealizowane',
                    'canceled'=>'Anulowane'];

  const PAYMENT_TYPES = ['payu'=>'PayU',
                         'cod'=>'Pobranie',
                         'cash'=>'Gotówka'];

	public static function fields()
	{
		return [
            'id'                          => ['type' => 'integer',
                                              'default' => null],
            'hash_id'                     => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['required', 'max_length:191', 'unique']],
            'workshop_id'                 => ['type' => 'integer',
                                              'default' => null,
                                              'validations' => ['required', 'max_length:11']],
            'customer_name'               => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['required', 'max_length:191']],
            'customer_street'             => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['required', 'max_length:191']],
            'customer_post_code'          => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['required', 'max_length:191']],
            'customer_city'               => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['required', 'max_length:191']],
            'customer_phone'              => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['max_length:191']],
            'customer_nip'                => ['type' => 'string',
                                              'default' => null], 
            'email'                       => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['required', 'max_length:191']],                                                                  
            'custom_shipping_name'        => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['max_length:191']],
            'custom_shipping_street'      => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['max_length:191']],
            'custom_shipping_post_code'   => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['max_length:191']],
            'custom_shipping_city'        => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['max_length:191']],
            'shipping_type'               => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['required', 'max_length:191']],
            'payment_type'                => ['type' => 'string',
                                              'default' => 'payu',
                                              'validations' => ['required', 'max_length:191']],
            'payment_status'              => ['type' => 'string',
                                              'default' => 'initialized'],
            'status'                      => ['type' => 'string',
                                              'default' => 'waiting',
                                              'validations' => ['required', 'max_length:191']],
            'value'                       => ['type' => 'double',
                                              'default' => 0.00,
                                              'validations' => ['required']],
            'download_invoice'            => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['max_length:191']],
            'quantity'                    => ['type' => 'integer',
                                              'default' => null,
                                              'validations' => ['required', 'max_length:11']],                                  
            'created_at'                  => ['type' => 'datetime',
                                              'default' => null],
            'updated_at'                  => ['type' => 'datetime',
                                              'default' => null],
		];
	}

	public static function relations() 
  { 
    return [
      'workshop'           => ['relation' => 'belongs_to', 'class' => 'Workshop'],
      'rolls'              => ['relation' => 'has_many', 'class' => 'Roll'],
    ];
  }
  public function createInvoice()
  {
    $albums = $this->albums();

    $code_value_for_single_item = 0;

    if (!empty($this->promotion_code)) {
      $code_value_for_single_item = $this->codeValueForSingleItem();
    }

    $items = [];
    foreach ($albums as $album) {
      $album_price = Config::get('album_type_'.$album->type.'_price');

      $album_price = $album_price - ($code_value_for_single_item / $album->count);
      
      $album_price = bruttoToNetto($album_price);

      $arr = ['name' => 'Pakiet Classic'.Album::IMAGES_NUMBER[$album->type], 'count' => $album->count, 'netto_price' => $album_price];
      array_push($items, $arr);
    }

    $shipping_price = Config::get($this->shipping_type.'_shipping_price');
    if ($this->payment_type == 'cod') {
      $shipping_price = $shipping_price + Config::get('cod_price');
    }

    array_push($items, ['name' => 'Dostawa', 'count' => 1, 'netto_price' => bruttoToNetto($shipping_price)]);

    $data = [
      'invoice' => ['client_name' => $this->customer_name,
                    'client_street' => $this->customer_street,
                    'client_zip' => $this->customer_post_code,
                    'client_city' => $this->customer_city,
                    'client_nip' => $this->customer_nip,
                    'series_id' => Config::get('invoice_series'),
                    'payment_method' => Order::PAYMENT_TYPES[$this->payment_type],
                    'description' => 'Zamówienie ZP'.$this->id,
                    'items_attributes' => $items]
    ];

    $response = BKTApi::post('/invoices', $data);
    $invoice = $response->body;
    $invoice = json_decode($invoice);

    $this->update(['download_invoice'=>$invoice->pdf_download]);
  }
}
