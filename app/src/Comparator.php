<?php
namespace BradGoldsmith\BenchmarkerApp;
use Benchmarker;

class Comparator {
 
    /**
     * BenchMark Results
     *
     * @var array
     */
    public $results;

    /**
     * Results after comparison
     *
     * @var array
     */
    public $comparatorResults;

    /**
     * Type of comparison this
     * comparator will make;
     * 
     * @var string
     */
    public $comparisonType;

    /**
     * Optional order
     * param.
     *
     * @var string
     */
    public $order;

    /**
     * initialize comparator with BenchMarker results,
     * type of comparison, and optional order.
     *
     * @param BenchMarker $benchMarker
     * @param string $comparisonType
     * @param string $order
     */
    public function __construct( BenchMarker $benchMarker, string $comparisonType, string $order = 'ASC')
    {
        $this->results = $benchMarker->getResults();
        $this->comparisonType = $comparisonType;
        $this->orderBy = $order;
    }

    public function rankBy()
    {
        switch ($this->comparisonType) {
                case 'average':
                    $this->rankByAverage();
                    break;
                case 'max':
                    $this->rankByMax();
                    break;
                case 'min':
                    $this->rankByMin();
                    break;
        }
        usort($this->comparatorResults, [$this, 'rank']);
    }

    /**
     * callback for the
     * sorting based on
     * order
     *
     * @param float $a
     * @param float $b
     * @return void
     */
    public function rank(float $a, float $b)
    {   
        if(strtolower($this->order) == strtolower('ASC')){
            return ( $a < $b );
        }

        if(strtolower($this->order) == strtolower('DESC')){
            return ( $a > $b );
        }
    }

    /**
     * get the average
     * of each function from 
     * the benchmark results
     * 
     * @return void 
     */
    public function rankByAverage()
    {
        foreach ($this->results as $function => $functionResults ) {
            $this->comparatorResults[$function] = array_sum($functionResults) / count($functionResults);
        }
    }

    /**
     * find the max value
     * of each function from 
     * the benchmark results
     * 
     * @return void
     */
    public function rankByMax(){
        foreach($this->results as $functoin => $functionResults ) {
            $this->comparatorResults[$function] = max($functionResults);
        }
    }

    /**
     * find the min value
     * of each function from 
     * the benchmark results
     * 
     * @return void
     */
    public function rankByMin()
    {
        foreach($this->results as $functoin => $functionResults ) {
            $this->comparatorResults[$function] = min($functionResults);
        }
    }
}

?>