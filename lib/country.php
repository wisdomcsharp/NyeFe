<?php
// ! Working, without ! then not working

/***Commands***//***
 * 
 *   !countrycodetophonecode
 *   !phonecodetocountrycode
 *   
 *   !ipdata [ip]
 *   
 *   !currencycodetocountry
 *   !countrycodetocurrency
 *   
 *   !continentcodetocountrycode
 *   !countrycodetocontinentcode
 *   
 *   !countrycodetocountryname
 *   !countrynametocountrycode
 *   
 *   !country
 *    countrycodetocapital
 *   // citytocountrycode
 *    
 */

$command = load('countrycodetocapital');// get set
$attrib = 'ng'; //get set
$switch;

function load($command){
	global $switch;
	switch(strtolower($command)){
		case 'countrycodetophonecode':
		case 'phonecodetocountrycode':
			$switch = '4';
			break;
		case 'ipdata':
			$switch = '-1';//invalid
			break;
		case 'countrycodetocurrency';
		case 'currencytocountrycode';
		$switch = '3';
		break;
		
		case 'continentcodetocountrycode':
		case 'countrycodetocontinentcode':
			$switch = '2';
			break;
			
		case 'countrycodetocountryname':
		case 'countrynametocountrycode':
		case 'country':
			$switch = '5';
			break;
			
		case 'countrycodetocapital': //make sure country names, are the same
		//case 'citytocountrycode':
		    $switch = '1';
			break;
			
			
			
	}
	
return $command;
}


//countries

//{cityName} --> country
//{country] --> cities
//


function callback($buffer){
	
	//for switchs
	//return $buffer;
	
	$buffer = json_decode($buffer, true);
	global $attrib;
	global $command;
	
//return $buffer;
	switch(strtolower($command)){
		case 'countrycodetophonecode':
			return  getPhoneCountryCodeByCountryCode($buffer,$attrib);
			break;
			
		case 'phonecodetocountrycode':
			return getCountryCodeByPhoneCountryCode($buffer,$attrib);
			break;
			
		case 'ipdata':
			return getCountryCodeAndIpsByIp($buffer, $attrib);
			break;
			
		case 'currencycodetocountry':
			return getCountryCodeByCurrencyCode($buffer, $attrib);
			break;
			
		case 'countrycodetocurrency':
			return getCurrencyCodeByCountryCode($buffer, $attrib);
			break;
			
		case 'continentcodetocountrycode':
				return getCountryByContinentCode($buffer, $attrib);
				break;
				
		case 'countrycodetocontinentcode':
	        	return getContinentByCountryCode($buffer, $attrib);
				break;
				
		case 'countrycodetocountryname':
			    return getCountryByCountryCode($buffer, $attrib);
				break;
				
		case 'countrynametocountrycode':
			    return getCountryCodeByCountry($buffer, $attrib);
				break;
				
	    case 'countrycodetocapital':
					return getCapitalWithCountry($buffer, $attrib);
					break;
					
		case 'country':
				    return getCountries($buffer);
					break;
			
	}
	
}
ob_start('callback');

//switch 1
/*functions*/

function getCountries($data){
	$arr[] = array();
	
	foreach($data as $key => $country){
		
		array_push($arr, $country);
		
	}
	
	

   unset($arr['0']);
   sort($arr);
   
  	return json_encode($arr) ;
	

}

function getCapitalWithCountry($data, $country){
	$arr[] = array();
	
	return json_encode($data);
	foreach($data as $key => $value){
		
	//	return 'l';
	}
	
 
	/*
		if(strtolower($key) == strtolower($country)){
 
				array_push($arr, $value);

				
		}
		*/
	//	return 'lol';
	
	//return $data;
	unset($arr['0']);
    sort($arr);
	//return json_encode($arr) ;
}
//switch 1 end

//switch 2
function getContinentByCountryCode($data, $code){
	$arr[] = array();
	
	
	foreach($data as $country => $continent){
	
		if(strtolower($country) == strtolower($code)){
	
			
				array_push($arr, $continent);
			
			
		}
			
	}
	
   unset($arr['0']);
   sort($arr);
	return json_encode($arr) ;
	
}
function getCountryByContinentCode($data, $code){
	$arr[] = array();
	
	
	foreach($data as $country => $continent){
	
		if(strtolower($continent) == strtolower($code)){
	
				
			array_push($arr, $country);
				
				
		}
			
	}
  unset($arr['0']);
  sort($arr);
	return json_encode($arr) ;
	
}
//switch 2 end

