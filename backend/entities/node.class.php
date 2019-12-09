<?php
/**
 * User: Jose J. Pardines
 * Date: 2019-12-08
 */
require_once("./config/config.class.php");

class Node extends Config
{

    private $response = [
        "nodes" => []
    ];
    private $db = null;
    private $default_params = [
        "node_id" => 0,
        "language" => "",
        "search_keyword" => "",
        "page_num" => 1,
        "page_size" => 100
    ];

    // Constructor
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Get nodes filtering by params
     *
     * @param array $params List of params for filter
     */
    public function getNodes($params)
    {
        if ($this->validateParams($params)) {
            $params['page_num'] = isset($params['page_num']) ? $params['page_num'] : $this->default_params["page_num"];
            $params['page_size'] = isset($params['page_size']) ? $params['page_size'] : $this->default_params["page_size"];
            $search_keyword = isset($params['search_keyword']) ? $params['search_keyword'] : $this->default_params["search_keyword"];
            $search_keyword = "%$search_keyword%";
            try {
                $sql = 'SELECT distinct nt.idNode as node_id,
                                ntn.nodaName as name,
                                (SELECT count(nt2.idNode)
                                 FROM node_tree as nt2
                                 WHERE nt2.idNode >= nt.iLeft
                                   AND nt2.idNode <= nt.iRight
                                   AND nt2.level = nt.level + 1) as children_count
                FROM node_tree as nt, node_tree as nt_parent, node_tree_names ntn
                WHERE nt.idNode >= nt_parent.iLeft
                AND nt.idNode <= nt_parent.iRight
                AND nt.level = nt_parent.level + 1
                AND nt_parent.idNode = ?
                AND ntn.language = ?
                AND nt.idNode = ntn.idNode
                AND ntn.nodaName LIKE ?
                LIMIT ?, ?';
                $query = $this->db->prepare($sql);
                $params['page_num'] = ($params['page_num'] - 1) * $params['page_size'];
                if ($query) {
                    $query->bind_param(
                        'issii',
                        $params['node_id'],
                        $params['language'],
                        $search_keyword,
                        $params['page_num'],
                        $params['page_size']
                    );

                    if ($query->execute()) {
                        $result = $query->get_result();
                        if($result) {
                            while ($row = $result->fetch_assoc()) {
                                array_push($this->response['nodes'], $row);
                            }
                        }
                    } else {
                        $this->setError($this->db->error, 500);
                    }
                } else {
                    $this->setError($this->db->error, 500);
                }
                $this->db->close();
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }
    }

    /**
     * Validate the params before do a query
     *
     * @param array $params Params with options to search nodes
     * @return bool Return true if params are correct
     */
    private function validateParams($params)
    {
        $valid = false;
        if (
            !isset($params['node_id']) ||
            !is_numeric($params['node_id'])
        ) {
            $this->setError("Invalid node id", 400);
        } elseif (!isset($params['language'])) {
            $this->setError("Missing mandatory params", 400);
        } elseif (
            isset($params['page_num']) &&
            (!is_numeric($params['page_num']) || $params['page_num'] < 0)
        ) {
            $this->setError("Invalid page number requested", 400);
        } elseif (
            isset($params['page_size']) &&
            ($params['page_size'] < 0 || $params['page_size'] > 100)
        ) {
            $this->setError("Invalid page size requested", 400);
        } else {
            $valid = true;
        }
        return $valid;
    }

    /**
     * Set a error message to send
     *
     * @param string $message Error message to send
     */
    public function setError($message, $code)
    {
        http_response_code($code);
        $field = "error";
        if (isset($this->response[$field])) {
            unset($this->response[$field]);
        }

        $this->response[$field] = $message;
    }

    /**
     * Set connection to MySQL
     *
     * @param mysqli $db PDO MySQL connection
     */
    public function setDB($db)
    {
        $this->db = $db;
    }

    /**
     * Overwrite toString to transform response into JSON
     *
     * @return string JSON response
     */
    public function __toString()
    {
        return json_encode($this->response);
    }
}
