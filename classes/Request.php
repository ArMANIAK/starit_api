<?php

    class Request 
    {
        private $host;
        private $uri;
        private $method;
        private $getParams;
        private $postParams;
        private $resource;
        private $arguments;

        function __construct()
        {
            $this->host = $_SERVER['HTTP_HOST'];
            $this->uri = $_SERVER['REQUEST_URI'];
            $this->method = $_SERVER['REQUEST_METHOD'];
            $this->getParams = $_GET;
            $this->postParams = $_POST;
            $argString = explode('?', $this->uri)[0];
            if (strlen($argString) > 5)
            {
                $argArray = explode('/', substr(rtrim($argString, "/"), 5));
                $resourceParts = explode('_', $argArray[0]);
                foreach ($resourceParts as &$part) {
                    $part = ucfirst($part);
                }
                $this->resource = implode('', $resourceParts);
                if (count($argArray) > 1)
                {
                    $this->arguments = array_slice($argArray, 1);
                }
            }
        }

        public function __get($attr)
        {
            return $this->{$attr};
        }
    }