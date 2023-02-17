<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Time;

use DateTimeZone;
use Dogma\Enum\PartialStringEnum;
use Dogma\InvalidValueException;
use function date_default_timezone_get;
use function date_default_timezone_set;
use function in_array;

class TimeZone extends PartialStringEnum
{

    public const UTC = 'UTC';

    public const AFRICA_ABIDJAN = 'Africa/Abidjan';
    public const AFRICA_ACCRA = 'Africa/Accra';
    public const AFRICA_ADDIS_ABABA = 'Africa/Addis_Ababa';
    public const AFRICA_ALGIERS = 'Africa/Algiers';
    public const AFRICA_ASMARA = 'Africa/Asmara';
    public const AFRICA_BAMAKO = 'Africa/Bamako';
    public const AFRICA_BANGUI = 'Africa/Bangui';
    public const AFRICA_BANJUL = 'Africa/Banjul';
    public const AFRICA_BISSAU = 'Africa/Bissau';
    public const AFRICA_BLANTYRE = 'Africa/Blantyre';
    public const AFRICA_BRAZZAVILLE = 'Africa/Brazzaville';
    public const AFRICA_BUJUMBURA = 'Africa/Bujumbura';
    public const AFRICA_CAIRO = 'Africa/Cairo';
    public const AFRICA_CASABLANCA = 'Africa/Casablanca';
    public const AFRICA_CEUTA = 'Africa/Ceuta';
    public const AFRICA_CONAKRY = 'Africa/Conakry';
    public const AFRICA_DAKAR = 'Africa/Dakar';
    public const AFRICA_DAR_ES_SALAAM = 'Africa/Dar_es_Salaam';
    public const AFRICA_DJIBOUTI = 'Africa/Djibouti';
    public const AFRICA_DOUALA = 'Africa/Douala';
    public const AFRICA_EL_AAIUN = 'Africa/El_Aaiun';
    public const AFRICA_FREETOWN = 'Africa/Freetown';
    public const AFRICA_GABORONE = 'Africa/Gaborone';
    public const AFRICA_HARARE = 'Africa/Harare';
    public const AFRICA_JOHANNESBURG = 'Africa/Johannesburg';
    public const AFRICA_JUBA = 'Africa/Juba';
    public const AFRICA_KAMPALA = 'Africa/Kampala';
    public const AFRICA_KHARTOUM = 'Africa/Khartoum';
    public const AFRICA_KIGALI = 'Africa/Kigali';
    public const AFRICA_KINSHASA = 'Africa/Kinshasa';
    public const AFRICA_LAGOS = 'Africa/Lagos';
    public const AFRICA_LIBREVILLE = 'Africa/Libreville';
    public const AFRICA_LOME = 'Africa/Lome';
    public const AFRICA_LUANDA = 'Africa/Luanda';
    public const AFRICA_LUBUMBASHI = 'Africa/Lubumbashi';
    public const AFRICA_LUSAKA = 'Africa/Lusaka';
    public const AFRICA_MALABO = 'Africa/Malabo';
    public const AFRICA_MAPUTO = 'Africa/Maputo';
    public const AFRICA_MASERU = 'Africa/Maseru';
    public const AFRICA_MBABANE = 'Africa/Mbabane';
    public const AFRICA_MOGADISHU = 'Africa/Mogadishu';
    public const AFRICA_MONROVIA = 'Africa/Monrovia';
    public const AFRICA_NAIROBI = 'Africa/Nairobi';
    public const AFRICA_NDJAMENA = 'Africa/Ndjamena';
    public const AFRICA_NIAMEY = 'Africa/Niamey';
    public const AFRICA_NOUAKCHOTT = 'Africa/Nouakchott';
    public const AFRICA_OUAGADOUGOU = 'Africa/Ouagadougou';
    public const AFRICA_PORTO_NOVO = 'Africa/Porto-Novo';
    public const AFRICA_SAO_TOME = 'Africa/Sao_Tome';
    public const AFRICA_TRIPOLI = 'Africa/Tripoli';
    public const AFRICA_TUNIS = 'Africa/Tunis';
    public const AFRICA_WINDHOEK = 'Africa/Windhoek';
    public const AMERICA_ADAK = 'America/Adak';
    public const AMERICA_ANCHORAGE = 'America/Anchorage';
    public const AMERICA_ANGUILLA = 'America/Anguilla';
    public const AMERICA_ANTIGUA = 'America/Antigua';
    public const AMERICA_ARAGUAINA = 'America/Araguaina';
    public const AMERICA_ARGENTINA_BUENOS_AIRES = 'America/Argentina/Buenos_Aires';
    public const AMERICA_ARGENTINA_CATAMARCA = 'America/Argentina/Catamarca';
    public const AMERICA_ARGENTINA_CORDOBA = 'America/Argentina/Cordoba';
    public const AMERICA_ARGENTINA_JUJUY = 'America/Argentina/Jujuy';
    public const AMERICA_ARGENTINA_LA_RIOJA = 'America/Argentina/La_Rioja';
    public const AMERICA_ARGENTINA_MENDOZA = 'America/Argentina/Mendoza';
    public const AMERICA_ARGENTINA_RIO_GALLEGOS = 'America/Argentina/Rio_Gallegos';
    public const AMERICA_ARGENTINA_SALTA = 'America/Argentina/Salta';
    public const AMERICA_ARGENTINA_SAN_JUAN = 'America/Argentina/San_Juan';
    public const AMERICA_ARGENTINA_SAN_LUIS = 'America/Argentina/San_Luis';
    public const AMERICA_ARGENTINA_TUCUMAN = 'America/Argentina/Tucuman';
    public const AMERICA_ARGENTINA_USHUAIA = 'America/Argentina/Ushuaia';
    public const AMERICA_ARUBA = 'America/Aruba';
    public const AMERICA_ASUNCION = 'America/Asuncion';
    public const AMERICA_ATIKOKAN = 'America/Atikokan';
    public const AMERICA_BAHIA = 'America/Bahia';
    public const AMERICA_BAHIA_BANDERAS = 'America/Bahia_Banderas';
    public const AMERICA_BARBADOS = 'America/Barbados';
    public const AMERICA_BELEM = 'America/Belem';
    public const AMERICA_BELIZE = 'America/Belize';
    public const AMERICA_BLANC_SABLON = 'America/Blanc-Sablon';
    public const AMERICA_BOA_VISTA = 'America/Boa_Vista';
    public const AMERICA_BOGOTA = 'America/Bogota';
    public const AMERICA_BOISE = 'America/Boise';
    public const AMERICA_CAMBRIDGE_BAY = 'America/Cambridge_Bay';
    public const AMERICA_CAMPO_GRANDE = 'America/Campo_Grande';
    public const AMERICA_CANCUN = 'America/Cancun';
    public const AMERICA_CARACAS = 'America/Caracas';
    public const AMERICA_CAYENNE = 'America/Cayenne';
    public const AMERICA_CAYMAN = 'America/Cayman';
    public const AMERICA_CHICAGO = 'America/Chicago';
    public const AMERICA_CHIHUAHUA = 'America/Chihuahua';
    public const AMERICA_COSTA_RICA = 'America/Costa_Rica';
    public const AMERICA_CRESTON = 'America/Creston';
    public const AMERICA_CUIABA = 'America/Cuiaba';
    public const AMERICA_CURACAO = 'America/Curacao';
    public const AMERICA_DANMARKSHAVN = 'America/Danmarkshavn';
    public const AMERICA_DAWSON = 'America/Dawson';
    public const AMERICA_DAWSON_CREEK = 'America/Dawson_Creek';
    public const AMERICA_DENVER = 'America/Denver';
    public const AMERICA_DETROIT = 'America/Detroit';
    public const AMERICA_DOMINICA = 'America/Dominica';
    public const AMERICA_EDMONTON = 'America/Edmonton';
    public const AMERICA_EIRUNEPE = 'America/Eirunepe';
    public const AMERICA_EL_SALVADOR = 'America/El_Salvador';
    public const AMERICA_FORT_NELSON = 'America/Fort_Nelson';
    public const AMERICA_FORTALEZA = 'America/Fortaleza';
    public const AMERICA_GLACE_BAY = 'America/Glace_Bay';
    public const AMERICA_GODTHAB = 'America/Godthab';
    public const AMERICA_GOOSE_BAY = 'America/Goose_Bay';
    public const AMERICA_GRAND_TURK = 'America/Grand_Turk';
    public const AMERICA_GRENADA = 'America/Grenada';
    public const AMERICA_GUADELOUPE = 'America/Guadeloupe';
    public const AMERICA_GUATEMALA = 'America/Guatemala';
    public const AMERICA_GUAYAQUIL = 'America/Guayaquil';
    public const AMERICA_GUYANA = 'America/Guyana';
    public const AMERICA_HALIFAX = 'America/Halifax';
    public const AMERICA_HAVANA = 'America/Havana';
    public const AMERICA_HERMOSILLO = 'America/Hermosillo';
    public const AMERICA_INDIANA_INDIANAPOLIS = 'America/Indiana/Indianapolis';
    public const AMERICA_INDIANA_KNOX = 'America/Indiana/Knox';
    public const AMERICA_INDIANA_MARENGO = 'America/Indiana/Marengo';
    public const AMERICA_INDIANA_PETERSBURG = 'America/Indiana/Petersburg';
    public const AMERICA_INDIANA_TELL_CITY = 'America/Indiana/Tell_City';
    public const AMERICA_INDIANA_VEVAY = 'America/Indiana/Vevay';
    public const AMERICA_INDIANA_VINCENNES = 'America/Indiana/Vincennes';
    public const AMERICA_INDIANA_WINAMAC = 'America/Indiana/Winamac';
    public const AMERICA_INUVIK = 'America/Inuvik';
    public const AMERICA_IQALUIT = 'America/Iqaluit';
    public const AMERICA_JAMAICA = 'America/Jamaica';
    public const AMERICA_JUNEAU = 'America/Juneau';
    public const AMERICA_KENTUCKY_LOUISVILLE = 'America/Kentucky/Louisville';
    public const AMERICA_KENTUCKY_MONTICELLO = 'America/Kentucky/Monticello';
    public const AMERICA_KRALENDIJK = 'America/Kralendijk';
    public const AMERICA_LA_PAZ = 'America/La_Paz';
    public const AMERICA_LIMA = 'America/Lima';
    public const AMERICA_LOS_ANGELES = 'America/Los_Angeles';
    public const AMERICA_LOWER_PRINCES = 'America/Lower_Princes';
    public const AMERICA_MACEIO = 'America/Maceio';
    public const AMERICA_MANAGUA = 'America/Managua';
    public const AMERICA_MANAUS = 'America/Manaus';
    public const AMERICA_MARIGOT = 'America/Marigot';
    public const AMERICA_MARTINIQUE = 'America/Martinique';
    public const AMERICA_MATAMOROS = 'America/Matamoros';
    public const AMERICA_MAZATLAN = 'America/Mazatlan';
    public const AMERICA_MENOMINEE = 'America/Menominee';
    public const AMERICA_MERIDA = 'America/Merida';
    public const AMERICA_METLAKATLA = 'America/Metlakatla';
    public const AMERICA_MEXICO_CITY = 'America/Mexico_City';
    public const AMERICA_MIQUELON = 'America/Miquelon';
    public const AMERICA_MONCTON = 'America/Moncton';
    public const AMERICA_MONTERREY = 'America/Monterrey';
    public const AMERICA_MONTEVIDEO = 'America/Montevideo';
    public const AMERICA_MONTSERRAT = 'America/Montserrat';
    public const AMERICA_NASSAU = 'America/Nassau';
    public const AMERICA_NEW_YORK = 'America/New_York';
    public const AMERICA_NIPIGON = 'America/Nipigon';
    public const AMERICA_NOME = 'America/Nome';
    public const AMERICA_NORONHA = 'America/Noronha';
    public const AMERICA_NORTH_DAKOTA_BEULAH = 'America/North_Dakota/Beulah';
    public const AMERICA_NORTH_DAKOTA_CENTER = 'America/North_Dakota/Center';
    public const AMERICA_NORTH_DAKOTA_NEW_SALEM = 'America/North_Dakota/New_Salem';
    public const AMERICA_OJINAGA = 'America/Ojinaga';
    public const AMERICA_PANAMA = 'America/Panama';
    public const AMERICA_PANGNIRTUNG = 'America/Pangnirtung';
    public const AMERICA_PARAMARIBO = 'America/Paramaribo';
    public const AMERICA_PHOENIX = 'America/Phoenix';
    public const AMERICA_PORT_OF_SPAIN = 'America/Port_of_Spain';
    public const AMERICA_PORT_AU_PRINCE = 'America/Port-au-Prince';
    public const AMERICA_PORTO_VELHO = 'America/Porto_Velho';
    public const AMERICA_PUERTO_RICO = 'America/Puerto_Rico';
    public const AMERICA_PUNTA_ARENAS = 'America/Punta_Arenas';
    public const AMERICA_RAINY_RIVER = 'America/Rainy_River';
    public const AMERICA_RANKIN_INLET = 'America/Rankin_Inlet';
    public const AMERICA_RECIFE = 'America/Recife';
    public const AMERICA_REGINA = 'America/Regina';
    public const AMERICA_RESOLUTE = 'America/Resolute';
    public const AMERICA_RIO_BRANCO = 'America/Rio_Branco';
    public const AMERICA_SANTAREM = 'America/Santarem';
    public const AMERICA_SANTIAGO = 'America/Santiago';
    public const AMERICA_SANTO_DOMINGO = 'America/Santo_Domingo';
    public const AMERICA_SAO_PAULO = 'America/Sao_Paulo';
    public const AMERICA_SCORESBYSUND = 'America/Scoresbysund';
    public const AMERICA_SITKA = 'America/Sitka';
    public const AMERICA_ST_BARTHELEMY = 'America/St_Barthelemy';
    public const AMERICA_ST_JOHNS = 'America/St_Johns';
    public const AMERICA_ST_KITTS = 'America/St_Kitts';
    public const AMERICA_ST_LUCIA = 'America/St_Lucia';
    public const AMERICA_ST_THOMAS = 'America/St_Thomas';
    public const AMERICA_ST_VINCENT = 'America/St_Vincent';
    public const AMERICA_SWIFT_CURRENT = 'America/Swift_Current';
    public const AMERICA_TEGUCIGALPA = 'America/Tegucigalpa';
    public const AMERICA_THULE = 'America/Thule';
    public const AMERICA_THUNDER_BAY = 'America/Thunder_Bay';
    public const AMERICA_TIJUANA = 'America/Tijuana';
    public const AMERICA_TORONTO = 'America/Toronto';
    public const AMERICA_TORTOLA = 'America/Tortola';
    public const AMERICA_VANCOUVER = 'America/Vancouver';
    public const AMERICA_WHITEHORSE = 'America/Whitehorse';
    public const AMERICA_WINNIPEG = 'America/Winnipeg';
    public const AMERICA_YAKUTAT = 'America/Yakutat';
    public const AMERICA_YELLOWKNIFE = 'America/Yellowknife';
    public const ANTARCTICA_CASEY = 'Antarctica/Casey';
    public const ANTARCTICA_DAVIS = 'Antarctica/Davis';
    public const ANTARCTICA_DUMONTDURVILLE = 'Antarctica/DumontDUrville';
    public const ANTARCTICA_MACQUARIE = 'Antarctica/Macquarie';
    public const ANTARCTICA_MAWSON = 'Antarctica/Mawson';
    public const ANTARCTICA_MCMURDO = 'Antarctica/McMurdo';
    public const ANTARCTICA_PALMER = 'Antarctica/Palmer';
    public const ANTARCTICA_ROTHERA = 'Antarctica/Rothera';
    public const ANTARCTICA_SYOWA = 'Antarctica/Syowa';
    public const ANTARCTICA_TROLL = 'Antarctica/Troll';
    public const ANTARCTICA_VOSTOK = 'Antarctica/Vostok';
    public const ARCTIC_LONGYEARBYEN = 'Arctic/Longyearbyen';
    public const ASIA_ADEN = 'Asia/Aden';
    public const ASIA_ALMATY = 'Asia/Almaty';
    public const ASIA_AMMAN = 'Asia/Amman';
    public const ASIA_ANADYR = 'Asia/Anadyr';
    public const ASIA_AQTAU = 'Asia/Aqtau';
    public const ASIA_AQTOBE = 'Asia/Aqtobe';
    public const ASIA_ASHGABAT = 'Asia/Ashgabat';
    public const ASIA_ATYRAU = 'Asia/Atyrau';
    public const ASIA_BAGHDAD = 'Asia/Baghdad';
    public const ASIA_BAHRAIN = 'Asia/Bahrain';
    public const ASIA_BAKU = 'Asia/Baku';
    public const ASIA_BANGKOK = 'Asia/Bangkok';
    public const ASIA_BARNAUL = 'Asia/Barnaul';
    public const ASIA_BEIRUT = 'Asia/Beirut';
    public const ASIA_BISHKEK = 'Asia/Bishkek';
    public const ASIA_BRUNEI = 'Asia/Brunei';
    public const ASIA_CHITA = 'Asia/Chita';
    public const ASIA_CHOIBALSAN = 'Asia/Choibalsan';
    public const ASIA_COLOMBO = 'Asia/Colombo';
    public const ASIA_DAMASCUS = 'Asia/Damascus';
    public const ASIA_DHAKA = 'Asia/Dhaka';
    public const ASIA_DILI = 'Asia/Dili';
    public const ASIA_DUBAI = 'Asia/Dubai';
    public const ASIA_DUSHANBE = 'Asia/Dushanbe';
    public const ASIA_FAMAGUSTA = 'Asia/Famagusta';
    public const ASIA_GAZA = 'Asia/Gaza';
    public const ASIA_HEBRON = 'Asia/Hebron';
    public const ASIA_HO_CHI_MINH = 'Asia/Ho_Chi_Minh';
    public const ASIA_HONG_KONG = 'Asia/Hong_Kong';
    public const ASIA_HOVD = 'Asia/Hovd';
    public const ASIA_IRKUTSK = 'Asia/Irkutsk';
    public const ASIA_JAKARTA = 'Asia/Jakarta';
    public const ASIA_JAYAPURA = 'Asia/Jayapura';
    public const ASIA_JERUSALEM = 'Asia/Jerusalem';
    public const ASIA_KABUL = 'Asia/Kabul';
    public const ASIA_KAMCHATKA = 'Asia/Kamchatka';
    public const ASIA_KARACHI = 'Asia/Karachi';
    public const ASIA_KATHMANDU = 'Asia/Kathmandu';
    public const ASIA_KHANDYGA = 'Asia/Khandyga';
    public const ASIA_KOLKATA = 'Asia/Kolkata';
    public const ASIA_KRASNOYARSK = 'Asia/Krasnoyarsk';
    public const ASIA_KUALA_LUMPUR = 'Asia/Kuala_Lumpur';
    public const ASIA_KUCHING = 'Asia/Kuching';
    public const ASIA_KUWAIT = 'Asia/Kuwait';
    public const ASIA_MACAU = 'Asia/Macau';
    public const ASIA_MAGADAN = 'Asia/Magadan';
    public const ASIA_MAKASSAR = 'Asia/Makassar';
    public const ASIA_MANILA = 'Asia/Manila';
    public const ASIA_MUSCAT = 'Asia/Muscat';
    public const ASIA_NICOSIA = 'Asia/Nicosia';
    public const ASIA_NOVOKUZNETSK = 'Asia/Novokuznetsk';
    public const ASIA_NOVOSIBIRSK = 'Asia/Novosibirsk';
    public const ASIA_OMSK = 'Asia/Omsk';
    public const ASIA_ORAL = 'Asia/Oral';
    public const ASIA_PHNOM_PENH = 'Asia/Phnom_Penh';
    public const ASIA_PONTIANAK = 'Asia/Pontianak';
    public const ASIA_PYONGYANG = 'Asia/Pyongyang';
    public const ASIA_QATAR = 'Asia/Qatar';
    public const ASIA_QYZYLORDA = 'Asia/Qyzylorda';
    public const ASIA_RIYADH = 'Asia/Riyadh';
    public const ASIA_SAKHALIN = 'Asia/Sakhalin';
    public const ASIA_SAMARKAND = 'Asia/Samarkand';
    public const ASIA_SEOUL = 'Asia/Seoul';
    public const ASIA_SHANGHAI = 'Asia/Shanghai';
    public const ASIA_SINGAPORE = 'Asia/Singapore';
    public const ASIA_SREDNEKOLYMSK = 'Asia/Srednekolymsk';
    public const ASIA_TAIPEI = 'Asia/Taipei';
    public const ASIA_TASHKENT = 'Asia/Tashkent';
    public const ASIA_TBILISI = 'Asia/Tbilisi';
    public const ASIA_TEHRAN = 'Asia/Tehran';
    public const ASIA_THIMPHU = 'Asia/Thimphu';
    public const ASIA_TOKYO = 'Asia/Tokyo';
    public const ASIA_TOMSK = 'Asia/Tomsk';
    public const ASIA_ULAANBAATAR = 'Asia/Ulaanbaatar';
    public const ASIA_URUMQI = 'Asia/Urumqi';
    public const ASIA_UST_NERA = 'Asia/Ust-Nera';
    public const ASIA_VIENTIANE = 'Asia/Vientiane';
    public const ASIA_VLADIVOSTOK = 'Asia/Vladivostok';
    public const ASIA_YAKUTSK = 'Asia/Yakutsk';
    public const ASIA_YANGON = 'Asia/Yangon';
    public const ASIA_YEKATERINBURG = 'Asia/Yekaterinburg';
    public const ASIA_YEREVAN = 'Asia/Yerevan';
    public const ATLANTIC_AZORES = 'Atlantic/Azores';
    public const ATLANTIC_BERMUDA = 'Atlantic/Bermuda';
    public const ATLANTIC_CANARY = 'Atlantic/Canary';
    public const ATLANTIC_CAPE_VERDE = 'Atlantic/Cape_Verde';
    public const ATLANTIC_FAROE = 'Atlantic/Faroe';
    public const ATLANTIC_MADEIRA = 'Atlantic/Madeira';
    public const ATLANTIC_REYKJAVIK = 'Atlantic/Reykjavik';
    public const ATLANTIC_SOUTH_GEORGIA = 'Atlantic/South_Georgia';
    public const ATLANTIC_ST_HELENA = 'Atlantic/St_Helena';
    public const ATLANTIC_STANLEY = 'Atlantic/Stanley';
    public const AUSTRALIA_ADELAIDE = 'Australia/Adelaide';
    public const AUSTRALIA_BRISBANE = 'Australia/Brisbane';
    public const AUSTRALIA_BROKEN_HILL = 'Australia/Broken_Hill';
    public const AUSTRALIA_CURRIE = 'Australia/Currie';
    public const AUSTRALIA_DARWIN = 'Australia/Darwin';
    public const AUSTRALIA_EUCLA = 'Australia/Eucla';
    public const AUSTRALIA_HOBART = 'Australia/Hobart';
    public const AUSTRALIA_LINDEMAN = 'Australia/Lindeman';
    public const AUSTRALIA_LORD_HOWE = 'Australia/Lord_Howe';
    public const AUSTRALIA_MELBOURNE = 'Australia/Melbourne';
    public const AUSTRALIA_PERTH = 'Australia/Perth';
    public const AUSTRALIA_SYDNEY = 'Australia/Sydney';
    public const EUROPE_AMSTERDAM = 'Europe/Amsterdam';
    public const EUROPE_ANDORRA = 'Europe/Andorra';
    public const EUROPE_ASTRAKHAN = 'Europe/Astrakhan';
    public const EUROPE_ATHENS = 'Europe/Athens';
    public const EUROPE_BELGRADE = 'Europe/Belgrade';
    public const EUROPE_BERLIN = 'Europe/Berlin';
    public const EUROPE_BRATISLAVA = 'Europe/Bratislava';
    public const EUROPE_BRUSSELS = 'Europe/Brussels';
    public const EUROPE_BUCHAREST = 'Europe/Bucharest';
    public const EUROPE_BUDAPEST = 'Europe/Budapest';
    public const EUROPE_BUSINGEN = 'Europe/Busingen';
    public const EUROPE_CHISINAU = 'Europe/Chisinau';
    public const EUROPE_COPENHAGEN = 'Europe/Copenhagen';
    public const EUROPE_DUBLIN = 'Europe/Dublin';
    public const EUROPE_GIBRALTAR = 'Europe/Gibraltar';
    public const EUROPE_GUERNSEY = 'Europe/Guernsey';
    public const EUROPE_HELSINKI = 'Europe/Helsinki';
    public const EUROPE_ISLE_OF_MAN = 'Europe/Isle_of_Man';
    public const EUROPE_ISTANBUL = 'Europe/Istanbul';
    public const EUROPE_JERSEY = 'Europe/Jersey';
    public const EUROPE_KALININGRAD = 'Europe/Kaliningrad';
    public const EUROPE_KIEV = 'Europe/Kiev';
    public const EUROPE_KIROV = 'Europe/Kirov';
    public const EUROPE_LISBON = 'Europe/Lisbon';
    public const EUROPE_LJUBLJANA = 'Europe/Ljubljana';
    public const EUROPE_LONDON = 'Europe/London';
    public const EUROPE_LUXEMBOURG = 'Europe/Luxembourg';
    public const EUROPE_MADRID = 'Europe/Madrid';
    public const EUROPE_MALTA = 'Europe/Malta';
    public const EUROPE_MARIEHAMN = 'Europe/Mariehamn';
    public const EUROPE_MINSK = 'Europe/Minsk';
    public const EUROPE_MONACO = 'Europe/Monaco';
    public const EUROPE_MOSCOW = 'Europe/Moscow';
    public const EUROPE_OSLO = 'Europe/Oslo';
    public const EUROPE_PARIS = 'Europe/Paris';
    public const EUROPE_PODGORICA = 'Europe/Podgorica';
    public const EUROPE_PRAGUE = 'Europe/Prague';
    public const EUROPE_RIGA = 'Europe/Riga';
    public const EUROPE_ROME = 'Europe/Rome';
    public const EUROPE_SAMARA = 'Europe/Samara';
    public const EUROPE_SAN_MARINO = 'Europe/San_Marino';
    public const EUROPE_SARAJEVO = 'Europe/Sarajevo';
    public const EUROPE_SARATOV = 'Europe/Saratov';
    public const EUROPE_SIMFEROPOL = 'Europe/Simferopol';
    public const EUROPE_SKOPJE = 'Europe/Skopje';
    public const EUROPE_SOFIA = 'Europe/Sofia';
    public const EUROPE_STOCKHOLM = 'Europe/Stockholm';
    public const EUROPE_TALLINN = 'Europe/Tallinn';
    public const EUROPE_TIRANE = 'Europe/Tirane';
    public const EUROPE_ULYANOVSK = 'Europe/Ulyanovsk';
    public const EUROPE_UZHGOROD = 'Europe/Uzhgorod';
    public const EUROPE_VADUZ = 'Europe/Vaduz';
    public const EUROPE_VATICAN = 'Europe/Vatican';
    public const EUROPE_VIENNA = 'Europe/Vienna';
    public const EUROPE_VILNIUS = 'Europe/Vilnius';
    public const EUROPE_VOLGOGRAD = 'Europe/Volgograd';
    public const EUROPE_WARSAW = 'Europe/Warsaw';
    public const EUROPE_ZAGREB = 'Europe/Zagreb';
    public const EUROPE_ZAPOROZHYE = 'Europe/Zaporozhye';
    public const EUROPE_ZURICH = 'Europe/Zurich';
    public const INDIAN_ANTANANARIVO = 'Indian/Antananarivo';
    public const INDIAN_CHAGOS = 'Indian/Chagos';
    public const INDIAN_CHRISTMAS = 'Indian/Christmas';
    public const INDIAN_COCOS = 'Indian/Cocos';
    public const INDIAN_COMORO = 'Indian/Comoro';
    public const INDIAN_KERGUELEN = 'Indian/Kerguelen';
    public const INDIAN_MAHE = 'Indian/Mahe';
    public const INDIAN_MALDIVES = 'Indian/Maldives';
    public const INDIAN_MAURITIUS = 'Indian/Mauritius';
    public const INDIAN_MAYOTTE = 'Indian/Mayotte';
    public const INDIAN_REUNION = 'Indian/Reunion';
    public const PACIFIC_APIA = 'Pacific/Apia';
    public const PACIFIC_AUCKLAND = 'Pacific/Auckland';
    public const PACIFIC_BOUGAINVILLE = 'Pacific/Bougainville';
    public const PACIFIC_CHATHAM = 'Pacific/Chatham';
    public const PACIFIC_CHUUK = 'Pacific/Chuuk';
    public const PACIFIC_EASTER = 'Pacific/Easter';
    public const PACIFIC_EFATE = 'Pacific/Efate';
    public const PACIFIC_ENDERBURY = 'Pacific/Enderbury';
    public const PACIFIC_FAKAOFO = 'Pacific/Fakaofo';
    public const PACIFIC_FIJI = 'Pacific/Fiji';
    public const PACIFIC_FUNAFUTI = 'Pacific/Funafuti';
    public const PACIFIC_GALAPAGOS = 'Pacific/Galapagos';
    public const PACIFIC_GAMBIER = 'Pacific/Gambier';
    public const PACIFIC_GUADALCANAL = 'Pacific/Guadalcanal';
    public const PACIFIC_GUAM = 'Pacific/Guam';
    public const PACIFIC_HONOLULU = 'Pacific/Honolulu';
    public const PACIFIC_KIRITIMATI = 'Pacific/Kiritimati';
    public const PACIFIC_KOSRAE = 'Pacific/Kosrae';
    public const PACIFIC_KWAJALEIN = 'Pacific/Kwajalein';
    public const PACIFIC_MAJURO = 'Pacific/Majuro';
    public const PACIFIC_MARQUESAS = 'Pacific/Marquesas';
    public const PACIFIC_MIDWAY = 'Pacific/Midway';
    public const PACIFIC_NAURU = 'Pacific/Nauru';
    public const PACIFIC_NIUE = 'Pacific/Niue';
    public const PACIFIC_NORFOLK = 'Pacific/Norfolk';
    public const PACIFIC_NOUMEA = 'Pacific/Noumea';
    public const PACIFIC_PAGO_PAGO = 'Pacific/Pago_Pago';
    public const PACIFIC_PALAU = 'Pacific/Palau';
    public const PACIFIC_PITCAIRN = 'Pacific/Pitcairn';
    public const PACIFIC_POHNPEI = 'Pacific/Pohnpei';
    public const PACIFIC_PORT_MORESBY = 'Pacific/Port_Moresby';
    public const PACIFIC_RAROTONGA = 'Pacific/Rarotonga';
    public const PACIFIC_SAIPAN = 'Pacific/Saipan';
    public const PACIFIC_TAHITI = 'Pacific/Tahiti';
    public const PACIFIC_TARAWA = 'Pacific/Tarawa';
    public const PACIFIC_TONGATAPU = 'Pacific/Tongatapu';
    public const PACIFIC_WAKE = 'Pacific/Wake';
    public const PACIFIC_WALLIS = 'Pacific/Wallis';

