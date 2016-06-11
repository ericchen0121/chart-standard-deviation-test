<?php

require_once __DIR__ . "/../average.php";

class PluginAverageTest extends PHPUnit_Framework_TestCase {

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
        echo var_dump($params);
        $result = plugin_average($params);
        $this->assertCount(3, $result);
        $this->assertCount(24, $result['day']);
        $this->assertCount(7, $result['week']);
        $this->assertCount(28, $result['week4']);
        $this->assertEquals(
            "12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35",
            implode(', ', $result['day'])
        );
        $this->assertEquals(
            "3.5, 4.5, 5.5, 6.5, 7.5, 8.5, 9.5",
            implode(', ', $result['week'])
        );
        $this->assertEquals(
            "14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41",
            implode(', ', $result['week4'])
        );
    }
}