//switch 3
function getCurrencyCodeByCountryCode($data, $code){
	//done
	$arr[] = array();
	
	
	foreach($data as $countryCode => $currency){
	
		if(strtolower($countryCode) == strtolower($code)){
	
				
			array_push($arr, $currency);
				
				
		}
			
	}
	
	unset($arr['0']);
	sort($arr);
	return json_encode($arr) ;
	
}
function getCountryCodeByCurrencyCode($data, $code){
	$arr[] = array();
	
	
	foreach($data as $countryCode => $currency){
	
		if(strtolower($currency) == strtolower($code)){
	
	
			array_push($arr, $countryCode);
	
	
		}
			
	}
	
	unset($arr['0']);
	sort($arr);
	return json_encode($arr) ;
	
}
//switch 3 end

//switch 4 
function getCountryCodeByPhoneCountryCode($data, $code){
	$arr[] = array();
	
	
	foreach($data as $countryCode => $phonePrefix){
	
		if(strtolower($phonePrefix) == strtolower($code)){
	
	
			array_push($arr, $countryCode);
	
	
		}
			
	}
	
	unset($arr['0']);
	sort($arr);
	return json_encode($arr) ;
	
}
function getPhoneCountryCodeByCountryCode($data, $code){
		$arr[] = array();
	
	
		foreach($data as $countryCode => $phonePrefix){
	
			if(strtolower($countryCode ) == strtolower($code)){
	
	
				array_push($arr, $phonePrefix);
	
	
			}
				
		}
	
		unset($arr['0']);
		sort($arr);
		return json_encode($arr) ;
	
}
//switch 4 end

//switch 5
function getCountryByCountryCode($data, $code){

	$arr[] = array();
	foreach($data as $codeX => $country){

		if(strtolower($codeX) == strtolower($code)){
			array_push($arr, $country);
		}
	}

	unset($arr['0']);
	sort($arr);
	return json_encode($arr);
}
function getCountryCodeByCountry($data, $country){

	$arr[] = array();
	foreach($data as $codeX => $countryX){

		if(strtolower($countryX) == strtolower($country)){
			array_push($arr, $codeX);
		}
	}

	unset($arr['0']);
	sort($arr);
	return json_encode($arr);
}
//switch 5 end

//function url, no swtch
function getCountryCodeAndIpsByIp($data){
	//done
	$arr[] = array();
	
	$result = json_decode(file_get_contents('http://www.telize.com/geoip/'.$data));
	
	
	foreach($result as $key => $value){
		if(strtolower($key) == 'isp' || strtolower($key) == 'country_code' || strtolower($key)  == 'region'){
		 
			$arr = array_merge($arr, array($key => $value));
		
		}

		
			
	}
	
	
	unset($arr['0']);
	//sort($arr);
	return json_encode($arr);
}
//function url, no swtch

//function Db, no swtch

//*get bitcin address by number,
//*send bitcoin payment 
//new lib called payment

//function Db, no swtch end

/*functions*/




//echo json_encode($jsonString);

