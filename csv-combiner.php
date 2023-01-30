<?php
if (isset($argc)) {
	for ($i = 1; $i < $argc; $i++) {
        if (file_exists($argv[$i])) {
            addToCSV($argv[$i]);
        }
	}

    // for ($i = 1; $i < $argc; $i++) {
   //     $columnNames;
    //     if (file_exists($argv[$i])) {
    //         $columnNames = array_unique(getColumnNames($argv[$i]), $columnNames);
    //     }
	// }
}
else {
	echo "argc and argv disabled\n";
} 

function addToCSV($filePath) {
    $parts = explode("/", $filePath);
    $fileName = array_pop($parts);
    $file = fopen($filePath, "r");
    // check regex instead of parts?
    if( ($data = fgetcsv($file) ) !== FALSE && !($empty = empty($data) || (count($data) === 1 && empty($data[0])))) {
        print_r(count($data));
        array_push($data, "filename");
        fputcsv(STDOUT, $data);
    }
    while((($content = fgetcsv($file) ) !== FALSE)) {   
        // print_r(gettype($content) . "\n");
        array_push($content, $fileName);
        fputcsv(STDOUT, $content);
    }
    fclose($file);


}

// function getColumnNames($filePath) {
//     if( ($data = fgetcsv($file) ) !== FALSE && !($empty = empty($data) || (count($data) === 1 && empty($data[0])))) {
//         print_r(count($data));
//         array_push($data, "filename");
      
// }

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