<?php
    /*
     * The MIT License
     *
     * Copyright 2016 Kyto.
     *
     * Permission is hereby granted, free of charge, to any person obtaining a copy
     * of this software and associated documentation files (the "Software"), to deal
     * in the Software without restriction, including without limitation the rights
     * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
     * copies of the Software, and to permit persons to whom the Software is
     * furnished to do so, subject to the following conditions:
     *
     * The above copyright notice and this permission notice shall be included in
     * all copies or substantial portions of the Software.
     *
     * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
     * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
     * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
     * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
     * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
     * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
     * THE SOFTWARE.
     */

    class servers
    {
        /**
         * @var integer ID of the Selected Key
         */
        public $server_id = null;
        public $server_name = null;
        public $server_url = null;
        public $server_location = null;
        public $server_host = null;
        public $server_type = null;
        public $servers = array();

        /**
         * DataBase Object
         * @var object
         */
        public $db;
        public $error;

        /**
         *
         * @param object $database
         * @param type $serverName
         * @param type $serverUrl
         * @param type $serverLocation
         * @param type $serverHost
         * @param type $serverType
         */
        public function __construct($database, $serverName = null,
                                    $serverUrl = null, $serverLocation = null,
                                    $serverHost = null, $serverType = null)
        {
            $this->db = $database;
            $this->server_name = $serverName;
            $this->server_url = $serverUrl;
            $this->server_location = $serverLocation;
            $this->server_host = $serverHost;
            $this->server_type = $serverType;
        }

        /**
         * Declare a Key ID
         * @param object $database
         * @param integer $server_id
         * @overload
         */
        public static function __constructID($database, $server_id = null)
        {
            $obj = new Servers($database);
            $obj->server_id = $server_id;
            return $obj;
        }

        /**
         * Return all the active servers in an array with all the server_data table info
         * @return array
         */
        public function getServers($id = null)
        {
            try {
                $this->servers = array();

                $query = 'SELECT * FROM '.DB_DATABASE.'.servers k';
                (!is_null($id)) ? $query .= ' WHERE id = '.$id : null;
                Foreach ($this->db->query($query) as $row) {
                    $this->servers[] = $row;
                }
            } catch (Exception $ex) {
                $this->servers = array();
                $this->error = $ex->getMessage();
            }
        }

        public function createServer()
        {
            try {
                $query = 'INSERT INTO '.DB_DATABASE.'.servers (name, url, location, host, type) VALUES(:name, :url, :location, :host, :type)';
                $this->db->prepare($query)->execute(array(
                    ':name' => $this->server_name,
                    ':url' => $this->server_url,
                    ':location' => $this->server_location,
                    ':host' => $this->server_host,
                    ':type' => $this->server_type
                ));
                return true;
            } catch (Exception $ex) {
                $this->error .= 'createServer::'.$ex->getMessage();
                return false;
            }
        }

        public function deleteServer()
        {
            try {
                $query = 'DELETE FROM '.DB_DATABASE.'.servers WHERE id = :id';
                $this->db->prepare($query)->execute(array(':id' => $this->server_id));
                return true;
            } catch (Exception $ex) {
                $this->error .= 'deleteKey::'.$ex->getMessage();
                return false;
            }
        }
    }