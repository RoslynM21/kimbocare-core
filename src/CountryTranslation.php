<?php

namespace Kimbocare\Core;

use Exception;

/**
 * Service de traduction des pays.
 *
 * Ce service permet de traduire les noms des pays en fonction du code du pays et de la langue cible.
 * Actuellement, il prend en charge l'anglais et le français, mais il est conçu pour être facilement extensible.
 */
class CountryTranslation
{
    /**
     * Tableau des traductions des pays par code pays et langue.
     *
     * @var array
     */
    private array $countryTranslations;

    /**
     * Liste des langues disponibles pour la traduction.
     *
     * @var array
     */
    private array $availableLanguages;


    /**
     * Constructeur pour initialiser le service avec les traductions configurées.
     *
     * Le service utilise une configuration externe pour gérer les traductions des pays.
     * Actuellement, les traductions disponibles sont en anglais et en français.
     * Cette configuration peut être étendue pour inclure plus de pays et de langues.
     */
    public function __construct()
    {
        $this->countryTranslations = self::COUNTRY_TRANSLATIONS;

        $this->availableLanguages = ['fr', 'en'];
    }




    /**
     * Obtenez la traduction du nom d'un pays dans une langue donnée.
     *
     * Cette méthode renvoie la traduction du pays pour la langue cible, si disponible.
     * Si le pays ou la langue ne sont pas trouvés, une exception est levée.
     *
     * @param string $countryCode Le code du pays à traduire (par exemple 'FR' pour la France).
     * @param string $languageCode Le code de la langue cible (par exemple 'en' pour l'anglais, 'fr' pour le français).
     *
     * @return string Le nom du pays dans la langue cible.
     *
     * @throws Exception Si la traduction n'est pas disponible pour ce pays ou cette langue.
     */
    public function getCountryTranslation(string $countryCode, string $languageCode): string
    {
        if (!in_array($languageCode, $this->availableLanguages)) {
            throw new Exception("La langue {$languageCode} n'est pas disponible pour la traduction.");
        }

        if (isset($this->countryTranslations[$languageCode][$countryCode])) {
            return $this->countryTranslations[$languageCode][$countryCode];
        }

        throw new Exception("La traduction pour le pays {$countryCode} dans la langue {$languageCode} n'est pas disponible.");
    }




    /**
     * Obtenez la traduction du pays en anglais.
     *
     * Cette méthode renvoie la traduction du pays en anglais, si disponible.
     * Si le pays n'est pas trouvé dans la liste des traductions en anglais, une exception est levée.
     *
     * @param string $countryCode Le code du pays à traduire (par exemple 'cm' pour le Cameroun).
     *
     * @return string Le nom du pays en anglais.
     *
     * @throws Exception Si la traduction en anglais n'est pas disponible pour ce pays.
     */
    public function getCountryTranslationInEnglish(string $countryCode): string
    {
        return $this->getCountryTranslation($countryCode, 'en');
    }

    /**
     * Obtenez la traduction du pays en français.
     *
     * Cette méthode renvoie la traduction du pays en français, si disponible.
     * Si le pays n'est pas trouvé dans la liste des traductions en français, une exception est levée.
     *
     * @param string $countryCode Le code du pays à traduire (par exemple 'cm' pour le Cameroun).
     *
     * @return string Le nom du pays en français.
     *
     * @throws Exception Si la traduction en français n'est pas disponible pour ce pays.
     */
    public function getCountryTranslationInFrench(string $countryCode): string
    {
        return $this->getCountryTranslation($countryCode, 'fr');
    }



