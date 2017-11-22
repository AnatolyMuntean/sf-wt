<?php

namespace AppBundle\Services;

class SluggerService
{
    public function slugify($input)
    {
        $input = mb_strtolower($input);

        if (function_exists('iconv')) {
            $input = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $input);
        }

        return trim(preg_replace('/\W|\s+/', '-', $input));
    }
}
