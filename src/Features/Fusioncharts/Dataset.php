<?php

namespace ConsoleTVs\Charts\Features\Fusioncharts;

trait Dataset
{
    /**
     * Set the dataset color.
     *
     * @param  string|Array $color
     * @return Self
     */
    public function color($color)
    {
        return $this->options([
            'color' => $color
        ]);
    }
}