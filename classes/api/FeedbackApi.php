<?php

// namespace classes\api;

// use classes\api\Api;

    class FeedbackApi extends Api 
    {
        function __construct(Request $request)
        {
            $this->relatedTable = 'feedback';
            parent::__construct($request);
        }
        
        function getList()
        {
            parent::getList();
            // echo '<p>This is get list method of FeedbackApi</p>';
        }

        function getOne($params)
        {
            parent::getOne($params);
            // echo '<p>This is get one method of FeedbackApi</p>';
        }

        function insert($params, $post)
        {
            parent::insert($params, $post);
            // echo '<p>This is insert method of FeedbackApi</p>';
        }
    }