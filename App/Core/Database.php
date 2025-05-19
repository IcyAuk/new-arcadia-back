<?php 

//opens and closes database connection

namespace App\Core;

//defined('ROOTPATH') OR exit('Access Denied!');

use Exception;

Trait Database
{

    private static $pdo = null; //static is accessible without creating an object of the class

    public static function openDatabaseConnection(): \PDO
    {
        if (self::$pdo === null)
        {
            /*
            $host = DBHOST;
            $port = DBPORT ?? '';
            $dbname = DBNAME;
            $username = DBUSER;
            $password = DBPASS;
            $charset = DBCHARSET ?? 'utf8'; // Character set
            */

            $host = "localhost";
            $port = '3306';
            $dbname = "new-arcadia-db";
            $username = "root";
            $password = "";
            $charset = 'utf8'; // Character set

            if(IS_DOMAIN_DEPLOYED)
            {
                //mind the pgsql dsn
                $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$username;password=$password;options='--client_encoding=$charset'";
            }
            else
            {
                if (!empty($port)) {
                    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
                } else {
                    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
                }
            }

            try
            {
                self::$pdo = new \PDO($dsn, $username, $password);
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

                return self::$pdo;
            }
            catch (\PDOException $e)
            {
                error_log("Database connection failed: " . $e->getMessage());
                die(json_encode(['error' => 'Database connection failed', 'details' => $e->getMessage()]));
            }
            
        }
        return self::$pdo;
    }

    public static function closeDatabaseConnection(): void
    {
        self::$pdo = null;
    }

	public function query($query, $data = [])
	{

		$con = $this->openDatabaseConnection();
		$stm = $con->prepare($query);

		$check = $stm->execute($data);
		if($check)
		{
			$result = $stm->fetchAll(\PDO::FETCH_OBJ);
			if(is_array($result) && count($result))
			{
				return $result;
			}
		}

		return false;
	}

	public function get_row($query, $data = [])
	{

		$con = $this->openDatabaseConnection();
		$stm = $con->prepare($query);

		$check = $stm->execute($data);
		if($check)
		{
			$result = $stm->fetchAll(\PDO::FETCH_OBJ);
			if(is_array($result) && count($result))
			{
				return $result[0];
			}
		}

		return false;
	}

	
}