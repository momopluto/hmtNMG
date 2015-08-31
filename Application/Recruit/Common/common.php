<?php
/**
 * Recruit公共函数
 */

/**
 * 预处理简历数据
 * @param mix &$temp 简历数据
 */
function pre_process_resume_data(&$temp){

	// 预处理
	$temp['province'] 			= str_replace('省', '', $temp['province']);
	$temp['city']			 	= str_replace('市', '', $temp['city']);
	$temp['race']				= str_replace('族', '', $temp['race']);
	$temp['college']			= str_replace('学院', '', $temp['college']);
	$temp['major']				= str_replace('专业', '', $temp['major']);
	$temp['building']			= str_replace('栋', '', $temp['building']);
	$temp['room']				= str_replace('房', '', $temp['room']);
}

/**
 * 格式化数据库内简历数据->简历表单数据
 * @param  mix $resume 数据库内简历数据
 * @return mix         简历表单数据
 */
function format_sqlData_to_formData($resume){

	$temp['name'] 					= $resume['name'];
	$temp['gender']					= $resume['gender'];
	$temp['birthday']				= $resume['birthday'];


	$birth_place = explode('省', $resume['birth_place']);
	$province = $birth_place[0];
	// p($birth_place);
	$birth_place = explode('市', $birth_place[1]);
	$city = $birth_place[0];
	// p($birth_place);
	$temp['province']				= $province;
	$temp['city']					= $city;

	$temp['race']					= $resume['race'];
	$temp['college']				= $resume['college'];
	$temp['major']					= $resume['major'];
	$temp['short_phone']			= $resume['short_phone'];

	$address = explode('区', $resume['address']);
	$district = $address[0];
	// p($address);
	$address = explode('栋', $address[1]);
	$building = $address[0];
	// p($address);
	$address = explode('房', $address[1]);
	$room = $address[0];
	// p($address);
	$temp['district']				= $district;
	$temp['building']				= $building;
	$temp['room']					= $room;
	

	$temp['willing_district']		= $resume['willing_district'];
	$temp['accept_deploy']			= $resume['accept_deploy'];
	$temp['free_time']				= explode(',', $resume['free_time']);
	$temp['hobbies_n_expertise']	= $resume['hobbies_n_expertise'];
	$temp['reason']					= $resume['reason'];
	$temp['skill_level']			= $resume['skill_level'];
	$temp['joined_group']			= $resume['joined_group'];
	$temp['self_assessment']		= $resume['self_assessment'];

	return $temp;
}

/**
 * session里的简历标识数据->添加/覆盖->简历cookie数据
 * @param mix &$temp 简历cookie数据
 */
function process_sessionInfo_to_Data(&$temp){

	$info = session("RESUME_INFO");
	// 使用session里面的标识数据
	$temp['stu_id'] 		= $info['stu_id'];
	$temp['phone']			= $info['phone'];
	$temp['cv_flag'] 		= $info['cv_flag'];
}


?>