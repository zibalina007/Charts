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
use ConsoleTVs\Charts\Builder\Chart;
use ConsoleTVs\Charts\Builder\Realtime;
use ConsoleTVs\Charts\Builder\Database;
use ConsoleTVs\Charts\Builder\Math;
use ConsoleTVs\Charts\Builder\Multi;
use Illuminate\Support\Facades\File;
use Collective\Html\HtmlFacade as Html;

/**
 * This is the charts facade class.
 *
 * @author Erik Campobadal <soc@erik.cat>
 */
class Builder
{
    /**
     * Return a new chart instance.
     *
     * @param string $type
     * @param string $library
     */
    public static function create($type = null, $library = null)
    {
        return new Chart($type, $library);
    }

    /**
     * Return a new realtime chart instance.
     *
     * @param mixed  $data
     * @param string $type
     * @param string $library
     */
    public static function realtime($url, $interval, $type = null, $library = null)
    {
        return new Realtime($url, $interval, $type, $library);
    }

    /**
     * Return a new database chart instance.
     *
     * @param mixed  $data
     * @param string $type
     * @param string $library
     */
    public static function database($data, $type = null, $library = null)
    {
        return new Database($data, $type, $library);
    }

    /**
     * Return a new math chart instance.
     *
     * @param string $function
     * @param array  $interval
     * @param int    $amplitude
     * @param string $type
     * @param string $library
     */
    public static function math($function, $interval, $amplitude, $type = null, $library = null)
    {
        return new Math($function, $interval, $amplitude, $type, $library);
    }

    /**
     * Return a new multi chart instance.
     *
     * @param string $type
     * @param string $library
     */
    public static function multi($type = null, $library = null)
    {
        return new Multi($type, $library);
    }

    /**
     * Return all the libraries available.
     *
     * @param string $type
     */
    public static function libraries($type = null)
    {
        $directories = File::directories(__DIR__.'/../resources/views');

        $results = [];
        foreach ($directories as $directory) {
            // type was not defined...
            if (! $type) {
                return collect($directories)->map(function ($item, $key) {
                    return basename($item);
                })->toArray();
            }

            // type was defined...
            foreach (File::allFiles($directory) as $library) {
                if (str_contains($library, $type)) {
                    $results[] = basename($directory);
                }
            }
        }

        return array_unique($results);
    }

    /**
     * Return all the types available.
     *
     * @param string $library
     */
    public static function types($library = null)
    {
        // library defined...
        if ($library) {
            $files = File::allFiles(__DIR__."/../resources/views/$library");

            return collect($files)->map(function ($item, $key) {
                return str_replace('.php', null, $item->getFileName());
            })->toArray();
        }

        // no library defined...
        $libraries = File::directories(__DIR__.'/../resources/views');

        $results = [];
        foreach ($libraries as $library) {
            foreach (File::allFiles($library) as $type) {
                $results[] = str_replace('.php', null, $type->getFileName());
            }
        }

        return array_unique($results);
    }

    /**
     * Return the library assets.
     *
     * @param array  $libraries
     * @param string $type
     */
    public static function assets($libraries = [], $type = null)
    {
        $assets = config('charts.assets');

        if ($libraries && is_string($libraries)) {
            $libraries = explode(',', $libraries);
        }

        $assetsToInclude = [];

        if ($libraries) {
            if ($type) {
                // return all assets of type in requested libs
                return collect($libraries)->reduce(function ($result, $library) use ($type, $assets) {
                    return empty($assets[$library][$type])
                            ? $result
                            : $result.static::buildIncludeTags($assets[$library][$type]);
                });
            }

            // return all libraries assets that match requested libraries
            return collect($libraries)->reduce(function ($result, $library) use ($assets) {
                return empty($assets[$library])
                        ? $result
                        : $result.static::buildIncludeTags($assets[$library]);
            });
        }

        if ($type) {
            // return all libraries that have requested asset types
            return static::buildIncludeTags(array_collapse(array_pluck($assets, $type)));
        }

        // return all libraries
        return static::buildIncludeTags($assets);
    }

    /**
     * Build HTML Tags to include.
     *
     * @param array $data
     *
     * @return string
     */
    private static function buildIncludeTags(array $data)
    {
        return collect(array_flatten($data))->map(function ($item) {
            if (ends_with($item, '.css')) {
                return starts_with($item, ['http://', 'https://'])
                        ? Html::style($item)->__toString()
                        : '<style type="text/css">'.$item.'</style>';
            }

            if (ends_with($item, '.js')) {
                return starts_with($item, ['http://', 'https://'])
                        ? Html::script($item)->__toString()
                        : '<script type="text/javascript">'.$item.'</script>';
            }
        })->implode('');
    }
}
