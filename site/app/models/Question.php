<?php

class Question extends Eloquent {

	protected $table = 'questions';

	public static function getCategory($id){
		return DB::table('question_categories')->where('id',$id)->first();
	}

	public static function getCategoryList(){
		return DB::table('question_categories')->get();
	}


	// public static function filters(){
	// 	return  array(["id"=>'1','name' => 'Filter'],["id"=>'2','name' => 'Match'] );
	// }

	// /** for php only **/
	// public static function filter_list(){
	// 	return  array('1' => 'Filter','2' => 'Match');
	// }

	public static function types(){
		return  array(
			["id"=>'1','name' => 'Select One'],
			["id"=>'2','name' => 'Multiple'],
			["id"=>'3','name' => 'Scrolling Bar'],
			["id"=>'4','name' => 'Input Text'],
			["id"=>'5','name' => 'Number'],
			// ["id"=>'6','name' => 'Group Single'],
			// ["id"=>'7','name' => 'Multiple Search'],
			// ["id"=>'8','name' => 'Rank'],
			// ["id"=>'9','name' => 'Drag Drop'],
			// ["id"=>'10','name' => 'US Map'],
			// ["id"=>'11','name' => 'Continent Map'],
			// ["id"=>'12','name' => 'World Map'],
		);
	}

	/** for php only **/
	public static function type_list(){
		return  array(
			'1' => 'Select One',
			'2' => 'Multiple',
			'3' => 'Scrolling Bar',
			'4' => 'Input Text',
			'5' => 'Number',
			'6' => 'Group Single',
			'7' => 'Multiple Search',
			'8' => 'Rank',
			'9' => 'Drag Drop',
			'10' => 'US Map',
			'11' => 'Continent Map',
			'12' => 'World Map',
		);
	}

}
