using System;

public class AmountInWordsEn
{
    private string[] ones = new string[] { "Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen" };
    private string[] tens = new string[] { "", "Ten", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety" };

    public string ConvertAmountToWords(double amount)
    {
        return AmountInWord(amount);
    }

    private string AmountInWord(double amount = 0)
    {
        double val = amount;
        string words = "";
        if (val < 99999999999999)
        {
            string[] result = val.ToString().Split('.');
            int exponent = (!string.IsNullOrEmpty(result[1])) ? int.Parse(result[1]) : 0;
            words += EnglishNumber(int.Parse(result[0]));
            words += " Taka";
            if (exponent != 0)
            {
                words += " " + EnglishNumber(exponent);
                words += " Poysha";
            }
        }
        return words;
    }

    private string EnglishNumber(int value)
    {
        if (value < 0)
        {
            return "-" + EnglishNumber(-value);
        }
        else if (value >= 10000000)
        {
            return EnglishNumber(value / 10000000) + " Crore" + (value % 10000000 != 0 ? " " + EnglishNumber(value % 10000000) : "");
        }
        else if (value >= 100000)
        {
            return EnglishNumber(value / 100000) + " Lakh" + (value % 100000 != 0 ? " " + EnglishNumber(value % 100000) : "");
        }
        else if (value >= 1000)
        {
            if (value % 1000 != 0)
            {
                return EnglishNumber(value / 1000) + " Thousand " + EnglishNumber(value % 1000);
            }
            else
            {
                return EnglishNumber(value / 1000) + " Thousand";
            }
        }
        else if (value >= 100)
        {
            return EnglishNumber(value / 100) + " Hundred" + (value % 100 != 0 ? " " + EnglishNumber(value % 100) : "");
        }
        else if (value >= 20)
        {
            return tens[value / 10] + (value % 10 != 0 ? " " + ones[value % 10] : "");
        }
        else
        {
            return ones[value];
        }
    }
}

class Program
{
    static void Main(string[] args)
    {
        AmountInWordsEn amountInWordsEn = new AmountInWordsEn();
        string words = amountInWordsEn.ConvertAmountToWords(1050543.11);
        Console.WriteLine(words);
    }
}