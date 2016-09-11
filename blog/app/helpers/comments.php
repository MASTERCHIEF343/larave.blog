<?php
//get comments
function getcomments($model,$parent_id = 0,&$result = array()){
	$comments = DB::table($model)->where('parent_id', '=', $parent_id)->get();
	$model = $model;
	if(empty($comments)){
		return array();
	}
	foreach ($comments as $cm) {
		$thisArr = &$result[];
		$cm->children = getcomments($model,$cm->id,$thisArr);
		$thisArr = $cm;
	}
	return $result;	
}