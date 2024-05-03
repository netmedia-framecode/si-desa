<?php
// Function to handle errors
function handle_error($errno, $errstr, $errfile, $errline) {
    // Create error log file path based on the file where the error occurred
    $errorLog = dirname(__FILE__) . '/error_log.log'; // Error log file location within the project folder

    // Format error message with additional information
    $error_message = "[" . date("Y-m-d H:i:s") . "] Error [$errno]: $errstr in $errfile on line $errline" . PHP_EOL;

    // Attempt to open the error log file in append mode, creating it if it doesn't exist
    $file_handle = fopen($errorLog, 'a');
    if ($file_handle === false) {
        // Unable to open or create error log file, output error message
        die("Error: Unable to open or create error log file.");
    }

    // Write error message to the log file
    if (fwrite($file_handle, $error_message) === false) {
        // Error writing to log file, output error message
        die("Error: Unable to write to error log file.");
    }

    // Close the file handle
    fclose($file_handle);

    // Display error message for debugging
    echo "<h1>Oops! Something went wrong.</h1>";
    echo "<p>We apologize for the inconvenience. The following error occurred:</p>";
    echo "<pre>$error_message</pre>";
}

// Set error handler to handle errors
set_error_handler('handle_error');
?>
