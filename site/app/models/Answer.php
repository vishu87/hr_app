<?php

class Answer extends Eloquent {

	protected $table = 'answers';

	public static function getValue($user_id, $question_id, $menu_id){
		$value = AnswerOption::select('value')->join('answers','answers.id','=','answer_options.answer_id');
		$value = $value->where('answers.question_id',$question_id);
		$value = $value->where('answers.user_id',$user_id);
		$value = $value->first();
		if($value){
			return $value->value;
		} else {
			return '';
		}
	}

	public static function hasUserAnswered($user_id){
		$options = DB::table('answers')->where('answers.user_id',$user_id)->count();
		if($options == 0)
			return false;
		return true;				
	}

	public static function getAmountUserWantToInvest($user_id){
		$question_id = HardCodedIds::getQuestionIdOfAmountUserWantToInvest();
		return Answer::getValue($user_id, $question_id , 1);
	}

	public static function getAllSectors($user_id, $sectorQuestionId, $menuId){
		return Answer::getSubtags($user_id, $sectorQuestionId, $menuId, 0);
	}

	public static function getAllSectorsWithRelation($user_id, $sectorQuestionId, $menuId, $relationId){
		return Answer::getRelationSubtags($user_id, $sectorQuestionId, $menuId, $relationId, 0);
	}


	public static function isSectorSplitEvenly($user_id, $sectorQuestionId){
		return Answer::isSplitEvenly($user_id, $sectorQuestionId);
	}


	public static function getTopSectors($user_id, $sectorQuestionId, $menuId){

		$options_array = Answer::getAllSectors($user_id, $sectorQuestionId, $menuId);
		if(sizeof($options_array) == 0)
			return $options_array;
		if(empty($options_array))
			return $options_array;
		$is_split_evenly = Answer::isSplitEvenly($user_id, $sectorQuestionId);
		if($is_split_evenly || sizeof($options_array) <= 3){
			return $options_array;
		}
		$res = [];
		$totalAdded = 0;
		foreach ($options_array as $option) {
			if($totalAdded < 3){
				$res[] = $option;
				$totalAdded = $totalAdded +1;
			}
		}
		return $res;
	}

	public static function isSplitEvenly($user_id, $question_id){
		$answer = Answer::select('split_evenly');
		$answer = $answer->where('question_id', $question_id);
		$answer = $answer->where('answers.user_id',$user_id);
		$answer = $answer->first();
		if(empty($answer))
			return false;
		if($answer->split_evenly == 1)
			return true;
			return false;

	}



	public static function getSelectedOptionsTextArray($user_id, $question_id){
		$options = Answer::getSelectedOptions($user_id, $question_id);
		 if(sizeof($options) == 0) return [];
		 $optionNamesArray = [];
		foreach ($options as $option) {
		 	$optionNamesArray[] = $option->option_name;
		 }
		 return $optionNamesArray;
	}

	public static function getSelectedOptionsIdArray($user_id, $question_id){
		$options = Answer::getSelectedOptions($user_id, $question_id);
		 if(sizeof($options) == 0) return [];
		 $optionIdArray = [];
		foreach ($options as $option) {
		 	$optionIdArray[] = $option->id;
		 }
		 return $optionIdArray;
	}

	// public static function getSelectedOptionsForGeoLocation($user_id, $question_id){
	// 	$options = DB::table('answer_options')->select('answer_options.geo_id', 'answer_options.geo_type');
	// 	$options = $options->join('answers','answers.id','=','answer_options.answer_id');
	// 	$options = $options->where('answers.question_id',$question_id);
	// 	$options = $options->where('answers.user_id',$user_id);
	// 	$options = $options->orderBy('answer_options.rank', 'asc');
	// 	$options = $options->get();
	// 	return $options;
	// }


	public static function getSelectedOptionsForGeoLocation($user_id, $question_id){
		$options = DB::table('answer_options')->select('answer_options.geo_id', 'answer_options.geo_type' , 'locations.latitude', 'locations.longitude', 'locations.name');
		$options = $options->join('answers','answers.id','=','answer_options.answer_id');
		$options = $options->join('locations','locations.id','=','answer_options.geo_id');
		$options = $options->where('answers.question_id',$question_id);
		$options = $options->where('answers.user_id',$user_id);
		$options = $options->orderBy('answer_options.rank', 'asc');
		$options = $options->get();
		return $options;
	}

	public static function getGeoLocations($user_id){
		$question_id = HardCodedIds::getGeographicPreferenceQuestionId();
		$options = DB::table('answer_options')->select('locations.id as geo_id', 'locations.name as name', 'locations.type as type', 'locations.in_us as in_us', 'locations.continent_id as continent_id', 'locations.country_id as country_id', 'locations.state_id as state_id');
		$options = $options->join('answers','answers.id','=','answer_options.answer_id');
		$options = $options->join('locations','locations.id','=','answer_options.geo_id');
		$options = $options->where('answers.question_id',$question_id);
		$options = $options->where('answers.user_id',$user_id);
		$options = $options->orderBy('answer_options.rank', 'asc');
		$options = $options->get();
		return $options;
	}

	
	public static function getSelectedOptions($user_id, $question_id){
		$options = DB::table('answer_options')->select('options.id', 'options.option_name')->join('answers','answers.id','=','answer_options.answer_id');
		$options = $options->join('options', 'options.id','=', 'answer_options.option_id');
		$options = $options->where('answers.question_id',$question_id);
		$options = $options->where('answers.user_id',$user_id);
		$options = $options->orderBy('answer_options.rank', 'asc');
		$options = $options->get();
		return $options;
	}


