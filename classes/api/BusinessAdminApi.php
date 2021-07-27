<?php

// namespace classes\api;

// use classes\api\Api;

    class BusinessAdminApi extends Api 
    {
        function __construct(Request $request)
        {
            $this->relatedTable = 'business_admin';
            parent::__construct($request);
        }

    }