    /**
     * @see https://secure.php.net/manual/en/timezones.others.php for deprecated timezones info
     * @var string[]
     */
    private static $deprecated = [
        'Africa/Asmera',
        'Africa/Timbuktu',
        'America/Argentina/ComodRivadavia',
        'America/Atka',
        'America/Buenos_Aires',
        'America/Catamarca',
        'America/Coral_Harbour',
        'America/Cordoba',
        'America/Ensenada',
        'America/Fort_Wayne',
        'America/Indianapolis',
        'America/Jujuy',
        'America/Knox_IN',
        'America/Louisville',
        'America/Mendoza',
        'America/Montreal',
        'America/Porto_Acre',
        'America/Rosario',
        'America/Santa_Isabel',
        'America/Shiprock',
        'America/Virgin',
        'Antarctica/South_Pole',
        'Asia/Ashkhabad',
        'Asia/Calcutta',
        'Asia/Chongqing',
        'Asia/Chungking',
        'Asia/Dacca',
        'Asia/Harbin',
        'Asia/Istanbul',
        'Asia/Kashgar',
        'Asia/Katmandu',
        'Asia/Macao',
        'Asia/Rangoon',
        'Asia/Saigon',
        'Asia/Tel_Aviv',
        'Asia/Thimbu',
        'Asia/Ujung_Pandang',
        'Asia/Ulan_Bator',
        'Atlantic/Faeroe',
        'Atlantic/Jan_Mayen',
        'Australia/ACT',
        'Australia/Canberra',
        'Australia/LHI',
        'Australia/North',
        'Australia/NSW',
        'Australia/Queensland',
        'Australia/South',
        'Australia/Tasmania',
        'Australia/Victoria',
        'Australia/West',
        'Australia/Yancowinna',
        'Brazil/Acre',
        'Brazil/DeNoronha',
        'Brazil/East',
        'Brazil/West',
        'Canada/Atlantic',
        'Canada/Central',
        'Canada/Eastern',
        'Canada/Mountain',
        'Canada/Newfoundland',
        'Canada/Pacific',
        'Canada/Saskatchewan',
        'Canada/Yukon',
        'CET',
        'Chile/Continental',
        'Chile/EasterIsland',
        'CST6CDT',
        'Cuba',
        'EET',
        'Egypt',
        'Eire',
        'EST',
        'EST5EDT',
        'Etc/GMT',
        'Etc/GMT+0',
        'Etc/GMT+1',
        'Etc/GMT+10',
        'Etc/GMT+11',
        'Etc/GMT+12',
        'Etc/GMT+2',
        'Etc/GMT+3',
        'Etc/GMT+4',
        'Etc/GMT+5',
        'Etc/GMT+6',
        'Etc/GMT+7',
        'Etc/GMT+8',
        'Etc/GMT+9',
        'Etc/GMT0',
        'Etc/GMT-0',
        'Etc/GMT-1',
        'Etc/GMT-10',
        'Etc/GMT-11',
        'Etc/GMT-12',
        'Etc/GMT-13',
        'Etc/GMT-14',
        'Etc/GMT-2',
        'Etc/GMT-3',
        'Etc/GMT-4',
        'Etc/GMT-5',
        'Etc/GMT-6',
        'Etc/GMT-7',
        'Etc/GMT-8',
        'Etc/GMT-9',
        'Etc/Greenwich',
        'Etc/UCT',
        'Etc/Universal',
        'Etc/UTC',
        'Etc/Zulu',
        'Europe/Belfast',
        'Europe/Nicosia',
        'Europe/Tiraspol',
        'Factory',
        'GB',
        'GB-Eire',
        'GMT',
        'GMT+0',
        'GMT0',
        'GMT-0',
        'Greenwich',
        'Hongkong',
        'HST',
        'Iceland',
        'Iran',
        'Israel',
        'Jamaica',
        'Japan',
        'Kwajalein',
        'Libya',
        'MET',
        'Mexico/BajaNorte',
        'Mexico/BajaSur',
        'Mexico/General',
        'MST',
        'MST7MDT',
        'Navajo',
        'NZ',
        'NZ-CHAT',
        'Pacific/Johnston',
        'Pacific/Ponape',
        'Pacific/Samoa',
        'Pacific/Truk',
        'Pacific/Yap',
        'Poland',
        'Portugal',
        'PRC',
        'PST8PDT',
        'ROC',
        'ROK',
        'Singapore',
        'Turkey',
        'UCT',
        'Universal',
        'US/Alaska',
        'US/Aleutian',
        'US/Arizona',
        'US/Central',
        'US/Eastern',
        'US/East-Indiana',
        'US/Hawaii',
        'US/Indiana-Starke',
        'US/Michigan',
        'US/Mountain',
        'US/Pacific',
        'US/Pacific-New',
        'US/Samoa',
        'UTC',
        'WET',
        'W-SU',
        'Zulu',
    ];

    public static function validateValue(string &$value): bool
    {
        return in_array($value, self::getAllowedValues(), true) || in_array($value, self::$deprecated, true);
    }

    public function isDeprecated(): bool
    {
        return !self::isKnownValue($this->getValue());
    }

    // DateTimeZone ----------------------------------------------------------------------------------------------------

    public function getDateTimeZone(): DateTimeZone
    {
        return new DateTimeZone($this->getValue());
    }

    private static function createDateTimeZone(string $name): DateTimeZone
    {
        try {
            $timeZone = self::get($name);
        } catch (InvalidValueException $e) {
            throw new InvalidOrDeprecatedTimeZoneException($name);
        }

        return $timeZone->getDateTimeZone();
    }

    public static function getUtc(): DateTimeZone
    {
        static $utcTimeZone;

        if ($utcTimeZone === null) {
            $utcTimeZone = self::createDateTimeZone(self::UTC);
        }

        return $utcTimeZone;
    }

    public static function getDefault(): DateTimeZone
    {
        return self::createDateTimeZone(date_default_timezone_get());
    }

    public static function setDefault(self $timeZone): void
    {
        date_default_timezone_set($timeZone->getValue());
    }

}
