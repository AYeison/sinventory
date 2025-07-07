<?php

if(!function_exists('get_template_part')):

            function get_template_part($slug, $name){
                $dir = dirname(__DIR__) . '/templates/';
                $file = $dir . $slug . '-' . $name . '.php';

                return file_exists($file) ? include $file : false;

            }
endif;