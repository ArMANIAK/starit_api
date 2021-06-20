<?php
// namespace classes\api;

require_once dirname(__FILE__, 2) . "\\Request.php";

    abstract class Api 
    {
        public $relatedTable;

        public function __construct(Request $request) {
            
            $this->db = DbConnect::connect();

            if ($request->method === 'GET')
            {
                if ($request->arguments === NULL)
                {
                    self::getList();
                }
                else
                {
                    self::getOne($request->arguments);
                }
            }
            elseif ($request->method === 'POST')
            {
                self::insert($request->arguments, $request->postParams);
            }
            else
            {
                echo 'Something went wrong';
            }
        }

        public function getList() 
        { 
            header('Content-Type: application/json');
            $queryResult = $this->db->query("SELECT * FROM {$this->relatedTable}");
            $result = $queryResult ? $queryResult->fetchAll() 
                : ($queryResult === FALSE 
                    ? array('error message' => 'Connection failed') 
                    : array('error message' => 'Got nothing'));
            echo json_encode($result); 
        }

        public function getOne($params) 
        { 
            header('Content-Type: application/json');
            // echo '<p>Querying ' . $this->relatedTable . '</p>';
            $queryResult = $this->db->query("SELECT * FROM {$this->relatedTable} WHERE id=$params[0]");
            $result = $queryResult ? $queryResult->fetchAll() 
                : ($queryResult === FALSE 
                    ? array('error message' => 'Connection failed') 
                    : array('error message' => 'Got nothing'));
            echo json_encode($result); 
        }

        public function insert($arguments, $post) 
        {
            header('Content-Type: application/json');
            if (empty($arguments))
            {
                $keys = implode(", ", array_filter(array_keys($post), fn($index) => $index !== 'id'));
                $values = implode(", ", array_filter($post, fn($index) => $index !== 'id'));
                $queryString = "INSERT INTO {$this->relatedTable} ({$keys}) VALUES ({$values})";
                echo $queryString;
                $queryResult = $this->db->query($queryString);
            }
            else
            {
                $setParams = '';
                foreach ($post as $key => $value)
                {
                    $setParams .= "$key = $value";
                }
                $queryString = "UPDATE {$this->relatedTable} SET {$setParams} WHERE id={$arguments[0]}";
                echo $queryString;
                $queryResult = $this->db->query($queryString);
            }
            $result = $queryResult ? $queryResult->fetch(PDO::FETCH_ASSOC) 
                : ($queryResult === FALSE 
                    ? array('error message' => 'Connection failed') 
                    : array('error message' => 'Got nothing'));
            echo json_encode($result);
        }
        
        public function delete($id) {}

    }