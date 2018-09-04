<?php

namespace ConsoleTVs\Charts\Features\Frappe;

trait Chart
{
    /**
     * Add a title to the Chart.
     *
     * @param string $title
     * @return void
     */
    public function title(string $title)
    {
        return $this->options([
            'title' => $title
        ]);
    }

    /**
     * Determines the spaceRatio of the bars.
     *
     * @param float $space
     * @return Self
     */
    public function spaceRatio(float $space = 0.75)
    {
        return $this->options([
            'barOptions' => [
                'spaceRatio' => $space
            ]
        ]);
    }

    /**
     * Determines if the bars are stacked.
     *
     * @param bool $stacked
     * @return Self
     */
    public function stacked(bool $stacked)
    {
        return $this->options([
            'barOptions' => [
                'stacked' => $stacked
            ]
        ]);
    }

    /**
     * Makes the chart interactive with arrow keys and highlights the current active data point.
     *
     * @param bool $stacked
     * @return Self
     */
    public function isNavigable(bool $value)
    {
        return $this->options([
            'isNavigable' => $value
        ]);
    }

    /**
     * To display data values over bars or dots in an axis graph.
     *
     * @param bool $stacked
     * @return Self
     */
    public function valuesOverPoints(bool $value)
    {
        return $this->options([
            'valuesOverPoints' => $value
        ]);
    }

    /**
     * Determines if the lines will show a dot.
     *
     * @param boolean $value
     * @return Self
     */
    public function hideDots(bool $value)
    {
        return $this->options([
            'lineOptions' => [
                'hideDots' => $value
            ]
        ]);
    }

    /**
     * Determines if the line will be hidden.
     *
     * @param boolean $value
     * @return Self
     */
    public function hideLine(bool $value)
    {
        return $this->options([
            'lineOptions' => [
                'hideDots' => $value
            ]
        ]);
    }

    /**
     * Determines if the line will be a heatline.
     *
     * @param boolean $value
     * @return Self
     */
    public function heatline(bool $value)
    {
        return $this->options([
            'lineOptions' => [
                'heatline' => $value
            ]
        ]);
    }
}
