#!/usr/bin/php

<?php
// $str = file_get_contents("sample_data/sample_data.json");
// $json = json_decode($str, true);
// plugin_standarddeviation($json);
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

      $stdDevData = array();
      $loopCount = $periodLength; 
      while($loopCount > 0) {
        // initialize variables
        $currentPeriod = array_slice($data, 0, $periodLength);
        $sum = 0;
        $count = 0;
        $mean = 0;
        // 1. Calculate Mean
        foreach ($currentPeriod as $key => $value) {
          if (isset($value['total_count'])) {
            $count += 1;
            $sum += $value['total_count'];
          }
        }

        if ($count > 0){
          $mean = $sum / $count;  
        }

        // 2. Subtract the Mean and Square the result
        $sumSquares = 0;
        $variance = 0;
        foreach ($currentPeriod as $key => $value) {
          if (isset($value['total_count'])) {
            $sumSquares += pow($value['total_count'] - $mean, 2);
          } 
        }
        
        // 3. Calculate variance
        if ($count > 0){
          $variance =  $sumSquares / $count;
        }

       // 4. Calculate Std Dev
       $stdDev = sqrt($variance);

       if (!empty($data) ) {
        $key = current(array_keys($currentPeriod));
        // shift the data set
        array_shift($data);
       }

       $stdDevData[$key] = $stdDev;
       
       $loopCount--;

      }
      $standardDeviation[$periodName] = $stdDevData;
    }
    echo var_dump($standardDeviation);
    return $standardDeviation;
}

?>
