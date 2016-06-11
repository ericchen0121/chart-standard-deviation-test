<?php

require_once __DIR__ . "/../standarddeviation.php";

class PluginStdDevTest extends PHPUnit_Framework_TestCase {

  private function genRange($start, $elements) {
    $array = range($start, $elements);
    $dict = array();
    foreach ($array as $value) {
      $dict[] = array(
        "total_count" => $value
      );
    }
    echo $dict;
    return $dict;
  }

  public function testAverageIsCorrect() {
    $day = $this->genRange(0, 96);
    $week = $this->genRange(0, 28);
    $week4 = $this->genRange (0, 112);
    $params = array(
      'day' => $day,
      'week' => $week,
      'week4' => $week4
    );
    echo $params;
    $result = plugin_average($params);
    $this->assertCount(3, $result);
    $this->assertCount(48, $result['day']);
    $this->assertCount(14, $result['week']);
    $this->assertCount(56, $result['week4']);
    $this->assertEquals(
        "14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14",
        implode(',', $result['day'])
    );
    $this->assertEquals(
        "7.65104,7.65104,7.65104,7.65104,7.65104,7.65104,7.65104,7.65104,7.65104,7.65104,7.65104,7.65104,7.65104,7.65104",
        implode(',', $result['week'])
    );
    $this->assertEquals(
        "15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076,15.8076",
        implode(',', $result['week4'])
    );
  }
}