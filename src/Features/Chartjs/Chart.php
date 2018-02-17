<?php

namespace ConsoleTVs\Charts\Features\Chartjs;

trait Chart
{
    /**
     * Minalist chart display (Hide labels and axes).
     *
     * @return Self
     */
    public function minimalist(bool $display)
    {
        $this->displayLegend(!$display);

        return $this->displayAxes(!$display);
    }

    /**
     * Display the chart legend.
     *
     * @param  bool   $legend
     * @return Self
     */
    public function displayLegend(bool $legend)
    {
        return $this->options([
            'legend' => [
                'display' => $legend
            ]
        ]);
    }

    /**
     * Display the chart axis.
     *
     * @param  bool   $axes
     * @return Self
     */
    public function displayAxes(bool $axes, bool $strict = false)
    {
        if ($strict) {
            return $this->options([
                'scale' => [
                    'display' => $axes,
                ]
            ]);
        }

        return $this->options([
            'scales' => [
                'xAxes' => [
                    [
                        'display' => $axes,
                    ]
                ],
                'yAxes' => [
                    [
                        'display' => $axes
                    ]
                ]
            ]
        ]);
    }

    /**
     * Set the bar width of the X Axis.
     *
     * @param  float  $width
     * @return Self
     */
    public function barWidth(float $width)
    {
        return $this->options([
            'scales' => [
                'xAxes' => [
                    [
                        'barPercentage' => $width,
                    ]
                ]
            ]
        ]);
    }

    /**
     * Set the chart title.
     *
     * @param  string  $title
     * @param  integer $font_size
     * @param  string  $color
     * @param  boolean $bold
     * @param  string  $font_family
     * @return Self
     */
    public function title(
        string $title,
        int $font_size = 14,
        string $color = '#666',
        bool $bold = true,
        string $font_family = "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
    ) {
        return $this->options([
            'title' => [
                'display' => true,
                'fontFamily' => $font_family,
                'fontSize' => $font_size,
                'fontColor' => $color,
                'fontStyle' => $bold,
                'text' => $title,
            ]
        ]);
    }
}