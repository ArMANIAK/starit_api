<?php

class DbConnect 
{
    public static function connect()
    {
        $db = parse_url(getenv("DATABASE_URL"));

        $pdoObj = new PDO("pgsql:" . sprintf(
            "host=%s;port=%s;user=%s;password=%s;dbname=%s",
            $db["host"],
            $db["port"],
            $db["user"],
            $db["pass"],
            ltrim($db["path"], "/")
        ));
        return $pdoObj;
    }
}