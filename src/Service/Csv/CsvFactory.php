<?php


namespace App\Service\Csv;


use League\Csv\Reader;
use League\Csv\Writer;

class CsvFactory
{
    /**
     * @param string $fileName
     * @return Reader
     */
    public function createReader(string $fileName){
        return Reader::createFromPath($fileName);
    }

    /**
     * @param string $fileName
     * @return Writer
     */
    public function createWriter(string $fileName){
        return Writer::createFromPath($fileName);
    }
}