<?php
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    spl_autoload_register(function ($nombre_clase) {
        include strtolower($nombre_clase).'.php';
    });
    