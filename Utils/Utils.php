<?php

namespace Zyncro\Framework\Utils;

class Utils
{
    public function pre($var)
    {
        echo '<pre>';

        var_dump($var);
    }

    public function preDie($var)
    {
        $this->pre($var);

        die;
    }
}