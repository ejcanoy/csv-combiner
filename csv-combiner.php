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
    //  print_r (array_flip($columnNames));
    array_push($columnNames, 'filename');
    print_r($columnNames);
    print_r($curFileColNames);
    // fputcsv(STDOUT, $columnNames);
    // for ($i = 1; $i < $argc; $i++) {
    //     if (file_exists($argv[$i])) {
    //         addToCSV($argv[$i], $columnNames, curFileColNames);
    //     }
	// }
}
else {
	echo "argc and argv disabled\n";
} 

function addToCSV($filePath, $columnNames) {
    $parts = explode("/", $filePath);
    $fileName = array_pop($parts);
    $file = fopen($filePath, "r");
    // check regex instead of parts?
    if( ($data = fgetcsv($file) ) !== FALSE && !($empty = empty($data) || (count($data) === 1 && empty($data[0])))) {
  
    }
    while((($content = fgetcsv($file) ) !== FALSE)) {   
        // print_r(gettype($content) . "\n");
        array_push($content, $fileName);
        fputcsv(STDOUT, $content);
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
        5. multiple files
        6. how to deal with files with different columns?

*/
// $output = "hello World";
// fwrite(STDOUT, $output);

// $input = fgets(STDIN);

// fwrite(STDOUT, $output);
?>