<?php

/*
 * This file is part of consoletvs/charts.
 *
 * (c) Erik Campobadal <soc@erik.cat>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ConsoleTVs\Charts;

use Illuminate\Support\Facades\Facade;

/**
 * This is the charts facade class.
 *
 * @author Erik Campobadal <soc@erik.cat>
 */
class Charts extends Facade
{
    /**
     * Return a new chart instance.
     *
     * @param string $type
     * @param string $library
     */
    public static function new($type = null, $library = null)
    {
        return new Chart($type, $library);
    }

    /**
     * @param mixed  $data
     * @param string $type
     * @param string $library
     */
    public static function realtime($url, $interval, $type = null, $library = null)
    {
        return new Realtime($url, $interval, $type, $library);
    }

    /**
     * @param mixed  $data
     * @param string $type
     * @param string $library
     */
    public static function database($data, $type = null, $library = null)
    {
        return new Database($data, $type, $library);
    }

    /**
     * Return all the libraries available.
     *
     * @param string $type
     */
    public static function libraries($type = null)
    {
        $libraries = [];
        foreach (scandir(__DIR__.'/Templates') as $file) {
            if ($file != '.' and $file != '..') {
                $library = explode('.', $file)[0];

                if (!in_array($library, $libraries)) {
                    if (!$type or $type == explode('.', $file)[1]) {
                        array_push($libraries, $library);
                    }
                }
            }
        }

        return $libraries;
    }

    /**
     * Return all the types available.
     *
     * @param string $library
     */
    public static function types($library = null)
    {
        $types = [];
        foreach (scandir(__DIR__.'/Templates') as $file) {
            if ($file != '.' and $file != '..') {
                $type = explode('.', $file)[1];

                if (!in_array($type, $types)) {
                    if (!$library or $library == explode('.', $file)[0]) {
                        array_push($types, $type);
                    }
                }
            }
        }

        return $types;
    }

    /**
     * Return the library assets.
     *
     * @param array $libs
     */
    public static function assets($libs = null)
    {
        $includes = include __DIR__.'/includes.php';

        if ($libs && is_array($libs)) {
            $template = $includes['global'];
            foreach ($libs as $lib) {
                $template .= $includes[$lib]."\n";
            }

            return $template;
        }

        return implode("\n", $includes);
    }
}
