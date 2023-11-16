<?php
/**
 * PHP Class for Converting Numeric Amounts into Words in Bangladeshi Currency Format
 *
 * This script features the `AmountInWordsEn` class, which converts numerical amounts into their word equivalents
 * in the context of Bangladeshi currency (Taka and Poysha). It is designed to handle both integer and fractional parts of an amount.
 *
 * Requirements:
 * - PHP 7.0 or higher (due to the use of strict_types).
 *
 * Usage:
 * 
 * 1. Include this script in your PHP project.
 * 2. Instantiate the `AmountInWordsEn` class with the numeric amount as a string argument.
 *    Example:
 *    ```php
 *    declare(strict_types=1);
 *    $amount = 1234.56;
 *    $amountInWordEn = new AmountInWordsEn((string) $amount);
 *    ```
 *    This will automatically output "One Thousand Two Hundred Thirty Four Taka and Fifty Six Poysha".
 * 
 * Features:
 * - Handles amounts up to 99999999999999.
 * - Converts both the integer and decimal parts of the amount into words, appending 'Taka' for the integer part and 'Poysha' for the decimal part.
 * - Does not display 'Zero Poysha' if the decimal part is 0.
 * 
 * This class is ideal for applications like financial systems, invoicing tools, and reports where currency amounts need to be verbalized.
 *
 * Author: [Zawadul Kawum]
 * Repository: [https://github.com/zawad1992/number_in_words_library]
 * License: [N/A]
 */
 
declare(strict_types=1);

$amount =  1000000000.55;
$amountInWordEn = new AmountInWordsEn((string) $amount);

class AmountInWordsEn
{
    function __construct(string $amount) {
        $this->amountInWord($amount);
    }

    private function amountInWord(string $amount='0') : void {
        $val = (double)$amount;
        if($val<99999999999999){
            $result = explode('.',(string) $val);
            $exponent =(!empty($result[1]))? $result[1]:0;
            echo $this->englishNumber((int) $result[0]);
            echo ' Taka';
            if($exponent!=0){
            echo $this->englishNumber((int) $exponent);
            // echo $this->englishNumber_exp($exponent); // Use this if you want 11 as One One Instead of Eleven
            echo ' Poysha';

            }
        }
    }
    private function englishNumber(int $value) : void {
        //$value = ltrim($value, '0');
        $ones = array(" Zero ", " One ", " Two ", " Three ", " Four ", " Five ", " Six ", " Seven ", " Eight ", " Nine "," Ten ", " Eleven ", " Twelve ", " Thirteen ", " Fourteen ", " Fifteen ", " Sixteen ", " Seventeen ", " Eighteen ", " Nineteen ", " Twenty ", " Twenty One ", " Twenty Two ", " Twenty Three ", " Twenty Four ", " Twenty Five ", " Twenty Six ", " Twenty Seven "," Twenty Eight "," Twenty Nine ", " Thirty "," Thirty One ", " Thirty Two ", " Thirty Three ", " Thirty Four ", " Thirty Five ", " Thirty Six ", " Thirty Seven ", " Thirty Eight "," Thirty Nine ", " Forty ", " Forty One ", " Forty Two ", " Forty Three ", " Forty Four ", " Forty Five ", " Forty Six ", " Forty Seven ", " Forty Eight ", " Forty Nine ", " Fifty ", " Fifty One ", " Fifty Two ", " Fifty Three ", " Fifty Four ", " Fifty Five ", " Fifty Six ", " Fifty Seven ", " Fifty Eight ", " Fifty Nine ", " Sixty ", " Sixty One ", " Sixty Two ", " Sixty Three ", " Sixty Four ", " Sixty Five ", " Sixty Six ", " Sixty Seven ", " Sixty Eight ", " Sixty Nine ", " Seventy ", " Seventy One ", " Seventy Two ", " Seventy Three ", " Seventy Four ", " Seventy Five ", " Seventy Six ", " Seventy Seven ", " Seventy Eight ", " Seventy Nine ", " Eighty ", " Eighty One ", " Eighty Two ", " Eighty Three ", " Eighty Four ", " Eighty Five ", " Eighty Six ", " Eighty Seven ", " Eighty Eight ", " Eighty Nine ", " Ninety ", " Ninety One ", " Ninety Two ", " Ninety Three ", " Ninety Four ", " Ninety Five ", " Ninety Six ", " Ninety Seven ", " Ninety Eight ", " Ninety Nine ");

        $tens = array("", "Ten", "Twenty", "Thirty","Fourty","Fifty","Sixty","Seventy","Eighty","Ninety");

        if($value<0)
        {
            print "-";
            $this->englishNumber(-$value);
        }
        
        else if($value>=1000000000)
        {
            $this->englishNumber($value/10000000);
            print " Crore ";
            $value_1 = substr((string)$value, -7);

            if($value_1>=100000 && $value_1<=9999999){
            $this->englishNumber($value_1/100000);
            print " Lakh ";
            }
           

            $value_2 = substr((string)$value, -5);
            if($value_2>=1000 && $value_2<=99999){
            $this->englishNumber($value_2/1000);
            print " Thousand ";
            }
            
            $value_3 = substr((string)$value, -3);

            if($value_3 >= 100){
                $this->englishNumber($value_3 / 100);
                print" Hundred ";
                if($value_3 % 100)
                {
                    print " ";
                    $this->englishNumber($value_3 % 100);
                }
            } 
            $value_4 = substr((string)$value, -2);
            $value_4 = ltrim($value_4, '0');
            if($value_3<100 && $value_3!='0'){  
            print $ones[$value_4];
            }
           
        }

        else if($value>=10000000 && $value<=999999999)
        {
            
            $this->englishNumber($value/10000000);
            print " Crore ";
            if($value % 10000000)
            {
                if($value % 10000000 < 1000000)
                {
                    print "";
                }
                print " " ;
                $this->englishNumber($value % 10000000);
            }
        }

        else if($value>=100000 && $value<=9999999)
        {
            $this->englishNumber($value/100000);
            print " Lakh ";
            if($value % 100000)
            {
                if($value % 100000 < 100000)
                {
                    print "";
                }
                print " " ;
                $this->englishNumber($value % 100000);
            }
        }
        else if($value>=1000 && $value<=99999)
        {
            $this->englishNumber($value/1000);
            print " Thousand ";
            if($value % 1000)
            {
                if($value % 1000 < 100)
                {
                    print "";
                }
                print " " ;
                $this->englishNumber($value % 1000);
            }
        }
        else if($value >= 100)
        {
            $this->englishNumber($value / 100);
            print" Hundred ";
            if($value % 100)
            {
                print "";
                $this->englishNumber($value % 100);
            }
        }
       
        else
        {
            print $ones[$value];
        }
        return;
    }
    private function englishNumber_exp(string $value1) : void {
        $ones = array(" Zero ", " One ", " Two ", " Three ", " Four ", " Five ", " Six ", " Seven ", " Eight ", " Nine ");
       
        $value1 = str_replace(range(0, 9),$ones,$value1); 
        echo $value1;
      
        //print $ones[$value1];
        return;
    }

}
