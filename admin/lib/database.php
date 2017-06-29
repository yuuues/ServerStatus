<?php
    /*
     * The MIT License
     *
     * Copyright 2017 kyto.
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

    /**
     * Conection to Database Class
     */
    class Database
    {
        /**
         * @var object Objeto de acceso a la Base de Datos
         */
        public $db;
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASSWORD;
        private $dbname = DB_DATABASE;
        private $stmt;
        public $AuthConfig;
        public $AuthClass;

        public function __construct()
        {
            try {
                $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
                $options = array(
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                );
                $this->db = new PDO($dsn, $this->user, $this->pass, $options);
                //
            } catch (Exception $ex) {
                $this->error = 'DataBase::'.$ex->getMessage();
            }
            self::deployAuth();
        }

        public function deployAuth()
        {
            $this->AuthConfig = new PHPAuth\Config($this->db);
            $this->AuthClass = new PHPAuth\Auth($this->db, $this->AuthConfig);
        }
    }    