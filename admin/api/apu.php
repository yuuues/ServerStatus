<?php
    /*
     * The MIT License
     *
     * Copyright 2016 Kyto
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

    $text_result = 'Nyah';
    require_once '../../vendor/autoload.php';
    include "../lib/_autoload.php";
    include "../../config/ky-config.php";

//filters to stop execution
    (isset($_POST['action']) && ($dbo->AuthClass->checkSession($cookies['Auth'])) or $_POST['action']
        == 'login') or die('Nyah');

    if (@include 'ex/'.$_POST['action'].'.php') {
        json_encode($text_result);
        echo json_encode($text_result);
    } else {
        echo 'Error 418<br/>I\'m a teapot';
    }