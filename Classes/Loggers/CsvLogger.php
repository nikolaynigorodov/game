<?php


namespace Classes\Loggers;


class CsvLogger
{
    protected static $fileName;

    static function writeToFile($text)
    {
        $list = explode("</p>", $text);
        $file = "csv/" . uniqid() . ".csv";

        if(is_array($list)) {
            $fp = fopen($file, 'w');
            foreach ($list as $fields) {
                fputcsv($fp, (array) strip_tags($fields));
            }
            fclose($fp);
            self::$fileName = $file;
        }
    }

    /**
     * @return string
     */
    public static function getFileName()
    {
        return self::$fileName;
    }
}