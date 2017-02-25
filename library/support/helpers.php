<?php
/**
 * Created by Artdevue.
 * User: artdevue - helpers.php
 * Date: 25.02.17
 * Time: 16:00
 * Project: phalcon-blank
 */

function array_get($array, $key, $default = null)
{
    if (is_null($key)) return $array;

    if (isset($array[$key])) return $array[$key];

    foreach (explode('.', $key) as $segment)
    {
        if ( ! is_array($array) or ! array_key_exists($segment, $array))
        {
            return value($default);
        }

        $array = $array[$segment];
    }

    return $array;
}

function value($value)
{
    return $value instanceof Closure ? $value() : $value;
}

function str_contains($haystack, $needles)
{
    foreach ((array) $needles as $needle)
    {
        if ($needle != '' && strpos($haystack, $needle) !== false) return true;
    }

    return false;
}

function with($object)
{
    return $object;
}
