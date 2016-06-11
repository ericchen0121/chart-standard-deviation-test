#!/usr/bin/php

<?php
$str = file_get_contents("sample_data/sample_data.json");
$json = json_decode($str, true);
plugin_average($json);
/**
 * Calculates Average between Current and Past Periods
 *
 * @param $day - 96 data points (4 days, 96 hours, starting from now)
 * @param $week - 28 data points (4 weeks, 28 days, starting from today)
 * @param $week4 - 112 data points (16 weeks, 112 days, starting from today)
 * @return array - array(day, week, week4) -> for today, yesterday
 */
function plugin_average($params) {
    $currentPeriods = array(
        "day" => 24,
        "week" => 7,
        "week4" => 28
    );

    $periodAverages = array();
    foreach ($currentPeriods as $periodName => $periodLength) {
        $data = $params[$periodName];
        $currentPeriod = array_slice($data, 0, $periodLength);
        $pastPeriod = array_slice($data, $periodLength, $periodLength);
        $averageData = array();
        foreach ($currentPeriod as $key => $value) {
            $currentValue = 0;
            $pastValue = 0;
            if (isset($value['total_count'])) {
                $currentValue = $value['total_count'];
            }
            $pastPeriodData = array_shift($pastPeriod);
            if (isset($pastPeriodData['total_count'])) {
                $pastValue = $pastPeriodData['total_count'];
            }
            $averageData[$key] = ($currentValue + $pastValue) / 2;
        }
        $periodAverages[$periodName] = $averageData;
    }
    echo var_dump($periodAverages);
    return $periodAverages;
}

?>
