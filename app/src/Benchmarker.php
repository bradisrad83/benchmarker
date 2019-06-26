<?php

namespace BradGoldsmith\BenchmarkerApp;

class BenchMarker{

    /**
     * Array of functions to
     * test
     * @var array
     */
    public $functions;

    /**
     * Array containing results
     * of benchmarked functions
     *
     * @var array
     */
    public $results;

    /**
     * How many times to run 
     * this function
     *
     * @var int
     */
    public $executionCount;


    /**
     * Initialize object with callable
     * function property.
     *
     * @param string $callableFunction
     */
    public function __construct(array $functions, int $executionCount )
    {
        $this->results = [];
        $this->functions = $functions;
        $this->executionCount = $executionCount;
        $this->test();
    }

    /**
     * Test the function
     * and return a float.
     *
     * @return void
     */
    public function test() : void
    {
        foreach($this->functions as $function)
        {
            for ( $count = 0 ; $count < $this->executionCount; $count++){ 
                $this->results[$function] = $this->testFunction($function);
            }
        }
    }

    /**
     * Benchmark and individual function
     * 
     * @return float
     */
    public function testFunction($function)
    {
        $start = microtime(true);
        call_user_func($function);
        $end = microtime(true);
        return $end - $start;
    }

    /**
     * Getter for results prop
     *
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }
}
?>