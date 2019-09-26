<?php
    include_once __DIR__.'/Classes/KFProxy.php';

    // these parameters are sent by Bootstrap Table using GET. All other search criterias are transfered using SESSION variables
    $input = filter_input_array(INPUT_GET);
    $pagesize = isset($input['pagesize']) ? filter_var($input['pagesize'], FILTER_SANITIZE_NUMBER_INT) : 100;
    $offset = isset($input['offset']) ? filter_var($input['offset'], FILTER_SANITIZE_NUMBER_INT) : 0;
    $direction = !empty($input['direction']) ? filter_var($input['direction'], FILTER_SANITIZE_STRING) : 'asc';
    $sort = !empty($input['sort']) ? filter_var($input['sort'], FILTER_SANITIZE_STRING) : 'id';
    
    $kortvaerk = !empty($input['kortvaerk']) ? filter_var($input['kortvaerk'], FILTER_SANITIZE_STRING) : null;
    $daekningsomraade = !empty($input['daekningsomraade']) ? filter_var($input['daekningsomraade'], FILTER_SANITIZE_STRING) : null;
    $maalestok = !empty($input['maalestok']) ? filter_var($input['maalestok'], FILTER_SANITIZE_STRING) : null;

    $titel = !empty($input['titel']) ? filter_var($input['titel'], FILTER_SANITIZE_STRING) : null;
    $gyldighedsaar = !empty($input['gyldighedsaar']) ? filter_var($input['gyldighedsaar'], FILTER_SANITIZE_NUMBER_INT) : NULL;
    $kortbladnummer = !empty($input['kortbladnummer']) ? filter_var($input['kortbladnummer'], FILTER_SANITIZE_STRING) : null;

    $bemaerk = !empty($input['bemaerk']) ? filter_var($input['bemaerk'], FILTER_SANITIZE_STRING) : null;
    $geometri = !empty($input['geometri']) ? filter_var($input['geometri'], FILTER_SANITIZE_STRING) : null;

    
    // Make an object of search criterias
    $postdata = [];
    $postdata["kortvaerk"] = isset($kortvaerk) ? $kortvaerk : null;
    $postdata["daekningsomraade"] = isset($daekningsomraade) ? $daekningsomraade : null;
    $postdata["maalestok"] = isset($maalestok) ? $maalestok : null;
    $postdata["titel"] = isset($titel) ? $titel : null;
    $postdata["gyldighedsaar"] = isset($gyldighedsaar) ? $gyldighedsaar : null;
    $postdata["kortbladnummer"] = isset($kortbladnummer) ? $kortbladnummer : null;
    $postdata["bemaerk"] = isset($bemaerk) ? $bemaerk : null;
    $postdata["geometri"] = isset($geometri) ? $geometri : null;
    $postdata["pagesize"] = isset($pagesize) ? $pagesize : null;
    $postdata["offset"] = isset($offset) ? $offset : null;
    $postdata["direction"] = isset($direction) ? $direction : null;
    $postdata["sort"] = isset($sort) ? $sort : null;

    // Remove empty values
    $postdata = array_filter($postdata);    

    // API URL
    $url = "/rest/arkivmeta/kort";

    $proxy = new KFProxy();
    $proxy->setUrl($proxy->getHost().$url);
    $data = $proxy->postData(json_encode($postdata));
    
    
    // Output data
    header("HTTP/1.1 200 OK");
    echo json_encode([
        'total' => isset($data["total"]) ? $data["total"] : 0,
        'rows' => isset($data["kort"]) ? array_values($data["kort"]) : null
    ]);
