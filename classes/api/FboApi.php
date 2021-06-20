<?php

// namespace classes\api;

// use classes\api\Api;

    class FboApi extends Api 
    {
        function __construct(Request $request)
        {
            $this->relatedTable = 'feedback_object';
            parent::__construct($request);
        }
        
        // function getList()
        // {
        //     parent::getList();
        //     // echo '<p>This is get list method of FboApi</p>';
        // }

        // function getOne($params)
        // {
        //     parent::getOne($params);
        //     // echo '<p>This is get one method of FboApi</p>';
        // }

        // function insert($params, $post)
        // {
        //     parent::insert($params, $post);
        //     // echo '<p>This is insert method of FboApi</p>';
        // }
    }