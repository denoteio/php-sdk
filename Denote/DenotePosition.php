<?php
// Denote API PHP SDK
//
// Copyright (c) 2013, 2014 All Right Reserved, http://denote.io
//
// THIS CODE AND INFORMATION ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY 
// KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
// IMPLIED WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A
// PARTICULAR PURPOSE.
//
// AUTHOR: Reza Bashash, Reza [at] denote [dot] io
// 
// Community questions and answers:
// http://stackoverflow.com/questions/tagged/denote
//
// Denote.io Knowledgebase:
// http://denote.io/knowledgebase
//
// Denote.io API Documentation:
// Denote.io/api/v1/docs
//
// API Major Version: 1


class DenotePosition{


	public function __construct(){}


	public static function getQueries($engineId){

		$connect = new DenoteConnect(Denote::$access_token);
		$result = $connect->get('engines/'.$engineId.'/position_queries');
		if (isset($result->error_id)){ // Response includes an Error
			throw new DenoteException($result->error_message, $result->error_id);
		} else {
			return $result;
		}
	}


	public static function removeQuery($engineId, $params){

		$connect = new DenoteConnect(Denote::$access_token);
		$result = $connect->get('engines/'.$engineId.'/remove_position_query', $params);
		if (isset($result->error_id)){ // Response includes an Error
			throw new DenoteException($result->error_message, $result->error_id);
		} else {
			return $result;
		}
	}

	



}
?>