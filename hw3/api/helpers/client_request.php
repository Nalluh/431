<?php

class ClientRequest
{
    public $files;
    public $put;
    public $post;
    public $get;
    public $jsonData;
    public $method;
    public $db;
    public $clientIP;
    public string $uri;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->files = $_FILES;
        $this->post = $_POST;
        $this->get = $_GET;
        $this->uri = $_SERVER['REQUEST_URI'];

        $inputStream = file_get_contents("php://input");

        if (!function_exists("json_validate")) {
            function json_validate($string)
            {
                json_decode($string);
                return json_last_error() === JSON_ERROR_NONE;
            }
        }

        // Was the input JSON? 
        if (json_validate($inputStream)) {
            $this->put = json_decode($inputStream); // make "put" the decoded JSON            $this->post = json_decode($inputStream, true);
            $this->post = json_decode($inputStream, true);
            $this->jsonData = $this->put; // Copy to jsonData (optional, just makes it easier to read). 
        } else {
            parse_str($inputStream, $this->put); // not JSON, parse the raw input into the variable
        }



        // if we got a "json" value from POST or PUT, let's just 
        // decode it and set those values. 

        $postJson = $_POST['json'] ?? false;
        $putJson = $this->put['json'] ?? false;

        if ($postJson) {
            $this->post = json_decode($postJson, true);
            // keep the 'json' property for backwards compatability
            $this->post['json'] = $postJson;
        }

        if ($putJson) {
            $this->put = json_decode($putJson, true);
            // keep the 'json' property for backwards compatability
            $this->put['json'] = $putJson;
        }
    }
}
