<?php
/**
 * PHP Script to Convert Numeric Amounts into Words for Bangladeshi Currency
 *
 * This script contains a function `amountInWord` which takes a numeric amount and converts it into its
 * equivalent word representation in the context of Bangladeshi currency (Taka and Poysha).
 *
 * Requirements:
 * - PHP 7.0 or higher (as strict_types is used).
 * 
 * Usage:
 * 
 * 1. Include this script in your PHP project.
 * 2. To convert an amount into words, call the `amountInWord` function with a numeric value as its argument.
 *    Example: 
 *    ```php
 *    declare(strict_types=1);
 *    $amount = 1000000000.55;
 *    amountInWord((string) $amount);
 *    ```
 *    This will output "One Hundred Crore Taka and Fifty Five Poysha".
 * 
 * Functionality:
 * - The function handles amounts up to 99999999999999.
 * - It converts the integer part into words followed by 'Taka' and the decimal part into words followed by 'Poysha'.
 * - Zero Poysha is not displayed if the decimal part is 0.
 * 
 * Note:
 * - The function expects a string type input for the amount due to PHP's handling of large numbers and floating points.
 * - Ensure to cast the amount to string before passing it to the function if it's not already a string.
 * 
 * This script is particularly useful for financial applications, billing systems, and anywhere
 * where there is a need to display currency amounts in words.
 *
 * Author: [Zawadul Kawum]
 * Repository: [https://github.com/zawad1992/number_in_words_library]
 * License: [N/A]
 */


declare(strict_types=1);

$amount =  1000000000.55;
amountInWord((string) $amount);
		

function amountInWord(string $amount='0') : void {
    $val = (double)$amount;
    if($val<99999999999999){
        $result = explode('.',(string) $val);
        $exponent =(!empty($result[1]))? $result[1]:0;
        echo englishNumber((int) $result[0]);
        echo ' Taka';
        if($exponent!=0){
        echo englishNumber((int) $exponent);
        // echo englishNumber_exp($exponent); // Use this if you want 11 as One One Instead of Eleven
        echo ' Poysha';

        }
    }
}
function englishNumber(int $value) : void{
    //$value = ltrim($value, '0');
    $ones = array(" Zero ", " One ", " Two ", " Three ", " Four ", " Five ", " Six ", " Seven ", " Eight ", " Nine "," Ten ", " Eleven ", " Twelve ", " Thirteen ", " Fourteen ", " Fifteen ", " Sixteen ", " Seventeen ", " Eighteen ", " Nineteen ", " Twenty ", " Twenty One ", " Twenty Two ", " Twenty Three ", " Twenty Four ", " Twenty Five ", " Twenty Six ", " Twenty Seven "," Twenty Eight "," Twenty Nine ", " Thirty "," Thirty One ", " Thirty Two ", " Thirty Three ", " Thirty Four ", " Thirty Five ", " Thirty Six ", " Thirty Seven ", " Thirty Eight "," Thirty Nine ", " Forty ", " Forty One ", " Forty Two ", " Forty Three ", " Forty Four ", " Forty Five ", " Forty Six ", " Forty Seven ", " Forty Eight ", " Forty Nine ", " Fifty ", " Fifty One ", " Fifty Two ", " Fifty Three ", " Fifty Four ", " Fifty Five ", " Fifty Six ", " Fifty Seven ", " Fifty Eight ", " Fifty Nine ", " Sixty ", " Sixty One ", " Sixty Two ", " Sixty Three ", " Sixty Four ", " Sixty Five ", " Sixty Six ", " Sixty Seven ", " Sixty Eight ", " Sixty Nine ", " Seventy ", " Seventy One ", " Seventy Two ", " Seventy Three ", " Seventy Four ", " Seventy Five ", " Seventy Six ", " Seventy Seven ", " Seventy Eight ", " Seventy Nine ", " Eighty ", " Eighty One ", " Eighty Two ", " Eighty Three ", " Eighty Four ", " Eighty Five ", " Eighty Six ", " Eighty Seven ", " Eighty Eight ", " Eighty Nine ", " Ninety ", " Ninety One ", " Ninety Two ", " Ninety Three ", " Ninety Four ", " Ninety Five ", " Ninety Six ", " Ninety Seven ", " Ninety Eight ", " Ninety Nine ");

    $tens = array("", "Ten", "Twenty", "Thirty","Fourty","Fifty","Sixty","Seventy","Eighty","Ninety");

    if($value<0)
    {
        print "-";
        englishNumber(-$value);
    }
    
    else if($value>=1000000000)
    {
    	englishNumber($value/10000000);
        print " Crore ";
        $value_1 = substr((string)$value, -7);

        if($value_1>=100000 && $value_1<=9999999){
        englishNumber($value_1/100000);
        print " Lakh ";
        }
       

        $value_2 = substr((string)$value, -5);
        if($value_2>=1000 && $value_2<=99999){
        englishNumber($value_2/1000);
        print " Thousand ";
        }
        
        $value_3 = substr((string)$value, -3);

        if($value_3 >= 100){
            englishNumber($value_3 / 100);
            print" Hundred ";
            if($value_3 % 100)
            {
                print " ";
                englishNumber ($value_3 % 100);
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
    	
        englishNumber($value/10000000);
        print " Crore ";
        if($value % 10000000)
        {
            if($value % 10000000 < 1000000)
            {
                print "";
            }
            print " " ;
            englishNumber($value % 10000000);
        }
    }

    else if($value>=100000 && $value<=9999999)
    {
        englishNumber($value/100000);
        print " Lakh ";
        if($value % 100000)
        {
            if($value % 100000 < 100000)
            {
                print "";
            }
            print " " ;
            englishNumber($value % 100000);
        }
    }
    else if($value>=1000 && $value<=99999)
    {
        englishNumber($value/1000);
        print " Thousand ";
        if($value % 1000)
        {
            if($value % 1000 < 100)
            {
                print "";
            }
            print " " ;
            englishNumber($value % 1000);
        }
    }
    else if($value >= 100)
    {
        englishNumber($value / 100);
        print" Hundred ";
        if($value % 100)
        {
            print "";
            englishNumber ($value % 100);
        }
    }
   
    else
    {
        print $ones[$value];
    }
    return;
}
function englishNumber_exp($value1){
    $ones = array(" Zero ", " One ", " Two ", " Three ", " Four ", " Five ", " Six ", " Seven ", " Eight ", " Nine ");
   
    $value1 = str_replace(range(0, 9),$ones,$value1); 
    echo $value1;
  
    //print $ones[$value1];
    return;
}
