<?php
if (isset($argc)) {
	for ($i = 1; $i < $argc; $i++) {
        if (file_exists($argv[$i])) {
            addToCSV($argv[$i]);


        }
	}
}
else {
	echo "argc and argv disabled\n";
} 

function addToCSV($filePath) {
    $parts = explode("/", $filePath);
    $fileName = array_pop($parts);
    $file = fopen($filePath, "r");
    $row = 1;

    // deal with if file is empty and there is no need to add file name
    
    if( ($data = fgetcsv($file) ) !== FALSE ) {
        array_push($data, "filename");
        fputcsv(STDOUT, $data);
    }
    while(! feof($file)) {
        $content = fgetcsv($file);
        echo (gettype($content));
        array_push($content, $fileName);
        echo (gettype($content));
        // fputcsv(STDOUT, $content);
    }
    fclose($file);


}

/*

// assumptions
// 1. files are given as proper .csv file type
// 2. columns are formatted properly with 1 value per column title


 things to think about
    // test cases
        1. no file
        2. 1 file
        3. multiple files
        4. file does not exist 
        5. how to deal with files with different columns?

*/
// $output = "hello World";
// fwrite(STDOUT, $output);

// $input = fgets(STDIN);

// fwrite(STDOUT, $output);
?>