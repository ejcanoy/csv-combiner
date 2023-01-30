<?php
// Euan Canoy
// 1/30/2023

// csv-combiner takes in csv files through the command line then combines and outputs
// the combination to STDOUT

if (isset($argc)) {
    $columnNames = array();
    $curFileColNames = array();
    for ($i = 1; $i < $argc; $i++) {
         if (file_exists($argv[$i])) {
            $curArray = getColumnNames($argv[$i]);
            if ($curArray != null) {
                $curFileColNames[$argv[$i]] = $curArray;
                $columnNames = array_unique(array_merge($curArray, $columnNames));
            }
         }
     }
    array_push($columnNames, 'filename');
    fputcsv(STDOUT, $columnNames);
    $columnNames = array_flip($columnNames);
    for ($i = 1; $i < $argc; $i++) {
        if (file_exists($argv[$i])) {
            addToCSV($argv[$i], $columnNames, $curFileColNames);
        }
	}
}
else {
	echo "argc and argv disabled\n";
} 

function addToCSV($filePath, $columnNames, $curFileColNames) {
    $fileName = basename($filePath);
    $file = fopen($filePath, "r");
    if( ($data = fgetcsv($file) ) !== FALSE && !($empty = empty($data) || (count($data) === 1 && empty($data[0])))) {
        
    }
    while((($content = fgetcsv($file) ) !== FALSE)) {   
        $output = array_fill(0, sizeof($columnNames), " ");
        for ($i = 0; $i < sizeOf($content); $i++) {
            $output[$columnNames[$curFileColNames[$filePath][$i]]] =  $content[$i];
        }
        $output[sizeof($columnNames) - 1] = $fileName;
        fputcsv(STDOUT, $output);
    }
    fclose($file);


}

function getColumnNames($filePath) {
    $file = fopen($filePath, "r");
    if( ($data = fgetcsv($file) ) !== FALSE && !($empty = empty($data) || (count($data) === 1 && empty($data[0])))) {
        return $data;
    }
    fclose($file);
    return null;
}

/*

// assumptions
// 1. files are given as proper .csv file type
// 2. columns are formatted properly with 1 value per column title


 things to think about
    // test cases
        1. no file :)
        2. 1 file :)
        3. blank file :)
        4. file does not exist :)
        5. multiple files :)
        6. how to deal with files with different columns? :)

*/

?>