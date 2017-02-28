<?php
/**
* 
*/
class Code extends Model
{
	public $id;
	public $code;
	public $roll_id;
	public $created_at;
	public $updated_at;	

	public static function fields()
	{
		return [
            'id'                          => ['type' => 'integer',
                                              'default' => null],
            'code'                        => ['type' => 'integer',
                                              'default' => null,
                                              'validations' => ['required', 'max_length:11', 'unique']],
            'roll_id'                     => ['type' => 'integer',
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
      'roll'           => ['relation' => 'belongs_to', 'class' => 'Roll'],
    ];
  }
  public function workshop()
  {
    $roll = $this->roll();
    $order = $roll->order();
    $workshop = $order->workshop();

    return $workshop;
  }
}
