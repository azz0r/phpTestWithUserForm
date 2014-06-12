<?php


#please ensure you chmod 777 write.log


# force error reporting on
error_reporting(E_ALL);
ini_set( 'display_errors','1');


/**
 * Singleton
 * @author AARON LOTE <aaron.lote@gmail.com>
 */
class Singleton {


    /**
     * our instance reference is protected and defaults to null
     */
    protected static $instance = null;


    /**
     * get an instance of ourself
     */
    public static function getInstance() {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }


    /**
     * load file.php to include $data
     * we could use  local json or xml file
     * In which case i'd use :

     $var = file_get_contents("test.json");
     $json = json_decode($var, true);

     * however lets demo another way by requiring a standard php file
     */
    public function loadFile() {
        require('file.php');

        # assign it to the instances $data var
        $this->data = $data;
    }


    /**
     * @param array array main array or sub arraypassing back to itself
     * @return array
     */
    public function flattenedMultidimensionalArray($array) {
        $result = array();

        if (is_array($array)) {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $result = array_merge($result, $this->flattenedMultidimensionalArray($value));
                } else {
                    $result[] = $value;
                }
            }
        }

        return $result;
    }


    /**
     * Uploads a file
     * @param array $data data array to write to the log file
     * @return boolean
     */
    public function writeArrayToFile($data) {
        foreach ($data as $key => $value) {
            $data[$key] = Extended::roundNumericValues($value);
        }
        return file_put_contents('write.log', print_r($data, true));
    }


}


/**
 * Extended
 * @author AARON LOTE <aaron.lote@gmail.com>
 */
class Extended extends Singleton {


    /**
     * Converts a float to a straight up rounded int
     * @param integer $value  numeric value we are going to update
     * @return numeric
     */
    public static function roundNumericValues($value) {
        return is_numeric($value) ? round($value) : $value;
    }

};


# call an instance of the singleton
$single = Singleton::getInstance();

# load the file.php which contains $data, maybe this was intended to be an xml file or json file?
$single->loadFile();

# lets just print out the flattened array for testing purposes
print_r($single->flattenedMultidimensionalArray($single->data));

# write the array to a log file
$single->writeArrayToFile($single->flattenedMultidimensionalArray($single->data));