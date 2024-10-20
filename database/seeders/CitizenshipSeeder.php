<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitizenshipSeeder extends Seeder
{
    public function run(): void
    {
        $citizenships = [
            'Filipino',
            'Afghan',
            'Albanian',
            'Algerian',
            'American',
            'Andorran',
            'Angolan',
            'Argentine',
            'Armenian',
            'Australian',
            'Austrian',
            'Azerbaijani',
            'Bahamian',
            'Bahraini',
            'Bangladeshi',
            'Barbadian',
            'Belarusian',
            'Belgian',
            'Belizean',
            'Beninese',
            'Bhutanese',
            'Bolivian',
            'Bosnian',
            'Botswanan',
            'Brazilian',
            'British',
            'Bruneian',
            'Bulgarian',
            'Burkinabé',
            'Burmese',
            'Burundian',
            'Cambodian',
            'Cameroonian',
            'Canadian',
            'Cape Verdean',
            'Central African',
            'Chadian',
            'Chilean',
            'Chinese',
            'Colombian',
            'Comoran',
            'Congolese (Congo-Brazzaville)',
            'Congolese (Congo-Kinshasa)',
            'Costa Rican',
            'Croatian',
            'Cuban',
            'Cypriot',
            'Czech',
            'Danish',
            'Djiboutian',
            'Dominican',
            'Dominican (Dominican Republic)',
            'Dutch',
            'East Timorese',
            'Ecuadorian',
            'Egyptian',
            'Emirati',
            'English',
            'Equatorial Guinean',
            'Eritrean',
            'Estonian',
            'Ethiopian',
            'Fijian',
            'Finnish',
            'French',
            'Gabonese',
            'Gambian',
            'Georgian',
            'German',
            'Ghanaian',
            'Greek',
            'Grenadian',
            'Guatemalan',
            'Guinean',
            'Guyanese',
            'Haitian',
            'Honduran',
            'Hungarian',
            'Icelandic',
            'Indian',
            'Indonesian',
            'Iranian',
            'Iraqi',
            'Irish',
            'Israeli',
            'Italian',
            'Ivorian',
            'Jamaican',
            'Japanese',
            'Jordanian',
            'Kazakh',
            'Kenyan',
            'Kiribati',
            'Korean (North)',
            'Korean (South)',
            'Kosovar',
            'Kuwaiti',
            'Kyrgyz',
            'Laotian',
            'Latvian',
            'Lebanese',
            'Liberian',
            'Libyan',
            'Liechtensteiner',
            'Lithuanian',
            'Luxembourger',
            'Macedonian',
            'Madagascan',
            'Malawian',
            'Malaysian',
            'Maldivian',
            'Malian',
            'Maltese',
            'Marshallese',
            'Mauritanian',
            'Mauritian',
            'Mexican',
            'Micronesian',
            'Moldovan',
            'Monegasque',
            'Mongolian',
            'Montenegrin',
            'Moroccan',
            'Mozambican',
            'Namibian',
            'Nauruan',
            'Nepalese',
            'New Zealander',
            'Nicaraguan',
            'Nigerien',
            'Nigerian',
            'Norwegian',
            'Omani',
            'Pakistani',
            'Palauan',
            'Palestinian',
            'Panamanian',
            'Papua New Guinean',
            'Paraguayan',
            'Peruvian',
            'Polish',
            'Portuguese',
            'Qatari',
            'Romanian',
            'Russian',
            'Rwandan',
            'Saint Lucian',
            'Salvadoran',
            'Samoan',
            'San Marinese',
            'São Toméan',
            'Saudi',
            'Senegalese',
            'Serbian',
            'Seychellois',
            'Sierra Leonean',
            'Singaporean',
            'Slovak',
            'Slovenian',
            'Solomon Islander',
            'Somali',
            'South African',
            'Spanish',
            'Sri Lankan',
            'Sudanese',
            'Surinamese',
            'Swazi',
            'Swedish',
            'Swiss',
            'Syrian',
            'Taiwanese',
            'Tajik',
            'Tanzanian',
            'Thai',
            'Togolese',
            'Tongan',
            'Trinidadian/Tobagonian',
            'Tunisian',
            'Turkish',
            'Turkmen',
            'Tuvaluan',
            'Ugandan',
            'Ukrainian',
            'Uruguayan',
            'Uzbek',
            'Vanuatuan',
            'Venezuelan',
            'Vietnamese',
            'Yemeni',
            'Zambian',
            'Zimbabwean'
        ];

        foreach ($citizenships as $citizenship) {
            DB::table('citizenship')->insert([
                'citizenship_name' => $citizenship, 
            ]);
        }
    }
}
