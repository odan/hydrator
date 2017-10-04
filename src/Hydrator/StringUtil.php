<?php

namespace Odan\Hydrator;

class StringUtil
{

    /**
     * Convert a value to lower camel case.
     *
     * @param  string $value
     * @return string
     */
    public static function camel($value)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));
        return lcfirst(str_replace(' ', '', $value));
    }

    /**
     * Convert a string to snake case.
     *
     * @param string $value
     * @param string $delimiter
     * @return string
     */
    public static function snake($value, $delimiter = '_')
    {
        $value = preg_replace('/\s+/u', '', $value);
        $value = preg_replace('/(.)(?=[A-Z])/u', '$1' . $delimiter, $value);
        return mb_strtolower($value, 'UTF-8');
    }
}
