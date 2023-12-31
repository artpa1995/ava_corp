<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesCode extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $countries = array(
        'Cyprus' => 'CY',
        'Netherlands' => 'NL',
        'Switzerland' => 'CH',
        'United States' => 'US',
        'United Kingdom' => 'GB',
        'Ireland' => 'IE',
        'Aruba' => 'AW',
        'Afghanistan' => 'AF',
        'Angola' => 'AO',
        'Albania' => 'AL',
        'Andorra' => 'AD',
        'United Arab Emirates' => 'AE',
        'Argentina' => 'AR',
        'Armenia' => 'AM',
        'American Samoa' => 'AS',
        'Antigua and Barbuda' => 'AG',
        'Australia' => 'AU',
        'Austria' => 'AT',
        'Azerbaijan' => 'AZ',
        'Burundi' => 'BI',
        'Belgium' => 'BE',
        'Benin' => 'BJ',
        'Burkina Faso' => 'BF',
        'Bangladesh' => 'BD',
        'Bulgaria' => 'BG',
        'Bahrain' => 'BH',
        'Bahamas, The' => 'BS',
        'Bosnia and Herzegovina' => 'BA',
        'Belarus' => 'BY',
        'Belize' => 'BZ',
        'Bermuda' => 'BM',
        'Bolivia' => 'BO',
        'Brazil' => 'BZ',
        'Barbados' => 'BB',
        'Brunei Darussalam' => 'BN',
        'Bhutan' => 'BT',
        'Botswana' => 'BW',
        'Central African Republic' => 'CF',
        'Canada' => 'CA',
        'Channel Islands' => 'KY',
        'Chile' => 'CL',
        'China' => 'CN',
        'Cote d\'Ivoire' => 'CI',
        'Cameroon' => 'CM',
        'Congo, Dem. Rep.' => 'CD',
        'Congo, Rep.' => 'CG',
        'Colombia' => 'CO',
        'Comoros' => 'KM',
        'Cabo Verde' => 'CV',
        'Costa Rica' => 'CR',
        'Cuba' => 'CU',
        'Curacao' => 'CW',
        'Cayman Islands' => 'KY',
        'Czech Republic' => 'CZ',
        'Germany' => 'DE',
        'Djibouti' => 'DJ',
        'Dominica' => 'DM',
        'Denmark' => 'DK',
        'Dominican Republic' => 'DO',
        'Algeria' => 'DZ',
        'Ecuador' => 'EC',
        'Egypt, Arab Rep.' => 'EG',
        'Eritrea' => 'ER',
        'Spain' => 'ES',
        'Estonia' => 'EE',
        'Ethiopia' => 'ET',
        'Finland' => 'FI',
        'Fiji' => 'FJ',
        'France' => 'FR',
        'Faroe Islands' => 'FO',
        'Micronesia, Fed. Sts.' => 'FM',
        'Gabon' => 'GA',
        'Georgia' => 'GE',
        'Ghana' => 'GH',
        'Gibraltar' => 'GI',
        'Guinea' => 'GN',
        'Gambia, The' => 'GN',
        'Guinea-Bissau' => 'GW',
        'Equatorial Guinea' => 'GQ',
        'Greece' => 'GR',
        'Grenada' => 'GD',
        'Greenland' => 'GL',
        'Guatemala' => 'GT',
        'Guam' => 'GU',
        'Guyana' => 'GY',
        'Hong Kong SAR, China' => 'HK',
        'Honduras' => 'HN',
        'Croatia' => 'HR',
        'Haiti' => 'HT',
        'Hungary' => 'HU',
        'Indonesia' => 'ID',
        'Isle of Man' => 'IM',
        'India' => 'IN',
        'Iran, Islamic Rep.' => 'IR',
        'Iraq' => 'IQ',
        'Iceland' => 'IS',
        'Israel' => 'IL',
        'Italy' => 'IT',
        'Jamaica' => 'JM',
        'Jordan' => 'JO',
        'Japan' => 'JP',
        'Kazakhstan' => 'KZ',
        'Kenya' => 'KE',
        'Kyrgyz Republic' => 'KG',
        'Cambodia' => 'KH',
        'Kiribati' => 'KI',
        'St. Kitts and Nevis' => 'KN',
        'Korea, Rep.' => 'KR',
        'Kuwait' => 'KW',
        'Lao PDR' => 'LA',
        'Lebanon' => 'LB',
        'Liberia' => 'LR',
        'Libya' => 'LY',
        'St. Lucia' => 'LC',
        'Liechtenstein' => 'LI',
        'Sri Lanka' => 'LK',
        'Lesotho' => 'LS',
        'Lithuania' => 'LT',
        'Luxembourg' => 'LU',
        'Latvia' => 'LV',
        'Macao SAR, China' => 'MO',
        'St. Martin (French part)' => 'MF',
        'Morocco' => 'MA',
        'Monaco' => 'MC',
        'Moldova' => 'MD',
        'Madagascar' => 'MG',
        'Maldives' => 'MV',
        'Mexico' => 'MX',
        'Marshall Islands' => 'MH',
        'Macedonia, FYR' => 'MK',
        'Mali' => 'ML',
        'Malta' => 'MT',
        'Myanmar' => 'MM',
        'Montenegro' => 'ME',
        'Mongolia' => 'MN',
        'Northern Mariana Islands' => 'MP',
        'Mozambique' => 'MZ',
        'Mauritania' => 'MR',
        'Mauritius' => 'MU',
        'Malawi' => 'MW',
        'Malaysia' => 'MY',
        'Namibia' => 'NA',
        'New Caledonia' => 'NC',
        'Niger' => 'NE',
        'Nigeria' => 'NG',
        'Nicaragua' => 'NI',
        'Norway' => 'NO',
        'Nepal' => 'NP',
        'Nauru' => 'NR',
        'New Zealand' => 'NZ',
        'Oman' => 'OM',
        'Pakistan' => 'PK',
        'Panama' => 'PA',
        'Peru' => 'PE',
        'Philippines' => 'PH',
        'Palau' => 'PW',
        'Papua New Guinea' => 'PG',
        'Poland' => 'PL',
        'Puerto Rico' => 'PR',
        'Korea, Dem. Peoples Rep.' => 'KP',
        'Portugal' => 'PT',
        'Paraguay' => 'PY',
        'West Bank and Gaza' => 'GZ',
        'French Polynesia' => 'PF',
        'Qatar' => 'QA',
        'Romania' => 'RO',
        'Russian Federation' => 'RU',
        'Rwanda' => 'RW',
        'Saudi Arabia' => 'SA',
        'Sudan' => 'SD',
        'Senegal' => 'SN',
        'Singapore' => 'SG',
        'Solomon Islands' => 'SB',
        'Sierra Leone' => 'SL',
        'El Salvador' => 'SV',
        'San Marino' => 'SM',
        'Somalia' => 'SO',
        'Serbia' => 'RS',
        'South Sudan' => 'SS',
        'Sao Tome and Principe' => 'ST',
        'Suriname' => 'SR',
        'Slovak Republic' => 'SK',
        'Slovenia' => 'SI',
        'Sweden' => 'SE',
        'Swaziland' => 'SZ',
        'Sint Maarten (Dutch part)' => 'SX',
        'Seychelles' => 'SC',
        'Syrian Arab Republic' => 'SY',
        'Turks and Caicos Islands' => 'TC',
        'Chad' => 'TD',
        'Togo' => 'TG',
        'Thailand' => 'TH',
        'Tajikistan' => 'TJ',
        'Turkmenistan' => 'TM',
        'Timor-Leste' => 'TL',
        'Tonga' => 'TO',
        'Trinidad and Tobago' => 'TT',
        'Tunisia' => 'TN',
        'Turkey' => 'TR',
        'Tuvalu' => 'TV',
        'Taiwan, China' => 'TW',
        'Tanzania' => 'TZ',
        'Uganda' => 'UG',
        'Ukraine' => 'UA',
        'Uruguay' => 'UY',
        'Uzbekistan' => 'UZ',
        'St. Vincent and the Grenadines' => 'VC',
        'Venezuela, RB' => 'VE',
        'British Virgin Islands' => 'VG',
        'Virgin Islands (U.S.)' => 'VI',
        'Vietnam' => 'VN',
        'Vanuatu' => 'VU',
        'Samoa' => 'AS',
        'Kosovo' => 'XK',
        'Yemen, Rep.' => 'YE',
        'South Africa' => 'ZA',
        'Zambia' => 'ZM',
        'Zimbabwe' => 'ZW',
     );

    public function run()
    {
        foreach ($this->countries as $key => $country){
            DB::table('countries')
                ->where('name', $key)
                ->update(array('code' => $country));
        }

    }
}
