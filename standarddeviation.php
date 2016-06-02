<?php

/**
 * Standard Deviation
 *
 * @param $day - 96 data points (4 days, 96 hours, starting from now)
 * @param $week - 28 data points (4 weeks, 28 days, starting from today)
 * @param $week4 - 112 data points (16 weeks, 112 days, starting from today)
 * @return array - array(day, week, week4) -> for today, yesterday
 */
function plugin_standarddevation($params) {
    $standardDeviation = array(
        'day' => array(),
        'week' => array(),
        'week4' => array()
    );

    // --- your code comes here ---

    return $standardDeviation;
}
