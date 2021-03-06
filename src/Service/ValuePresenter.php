<?php

namespace App\Service;


use App\Entity\DataEntry;

class ValuePresenter
{
    private static $dataEntries;
    private static $decimals = 0;

    /**
     * @param string $value
     * @return string
     */
    public static function present(string $value): string
    {
        if(empty(self::$dataEntries)){
            return $value;
        }

        return number_format($value, self::$decimals, '.', "'");
    }

    /**
     * @param DataEntry[] $dataEntries
     */
    public static function setDataEntries(array $dataEntries)
    {
        self::$dataEntries = $dataEntries;
        self::$decimals = 0;

        foreach($dataEntries as $dataEntry){
            $arr = explode(".", $dataEntry->getValue());
            $decimals = $arr[1];
            for($i = 0; $i < strlen($decimals); $i++)
            {
                $digit = substr($decimals, $i, 1);
                if($digit !== "0"){
                    if($i + 1 > self::$decimals)
                    {
                        self::$decimals = $i + 1;
                    }
                }
            }
        }
    }
}