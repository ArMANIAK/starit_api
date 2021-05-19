<?php

    namespace classes;

    class Request 
    {
        function __construct()
        {
            $this->host = $_SERVER['HTTP_HOST'];
            $this->uri = $_SERVER['REQUEST_URI'];
            $this->method = $_SERVER['REQUEST_METHOD'];
            $this->query = $_SERVER['QUERY_STRING'];
        }

        function printRequest() 
        {
            var_dump($this);
        }
    }