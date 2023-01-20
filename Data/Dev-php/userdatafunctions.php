<?php
if (file_exists('../../Import/php/restrict-access.php')) include_once '../../Import/php/restrict-access.php';

class Dataset{
	private $sourceFile = "N/A";
	private $FileContent = "N/A";
	private $ArrayPartitiontIntoDataTypes = [];

	function __construct($sourceFile) {
        $this->sourceFile = $sourceFile;
        $this->FileContent = file_get_contents($this->sourceFile);
        $this->ArrayPartitiontIntoDataTypes = $this->ConvertFileToPartitionedArray();
    }

    function CreateTextArray(){
    	$array = explode("\n", $this->FileContent);
    	array_pop($array);
    	$array = $this->trimArray($array);
    	return $array;
    }

    function trimArray($array){
    	$trimmedArray = [];
    	foreach ($array as $value) {
    		$trimmedArray[] = substr($value, 5);
    	}
    	return $trimmedArray;
    }

    function ConvertFileToPartitionedArray(){
    	$PartitionedArray = [[],[],[],[]];
    	$splittedArray = $this->CreateTextArray();
    	foreach ($splittedArray as $key => $value) {
    		$PartitionedArray[$key % 3][] = $value;
    	}
    	return $PartitionedArray;
    }

    function TotalPageViews(){
    	return count($this->ArrayPartitiontIntoDataTypes[0]);
    }

    function MostVisitedPages(){
    	$countedValues = array_count_values($this->ArrayPartitiontIntoDataTypes[2]);
    	arsort($countedValues);
    	$TotalPageViews = $this->TotalPageViews();
    	foreach ($countedValues as $key => $value) {
    		$countedValues[$key] = [$value, $value/$TotalPageViews];
    	}
    	return $countedValues;
    }

    function UniqueUsers(){
    	return count(array_count_values($this->ArrayPartitiontIntoDataTypes[1]));
    }

    function PageViewsPerDatetimeString($datetimestring){
    	$pageViewsSorted = [];
    	foreach ($this->ArrayPartitiontIntoDataTypes[0] as $value) {
    		$pageViewsSorted[] = date($datetimestring, $value);
    	}
    	$returnArray = array_count_values($pageViewsSorted);
    	ksort($returnArray);
    	return $returnArray;
    }
}