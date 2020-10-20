<?php

class KFProxy
{
    private $token;
    private $url;
    private $headers;
    private $host;
    
    private static $hostWhitelist = ["https://services.kortforsyningen.dk/", "http://services.kortforsyningen.dk/", "https://test-service.kortforsyningen.dk/", "http://test-service.kortforsyningen.dk/"];

    public function __construct($url = null)
    {
        //$this->host = "https://test-service.kortforsyningen.dk";
        $this->host = "https://services.kortforsyningen.dk";
        $this->url = isset($url) ? $url : null;
        $this->token = "InsertKortforsyningenTokenHere";
        $this->headers = [
            "Content-Type: application/json",
            "token: ".$this->token
        ];
    }
    public function __destruct()
    {
    }

    public function setUrl($url) 
    {
        $this->url = $url;
    }

    public function getHost() 
    {
        return $this->host;
    }

    public function getUrl() 
    {
        return $this->url;
    }

    public function getToken() 
    {
        return $this->token;
    }

    public function getData() 
    {
        if (!$this->urlHostIsWhitelisted()) {
            throw new Error("URL not whitelisted");
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER => $this->headers
        ]);
        $data = json_decode(curl_exec($curl), true);
        curl_close($curl);
        return $data;
    }
    
    public function postData($params) 
    {
        if (!$this->urlHostIsWhitelisted()) {
            throw new Error("URL not whitelisted");
        }

        //$fp = fopen(dirname(__FILE__).'/errorlog.txt', 'w');
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_VERBOSE => 1,
            //CURLOPT_STDERR => $fp
        ]);
        $data = json_decode(curl_exec($curl), true);
        curl_close($curl);
        return $data;
    }

    public function urlHostIsWhitelisted()
    {
        foreach (KFProxy::$hostWhitelist as $host) {
            if (substr($this->url, 0, strlen($host)) === $host) {
                return true;
            }
        }

        return false;
    }
}
