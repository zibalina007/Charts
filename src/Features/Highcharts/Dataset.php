<?php

namespace ConsoleTVs\Charts\Features\Highcharts;

trait Dataset
{
    /**
     * Set the dataset color.
     *
     * @param  string|array $color
     * @return Self
     */
    public function color($color)
    {
        return $this->options([
            'color' => $color
        ]);
    }
}