<?php

namespace jumper423\migration;

/**
 * This class translates mysql views into postgresql views.
 */
class ViewGenerator
{
    /**
     * The purpose of explicit private constructor is 
     * to prevent an instance initialization.
     * 
     * @param void
     */
    private function __construct()
    {
        // No code should be put here.
    }
    
    /**
     * Attempt to convert mysql view to postgresql view.
     * 
     * @param  string $strSchema
     * @param  string $strViewName
     * @param  string $strMySqlViewCode
     * @return string
     */
    public static function generateView($strSchema, $strViewName, $strMySqlViewCode)
    {
        $strMySqlViewCode = str_replace('`', '"', $strMySqlViewCode);
        $intQueryStart    = stripos($strMySqlViewCode, 'as');
        $strMySqlViewCode = substr($strMySqlViewCode, $intQueryStart);
        
        $arrMySqlViewCode      = explode(' ', $strMySqlViewCode);
        $intMySqlViewCodeCount = count($arrMySqlViewCode);
        
        for ($i = 0; $i < $intMySqlViewCodeCount; $i++) {
            if (
                ('from' == strtolower($arrMySqlViewCode[$i]) || 'join' == strtolower($arrMySqlViewCode[$i])) 
                && ($i + 1 < $intMySqlViewCodeCount)
            ) {
                $arrMySqlViewCode[$i + 1] = '"' . $strSchema . '".' . $arrMySqlViewCode[$i + 1];
            }
        }
        
        return 'CREATE OR REPLACE VIEW "' . $strSchema . '"."' . $strViewName . '" ' . implode(' ', $arrMySqlViewCode);
    }
}
