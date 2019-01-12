<?php

include "../libchart/libchart/classes/libchart.php";


/**
 * libchart wrapper class
 * @author Ashraf Ajida 
 */

class LibchartWrapper
{

    /**
     * VerticalBarChart
     *
     * @var VerticalBarChart
     */
    private $chart;

    /**
     * XYDataSet
     *
     * @var XYDataSet
     */
    private $data_set;

    public function __construct()
    {
        $this->chart = new VerticalBarChart(500, 250);
        $this->data_set = new XYDataSet();
    }

    public function __destruct()
    {}


    /**
     * this function sets the data for the chart
     *
     * @return method
     */

    public function setChartData($title, $data)
    {
        $this->data_set->addPoint(new Point($title, $data));
        $this->chart->setDataSet($this->data_set);       
    }

    /**
     * this function sets the title
     *
     * @param string $title
     * @return method
     */
    public function setTitle($title)
    {
        return $this->chart->setTitle($title);
    }

    /**
     * this function renders the chart
     * @return method
     */

    public function render($img_location)
    {
        return $this->chart->render($img_location);
    }
    
}
