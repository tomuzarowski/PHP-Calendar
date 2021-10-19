<?php

namespace Calendar;

class Utils
{
    public function dump($data) {
        echo "<pre style='background: lime; padding: 1em;'>";
        print_r($data);
        echo "</pre>";
    }
}