	public static function getRiskScore($user_id){
		// 9, 13, 14, 15, 16, 17, 18
		$questionIds = [9, 13, 14, 15, 16, 17, 18];
		$noOfQuestions = 0;
		$totalScore = 0;
		$menuId = 2;
		foreach($questionIds as $question_id){
			$score = Answer::getSubtags($user_id, $question_id, $menuId, 1);
			if($score != false){
				$noOfQuestions = $noOfQuestions + 1;
				 $totalScore = $totalScore + $score;
			}
		}

		if($noOfQuestions == 0){
			return "";
		}

		$finalScore = $totalScore / $noOfQuestions;
		$finalScore = round($finalScore * 2, 0)/2;
		return $finalScore;
	}

	


	public static function getRelationSubtags($user_id, $question_ids, $menu_id, $relation_id, $type = 0){
					$options = DB::table('subtags')
					->select('subtags.subtag_name','subtags.id', 'subtags.remarks')
					->join('relation_links as rl','rl.relation_tag_id','=','subtags.id')
					->join('subtags as st2','st2.id','=','rl.subtag_id')
					->join('option_subtags','option_subtags.sub_tag_id','=','st2.id')
					->join('answer_options','answer_options.option_id','=','option_subtags.option_id')
					->join('answers','answers.id','=','answer_options.answer_id');


			if(is_array($question_ids)){
				$options = $options->whereIn('answers.question_id',$question_ids);
			} else {
				$options = $options->where('answers.question_id',$question_ids);
			}

			$options = $options->where('answers.user_id',$user_id);
			$options = $options->where('option_subtags.menu_id', $menu_id);
			$options = $options->where('rl.relation_id', $relation_id);
			$options = $options->orderBy('answer_options.rank', 'asc');
			$subtags = $options->get();


		if(sizeof($subtags) == 0) return "";

		if($type == 0){
			return $subtags;
		} elseif ($type == 1){
			$ar = [];
			foreach ($subtags as $subtag) {
				$ar[] = $subtag->subtag_name;
			}
			return implode(', ', $ar);
		} elseif ($type == 2){
			$ar = [];
			foreach ($subtags as $subtag) {
				$ar[] = $subtag->id;
			}
			return $ar;
		}
	}

	


	public static function getSubtags($user_id, $question_ids, $menu_id, $type = 0){
	$options = DB::table('subtags')->
				select(DB::raw('distinct subtags.subtag_name'), 'subtags.id','subtags.color', 'subtags.remarks')
				->join('option_subtags','option_subtags.sub_tag_id','=','subtags.id')
				->join('answer_options','answer_options.option_id','=','option_subtags.option_id')
				->join('answers','answers.id','=','answer_options.answer_id');


		if(is_array($question_ids)){
			$options = $options->whereIn('answers.question_id',$question_ids);
		} else {
			$options = $options->where('answers.question_id',$question_ids);
		}

		$options = $options->where('answers.user_id',$user_id);
		$options = $options->where('option_subtags.menu_id', $menu_id);
		$options = $options->orderBy('answer_options.rank', 'asc');
		
		$subtags = $options->get();

		if(sizeof($subtags) == 0) return "";

		if($type == 0){
			return $subtags;
		} elseif ($type == 1){
			$ar = [];
			foreach ($subtags as $subtag) {
				$ar[] = $subtag->subtag_name;
			}
			return implode(', ', $ar);
		} elseif ($type == 2){
			$ar = [];
			foreach ($subtags as $subtag) {
				$ar[] = $subtag->id;
			}
			return $ar;
		}

		//$query = Answer::select('subtags.subtag_name')->whereIn('question_id',array(7,20))->leftJoin('option_subtags','answers.option_id','=','option_subtags.option_id')->leftJoin('subtags','subtags.id','=','option_subtags.sub_tag_id')->lists('subtags.subtag_name');
	}

	// public static function getSubtags($user_id, $question_ids, $menu_id, $type = 0){
	// 	//$options = AnswerOption::select('option_id')->join('answers','answers.id','=','answer_options.answer_id');
	// $options = DB::table('answer_options')->select('option_id')->join('answers','answers.id','=','answer_options.answer_id');
	// 	if(is_array($question_ids)){
	// 		$options = $options->whereIn('answers.question_id',$question_ids);
	// 	} else {
	// 		$options = $options->where('answers.question_id',$question_ids);
	// 	}
	// 	$options = $options->where('answers.user_id',$user_id);
	// 	$options = $options->orderBy('answer_options.rank', 'asc');
	// 	$options = $options->lists('option_id');
	// 	if(sizeof($options) == 0)
	// 		return false;
	//
	// 	//$subtags = OptionSubTag::
	// 	$subtags = DB::table('option_subtags')->
	// 	select('subtags.subtag_name','subtags.id')
	// 	->join('subtags','subtags.id','=','option_subtags.sub_tag_id')
	// 	->whereIn('option_subtags.option_id',$options)->where('option_subtags.menu_id', $menu_id)->get();
	//
	// 	if(sizeof($subtags) == 0) return false;
	//
	// 	if($type == 0){
	// 		return $subtags;
	// 	} elseif ($type == 1){
	// 		$ar = [];
	// 		foreach ($subtags as $subtag) {
	// 			$ar[] = $subtag->subtag_name;
	// 		}
	// 		return implode(', ', $ar);
	// 	} elseif ($type == 2){
	// 		$ar = [];
	// 		foreach ($subtags as $subtag) {
	// 			$ar[] = $subtag->id;
	// 		}
	// 		return $ar;
	// 	}
	//
	// 	//$query = Answer::select('subtags.subtag_name')->whereIn('question_id',array(7,20))->leftJoin('option_subtags','answers.option_id','=','option_subtags.option_id')->leftJoin('subtags','subtags.id','=','option_subtags.sub_tag_id')->lists('subtags.subtag_name');
	// }

}
