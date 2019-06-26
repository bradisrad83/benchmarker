<?php
namespace BradGoldsmith\BenchmarkerApp;
use Benchmarker;
use Comparator;

class Reporter {
    
    /**
     * BenchMark Results
     *
     * @var array
     */
    public $results;

    /**
     * Access to all the comparator methods
     *
     * @var array
     */
    public $comparator;

    /**
     * initialize reporter with BenchMarker results,
     * type of comparison, and optional order.
     *
     * @param BenchMarker $benchMarker
     * @param string $comparisonType
     * @param string $order
     */
    public function __construct( BenchMarker $benchMarker, Comparator $comparator)
    {
        $this->results = $benchMarker->getResults();
        $this->comparator = $comparator;
    }

    /**
     * get the min
     * of each function from 
     * the benchmark results
     * and writes them to a .txt file
     * in a storage folder
     * 
     * @return void 
     */
    public function getMinComparator() {
        $file = fopen('../storage/files/'.'min'.time().'txt', 'w');
        fwrite($file, $this->comparator->rankByMin());
        fclose($file);
        return;
    }

    /**
     * get the max
     * of each function from 
     * the benchmark results
     * and writes them to a .txt file
     * in a storage folder
     * 
     * @return void 
     */
    public function getMaxComparator() {
        $file = fopen('../storage/files/'.'max'.time().'txt', 'w');
        fwrite($file, $this->comparator->rankByMax());
        fclose($file);
        return;
    }

    /**
     * get the average
     * of each function from 
     * the benchmark results
     * and writes them to a .txt file
     * in a storage folder
     * 
     * @return void 
     */
    public function getAverageComparator() {
        $file = fopen('../storage/files/'.'average'.time().'txt', 'w');
        fwrite($file, $this->comparator->rankByAverage());
        fclose($file);
        return;
    }
}

?>