if($switch  == '1'){//[1: off] countries, countries using city, cities using country, country code to city
?>
{
    "next": {
        "NP": "Kathmandu",
        "coords": {
            "lon": 85.316666,
            "lat": 27.716667
        }
    },
    "next": {
        "PT": "Lisbon",
        "coords": {
            "lon": -9.13333,
            "lat": 38.716671
        }
    }
<?php 
}elseif ($switch == '2'){//conttinent to country code, country code to continent
?>
{"BD": "AS", "BE": "EU", "BF": "AF", "BG": "EU", "BA": "EU", "BB": "NA", "WF": "OC", "BL": "NA", "BM": "NA", "BN": "AS", "BO": "SA", "BH": "AS", "BI": "AF", "BJ": "AF", "BT": "AS", "JM": "NA", "BV": "AN", "BW": "AF", "WS": "OC", "BQ": "NA", "BR": "SA", "BS": "NA", "JE": "EU", "BY": "EU", "BZ": "NA", "RU": "EU", "RW": "AF", "RS": "EU", "TL": "OC", "RE": "AF", "TM": "AS", "TJ": "AS", "RO": "EU", "TK": "OC", "GW": "AF", "GU": "OC", "GT": "NA", "GS": "AN", "GR": "EU", "GQ": "AF", "GP": "NA", "JP": "AS", "GY": "SA", "GG": "EU", "GF": "SA", "GE": "AS", "GD": "NA", "GB": "EU", "GA": "AF", "SV": "NA", "GN": "AF", "GM": "AF", "GL": "NA", "GI": "EU", "GH": "AF", "OM": "AS", "TN": "AF", "JO": "AS", "HR": "EU", "HT": "NA", "HU": "EU", "HK": "AS", "HN": "NA", "HM": "AN", "VE": "SA", "PR": "NA", "PS": "AS", "PW": "OC", "PT": "EU", "SJ": "EU", "PY": "SA", "IQ": "AS", "PA": "NA", "PF": "OC", "PG": "OC", "PE": "SA", "PK": "AS", "PH": "AS", "PN": "OC", "PL": "EU", "PM": "NA", "ZM": "AF", "EH": "AF", "EE": "EU", "EG": "AF", "ZA": "AF", "EC": "SA", "IT": "EU", "VN": "AS", "SB": "OC", "ET": "AF", "SO": "AF", "ZW": "AF", "SA": "AS", "ES": "EU", "ER": "AF", "ME": "EU", "MD": "EU", "MG": "AF", "MF": "NA", "MA": "AF", "MC": "EU", "UZ": "AS", "MM": "AS", "ML": "AF", "MO": "AS", "MN": "AS", "MH": "OC", "MK": "EU", "MU": "AF", "MT": "EU", "MW": "AF", "MV": "AS", "MQ": "NA", "MP": "OC", "MS": "NA", "MR": "AF", "IM": "EU", "UG": "AF", "TZ": "AF", "MY": "AS", "MX": "NA", "IL": "AS", "FR": "EU", "IO": "AS", "SH": "AF", "FI": "EU", "FJ": "OC", "FK": "SA", "FM": "OC", "FO": "EU", "NI": "NA", "NL": "EU", "NO": "EU", "NA": "AF", "VU": "OC", "NC": "OC", "NE": "AF", "NF": "OC", "NG": "AF", "NZ": "OC", "NP": "AS", "NR": "OC", "NU": "OC", "CK": "OC", "XK": "EU", "CI": "AF", "CH": "EU", "CO": "SA", "CN": "AS", "CM": "AF", "CL": "SA", "CC": "AS", "CA": "NA", "CG": "AF", "CF": "AF", "CD": "AF", "CZ": "EU", "CY": "EU", "CX": "AS", "CR": "NA", "CW": "NA", "CV": "AF", "CU": "NA", "SZ": "AF", "SY": "AS", "SX": "NA", "KG": "AS", "KE": "AF", "SS": "AF", "SR": "SA", "KI": "OC", "KH": "AS", "KN": "NA", "KM": "AF", "ST": "AF", "SK": "EU", "KR": "AS", "SI": "EU", "KP": "AS", "KW": "AS", "SN": "AF", "SM": "EU", "SL": "AF", "SC": "AF", "KZ": "AS", "KY": "NA", "SG": "AS", "SE": "EU", "SD": "AF", "DO": "NA", "DM": "NA", "DJ": "AF", "DK": "EU", "VG": "NA", "DE": "EU", "YE": "AS", "DZ": "AF", "US": "NA", "UY": "SA", "YT": "AF", "UM": "OC", "LB": "AS", "LC": "NA", "LA": "AS", "TV": "OC", "TW": "AS", "TT": "NA", "TR": "AS", "LK": "AS", "LI": "EU", "LV": "EU", "TO": "OC", "LT": "EU", "LU": "EU", "LR": "AF", "LS": "AF", "TH": "AS", "TF": "AN", "TG": "AF", "TD": "AF", "TC": "NA", "LY": "AF", "VA": "EU", "VC": "NA", "AE": "AS", "AD": "EU", "AG": "NA", "AF": "AS", "AI": "NA", "VI": "NA", "IS": "EU", "IR": "AS", "AM": "AS", "AL": "EU", "AO": "AF", "AQ": "AN", "AS": "OC", "AR": "SA", "AU": "OC", "AT": "EU", "AW": "NA", "IN": "AS", "AX": "EU", "AZ": "AS", "IE": "EU", "ID": "AS", "UA": "EU", "QA": "AS", "MZ": "AF"}
<?php 
}elseif($switch == '3'){//currency to currenct code, vice versa
?>
{"BD": "BDT", "BE": "EUR", "BF": "XOF", "BG": "BGN", "BA": "BAM", "BB": "BBD", "WF": "XPF", "BL": "EUR", "BM": "BMD", "BN": "BND", "BO": "BOB", "BH": "BHD", "BI": "BIF", "BJ": "XOF", "BT": "BTN", "JM": "JMD", "BV": "NOK", "BW": "BWP", "WS": "WST", "BQ": "USD", "BR": "BRL", "BS": "BSD", "JE": "GBP", "BY": "BYR", "BZ": "BZD", "RU": "RUB", "RW": "RWF", "RS": "RSD", "TL": "USD", "RE": "EUR", "TM": "TMT", "TJ": "TJS", "RO": "RON", "TK": "NZD", "GW": "XOF", "GU": "USD", "GT": "GTQ", "GS": "GBP", "GR": "EUR", "GQ": "XAF", "GP": "EUR", "JP": "JPY", "GY": "GYD", "GG": "GBP", "GF": "EUR", "GE": "GEL", "GD": "XCD", "GB": "GBP", "GA": "XAF", "SV": "USD", "GN": "GNF", "GM": "GMD", "GL": "DKK", "GI": "GIP", "GH": "GHS", "OM": "OMR", "TN": "TND", "JO": "JOD", "HR": "HRK", "HT": "HTG", "HU": "HUF", "HK": "HKD", "HN": "HNL", "HM": "AUD", "VE": "VEF", "PR": "USD", "PS": "ILS", "PW": "USD", "PT": "EUR", "SJ": "NOK", "PY": "PYG", "IQ": "IQD", "PA": "PAB", "PF": "XPF", "PG": "PGK", "PE": "PEN", "PK": "PKR", "PH": "PHP", "PN": "NZD", "PL": "PLN", "PM": "EUR", "ZM": "ZMK", "EH": "MAD", "EE": "EUR", "EG": "EGP", "ZA": "ZAR", "EC": "USD", "IT": "EUR", "VN": "VND", "SB": "SBD", "ET": "ETB", "SO": "SOS", "ZW": "ZWL", "SA": "SAR", "ES": "EUR", "ER": "ERN", "ME": "EUR", "MD": "MDL", "MG": "MGA", "MF": "EUR", "MA": "MAD", "MC": "EUR", "UZ": "UZS", "MM": "MMK", "ML": "XOF", "MO": "MOP", "MN": "MNT", "MH": "USD", "MK": "MKD", "MU": "MUR", "MT": "EUR", "MW": "MWK", "MV": "MVR", "MQ": "EUR", "MP": "USD", "MS": "XCD", "MR": "MRO", "IM": "GBP", "UG": "UGX", "TZ": "TZS", "MY": "MYR", "MX": "MXN", "IL": "ILS", "FR": "EUR", "IO": "USD", "SH": "SHP", "FI": "EUR", "FJ": "FJD", "FK": "FKP", "FM": "USD", "FO": "DKK", "NI": "NIO", "NL": "EUR", "NO": "NOK", "NA": "NAD", "VU": "VUV", "NC": "XPF", "NE": "XOF", "NF": "AUD", "NG": "NGN", "NZ": "NZD", "NP": "NPR", "NR": "AUD", "NU": "NZD", "CK": "NZD", "XK": "EUR", "CI": "XOF", "CH": "CHF", "CO": "COP", "CN": "CNY", "CM": "XAF", "CL": "CLP", "CC": "AUD", "CA": "CAD", "CG": "XAF", "CF": "XAF", "CD": "CDF", "CZ": "CZK", "CY": "EUR", "CX": "AUD", "CR": "CRC", "CW": "ANG", "CV": "CVE", "CU": "CUP", "SZ": "SZL", "SY": "SYP", "SX": "ANG", "KG": "KGS", "KE": "KES", "SS": "SSP", "SR": "SRD", "KI": "AUD", "KH": "KHR", "KN": "XCD", "KM": "KMF", "ST": "STD", "SK": "EUR", "KR": "KRW", "SI": "EUR", "KP": "KPW", "KW": "KWD", "SN": "XOF", "SM": "EUR", "SL": "SLL", "SC": "SCR", "KZ": "KZT", "KY": "KYD", "SG": "SGD", "SE": "SEK", "SD": "SDG", "DO": "DOP", "DM": "XCD", "DJ": "DJF", "DK": "DKK", "VG": "USD", "DE": "EUR", "YE": "YER", "DZ": "DZD", "US": "USD", "UY": "UYU", "YT": "EUR", "UM": "USD", "LB": "LBP", "LC": "XCD", "LA": "LAK", "TV": "AUD", "TW": "TWD", "TT": "TTD", "TR": "TRY", "LK": "LKR", "LI": "CHF", "LV": "EUR", "TO": "TOP", "LT": "LTL", "LU": "EUR", "LR": "LRD", "LS": "LSL", "TH": "THB", "TF": "EUR", "TG": "XOF", "TD": "XAF", "TC": "USD", "LY": "LYD", "VA": "EUR", "VC": "XCD", "AE": "AED", "AD": "EUR", "AG": "XCD", "AF": "AFN", "AI": "XCD", "VI": "USD", "IS": "ISK", "IR": "IRR", "AM": "AMD", "AL": "ALL", "AO": "AOA", "AQ": "", "AS": "USD", "AR": "ARS", "AU": "AUD", "AT": "EUR", "AW": "AWG", "IN": "INR", "AX": "EUR", "AZ": "AZN", "IE": "EUR", "ID": "IDR", "UA": "UAH", "QA": "QAR", "MZ": "MZN"}
<?php 
}elseif($switch == '4'){//country code to country phone code, vice versa
?>
{"BD": "880", "BE": "32", "BF": "226", "BG": "359", "BA": "387", "BB": "+1-246", "WF": "681", "BL": "590", "BM": "+1-441", "BN": "673", "BO": "591", "BH": "973", "BI": "257", "BJ": "229", "BT": "975", "JM": "+1-876", "BV": "", "BW": "267", "WS": "685", "BQ": "599", "BR": "55", "BS": "+1-242", "JE": "+44-1534", "BY": "375", "BZ": "501", "RU": "7", "RW": "250", "RS": "381", "TL": "670", "RE": "262", "TM": "993", "TJ": "992", "RO": "40", "TK": "690", "GW": "245", "GU": "+1-671", "GT": "502", "GS": "", "GR": "30", "GQ": "240", "GP": "590", "JP": "81", "GY": "592", "GG": "+44-1481", "GF": "594", "GE": "995", "GD": "+1-473", "GB": "44", "GA": "241", "SV": "503", "GN": "224", "GM": "220", "GL": "299", "GI": "350", "GH": "233", "OM": "968", "TN": "216", "JO": "962", "HR": "385", "HT": "509", "HU": "36", "HK": "852", "HN": "504", "HM": " ", "VE": "58", "PR": "+1-787 and 1-939", "PS": "970", "PW": "680", "PT": "351", "SJ": "47", "PY": "595", "IQ": "964", "PA": "507", "PF": "689", "PG": "675", "PE": "51", "PK": "92", "PH": "63", "PN": "870", "PL": "48", "PM": "508", "ZM": "260", "EH": "212", "EE": "372", "EG": "20", "ZA": "27", "EC": "593", "IT": "39", "VN": "84", "SB": "677", "ET": "251", "SO": "252", "ZW": "263", "SA": "966", "ES": "34", "ER": "291", "ME": "382", "MD": "373", "MG": "261", "MF": "590", "MA": "212", "MC": "377", "UZ": "998", "MM": "95", "ML": "223", "MO": "853", "MN": "976", "MH": "692", "MK": "389", "MU": "230", "MT": "356", "MW": "265", "MV": "960", "MQ": "596", "MP": "+1-670", "MS": "+1-664", "MR": "222", "IM": "+44-1624", "UG": "256", "TZ": "255", "MY": "60", "MX": "52", "IL": "972", "FR": "33", "IO": "246", "SH": "290", "FI": "358", "FJ": "679", "FK": "500", "FM": "691", "FO": "298", "NI": "505", "NL": "31", "NO": "47", "NA": "264", "VU": "678", "NC": "687", "NE": "227", "NF": "672", "NG": "234", "NZ": "64", "NP": "977", "NR": "674", "NU": "683", "CK": "682", "XK": "", "CI": "225", "CH": "41", "CO": "57", "CN": "86", "CM": "237", "CL": "56", "CC": "61", "CA": "1", "CG": "242", "CF": "236", "CD": "243", "CZ": "420", "CY": "357", "CX": "61", "CR": "506", "CW": "599", "CV": "238", "CU": "53", "SZ": "268", "SY": "963", "SX": "599", "KG": "996", "KE": "254", "SS": "211", "SR": "597", "KI": "686", "KH": "855", "KN": "+1-869", "KM": "269", "ST": "239", "SK": "421", "KR": "82", "SI": "386", "KP": "850", "KW": "965", "SN": "221", "SM": "378", "SL": "232", "SC": "248", "KZ": "7", "KY": "+1-345", "SG": "65", "SE": "46", "SD": "249", "DO": "+1-809 and 1-829", "DM": "+1-767", "DJ": "253", "DK": "45", "VG": "+1-284", "DE": "49", "YE": "967", "DZ": "213", "US": "1", "UY": "598", "YT": "262", "UM": "1", "LB": "961", "LC": "+1-758", "LA": "856", "TV": "688", "TW": "886", "TT": "+1-868", "TR": "90", "LK": "94", "LI": "423", "LV": "371", "TO": "676", "LT": "370", "LU": "352", "LR": "231", "LS": "266", "TH": "66", "TF": "", "TG": "228", "TD": "235", "TC": "+1-649", "LY": "218", "VA": "379", "VC": "+1-784", "AE": "971", "AD": "376", "AG": "+1-268", "AF": "93", "AI": "+1-264", "VI": "+1-340", "IS": "354", "IR": "98", "AM": "374", "AL": "355", "AO": "244", "AQ": "", "AS": "+1-684", "AR": "54", "AU": "61", "AT": "43", "AW": "297", "IN": "91", "AX": "+358-18", "AZ": "994", "IE": "353", "ID": "62", "UA": "380", "QA": "974", "MZ": "258"}	
<?php 
}elseif ($switch == '5'){//[2: off] country code to name, vice versa| change
?>
{"BD": "Bangladesh", "BE": "Belgium", "BF": "Burkina Faso", "BG": "Bulgaria", "BA": "Bosnia and Herzegovina", "BB": "Barbados", "WF": "Wallis and Futuna", "BL": "Saint Barthelemy", "BM": "Bermuda", "BN": "Brunei", "BO": "Bolivia", "BH": "Bahrain", "BI": "Burundi", "BJ": "Benin", "BT": "Bhutan", "JM": "Jamaica", "BV": "Bouvet Island", "BW": "Botswana", "WS": "Samoa", "BQ": "Bonaire, Saint Eustatius and Saba ", "BR": "Brazil", "BS": "Bahamas", "JE": "Jersey", "BY": "Belarus", "BZ": "Belize", "RU": "Russia", "RW": "Rwanda", "RS": "Serbia", "TL": "East Timor", "RE": "Reunion", "TM": "Turkmenistan", "TJ": "Tajikistan", "RO": "Romania", "TK": "Tokelau", "GW": "Guinea-Bissau", "GU": "Guam", "GT": "Guatemala", "GS": "South Georgia and the South Sandwich Islands", "GR": "Greece", "GQ": "Equatorial Guinea", "GP": "Guadeloupe", "JP": "Japan", "GY": "Guyana", "GG": "Guernsey", "GF": "French Guiana", "GE": "Georgia", "GD": "Grenada", "GB": "United Kingdom", "GA": "Gabon", "SV": "El Salvador", "GN": "Guinea", "GM": "Gambia", "GL": "Greenland", "GI": "Gibraltar", "GH": "Ghana", "OM": "Oman", "TN": "Tunisia", "JO": "Jordan", "HR": "Croatia", "HT": "Haiti", "HU": "Hungary", "HK": "Hong Kong", "HN": "Honduras", "HM": "Heard Island and McDonald Islands", "VE": "Venezuela", "PR": "Puerto Rico", "PS": "Palestinian Territory", "PW": "Palau", "PT": "Portugal", "SJ": "Svalbard and Jan Mayen", "PY": "Paraguay", "IQ": "Iraq", "PA": "Panama", "PF": "French Polynesia", "PG": "Papua New Guinea", "PE": "Peru", "PK": "Pakistan", "PH": "Philippines", "PN": "Pitcairn", "PL": "Poland", "PM": "Saint Pierre and Miquelon", "ZM": "Zambia", "EH": "Western Sahara", "EE": "Estonia", "EG": "Egypt", "ZA": "South Africa", "EC": "Ecuador", "IT": "Italy", "VN": "Vietnam", "SB": "Solomon Islands", "ET": "Ethiopia", "SO": "Somalia", "ZW": "Zimbabwe", "SA": "Saudi Arabia", "ES": "Spain", "ER": "Eritrea", "ME": "Montenegro", "MD": "Moldova", "MG": "Madagascar", "MF": "Saint Martin", "MA": "Morocco", "MC": "Monaco", "UZ": "Uzbekistan", "MM": "Myanmar", "ML": "Mali", "MO": "Macao", "MN": "Mongolia", "MH": "Marshall Islands", "MK": "Macedonia", "MU": "Mauritius", "MT": "Malta", "MW": "Malawi", "MV": "Maldives", "MQ": "Martinique", "MP": "Northern Mariana Islands", "MS": "Montserrat", "MR": "Mauritania", "IM": "Isle of Man", "UG": "Uganda", "TZ": "Tanzania", "MY": "Malaysia", "MX": "Mexico", "IL": "Israel", "FR": "France", "IO": "British Indian Ocean Territory", "SH": "Saint Helena", "FI": "Finland", "FJ": "Fiji", "FK": "Falkland Islands", "FM": "Micronesia", "FO": "Faroe Islands", "NI": "Nicaragua", "NL": "Netherlands", "NO": "Norway", "NA": "Namibia", "VU": "Vanuatu", "NC": "New Caledonia", "NE": "Niger", "NF": "Norfolk Island", "NG": "Nigeria", "NZ": "New Zealand", "NP": "Nepal", "NR": "Nauru", "NU": "Niue", "CK": "Cook Islands", "XK": "Kosovo", "CI": "Ivory Coast", "CH": "Switzerland", "CO": "Colombia", "CN": "China", "CM": "Cameroon", "CL": "Chile", "CC": "Cocos Islands", "CA": "Canada", "CG": "Republic of the Congo", "CF": "Central African Republic", "CD": "Democratic Republic of the Congo", "CZ": "Czech Republic", "CY": "Cyprus", "CX": "Christmas Island", "CR": "Costa Rica", "CW": "Curacao", "CV": "Cape Verde", "CU": "Cuba", "SZ": "Swaziland", "SY": "Syria", "SX": "Sint Maarten", "KG": "Kyrgyzstan", "KE": "Kenya", "SS": "South Sudan", "SR": "Suriname", "KI": "Kiribati", "KH": "Cambodia", "KN": "Saint Kitts and Nevis", "KM": "Comoros", "ST": "Sao Tome and Principe", "SK": "Slovakia", "KR": "South Korea", "SI": "Slovenia", "KP": "North Korea", "KW": "Kuwait", "SN": "Senegal", "SM": "San Marino", "SL": "Sierra Leone", "SC": "Seychelles", "KZ": "Kazakhstan", "KY": "Cayman Islands", "SG": "Singapore", "SE": "Sweden", "SD": "Sudan", "DO": "Dominican Republic", "DM": "Dominica", "DJ": "Djibouti", "DK": "Denmark", "VG": "British Virgin Islands", "DE": "Germany", "YE": "Yemen", "DZ": "Algeria", "US": "United States", "UY": "Uruguay", "YT": "Mayotte", "UM": "United States Minor Outlying Islands", "LB": "Lebanon", "LC": "Saint Lucia", "LA": "Laos", "TV": "Tuvalu", "TW": "Taiwan", "TT": "Trinidad and Tobago", "TR": "Turkey", "LK": "Sri Lanka", "LI": "Liechtenstein", "LV": "Latvia", "TO": "Tonga", "LT": "Lithuania", "LU": "Luxembourg", "LR": "Liberia", "LS": "Lesotho", "TH": "Thailand", "TF": "French Southern Territories", "TG": "Togo", "TD": "Chad", "TC": "Turks and Caicos Islands", "LY": "Libya", "VA": "Vatican", "VC": "Saint Vincent and the Grenadines", "AE": "United Arab Emirates", "AD": "Andorra", "AG": "Antigua and Barbuda", "AF": "Afghanistan", "AI": "Anguilla", "VI": "U.S. Virgin Islands", "IS": "Iceland", "IR": "Iran", "AM": "Armenia", "AL": "Albania", "AO": "Angola", "AQ": "Antarctica", "AS": "American Samoa", "AR": "Argentina", "AU": "Australia", "AT": "Austria", "AW": "Aruba", "IN": "India", "AX": "Aland Islands", "AZ": "Azerbaijan", "IE": "Ireland", "ID": "Indonesia", "UA": "Ukraine", "QA": "Qatar", "MZ": "Mozambique"}
<?php 
}

ob_end_flush();

?>