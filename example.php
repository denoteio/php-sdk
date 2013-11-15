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

ini_set('display_errors',1); 
error_reporting(E_ALL);

    include('Denote.php');


    // Set access_token. This key can be found in your dashboard 
    Denote::initClient('535a12b0febcc946530eb001d85b6a923f72b7c9');


    ////////////////////////////////////
    // System
    ////////////////////////////////////

    try{
        $response = DenoteAPI::version();
        pre($response);
    } catch (DenoteException $e){
        echo $e;
    }


    ////////////////////////////////////
    // User Quotas
    ////////////////////////////////////

    try{
        $response = DenoteUser::limits();
        pre($response);
    } catch (DenoteException $e){
        echo $e;
    }




	////////////////////////////////////
    // Engine
    ////////////////////////////////////

	


    // Create an Engine
	try {

		$response = DenoteEngine::create(array(
    	    'engine_name'   =>      'Human Resources'              // A name for the search engine
    	));

    } catch (DenoteException $e){
    	echo $e;
    }


    // Get a specific engine info
	try {

		$engineId = 'dEn5285acaf11a003r3qs59429474ote';
    	$response = DenoteEngine::get($engineId);
        pre($response);
    } catch (DenoteException $e){
    	echo $e;
    }


    // Get all engines
    try {

        $response = DenoteEngine::getAll();
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }


    // Remove a specific engine info
    try {

        $engineId = 'dEn5285acaf11a003r3qs59429474ote';
        $response = DenoteEngine::remove($engineId);
        pre($response);
    } catch (DenoteException $e){
        echo $e;
    }


    // Create a Document
    try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $response = DenoteDocument::create($engineId, array(
            'bucket_name'   =>      'Software Engineer',        // Name for this bucket
            'external_id'   =>      'A3E213EDF',                // An external ID to locate the document within companies records
            'content_type'  =>      'application/pdf',          // A content type to distinguish content. e.g. text, html/text
            'fields'        =>      array(
                array(
                    'name'     =>      'Full name',
                    'value'    =>      'Reza Bashash',
                    'type'     =>      'text',
                    'boost'    =>      5
                ),
                array(
                    'name'     =>      'Education',
                    'value'    =>      'Phd in Mathematics',
                    'type'     =>      'text'
                ),
                array(
                    'name'     =>      'Work Experience',
                    'value'    =>      'CTO, Founder of Sidebuy Technologies Inc. Reza has been responsible for...',
                    'type'     =>      'text'
                ),
                array(
                    'name'     =>      'age',
                    'value'    =>      28,
                    'type'     =>      'number'
                )                    
            )
        ));
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }

     // Create Multiple documents in the same call   
     try {
        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $response = DenoteDocument::createMultiple($engineId, array(
            'bucket_name'   =>      'Contacts',        // Name for this bucket
            'documents'     =>      array(
                array(
                    'external_id'   =>      'A3E213'.rand(0,50),         // An external ID to locate the document within companies records
                    'content_type'  =>      'application/pdf',          // A content type to distinguish content. e.g. text, html/text
                    'fields'        =>      array(
                        array(
                            'name'     =>      'Full name',
                            'value'    =>      'Reza Bashash',
                            'type'     =>      'text',
                            'boost'    =>      5
                        ),
                        array(
                            'name'     =>      'Organization',
                            'value'    =>      'Denote Enterprises Inc.',
                            'type'     =>      'text',
                            'boost'    =>       3
                        )
                    )      
                ),
                array(
                    'external_id'   =>      'A3E213'.rand(0,50),         // An external ID to locate the document within companies records
                    'content_type'  =>      'application/pdf',          // A content type to distinguish content. e.g. text, html/text
                    'fields'        =>      array(
                        array(
                            'name'     =>      'Full name',
                            'value'    =>      'Jack Daniels',
                            'type'     =>      'text',
                            'boost'    =>      5
                        )
                    )      
                ),                                  
            )
        ));
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }



    // Modify a Document
    try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $documentId = '5285c6da46b1f4b02d1883ce';
        $response = DenoteDocument::modify($engineId, $documentId, array(
            'bucket_name'   =>      'Hired',        // Name for this bucket
            'external_id'   =>      'A3E213EDF',                // An external ID to locate the document within companies records
            'content_type'  =>      'application/pdf',          // A content type to distinguish content. e.g. text, html/text
            'fields'        =>      array(
                array(
                    'name'     =>      'Full name',
                    'value'    =>      'Reza Bashash',
                    'type'     =>      'text',
                    'boost'    =>      5
                )
            )
        ));
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }




    // Get a document
    try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $documentId = '5285bc4146b1f4b02d1883a7';
        $response = DenoteDocument::get($engineId, $documentId);
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }


    // Get all documents
    try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $response = DenoteDocument::getAll($engineId, array(
            'limit'         =>          '0-10',                    // Limit number of documents, (start-skip)
            'bucket_name'   =>          '/Contacts.*/i',           // An optional PCRE regular expression to specify bucket_name. If not provided all buckets are searched
            'external_id'   =>          '/A3.*/'                   // An optional PCRE regular expression to specify external_id. If not provided all external_ids are searched
        ));
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }


    // Remove a document
    try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $documentId = '5285bc4146b1f4b02d1883a7';
        $response = DenoteDocument::remove($engineId, $documentId);
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }



    // Remove documents
    try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $response = DenoteDocument::removeAll($engineId, array(
            'bucket_name'   =>          '/Contacts.*/i',           // An optional PCRE regular expression to specify bucket_name. If not provided all buckets are searched and removed
            'external_id'   =>          '/A3.*/'                   // An optional PCRE regular expression to specify external_id. If not provided all external_ids are searched and removed
        ));
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }


function pre($s){
    echo '<pre>';
    print_r($s);
    echo '</pre>';
}





?>