    /**
     * Tableau des traductions des pays par code pays et langue.
     *
     * Ce tableau contient les noms des pays traduits en fonction du code pays et de la langue cible.
     * Actuellement, les traductions disponibles sont pour le français (fr) et l'anglais (en).
     * Ce tableau peut être étendu pour inclure d'autres langues et pays.
     */
    const COUNTRY_TRANSLATIONS = [
        'fr' => [
            "cm" => "Cameroun",
            "ci" => "Côte d’Ivoire",
            "ke" => "Kenya",
            "af" => "Afghanistan",
            "al" => "Albanie",
            "dz" => "Algérie",
            "ad" => "Andorre",
            "ao" => "Angola",
            "ar" => "Argentine",
            "am" => "Arménie",
            "aw" => "Aruba",
            "au" => "Australie",
            "at" => "Autriche",
            "az" => "Azerbaïdjan",
            "bh" => "Bahreïn",
            "bd" => "Bangladesh",
            "by" => "Biélorussie",
            "be" => "Belgique",
            "bz" => "Belize",
            "bj" => "Bénin",
            "bt" => "Bhoutan",
            "bo" => "Bolivie",
            "ba" => "Bosnie-Herzégovine",
            "bw" => "Botswana",
            "br" => "Brésil",
            "bn" => "Brunei Darussalam",
            "bg" => "Bulgarie",
            "bf" => "Burkina Faso",
            "bi" => "Burundi",
            "kh" => "Cambodge",
            "cv" => "Cap-Vert",
            "cf" => "République centrafricaine",
            "td" => "Tchad",
            "cl" => "Chili",
            "cn" => "Chine",
            "co" => "Colombie",
            "km" => "Comores",
            "cg" => "Congo",
            "cd" => "Congo (RDC)",
            "ck" => "Îles Cook",
            "cr" => "Costa Rica",
            "hr" => "Croatie",
            "cu" => "Cuba",
            "cy" => "Chypre",
            "cz" => "République tchèque",
            "dk" => "Danemark",
            "dj" => "Djibouti",
            "ec" => "Équateur",
            "eg" => "Égypte",
            "sv" => "Salvador",
            "gq" => "Guinée équatoriale",
            "er" => "Érythrée",
            "ee" => "Estonie",
            "et" => "Éthiopie",
            "fo" => "Îles Féroé",
            "fj" => "Fidji",
            "fi" => "Finlande",
            "fr" => "France",
            "pf" => "Polynésie française",
            "ga" => "Gabon",
            "gm" => "Gambie",
            "ge" => "Géorgie",
            "de" => "Allemagne",
            "gh" => "Ghana",
            "gi" => "Gibraltar",
            "gr" => "Grèce",
            "gl" => "Groenland",
            "gp" => "Guadeloupe",
            "gt" => "Guatemala",
            "gn" => "Guinée",
            "gw" => "Guinée-Bissau",
            "gy" => "Guyana",
            "ht" => "Haïti",
            "hn" => "Honduras",
            "hk" => "Hong Kong",
            "hu" => "Hongrie",
            "is" => "Islande",
            "in" => "Inde",
            "id" => "Indonésie",
            "ir" => "Iran",
            "iq" => "Irak",
            "ie" => "Irlande",
            "il" => "Israël",
            "it" => "Italie",
            "jp" => "Japon",
            "jo" => "Jordanie",
            "kp" => "Corée du Nord",
            "kr" => "Corée du Sud",
            "kw" => "Koweït",
            "kg" => "Kirghizistan",
            "la" => "Laos",
            "lv" => "Lettonie",
            "lb" => "Liban",
            "ls" => "Lesotho",
            "lr" => "Libéria",
            "ly" => "Libye",
            "li" => "Liechtenstein",
            "lt" => "Lituanie",
            "lu" => "Luxembourg",
            "mo" => "Macao",
            "mk" => "Macédoine du Nord",
            "mg" => "Madagascar",
            "mw" => "Malawi",
            "my" => "Malaisie",
            "mv" => "Maldives",
            "ml" => "Mali",
            "mt" => "Malte",
            "mh" => "Îles Marshall",
            "mq" => "Martinique",
            "mr" => "Mauritanie",
            "mu" => "Maurice",
            "mx" => "Mexique",
            "fm" => "Micronésie",
            "md" => "Moldavie",
            "mc" => "Monaco",
            "mn" => "Mongolie",
            "me" => "Monténégro",
            "ma" => "Maroc",
            "mz" => "Mozambique",
            "mm" => "Myanmar",
            "na" => "Namibie",
            "nr" => "Nauru",
            "np" => "Népal",
            "nl" => "Pays-Bas",
            "nc" => "Nouvelle-Calédonie",
            "nz" => "Nouvelle-Zélande",
            "ni" => "Nicaragua",
            "ne" => "Niger",
            "ng" => "Nigeria",
            "no" => "Norvège",
            "om" => "Oman",
            "pk" => "Pakistan",
            "pw" => "Palaos",
            "ps" => "Palestine",
            "pa" => "Panama",
            "pg" => "Papouasie-Nouvelle-Guinée",
            "py" => "Paraguay",
            "pe" => "Pérou",
            "ph" => "Philippines",
            "pl" => "Pologne",
            "pt" => "Portugal",
            "qa" => "Qatar",
            "re" => "Réunion",
            "ro" => "Roumanie",
            "ru" => "Russie",
            "rw" => "Rwanda",
            "ws" => "Samoa",
            "sm" => "Saint-Marin",
            "st" => "Sao Tomé-et-Principe",
            "sa" => "Arabie Saoudite",
            "sn" => "Sénégal",
            "rs" => "Serbie",
            "sc" => "Seychelles",
            "sl" => "Sierra Leone",
            "sg" => "Singapour",
            "sk" => "Slovaquie",
            "si" => "Slovénie",
            "sb" => "Îles Salomon",
            "so" => "Somalie",
            "za" => "Afrique du Sud",
            "es" => "Espagne",
            "lk" => "Sri Lanka",
            "sd" => "Soudan",
            "sr" => "Suriname",
            "sz" => "Eswatini",
            "se" => "Suède",
            "ch" => "Suisse",
            "sy" => "Syrie",
            "tw" => "Taïwan",
            "tj" => "Tadjikistan",
            "tz" => "Tanzanie",
            "th" => "Thaïlande",
            "tl" => "Timor-Leste",
            "tg" => "Togo",
            "to" => "Tonga",
            "tn" => "Tunisie",
            "tr" => "Turquie",
            "tm" => "Turkménistan",
            "tv" => "Tuvalu",
            "ug" => "Ouganda",
            "ua" => "Ukraine",
            "ae" => "Émirats Arabes Unis",
            "gb" => "Royaume-Uni",
            "us" => "États-Unis",
            "uy" => "Uruguay",
            "uz" => "Ouzbékistan",
            "vu" => "Vanuatu",
            "ve" => "Venezuela",
            "vn" => "Viêt Nam",
            "ye" => "Yémen",
            "zm" => "Zambie",
            "zw" => "Zimbabwe",
            "ag" => "Antigua-et-Barbuda",
            "bb" => "Barbade",
            "ca" => "Canada",
            "dm" => "Dominique",
            "do" => "République dominicaine",
            "gd" => "Grenade",
            "jm" => "Jamaïque",
            "ki" => "Kiribati",
            "xk" => "Kosovo",
            "lc" => "Sainte-Lucie",
            "vc" => "Saint-Vincent-et-les-Grenadines",
            "tt" => "Trinité-et-Tobago",
            "kn" => "Saint-Kitts-et-Nevis"
        ],
        'en' => [
            "cm" => "Cameroon",
            "ci" => "Ivory coast",
            "ke" => "Kenya",
            "af" => "Afghanistan",
            "al" => "Albania",
            "dz" => "Algeria",
            "ad" => "Andorra",
            "ao" => "Angola",
            "ar" => "Argentina",
            "am" => "Armenia",
            "aw" => "Aruba",
            "au" => "Australia",
            "at" => "Austria",
            "az" => "Azerbaijan",
            "bh" => "Bahrain",
            "bd" => "Bangladesh",
            "by" => "Belarus",
            "be" => "Belgium",
            "bz" => "Belize",
            "bj" => "Benin",
            "bt" => "Bhutan",
            "bo" => "Bolivia",
            "ba" => "Bosnia and Herzegovina",
            "bw" => "Botswana",
            "br" => "Brazil",
            "bn" => "Brunei Darussalam",
            "bg" => "Bulgaria",
            "bf" => "Burkina Faso",
            "bi" => "Burundi",
            "kh" => "Cambodia",
            "cv" => "Cape Verde",
            "cf" => "Central African Republic",
            "td" => "Chad",
            "cl" => "Chile",
            "cn" => "China",
            "co" => "Colombia",
            "km" => "Comoros",
            "cg" => "Congo",
            "cd" => "Congo (DRC)",
            "ck" => "Cook Islands",
            "cr" => "Costa Rica",
            "hr" => "Croatia",
            "cu" => "Cuba",
            "cy" => "Cyprus",
            "cz" => "Czech Republic",
            "dk" => "Denmark",
            "dj" => "Djibouti",
            "ec" => "Ecuador",
            "eg" => "Egypt",
            "sv" => "El Salvador",
            "gq" => "Equatorial Guinea",
            "er" => "Eritrea",
            "ee" => "Estonia",
            "et" => "Ethiopia",
            "fo" => "Faroe Islands",
            "fj" => "Fiji",
            "fi" => "Finland",
            "fr" => "France",
            "pf" => "French Polynesia",
            "ga" => "Gabon",
            "gm" => "Gambia",
            "ge" => "Georgia",
            "de" => "Germany",
            "gh" => "Ghana",
            "gi" => "Gibraltar",
            "gr" => "Greece",
            "gl" => "Greenland",
            "gp" => "Guadeloupe",
            "gt" => "Guatemala",
            "gn" => "Guinea",
            "gw" => "Guinea-Bissau",
            "gy" => "Guyana",
            "ht" => "Haiti",
            "hn" => "Honduras",
            "hk" => "Hong Kong",
            "hu" => "Hungary",
            "is" => "Iceland",
            "in" => "India",
            "id" => "Indonesia",
            "ir" => "Iran",
            "iq" => "Iraq",
            "ie" => "Ireland",
            "il" => "Israel",
            "it" => "Italy",
            "jp" => "Japan",
            "jo" => "Jordan",
            "kp" => "North Korea",
            "kr" => "South Korea",
            "kw" => "Kuwait",
            "kg" => "Kyrgyzstan",
            "la" => "Laos",
            "lv" => "Latvia",
            "lb" => "Lebanon",
            "ls" => "Lesotho",
            "lr" => "Liberia",
            "ly" => "Libya",
            "li" => "Liechtenstein",
            "lt" => "Lithuania",
            "lu" => "Luxembourg",
            "mo" => "Macau",
            "mk" => "North Macedonia",
            "mg" => "Madagascar",
            "mw" => "Malawi",
            "my" => "Malaysia",
            "mv" => "Maldives",
            "ml" => "Mali",
            "mt" => "Malta",
            "mh" => "Marshall Islands",
            "mq" => "Martinique",
            "mr" => "Mauritania",
            "mu" => "Mauritius",
            "mx" => "Mexico",
            "fm" => "Micronesia",
            "md" => "Moldova",
            "mc" => "Monaco",
            "mn" => "Mongolia",
            "me" => "Montenegro",
            "ma" => "Morocco",
            "mz" => "Mozambique",
            "mm" => "Myanmar",
            "na" => "Namibia",
            "nr" => "Nauru",
            "np" => "Nepal",
            "nl" => "Netherlands",
            "nc" => "New Caledonia",
            "nz" => "New Zealand",
            "ni" => "Nicaragua",
            "ne" => "Niger",
            "ng" => "Nigeria",
            "no" => "Norway",
            "om" => "Oman",
            "pk" => "Pakistan",
            "pw" => "Palau",
            "ps" => "Palestine",
            "pa" => "Panama",
            "pg" => "Papua New Guinea",
            "py" => "Paraguay",
            "pe" => "Peru",
            "ph" => "Philippines",
            "pl" => "Poland",
            "pt" => "Portugal",
            "qa" => "Qatar",
            "re" => "Reunion",
            "ro" => "Romania",
            "ru" => "Russia",
            "rw" => "Rwanda",
            "ws" => "Samoa",
            "sm" => "San Marino",
            "st" => "Sao Tome and Principe",
            "sa" => "Saudi Arabia",
            "sn" => "Senegal",
            "rs" => "Serbia",
            "sc" => "Seychelles",
            "sl" => "Sierra Leone",
            "sg" => "Singapore",
            "sk" => "Slovakia",
            "si" => "Slovenia",
            "sb" => "Solomon Islands",
            "so" => "Somalia",
            "za" => "South Africa",
            "es" => "Spain",
            "lk" => "Sri Lanka",
            "sd" => "Sudan",
            "sr" => "Suriname",
            "sz" => "Eswatini",
            "se" => "Sweden",
            "ch" => "Switzerland",
            "sy" => "Syria",
            "tw" => "Taiwan",
            "tj" => "Tajikistan",
            "tz" => "Tanzania",
            "th" => "Thailand",
            "tl" => "Timor-Leste",
            "tg" => "Togo",
            "to" => "Tonga",
            "tn" => "Tunisia",
            "tr" => "Turkey",
            "tm" => "Turkmenistan",
            "tv" => "Tuvalu",
            "ug" => "Uganda",
            "ua" => "Ukraine",
            "ae" => "United Arab Emirates",
            "gb" => "United Kingdom",
            "us" => "United States",
            "uy" => "Uruguay",
            "uz" => "Uzbekistan",
            "vu" => "Vanuatu",
            "ve" => "Venezuela",
            "vn" => "Vietnam",
            "ye" => "Yemen",
            "zm" => "Zambia",
            "zw" => "Zimbabwe",
            "ag" => "Antigua and Barbuda",
            "bb" => "Barbados",
            "ca" => "Canada",
            "dm" => "Dominica",
            "do" => "Dominican Republic",
            "gd" => "Grenada",
            "jm" => "Jamaica",
            "ki" => "Kiribati",
            "xk" => "Kosovo",
            "lc" => "Saint Lucia",
            "vc" => "Saint Vincent and the Grenadines",
            "tt" => "Trinidad and Tobago",
            "kn" => "Saint Kitts and Nevis"
        ]
    ];
}
