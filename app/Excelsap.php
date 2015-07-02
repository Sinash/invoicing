<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Excelsap extends Model {

	/**
	 * The attributes included in the model's JSON form.
	 *
	 * @var array
	 */
	protected $fillable = array('description', 'excelfile');
	
	/**
	 * The rules for email field, automatic validation.
	 *
	 * @var array
	*/
	private $rules = array(
			'description' => 'required|min:2',
	);
	
	public function getImageUrl( $withBaseUrl = false )
	{
		if(!$this->excelfile) return NULL;
		
		$imgDir = '/images/excelsaps/' . $this->id;
		$url = $imgDir . '/' . $this->excelfile;
		
		return $withBaseUrl ? URL::asset( $url ) : $url;
	}
}