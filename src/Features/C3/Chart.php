<?php

namespace ConsoleTVs\Charts\Features\C3;

trait Chart
{
    /**
     * Determines if the chart legend will be displayed.
     *
     * @param boolean $display
     * @return Self
     */
    public function legend(bool $display)
    {
        return $this->options([
            'legend' => [
                'show' => $display
            ]
        ]);
    }

    /**
     * Determines if the chart grid will be shown.
     *
     * @param boolean $display
     * @return Self
     */
    public function grid(bool $display)
    {
        return $this->options([
            'grid' => [
                'x' => [
                    'show' => $display
                ],
                'y' => [
                    'show' => $display
                ],
            ]
        ]);
    }

    /**
     * Determines if the chart tooltip will be shown.
     *
     * @param boolean $display
     * @return Self
     */
    public function tooltip(bool $display)
    {
        return $this->options([
            'tooltip' => [
                'show' => $display
            ]
        ]);
    }
}
