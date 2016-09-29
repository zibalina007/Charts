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

/**
 * This is the database class.
 *
 * @author Erik Campobadal <soc@erik.cat>
 */
class Database extends Chart
{
    public $data;
    public $column;

    /**
     * Create a new database instance.
     *
     * @param string $data
     * @param string $type
     * @param string $library
     */
    public function __construct($data, $type = null, $library = null)
    {
        parent::__construct($type, $library);

        // Set the data
        $this->data = $data;
    }

    /**
     * Set chart data.
     *
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Group the data monthly based on the creation date.
     *
     * @param string $year
     * @param string $month
     * @param bool   $fancy
     */
    public function groupByDay($month = null, $year = null, $fancy = false)
    {
        $labels = [];
        $values = [];

        $month = $month ? $month : date('m');
        $year = $year ? $year : date('Y');

        $days = date('t', strtotime("$year-$month-01"));

        for ($i = 1; $i <= $days; $i++) {
            if ($i < 10) {
                $day = "0$i";
            } else {
                $day = "$i";
            }

            $date = "$year-$month-$day";

            $value = 0;

            foreach ($this->data as $data) {
                if (date('Y-m-d', strtotime($data->created_at)) == $date) {
                    $value++;
                }
            }

            $date_get = $fancy ? 'l dS M, Y' : 'd-m-Y';
            $label = date($date_get, strtotime("$year-$month-$day"));

            array_push($labels, $label);
            array_push($values, $value);
        }
        $this->labels = $labels;
        $this->values = $values;

        return $this;
    }

    /**
     * Group the data monthly based on the creation date.
     *
     * @param int $year
     */
    public function groupByMonth($year = null, $fancy = false)
    {
        $labels = [];
        $values = [];

        $year = $year ? $year : date('Y');

        for ($i = 1; $i <= 12; $i++) {
            if ($i < 10) {
                $month = "0$i";
            } else {
                $month = "$i";
            }

            $date_get = $fancy ? 'F, Y' : 'm-Y';
            $label = date($date_get, strtotime("$year-$month-01"));

            array_push($labels, $label);

            $value = 0;
            foreach ($this->data as $data) {
                if ($year == date('Y', strtotime($data->created_at))) {
                    // Same year
                    if ($month == date('m', strtotime($data->created_at))) {
                        // Same month
                        $value++;
                    }
                }
            }
            array_push($values, $value);
        }

        $this->labels = $labels;
        $this->values = $values;

        return $this;
    }

    /**
     * Group the data yearly based on the creation date.
     *
     * @param int $number
     */
    public function groupByYear($number = 5)
    {
        $labels = [];
        $values = [];
        for ($i = 0; $i < $number; $i++) {
            if ($i == 0) {
                $year = date('Y');
            } else {
                $year = date('Y', strtotime('-'.$i.' Year'));
            }

            array_push($labels, $year);
            // Check the value
            $value = 0;
            foreach ($this->data as $data) {
                if ($year == date('Y', strtotime($data->created_at))) {
                    $value++;
                }
            }
            array_push($values, $value);
        }
        $this->labels = array_reverse($labels);
        $this->values = array_reverse($values);

        return $this;
    }

    /**
     * Group the data based on the column.
     *
     * @param string $column
     */
    public function groupBy($column)
    {
        $labels = [];
        $values = [];
        foreach ($this->data->groupBy($column) as $data) {
            array_push($labels, $data[0]->$column);
            array_push($values, count($data));
        }
        $this->labels = $labels;
        $this->values = $values;

        return $this;
    }

    /*
     * .
     *
     * @param string $color
     */
}
