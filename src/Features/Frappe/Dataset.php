<?php

namespace ConsoleTVs\Charts\Features\Frappe;

use Illuminate\Support\Collection;

trait Dataset
{
    /**
     * Determines the color of the dataset.
     *
     * @param string $color
     * @return Self
     */
    public function color(string $color)
    {
        return $this->options([
            'color' => $color
        ]);
    }
}
