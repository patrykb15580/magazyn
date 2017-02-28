<?php
/**
* 
*/
class Workshop extends Model
{
	public $id;
	public $name;
	public $street;
	public $post_code;
	public $city;
  public $email;
	public $phone;
	public $nip;
	public $created_at;
	public $updated_at;	

	public static function fields()
	{
		return [
            'id'                          => ['type' => 'integer',
                                              'default' => null],
            'name'                        => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['required', 'max_length:191']],
            'street'                      => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['required', 'max_length:191']],
            'post_code'                   => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['required', 'max_length:191']],
            'city'                        => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['required', 'max_length:191']],
            'phone'                       => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['max_length:191']],
            'nip'                         => ['type' => 'string',
                                              'default' => null], 
            'email'                       => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['required', 'max_length:191', 'unique']],                                                                  
            'created_at'                  => ['type' => 'datetime',
                                              'default' => null],
            'updated_at'                  => ['type' => 'datetime',
                                              'default' => null],
		];
	}

	public static function relations() 
  { 
    return [
      'orders'           => ['relation' => 'has_many', 'class' => 'Order'],
    ];
  }
}
