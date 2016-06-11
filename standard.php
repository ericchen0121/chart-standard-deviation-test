#!/usr/bin/php

<?php
$str = file_get_contents("./sample_data/sample_data.json");
$json = json_decode($str, true);
plugin_standarddeviation($json);
/**
 * Standard Deviation
 *
 * @param $day - 96 data points (4 days, 96 hours, starting from now)
 * @param $week - 28 data points (4 weeks, 28 days, starting from today)
 * @param $week4 - 112 data points (16 weeks, 112 days, starting from today)
 * @return array - array(day, week, week4) -> for today, yesterday
 */
function plugin_standarddeviation($params) {
    // calculate 2 day, 2 week and 8 week trailing stadard deviations
    $periods = array("day" => 48, "week" => 14, "week4" => 56);
    $standardDeviation = array(
        'day' => array(),
        'week' => array(),
        'week4' => array()
    );

    // FOR EACH SET OF DATA
    foreach ($periods as $periodName => $periodLength) {
       // data is an array
      $data = $params[$periodName]; // $params['day'], $params['week'], etc.
      echo var_dump($data);
      // // 
      // $loopCount = $periodLength; 
      // while($loopCount > 0) {
      //   $currentPeriod = array_slice($data, 0, $periodLength);
      //   // 1. GET THE MEAN
      //   // 1a. SUM
      //   $sum = 0;
      //   $count = 0;
      //   $mean = 0;
      //   foreach ($currentPeriod as $key => $value) {
      //     if (isset($value['total_count'])) {
      //       $count += 1;
      //       $sum += $value['total_count'];
      //     }
      //   }
      //   $mean = $sum / $count;

      //   // 2. Subtract the Mean and Square the result
      //   // 3. Get Variance
      //   $sumSquares = 0;
      //   $variance = 0;
      //   foreach ($currentPeriod as $key => $value) {
      //     if (isset($value['total_count'])) {
      //       $sumSquares += pow($value['total_count'] - $mean, 2);
      //     } 
      //   }
      //  $variance =  $sumSquares / $count;
      //  // 4. Get Std Dev
      //  $stdDev = sqrt($variance);

      //  $firstDataPoint = array_shift($data);
      //  $key = key($firstDataPoint);

      //  $standardDeviation[$periodName][$key] = $stdDev;
      
      //  $loopCount--;
      // }
    }

    return $standardDeviation;
}

?>
