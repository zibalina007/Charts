<?php

/*
 * This file is part of consoletvs/charts.
 *
 * (c) Erik Campobadal <soc@erik.cat>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ConsoleTVs\Charts\Builder;

use Database;

/**
 * This is the database class.
 *
 * @author Erik Campobadal <soc@erik.cat>
 */
class MultiDatabase extends Multi
{
    public $datas;
    public $date_column = 'created_at';
    public $date_format = 'l dS M, Y';
    public $month_format = 'F, Y';
    public $preaggregated = false;

    /**
     * Create a new database instance.
     *
     * @param string $data
     * @param string $type
     * @param string $library
     */
    public function __construct($type = null, $library = null)
    {
        parent::__construct($type, $library);
    }

    /**
     * Set the dataset data.
     *
     * @param string $element_label
     * @param mixed  $data
     */
    public function dataset($element_label, $data)
    {
        $this->datas[$element_label] = new Database($data);

        return $this;
    }

    /**
     * Set date column to filter the data.
     *
     * @param string $column
     */
    public function dateColumn($column)
    {
        $this->date_column = $column;

        return $this;
    }

    /**
     * Set fancy date format based on PHP date() function.
     *
     * @param string $format
     */
    public function dateFormat($format)
    {
        $this->date_format = $format;

        return $this;
    }

    /**
     * Set fancy month format based on PHP date() function.
     *
     * @param string $format
     */
    public function monthFormat($format)
    {
        $this->month_format = $format;

        return $this;
    }

    /**
     * Set whether data is preaggregated or should be summed.
     *
     * @param bool $preaggregated
     * @return $this
     */
    public function preaggregated($preaggregated)
    {
        $this->preaggregated = $preaggregated;

        return $this;
    }

    /**
     * Group the data hourly based on the creation date.
     *
     * @param string $year
     * @param string $month
     * @param bool   $fancy
     */
    public function groupByHour($day = null, $month = null, $year = null, $fancy = false)
    {
        // Reset the datasets to avoid overlapping
        $this->datasets = [];

        foreach ($this->datas as $element_label => $data) {
            $data->groupByHour($day, $month, $year, $fancy);
            parent::dataset($element_label, $data->values);
        }

        $this->labels = $data->labels;

        return $this;
    }

    /**
     * Group the data daily based on the creation date.
     *
     * @param string $year
     * @param string $month
     * @param bool   $fancy
     */
    public function groupByDay($month = null, $year = null, $fancy = false)
    {
        // Reset the datasets to avoid overlapping
        $this->datasets = [];

        foreach ($this->datas as $element_label => $data) {
            $data->groupByDay($month, $year, $fancy);
            parent::dataset($element_label, $data->values);
        }

        $this->labels = $data->labels;

        return $this;
    }

    /**
     * Group the data monthly based on the creation date.
     *
     * @param int  $year
     * @param bool $fancy
     */
    public function groupByMonth($year = null, $fancy = false)
    {
        // Reset the datasets to avoid overlapping
        $this->datasets = [];

        foreach ($this->datas as $element_label => $data) {
            $data->groupByMonth($year, $fancy);
            parent::dataset($element_label, $data->values);
        }

        $this->labels = $data->labels;

        return $this;
    }

    /**
     * Group the data yearly based on the creation date.
     *
     * @param int $number
     */
    public function groupByYear($number = 4)
    {
        // Reset the datasets to avoid overlapping
        $this->datasets = [];

        foreach ($this->datas as $element_label => $data) {
            $data->groupByYear($number);
            parent::dataset($element_label, $data->values);
        }

        $this->labels = $data->labels;

        return $this;
    }

    /**
     * Group the data based on the column.
     *
     * @param string $column
     * @param string $relationColumn
     * @param array $labelsMapping
     * @return $this
     */
    public function groupBy($column, $relationColumn = null, array $labelsMapping = [])
    {
        // Reset the datasets to avoid overlapping
        $this->datasets = [];

        foreach ($this->datas as $element_label => $data) {
            $data->groupBy($column, $relationColumn, $labelsMapping);
            parent::dataset($element_label, $data->values);
        }

        $this->labels = $data->labels;

        return $this;
    }

    /**
     * Group the data based on the latest days.
     *
     * @param int  $number
     * @param bool $number
     */
    public function lastByDay($number = 7, $fancy = false)
    {
        // Reset the datasets to avoid overlapping
        $this->datasets = [];

        foreach ($this->datas as $element_label => $data) {
            $data->lastByDay($number, $fancy);
            parent::dataset($element_label, $data->values);
        }

        $this->labels = $data->labels;

        return $this;
    }

    /**
     * Group the data based on the latest months.
     *
     * @param int  $number
     * @param bool $number
     */
    public function lastByMonth($number = 6, $fancy = false)
    {
        // Reset the datasets to avoid overlapping
        $this->datasets = [];

        foreach ($this->datas as $element_label => $data) {
            $data->lastByMonth($number, $fancy);
            parent::dataset($element_label, $data->values);
        }

        $this->labels = $data->labels;

        return $this;
    }

    /**
     * Alias for groupByYear().
     *
     * @param int $number
     */
    public function lastByYear($number = 4)
    {
        return $this->groupByYear($number);
    }
}
