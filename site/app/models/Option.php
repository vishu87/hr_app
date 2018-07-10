<?php

class Option extends Eloquent {

	protected $table = 'options';

	public static function operators(){
		return  array(
			["id"=>'1','symbol' => '='],
			["id"=>'2','symbol' => '!='],
			["id"=>'3','symbol' => '>='],
			["id"=>'4','symbol' => '<='],
			["id"=>'5','symbol' => '>'],
			["id"=>'6','symbol' => '<'],
		);
	}

	public static function operatorsArray(){
		$ar = [];
		
		$ar[1] = '=';
		$ar[2] = '!=';
		$ar[3] = '>=';
		$ar[4] = '<=';
		$ar[5] = '>';
		$ar[6] = '<';

		return $ar;
	}
}	
