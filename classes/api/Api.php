<?php
// namespace classes\api;

require_once dirname(__FILE__, 2) . "/Request.php";

    abstract class Api 
    {
        public $relatedTable;

        public function __construct(Request $request) {
            
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
            header('Access-Control-Request-Headers: Content-Type');
            header('Content-Type: application/json');
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
            $queryResult = $this->db->query("SELECT * FROM {$this->relatedTable}");
            $result = $queryResult ? $queryResult->fetchAll() 
                : ($queryResult === FALSE 
                    ? array('error message' => 'Connection failed') 
                    : array('error message' => 'Got nothing'));
            echo json_encode($result); 
        }

        public function getOne($params) 
        { 
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
            if (empty($arguments))
            {
                $keys = "\"" . implode("\", \"", array_filter(array_keys($post), fn($index) => $index !== 'id')) . "\"";
                $values = "\"" . trim(implode("\", \"", array_filter($post, fn($index) => $index !== 'id')), ', ') . "\"";
                $queryString = "INSERT INTO {$this->relatedTable} ({$keys}) VALUES ({$values})";
                echo $queryString;
                $queryResult = $this->db->query($queryString);
            }
            else
            {
                $setParams = '';
                foreach ($post as $key => $value)
                {
                    if (preg_match('/.*date.*/', $key))
                    {
                        continue;
                    }
                    $setParams .= "$key = $value, ";
                }
                $queryString = trim($setParams, ', ');
                $query = "UPDATE {$this->relatedTable} SET {$queryString} WHERE id={$arguments[0]}";
                echo $query;
                $queryResult = $this->db->query($query);
            }
            $result = $queryResult ? $queryResult->fetch(PDO::FETCH_ASSOC) 
                : ($queryResult === FALSE 
                    ? array('error message' => 'Connection failed') 
                    : array('error message' => 'Got nothing'));
            echo json_encode($result);
        }
        
        public function delete($id) {}

    }