<?php
if (isset($argc)) {
	for ($i = 1; $i < $argc; $i++) {
        if (file_exists($argv[$i])) {
            echo "Argument #" . $i . " - " . $argv[$i] . "\n";
            $file = fopen($argv[$i], "r");
            $content = fgetcsv($file);
            array_push($content, $argv[$i]);
            $contentString = implode(",", $content);
            fwrite(STDOUT, $contentString);
            fclose($file);
        } else {
            echo "Argument file does not exist";
        }

	}
}
else {
	echo "argc and argv disabled\n";
} 


/*


 things to think about
    // test cases
        1. no file
        2. 1 file
        3. multiple files
        4. file does not exist 

*/
// $output = "hello World";
// fwrite(STDOUT, $output);

// $input = fgets(STDIN);

// fwrite(STDOUT, $output);
?>