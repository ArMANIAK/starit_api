<?php

// namespace classes\api;

// use classes\api\Api;

    class BusinessApi extends Api 
    {
        function __construct(Request $request)
        {
            $this->relatedTable = 'business';
            parent::__construct($request);
        }

        // function getList()
        // {
        //     parent::getList();
        //     // echo '<p>This is get list method of BusinessApi</p>';
        // }

        // function getOne($params)
        // {
        //     parent::getOne($params);
        //     // echo '<p>This is get one method of BusinessApi</p>';
        // }
    }