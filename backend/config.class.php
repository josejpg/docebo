<?php
/**
 * User: Jose J. Pardines
 * Date: 2019-12-08
 *
 * It has the API config.
 */

class Config
{

    // Conections list with Localhost by default
    private $conections = [];

    // Constructor
    public function __construct()
    {
        try {
            $this->setDefaultConection();
        }catch (Exception $ex){
            echo $ex->getMessage();
        }
    }

    /**
     * Set a default connection to Localhost
     * @throws Exception
     */
    private function setDefaultConection()
    {
        $connection = [
            'host' => 'localhost',
            'user' => 'root',
            'password' => '',
            'database' => 'docebo',
            'charset' => 'utf8mb4',
        ];
        try {
            $this->addConection("localhost", $connection);
        } catch (Exception $ex) {
            echo 'Failed adding default connection: ' . $ex->getMessage();
        }
    }

    /**
     * Add new connection for MySQL
     *
     * @param string $nameConnection Name of the new connection
     * @param array $connection Connection data
     * @throws Exception
     */
    public function addConection($nameConnection, $connection)
    {
        if (isset($connection['host']) &&
            isset($connection['user']) &&
            isset($connection['password']) &&
            isset($connection['database'])) {
            $connection['charset'] = isset($connection['charset']) ? $connection['charset'] : 'utf8mb4';
            $this->conections[$nameConnection] = $connection;
        } else {
            throw new Exception('All fields of connection are mandatory: host, user, password, database');
        }
    }

    /**
     * Return a PDO conection based on conenection name data
     * @param string $nameConnection Name of connection
     * @return mysqli MySQL connection
     */
    public function connect($nameConnection)
    {
        $db = null;
        $connectionData = $this->getDataConnection($nameConnection);

        if (isset($connectionData) && count($connectionData) > 0) {

            $db = new mysqli($connectionData['host'], $connectionData['user'], $connectionData['password'], $connectionData['database']);

            if (mysqli_connect_errno()) {
                printf("Connection failed: %s\n", mysqli_connect_error());
                exit();
            }
        }
        return $db;
    }

    /**
     * Return data connection for name given.
     *
     * @param string $nameConnection Name of the connection
     * @return array Connection data
     */
    private function getDataConnection($nameConnection)
    {
        if (isset($this->conections[$nameConnection])) {
            return $this->conections[$nameConnection];
        }
        return [];
    }
}
