<?php
/**
* 
*/
class Roll extends Model
{
	public $id;
	public $order_id;
	public $start_number;
  public $codes_quantity;
	public $created_at;
	public $updated_at;	

	public static function fields()
	{
		return [
            'id'                          => ['type' => 'integer',
                                              'default' => null],
            'order_id'                    => ['type' => 'integer',
                                              'default' => null,
                                              'validations' => ['required', 'max_length:191']],
            'start_number'                => ['type' => 'string',
                                              'default' => null,
                                              'validations' => ['required', 'max_length:191', 'unique']],
            'codes_quantity'              => ['type' => 'integer',
                                              'default' => null,
                                              'validations' => ['required', 'max_length:191']],                                                                                                
            'created_at'                  => ['type' => 'datetime',
                                              'default' => null],
            'updated_at'                  => ['type' => 'datetime',
                                              'default' => null],
		];
	}

	public static function relations() 
  { 
    return [
      'order'           => ['relation' => 'belongs_to', 'class' => 'Order'],
      'codes'           => ['relation' => 'has_many', 'class' => 'Code'],
    ];
  }
  public function generateCodes()
  {
    $start_number = $this->start_number;
    $end_number = $start_number + $this->codes_quantity;

    $i = $start_number;

    while ($i < $end_number) {
      $code_data = ['code'=>$i,
                    'roll_id'=>$this->id];

      $code = new Code($code_data);

      if ($code->save()) {
        $i++;
      }
    }
  }
  public function lastCodeNumber()
  { 
    $codes = Code::where('roll_id=?', ['roll_id'=>$this->id], ['order'=>'id DESC']);
    $last_code = $codes[0];
    $code_number = $last_code->code;
    
    return $code_number;
  }
}
