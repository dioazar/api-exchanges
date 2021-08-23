<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    private $currencies = [
        ['Peso Argentino', 'ARS', '$'],
        ['Dollars', 'USD', '$'],
        ['Euro', 'EUR', '€'],
        ['Dollars', 'CAD', '$'],
        ['Leke', 'ALL', 'Lek'],
        ['Afghanis', 'AFN', '؋'],
        ['Guilders', 'AWG', 'ƒ'],
        ['Dollars', 'AUD', '$'],
        ['New Manats', 'AZN', 'ман'],
        ['Dollars', 'BSD', '$'],
        ['Dollars', 'BBD', '$'],
        ['Rubles', 'BYR', 'p.'],
        ['Dollars', 'BZD', 'BZ$'],
        ['Dollars', 'BMD', '$'],
        ['Bolivianos', 'BOB', '$b'],
        ['Convertible Marka', 'BAM', 'KM'],
        ['Pula', 'BWP', 'P'],
        ['Leva', 'BGN', 'лв'],
        ['Reais', 'BRL', 'R$'],
        ['Pounds', 'GBP', '£'],
        ['Dollars', 'BND', '$'],
        ['Riels', 'KHR', '៛'],
        ['Dollars', 'KYD', '$'],
        ['Pesos', 'CLP', '$'],
        ['Yuan Renminbi', 'CNY', '¥'],
        ['Pesos', 'COP', '$'],
        ['Colón', 'CRC', '₡'],
        ['Kuna', 'HRK', 'kn'],
        ['Pesos', 'CUP', '₱'],
        ['Koruny', 'CZK', 'Kč'],
        ['Kroner', 'DKK', 'kr'],
        ['Pesos', 'DOP ', 'RD$'],
        ['Dollars', 'XCD', '$'],
        ['Pounds', 'EGP', '£'],
        ['Colones', 'SVC', '$'],
        ['Pounds', 'FKP', '£'],
        ['Dollars', 'FJD', '$'],
        ['Cedis', 'GHC', '¢'],
        ['Pounds', 'GIP', '£'],
        ['Quetzales', 'GTQ', 'Q'],
        ['Pounds', 'GGP', '£'],
        ['Dollars', 'GYD', '$'],
        ['Lempiras', 'HNL', 'L'],
        ['Dollars', 'HKD', '$'],
        ['Forint', 'HUF', 'Ft'],
        ['Kronur', 'ISK', 'kr'],
        ['Rupees', 'INR', 'Rp'],
        ['Rupiahs', 'IDR', 'Rp'],
        ['Rials', 'IRR', '﷼'],
        ['Pounds', 'IMP', '£'],
        ['New Shekels', 'ILS', '₪'],
        ['Dollars', 'JMD', 'J$'],
        ['Yen', 'JPY', '¥'],
        ['Pounds', 'JEP', '£'],
        ['Tenge', 'KZT', 'лв'],
        ['Won', 'KPW', '₩'],
        ['Won', 'KRW', '₩'],
        ['Soms', 'KGS', 'лв'],
        ['Kips', 'LAK', '₭'],
        ['Lati', 'LVL', 'Ls'],
        ['Pounds', 'LBP', '£'],
        ['Dollars', 'LRD', '$'],
        ['Switzerland Francs', 'CHF', 'CHF'],
        ['Litai', 'LTL', 'Lt'],
        ['Denars', 'MKD', 'ден'],
        ['Ringgits', 'MYR', 'RM'],
        ['Rupees', 'MUR', '₨'],
        ['Pesos', 'MXN', '$'],
        ['Tugriks', 'MNT', '₮'],
        ['Meticais', 'MZN', 'MT'],
        ['Dollars', 'NAD', '$'],
        ['Rupees', 'NPR', '₨'],
        ['Guilders', 'ANG', 'ƒ'],
        ['Dollars', 'NZD', '$'],
        ['Cordobas', 'NIO', 'C$'],
        ['Nairas', 'NGN', '₦'],
        ['Krone', 'NOK', 'kr'],
        ['Rials', 'OMR', '﷼'],
        ['Rupees', 'PKR', '₨'],
        ['Balboa', 'PAB', 'B/.'],
        ['Guarani', 'PYG', 'Gs'],
        ['Nuevos Soles', 'PEN', 'S/.'],
        ['Pesos', 'PHP', 'Php'],
        ['Zlotych', 'PLN', 'zł'],
        ['Rials', 'QAR', '﷼'],
        ['New Lei', 'RON', 'lei'],
        ['Rubles', 'RUB', 'руб'],
        ['Pounds', 'SHP', '£'],
        ['Riyals', 'SAR', '﷼'],
        ['Dinars', 'RSD', 'Дин.'],
        ['Rupees', 'SCR', '₨'],
        ['Dollars', 'SGD', '$'],
        ['Dollars', 'SBD', '$'],
        ['Shillings', 'SOS', 'S'],
        ['Rand', 'ZAR', 'R'],
        ['Rupees', 'LKR', '₨'],
        ['Kronor', 'SEK', 'kr'],
        ['Dollars', 'SRD', '$'],
        ['Pounds', 'SYP', '£'],
        ['New Dollars', 'TWD', 'NT$'],
        ['Baht', 'THB', '฿'],
        ['Dollars', 'TTD', 'TT$'],
        ['Lira', 'TRY', 'TL'],
        ['Liras', 'TRL', '£'],
        ['Dollars', 'TVD', '$'],
        ['Hryvnia', 'UAH', '₴'],
        ['Pesos', 'UYU', '$U'],
        ['Sums', 'UZS', 'лв'],
        ['Bolivares Fuertes', 'VEF', 'Bs'],
        ['Dong', 'VND', '₫'],
        ['Rials', 'YER', '﷼'],
        ['Zimbabwe Dollars', 'ZWD', 'Z$'],
    ];

    public function run()
    {
        foreach ($this->currencies as $value){
            $currency = Currency::where('name', $value[1])->orWhere('code', $value[1])->first();

            if ($currency) {
                $currency->name = $value[0];
                $currency->code = $value[1];
                $currency->symbol = $value[2];
                $currency->save();
            } else {
                Currency::create([
                    'name' => $value[0],
                    'code' => $value[1],
                    'symbol' => $value[2]
                ]);
            }
        }
    }
}
