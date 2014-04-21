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
    Denote::initClient('48182b7054d67815f49ef47bbdd1a24f4c3ba2ef');

    ////////////////////////////////////
    // System Version
    ////////////////////////////////////

    try{
        $response = DenoteAPI::version();
        pre($response);
    } catch (DenoteException $e){
        echo $e;
    }


    ////////////////////////////////////
    // System Status
    ////////////////////////////////////

    try{
        $response = DenoteAPI::status();
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
   //     $response = DenoteDocument::remove($engineId, $documentId);
     //   pre($response);

    } catch (DenoteException $e){
        echo $e;
    }



    // Remove documents
    try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
     //   $response = DenoteDocument::removeAll($engineId, array(
     //       'bucket_name'   =>          '/Contacts.*/i',           // An optional PCRE regular expression to specify bucket_name. If not provided all buckets are searched and removed
      //      'external_id'   =>          '/A3.*/'                   // An optional PCRE regular expression to specify external_id. If not provided all external_ids are searched and removed
     //   ));
     //   pre($response);

    } catch (DenoteException $e){
        echo $e;
    }



// Domains


    // Create a Domain
    try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $response = DenoteDomain::create($engineId, array(
            'domain'   =>      'www.inextweb.com',
            'seeds'   =>        array(
                'www.inextweb.com/contactus',
                'www.inextweb.com/aboutus'
            ),
            'patterns'   =>     array(
                '!www.inextweb.com/image*',
                'www.inextweb.com/a*'
            ),
        ));
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }

    // Modify a Domain
    try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $domainId = '5285c6da46b1f4b02d1883ce';
        $response = DenoteDomain::modify($engineId, $domainId, array(
            'domain'   =>      'www.inextweb.com',
            'seeds'   =>        array(
                'www.inextweb.com/contactus',
                'www.inextweb.com/aboutus'
            ),
            'patterns'   =>     array(
                '!www.inextweb.com/image*',
                'www.inextweb.com/a*'
            ),
        ));
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }




    // Get a domain
    try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $domainId = '5285bc4146b1f4b02d1883a7';
        $response = DenoteDomain::get($engineId, $domainId);
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }


    // Get all domains
    try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $response = DenoteDomain::getAll($engineId);
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }


    // Remove a domain
    try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $domainId = '5285bc4146b1f4b02d1883a7';
        $response = DenoteDomain::remove($engineId, $domainId);
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }

// Search


    // Simple search
     try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $response = DenoteSearch::search($engineId, array(
            "q"  =>  "today",
            "page"    =>  1,
            "per_page" =>  4,
            "visitor_id" => "123"// optional
        ));
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }
   



   // Advanced Search
     try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $response = DenoteSearch::search($engineId, array(
            "q"             =>  "Software Developer",
            "page"          =>  1,
            "per_page"      =>  4,
            "buckets"       => array("cvss","jobs"),
            "search_fields" => array("Programming Skills^12", "title^3~1"),
            "return_fields" => array("title", "salary"),
            "facets"        => array("title", "salary"),
            "sort"          => array("salary:desc", "title:asc"),
            "filters"       => array(
                array(
                    "method"   : "range",
                    "type"     : "float",
                    "field"    : "salary",
                    "from"     : 1,
                    "to"       : 120000
                ),
                array(
                    "method"    : "range",
                    "type"      : "float",
                    "field"     : "bonus",
                    "from"      : 1,
                    "to"        : 10000
                )
            ),
            "visitor_id"    => "123"// optional
        ));
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }    



// Analytics


    // Get all Searches
    try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $response = DenoteAnalytics::allSearches($engineId, array(
            "from"  =>  "today",
            "to"    =>  "now",
            "query" =>  "test" // optional
        ));
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }

    // Count all Searches
    try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $response = DenoteAnalytics::countTotalSearches($engineId, array(
            "from"  =>  "today",
            "to"    =>  "now",
            "query" =>  "test", // optional
            "interval"  =>  1800 // optional - Number of seconds
        ));
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }

    // Count all Searches that had results
    try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $response = DenoteAnalytics::countTotalSearchesWithResults($engineId, array(
            "from"  =>  "today",
            "to"    =>  "now",
            "query" =>  "test", // optional
            "interval"  =>  1800 // optional - Number of seconds
        ));
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }

    // Count all Searches that did not have results
    try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $response = DenoteAnalytics::countTotalSearchesWithNoResults($engineId, array(
            "from"  =>  "today",
            "to"    =>  "now",
            "query" =>  "test", // optional
            "interval"  =>  1800 // optional - Number of seconds
        ));
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }



    // Get all clicks
    try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $response = DenoteAnalytics::allClicks($engineId, array(
            "from"  =>  "today",
            "to"    =>  "now",
            "query" =>  "test", // optional
            "document_id" =>  "52ab7cdd0744231fe31c25a8" // optional
        ));
        pre($response);

    } catch (DenoteException $e){
        echo $e;
    }

    // Count all Searches
    try {

        $engineId = 'dEn5285b7fc49de98r3qs65001529ote';
        $response = DenoteAnalytics::countTotalClicks($engineId, array(
            "from"  =>  "-1 hour",
            "to"    =>  "now",
            "query" =>  "test", // optional
            "document_id" =>  "52ab7cdd0744231fe31c25a8", // optional
            "interval"  =>  1800 // optional - Number of seconds
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