<?php

//search form
function SEARCH_FORM(array $data)
{ ?>
        <form action="" method="GET" class="d-flex flex-row justify-content-end">
                <div class="form-group m-b-0 img-fluid text-right">
                        <span class="w-100 p-2 mt-2 text-right text-grey">Filter By</span>
                </div>
                <div class="form-group m-b-0 img-fluid w-25 text-right">
                        <select class="form-control w-100 text-grey" name="search_type" data-live-search="true">
                                <?php
                                foreach ($data as $key => $value) { ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                <?php  } ?>
                        </select>
                </div>
                <div class="form-group m-b-0 img-fluid text-right">
                        <input type="text" name="search_value" placeholder="Enter Search Value" class="form-control w-100">
                </div>
                <div class="form-group m-b-0 img-fluid text-right">
                        <button class="btn btn-sm btn-primary mt-0 mb-0 search-btn" name="search" value="true">Search</button>
                </div>
        </form>
        <script>
                $(function() {
                        $('.selectpicker').selectpicker();
                });
        </script>
<?php }

//search data clear
function CLEAR_SEARCH()
{ ?>
        <div class="row">
                <div class="col-md-12">
                        <?php if (isset($_GET['search'])) { ?>
                                <p class="fs-12 lh-1-1"><b>Search View :</b> <span class="text-grey">Search Data :</span> <?php echo $_GET['search_type']; ?> | <span class="text-grey">Search Value:</span> <?php echo $_GET['search_value']; ?>
                                        <a href="index.php" class="text-right float-end"><span class="text-danger"><i class="fa fa-times"></i>Clear Search</span></a>
                                </p>
                        <?php } ?>
                </div>
        </div>
<?php }

//select option for particular fields
function SelectOptions($SQL, $fielvalue, $columnname, $selected = null)
{
        global $DBConnection;
        $Sql = "$SQL";
        $query = mysqli_query($DBConnection, $Sql);
        while ($fetch = mysqli_fetch_array($query)) {
                $Option = $fetch["$columnname"];
                $Value = $fetch["$fielvalue"];

                if ($selected == null) {
                        $selected = "";
                } else {
                        if ($selected == $Value) {
                                $selected = "selected";
                        } else {
                                $selected = "";
                        }
                }
                echo "<option value='$Value' $selected>$Option</option>";
        }
}


//no data found View
function NoData($title)
{ ?>
        <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                        <div class="shadow-sm br10 p-1 rounded-2">
                                <div class="flex-s-b">
                                        <div class="item-details" style="width:100%;">
                                                <p class="lh-1-2 p-2" style="margin-top:0px !important;">
                                                        <span class="fs-15 bold"><?php echo $title; ?></span><br>
                                                </p>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
<?php }

//upload image with preview
function UploadImageInput($name, $id, $filetypes, $required = true, $class, $value = null)
{
        if ($required == true) {
                $req = "required=''";
        } else {
                $req = "";
        } ?>
        <div class="form-group <?php echo $class; ?>">
                <label>Upload Image</label>
                <input type="FILE" name="<?php echo $name; ?>" value="<?php echo $value; ?>" id="<?php echo $id; ?>" <?php echo $req; ?> accept="<?php echo $filetypes; ?>" class="form-control-2" />
        </div>
        <div class="col-md-12">
                <div class="flex-c mb-2-pr">
                        <img src="" id="<?php echo $id; ?>_img" class="imgrpreview">
                </div>
        </div>
        <script>
                <?php echo $id; ?>.onchange = evt => {
                        const [file] = <?php echo $id; ?>.files
                        if (file) {
                                <?php echo $id; ?>_img.src = URL.createObjectURL(file);
                        }
                }
        </script>
        <?php }

function InputOptions($data, $default = null)
{
        $RegOptions = $data;
        $Count = 0;
        foreach ($RegOptions as $options) {
                if ($options == $default) {
                        $selected = "selected=''";
                } else {
                        $selected = "";
                }
        ?>
                <option value="<?php echo $options; ?>" <?php echo $selected; ?>><?php echo $options; ?></option>
        <?php }
}

//current image
function CurrentFile($filename)
{
        ?>
        <input type="text" name="CurrentFile" value="<?php echo SECURE($filename, "e"); ?>" hidden="">
        <?php }


//country codes option
function InputCountryCodes()
{
        $CountyPhone = [
                '44' => 'UK (+44)',
                '1' => 'USA (+1)',
                '213' => 'Algeria (+213)',
                '376' => 'Andorra (+376)',
                '244' => 'Angola (+244)',
                '1264' => 'Anguilla (+1264)',
                '1268' => 'Antigua & Barbuda (+1268)',
                '54' => 'Argentina (+54)',
                '374' => 'Armenia (+374)',
                '297' => 'Aruba (+297)',
                '61' => 'Australia (+61)',
                '43' => 'Austria (+43)',
                '994' => 'Azerbaijan (+994)',
                '1242' => 'Bahamas (+1242)',
                '973' => 'Bahrain (+973)',
                '880' => 'Bangladesh (+880)',
                '1246' => 'Barbados (+1246)',
                '375' => 'Belarus (+375)',
                '32' => 'Belgium (+32)',
                '501' => 'Belize (+501)',
                '229' => 'Benin (+229)',
                '1441' => 'Bermuda (+1441)',
                '975' => 'Bhutan (+975)',
                '591' => 'Bolivia (+591)',
                '387' => 'Bosnia Herzegovina (+387)',
                '267' => 'Botswana (+267)',
                '55' => 'Brazil (+55)',
                '673' => 'Brunei (+673)',
                '359' => 'Bulgaria (+359)',
                '226' => 'Burkina Faso (+226)',
                '257' => 'Burundi (+257)',
                '855' => 'Cambodia (+855)',
                '237' => 'Cameroon (+237)',
                '1' => 'Canada (+1)',
                '238' => 'Cape Verde Islands (+238)',
                '1345' => 'Cayman Islands (+1345)',
                '236' => 'Central African Republic (+236)',
                '56' => 'Chile (+56)',
                '86' => 'China (+86)',
                '57' => 'Colombia (+57)',
                '269' => 'Comoros (+269)',
                '242' => 'Congo (+242)',
                '682' => 'Cook Islands (+682)',
                '506' => 'Costa Rica (+506)',
                '385' => 'Croatia (+385)',
                '53' => 'Cuba (+53)',
                '90392' => 'Cyprus North (+90392)',
                '357' => 'Cyprus South (+357)',
                '42' => 'Czech Republic (+42)',
                '45' => 'Denmark (+45)',
                '253' => 'Djibouti (+253)',
                '1809' => 'Dominica (+1809)',
                '1809' => 'Dominican Republic (+1809)',
                '593' => 'Ecuador (+593)',
                '20' => 'Egypt (+20)',
                '503' => 'El Salvador (+503)',
                '240' => 'Equatorial Guinea (+240)',
                '291' => 'Eritrea (+291)',
                '372' => 'Estonia (+372)',
                '251' => 'Ethiopia (+251)',
                '500' => 'Falkland Islands (+500)',
                '298' => 'Faroe Islands (+298)',
                '679' => 'Fiji (+679)',
                '358' => 'Finland (+358)',
                '33' => 'France (+33)',
                '594' => 'French Guiana (+594)',
                '689' => 'French Polynesia (+689)',
                '241' => 'Gabon (+241)',
                '220' => 'Gambia (+220)',
                '7880' => 'Georgia (+7880)',
                '49' => 'Germany (+49)',
                '233' => 'Ghana (+233)',
                '350' => 'Gibraltar (+350)',
                '30' => 'Greece (+30)',
                '299' => 'Greenland (+299)',
                '1473' => 'Grenada (+1473)',
                '590' => 'Guadeloupe (+590)',
                '671' => 'Guam (+671)',
                '502' => 'Guatemala (+502)',
                '224' => 'Guinea (+224)',
                '245' => 'Guinea - Bissau (+245)',
                '592' => 'Guyana (+592)',
                '509' => 'Haiti (+509)',
                '504' => 'Honduras (+504)',
                '852' => 'Hong Kong (+852)',
                '36' => 'Hungary (+36)',
                '354' => 'Iceland (+354)',
                '91' => 'India (+91)',
                '62' => 'Indonesia (+62)',
                '98' => 'Iran (+98)',
                '964' => 'Iraq (+964)',
                '353' => 'Ireland (+353)',
                '972' => 'Israel (+972)',
                '39' => 'Italy (+39)',
                '1876' => 'Jamaica (+1876)',
                '81' => 'Japan (+81)',
                '962' => 'Jordan (+962)',
                '7' => 'Kazakhstan (+7)',
                '254' => 'Kenya (+254)',
                '686' => 'Kiribati (+686)',
                '850' => 'Korea North (+850)',
                '82' => 'Korea South (+82)',
                '965' => 'Kuwait (+965)',
                '996' => 'Kyrgyzstan (+996)',
                '856' => 'Laos (+856)',
                '371' => 'Latvia (+371)',
                '961' => 'Lebanon (+961)',
                '266' => 'Lesotho (+266)',
                '231' => 'Liberia (+231)',
                '218' => 'Libya (+218)',
                '417' => 'Liechtenstein (+417)',
                '370' => 'Lithuania (+370)',
                '352' => 'Luxembourg (+352)',
                '853' => 'Macao (+853)',
                '389' => 'Macedonia (+389)',
                '261' => 'Madagascar (+261)',
                '265' => 'Malawi (+265)',
                '60' => 'Malaysia (+60)',
                '960' => 'Maldives (+960)',
                '223' => 'Mali (+223)',
                '356' => 'Malta (+356)',
                '692' => 'Marshall Islands (+692)',
                '596' => 'Martinique (+596)',
                '222' => 'Mauritania (+222)',
                '269' => 'Mayotte (+269)',
                '52' => 'Mexico (+52)',
                '691' => 'Micronesia (+691)',
                '373' => 'Moldova (+373)',
                '377' => 'Monaco (+377)',
                '976' => 'Mongolia (+976)',
                '1664' => 'Montserrat (+1664)',
                '212' => 'Morocco (+212)',
                '258' => 'Mozambique (+258)',
                '95' => 'Myanmar (+95)',
                '264' => 'Namibia (+264)',
                '674' => 'Nauru (+674)',
                '977' => 'Nepal (+977)',
                '31' => 'Netherlands (+31)',
                '687' => 'New Caledonia (+687)',
                '64' => 'New Zealand (+64)',
                '505' => 'Nicaragua (+505)',
                '227' => 'Niger (+227)',
                '234' => 'Nigeria (+234)',
                '683' => 'Niue (+683)',
                '672' => 'Norfolk Islands (+672)',
                '670' => 'Northern Marianas (+670)',
                '47' => 'Norway (+47)',
                '968' => 'Oman (+968)',
                '680' => 'Palau (+680)',
                '507' => 'Panama (+507)',
                '675' => 'Papua New Guinea (+675)',
                '595' => 'Paraguay (+595)',
                '51' => 'Peru (+51)',
                '63' => 'Philippines (+63)',
                '48' => 'Poland (+48)',
                '351' => 'Portugal (+351)',
                '1787' => 'Puerto Rico (+1787)',
                '974' => 'Qatar (+974)',
                '262' => 'Reunion (+262)',
                '40' => 'Romania (+40)',
                '7' => 'Russia (+7)',
                '250' => 'Rwanda (+250)',
                '378' => 'San Marino (+378)',
                '239' => 'Sao Tome & Principe (+239)',
                '966' => 'Saudi Arabia (+966)',
                '221' => 'Senegal (+221)',
                '381' => 'Serbia (+381)',
                '248' => 'Seychelles (+248)',
                '232' => 'Sierra Leone (+232)',
                '65' => 'Singapore (+65)',
                '421' => 'Slovak Republic (+421)',
                '386' => 'Slovenia (+386)',
                '677' => 'Solomon Islands (+677)',
                '252' => 'Somalia (+252)',
                '27' => 'South Africa (+27)',
                '34' => 'Spain (+34)',
                '94' => 'Sri Lanka (+94)',
                '290' => 'St. Helena (+290)',
                '1869' => 'St. Kitts (+1869)',
                '1758' => 'St. Lucia (+1758)',
                '249' => 'Sudan (+249)',
                '597' => 'Suriname (+597)',
                '268' => 'Swaziland (+268)',
                '46' => 'Sweden (+46)',
                '41' => 'Switzerland (+41)',
                '963' => 'Syria (+963)',
                '886' => 'Taiwan (+886)',
                '7' => 'Tajikstan (+7)',
                '66' => 'Thailand (+66)',
                '228' => 'Togo (+228)',
                '676' => 'Tonga (+676)',
                '1868' => 'Trinidad & Tobago (+1868)',
                '216' => 'Tunisia (+216)',
                '90' => 'Turkey (+90)',
                '7' => 'Turkmenistan (+7)',
                '993' => 'Turkmenistan (+993)',
                '1649' => 'Turks & Caicos Islands (+1649)',
                '688' => 'Tuvalu (+688)',
                '256' => 'Uganda (+256)',
                '380' => 'Ukraine (+380)',
                '971' => 'United Arab Emirates (+971)',
                '598' => 'Uruguay (+598)',
                '7' => 'Uzbekistan (+7)',
                '678' => 'Vanuatu (+678)',
                '379' => 'Vatican City (+379)',
                '58' => 'Venezuela (+58)',
                '84' => 'Vietnam (+84)',
                '84' => 'Virgin Islands - British (+1284)',
                '84' => 'Virgin Islands - US (+1340)',
                '681' => 'Wallis & Futuna (+681)',
                '969' => 'Yemen (North)(+969)',
                '967' => 'Yemen (South)(+967)',
                '260' => 'Zambia (+260)',
                '263' => 'Zimbabwe (+263)',
        ];

        foreach ($CountyPhone as $code => $countryname) {
                if ($code == "91") {
                        $selected = "selected=''";
                } else {
                        $selected = "";
                }
        ?>
                <option value="+<?php echo $code; ?>" <?php echo $selected; ?>><?php echo $countryname; ?></option>
        <?php }
}


function CurrencyOptions($name = "INR", $return = "options", $results = null)
{
        $currencies = array(
                "AFA" => array("name" => "Afghan Afghani", "symbol" => "؋"),
                "ALL" => array("name" => "Albanian Lek", "symbol" => "Lek"),
                "DZD" => array("name" => "Algerian Dinar", "symbol" => "دج"),
                "AOA" => array("name" => "Angolan Kwanza", "symbol" => "Kz"),
                "ARS" => array("name" => "Argentine Peso", "symbol" => "$"),
                "AMD" => array("name" => "Armenian Dram", "symbol" => "֏"),
                "AWG" => array("name" => "Aruban Florin", "symbol" => "ƒ"),
                "AUD" => array("name" => "Australian Dollar", "symbol" => "$"),
                "AZN" => array("name" => "Azerbaijani Manat", "symbol" => "m"),
                "BSD" => array("name" => "Bahamian Dollar", "symbol" => "B$"),
                "BHD" => array("name" => "Bahraini Dinar", "symbol" => ".د.ب"),
                "BDT" => array("name" => "Bangladeshi Taka", "symbol" => "৳"),
                "BBD" => array("name" => "Barbadian Dollar", "symbol" => "Bds$"),
                "BYR" => array("name" => "Belarusian Ruble", "symbol" => "Br"),
                "BEF" => array("name" => "Belgian Franc", "symbol" => "fr"),
                "BZD" => array("name" => "Belize Dollar", "symbol" => "$"),
                "BMD" => array("name" => "Bermudan Dollar", "symbol" => "$"),
                "BTN" => array("name" => "Bhutanese Ngultrum", "symbol" => "Nu."),
                "BTC" => array("name" => "Bitcoin", "symbol" => "฿"),
                "BOB" => array("name" => "Bolivian Boliviano", "symbol" => "Bs."),
                "BAM" => array("name" => "Bosnia", "symbol" => "KM"),
                "BWP" => array("name" => "Botswanan Pula", "symbol" => "P"),
                "BRL" => array("name" => "Brazilian Real", "symbol" => "R$"),
                "GBP" => array("name" => "British Pound Sterling", "symbol" => "£"),
                "BND" => array("name" => "Brunei Dollar", "symbol" => "B$"),
                "BGN" => array("name" => "Bulgarian Lev", "symbol" => "Лв."),
                "BIF" => array("name" => "Burundian Franc", "symbol" => "FBu"),
                "KHR" => array("name" => "Cambodian Riel", "symbol" => "KHR"),
                "CAD" => array("name" => "Canadian Dollar", "symbol" => "$"),
                "CVE" => array("name" => "Cape Verdean Escudo", "symbol" => "$"),
                "KYD" => array("name" => "Cayman Islands Dollar", "symbol" => "$"),
                "XOF" => array("name" => "CFA Franc BCEAO", "symbol" => "CFA"),
                "XAF" => array("name" => "CFA Franc BEAC", "symbol" => "FCFA"),
                "XPF" => array("name" => "CFP Franc", "symbol" => "₣"),
                "CLP" => array("name" => "Chilean Peso", "symbol" => "$"),
                "CNY" => array("name" => "Chinese Yuan", "symbol" => "¥"),
                "COP" => array("name" => "Colombian Peso", "symbol" => "$"),
                "KMF" => array("name" => "Comorian Franc", "symbol" => "CF"),
                "CDF" => array("name" => "Congolese Franc", "symbol" => "FC"),
                "CRC" => array("name" => "Costa Rican ColÃ³n", "symbol" => "₡"),
                "HRK" => array("name" => "Croatian Kuna", "symbol" => "kn"),
                "CUC" => array("name" => "Cuban Convertible Peso", "symbol" => "$, CUC"),
                "CZK" => array("name" => "Czech Republic Koruna", "symbol" => "Kč"),
                "DKK" => array("name" => "Danish Krone", "symbol" => "Kr."),
                "DJF" => array("name" => "Djiboutian Franc", "symbol" => "Fdj"),
                "DOP" => array("name" => "Dominican Peso", "symbol" => "$"),
                "XCD" => array("name" => "East Caribbean Dollar", "symbol" => "$"),
                "EGP" => array("name" => "Egyptian Pound", "symbol" => "ج.م"),
                "ERN" => array("name" => "Eritrean Nakfa", "symbol" => "Nfk"),
                "EEK" => array("name" => "Estonian Kroon", "symbol" => "kr"),
                "ETB" => array("name" => "Ethiopian Birr", "symbol" => "Nkf"),
                "EUR" => array("name" => "Euro", "symbol" => "€"),
                "FKP" => array("name" => "Falkland Islands Pound", "symbol" => "£"),
                "FJD" => array("name" => "Fijian Dollar", "symbol" => "FJ$"),
                "GMD" => array("name" => "Gambian Dalasi", "symbol" => "D"),
                "GEL" => array("name" => "Georgian Lari", "symbol" => "ლ"),
                "DEM" => array("name" => "German Mark", "symbol" => "DM"),
                "GHS" => array("name" => "Ghanaian Cedi", "symbol" => "GH₵"),
                "GIP" => array("name" => "Gibraltar Pound", "symbol" => "£"),
                "GRD" => array("name" => "Greek Drachma", "symbol" => "₯, Δρχ, Δρ"),
                "GTQ" => array("name" => "Guatemalan Quetzal", "symbol" => "Q"),
                "GNF" => array("name" => "Guinean Franc", "symbol" => "FG"),
                "GYD" => array("name" => "Guyanaese Dollar", "symbol" => "$"),
                "HTG" => array("name" => "Haitian Gourde", "symbol" => "G"),
                "HNL" => array("name" => "Honduran Lempira", "symbol" => "L"),
                "HKD" => array("name" => "Hong Kong Dollar", "symbol" => "$"),
                "HUF" => array("name" => "Hungarian Forint", "symbol" => "Ft"),
                "ISK" => array("name" => "Icelandic KrÃ³na", "symbol" => "kr"),
                "INR" => array("name" => "Indian Rupee", "symbol" => "₹"),
                "IDR" => array("name" => "Indonesian Rupiah", "symbol" => "Rp"),
                "IRR" => array("name" => "Iranian Rial", "symbol" => "﷼"),
                "IQD" => array("name" => "Iraqi Dinar", "symbol" => "د.ع"),
                "ILS" => array("name" => "Israeli New Sheqel", "symbol" => "₪"),
                "ITL" => array("name" => "Italian Lira", "symbol" => "L,£"),
                "JMD" => array("name" => "Jamaican Dollar", "symbol" => "J$"),
                "JPY" => array("name" => "Japanese Yen", "symbol" => "¥"),
                "JOD" => array("name" => "Jordanian Dinar", "symbol" => "ا.د"),
                "KZT" => array("name" => "Kazakhstani Tenge", "symbol" => "лв"),
                "KES" => array("name" => "Kenyan Shilling", "symbol" => "KSh"),
                "KWD" => array("name" => "Kuwaiti Dinar", "symbol" => "ك.د"),
                "KGS" => array("name" => "Kyrgystani Som", "symbol" => "лв"),
                "LAK" => array("name" => "Laotian Kip", "symbol" => "₭"),
                "LVL" => array("name" => "Latvian Lats", "symbol" => "Ls"),
                "LBP" => array("name" => "Lebanese Pound", "symbol" => "£"),
                "LSL" => array("name" => "Lesotho Loti", "symbol" => "L"),
                "LRD" => array("name" => "Liberian Dollar", "symbol" => "$"),
                "LYD" => array("name" => "Libyan Dinar", "symbol" => "د.ل"),
                "LTL" => array("name" => "Lithuanian Litas", "symbol" => "Lt"),
                "MOP" => array("name" => "Macanese Pataca", "symbol" => "$"),
                "MKD" => array("name" => "Macedonian Denar", "symbol" => "ден"),
                "MGA" => array("name" => "Malagasy Ariary", "symbol" => "Ar"),
                "MWK" => array("name" => "Malawian Kwacha", "symbol" => "MK"),
                "MYR" => array("name" => "Malaysian Ringgit", "symbol" => "RM"),
                "MVR" => array("name" => "Maldivian Rufiyaa", "symbol" => "Rf"),
                "MRO" => array("name" => "Mauritanian Ouguiya", "symbol" => "MRU"),
                "MUR" => array("name" => "Mauritian Rupee", "symbol" => "₨"),
                "MXN" => array("name" => "Mexican Peso", "symbol" => "$"),
                "MDL" => array("name" => "Moldovan Leu", "symbol" => "L"),
                "MNT" => array("name" => "Mongolian Tugrik", "symbol" => "₮"),
                "MAD" => array("name" => "Moroccan Dirham", "symbol" => "MAD"),
                "MZM" => array("name" => "Mozambican Metical", "symbol" => "MT"),
                "MMK" => array("name" => "Myanmar Kyat", "symbol" => "K"),
                "NAD" => array("name" => "Namibian Dollar", "symbol" => "$"),
                "NPR" => array("name" => "Nepalese Rupee", "symbol" => "₨"),
                "ANG" => array("name" => "Netherlands Antillean Guilder", "symbol" => "ƒ"),
                "TWD" => array("name" => "New Taiwan Dollar", "symbol" => "$"),
                "NZD" => array("name" => "New Zealand Dollar", "symbol" => "$"),
                "NIO" => array("name" => "Nicaraguan CÃ³rdoba", "symbol" => "C$"),
                "NGN" => array("name" => "Nigerian Naira", "symbol" => "₦"),
                "KPW" => array("name" => "North Korean Won", "symbol" => "₩"),
                "NOK" => array("name" => "Norwegian Krone", "symbol" => "kr"),
                "OMR" => array("name" => "Omani Rial", "symbol" => ".ع.ر"),
                "PKR" => array("name" => "Pakistani Rupee", "symbol" => "₨"),
                "PAB" => array("name" => "Panamanian Balboa", "symbol" => "B/."),
                "PGK" => array("name" => "Papua New Guinean Kina", "symbol" => "K"),
                "PYG" => array("name" => "Paraguayan Guarani", "symbol" => "₲"),
                "PEN" => array("name" => "Peruvian Nuevo Sol", "symbol" => "S/."),
                "PHP" => array("name" => "Philippine Peso", "symbol" => "₱"),
                "PLN" => array("name" => "Polish Zloty", "symbol" => "zł"),
                "QAR" => array("name" => "Qatari Rial", "symbol" => "ق.ر"),
                "RON" => array("name" => "Romanian Leu", "symbol" => "lei"),
                "RUB" => array("name" => "Russian Ruble", "symbol" => "₽"),
                "RWF" => array("name" => "Rwandan Franc", "symbol" => "FRw"),
                "SVC" => array("name" => "Salvadoran ColÃ³n", "symbol" => "₡"),
                "WST" => array("name" => "Samoan Tala", "symbol" => "SAT"),
                "SAR" => array("name" => "Saudi Riyal", "symbol" => "﷼"),
                "RSD" => array("name" => "Serbian Dinar", "symbol" => "din"),
                "SCR" => array("name" => "Seychellois Rupee", "symbol" => "SRe"),
                "SLL" => array("name" => "Sierra Leonean Leone", "symbol" => "Le"),
                "SGD" => array("name" => "Singapore Dollar", "symbol" => "$"),
                "SKK" => array("name" => "Slovak Koruna", "symbol" => "Sk"),
                "SBD" => array("name" => "Solomon Islands Dollar", "symbol" => "Si$"),
                "SOS" => array("name" => "Somali Shilling", "symbol" => "Sh.so."),
                "ZAR" => array("name" => "South African Rand", "symbol" => "R"),
                "KRW" => array("name" => "South Korean Won", "symbol" => "₩"),
                "XDR" => array("name" => "Special Drawing Rights", "symbol" => "SDR"),
                "LKR" => array("name" => "Sri Lankan Rupee", "symbol" => "Rs"),
                "SHP" => array("name" => "St. Helena Pound", "symbol" => "£"),
                "SDG" => array("name" => "Sudanese Pound", "symbol" => ".س.ج"),
                "SRD" => array("name" => "Surinamese Dollar", "symbol" => "$"),
                "SZL" => array("name" => "Swazi Lilangeni", "symbol" => "E"),
                "SEK" => array("name" => "Swedish Krona", "symbol" => "kr"),
                "CHF" => array("name" => "Swiss Franc", "symbol" => "CHf"),
                "SYP" => array("name" => "Syrian Pound", "symbol" => "LS"),
                "STD" => array("name" => "São Tomé and Príncipe Dobra", "symbol" => "Db"),
                "TJS" => array("name" => "Tajikistani Somoni", "symbol" => "SM"),
                "TZS" => array("name" => "Tanzanian Shilling", "symbol" => "TSh"),
                "THB" => array("name" => "Thai Baht", "symbol" => "฿"),
                "TOP" => array("name" => "Tongan pa'anga", "symbol" => "$"),
                "TTD" => array("name" => "Trinidad & Tobago Dollar", "symbol" => "$"),
                "TND" => array("name" => "Tunisian Dinar", "symbol" => "ت.د"),
                "TRY" => array("name" => "Turkish Lira", "symbol" => "₺"),
                "TMT" => array("name" => "Turkmenistani Manat", "symbol" => "T"),
                "UGX" => array("name" => "Ugandan Shilling", "symbol" => "USh"),
                "UAH" => array("name" => "Ukrainian Hryvnia", "symbol" => "₴"),
                "AED" => array("name" => "United Arab Emirates Dirham", "symbol" => "إ.د"),
                "UYU" => array("name" => "Uruguayan Peso", "symbol" => "$"),
                "USD" => array("name" => "US Dollar", "symbol" => "$"),
                "UZS" => array("name" => "Uzbekistan Som", "symbol" => "лв"),
                "VUV" => array("name" => "Vanuatu Vatu", "symbol" => "VT"),
                "VEF" => array("name" => "Venezuelan BolÃvar", "symbol" => "Bs"),
                "VND" => array("name" => "Vietnamese Dong", "symbol" => "₫"),
                "YER" => array("name" => "Yemeni Rial", "symbol" => "﷼"),
                "ZMK" => array("name" => "Zambian Kwacha", "symbol" => "ZK")
        );

        if ($return == "options") {

                foreach ($currencies as $code => $value) {
                        if ($name == $code) {
                                $selected = "selected=''";
                        } else {
                                $selected = "";
                        }
                        echo "
                        <option value='$code' $selected>" . $value['name'] . " (" . $value['symbol'] . ")</option>";
                }
        }
}

//function for display current symbole
function CurrencyDisplay($name = null, $res = "symbol")
{

        $currencies = array(
                "AFA" => array("name" => "Afghan Afghani", "symbol" => "؋"),
                "ALL" => array("name" => "Albanian Lek", "symbol" => "Lek"),
                "DZD" => array("name" => "Algerian Dinar", "symbol" => "دج"),
                "AOA" => array("name" => "Angolan Kwanza", "symbol" => "Kz"),
                "ARS" => array("name" => "Argentine Peso", "symbol" => "$"),
                "AMD" => array("name" => "Armenian Dram", "symbol" => "֏"),
                "AWG" => array("name" => "Aruban Florin", "symbol" => "ƒ"),
                "AUD" => array("name" => "Australian Dollar", "symbol" => "$"),
                "AZN" => array("name" => "Azerbaijani Manat", "symbol" => "m"),
                "BSD" => array("name" => "Bahamian Dollar", "symbol" => "B$"),
                "BHD" => array("name" => "Bahraini Dinar", "symbol" => ".د.ب"),
                "BDT" => array("name" => "Bangladeshi Taka", "symbol" => "৳"),
                "BBD" => array("name" => "Barbadian Dollar", "symbol" => "Bds$"),
                "BYR" => array("name" => "Belarusian Ruble", "symbol" => "Br"),
                "BEF" => array("name" => "Belgian Franc", "symbol" => "fr"),
                "BZD" => array("name" => "Belize Dollar", "symbol" => "$"),
                "BMD" => array("name" => "Bermudan Dollar", "symbol" => "$"),
                "BTN" => array("name" => "Bhutanese Ngultrum", "symbol" => "Nu."),
                "BTC" => array("name" => "Bitcoin", "symbol" => "฿"),
                "BOB" => array("name" => "Bolivian Boliviano", "symbol" => "Bs."),
                "BAM" => array("name" => "Bosnia", "symbol" => "KM"),
                "BWP" => array("name" => "Botswanan Pula", "symbol" => "P"),
                "BRL" => array("name" => "Brazilian Real", "symbol" => "R$"),
                "GBP" => array("name" => "British Pound Sterling", "symbol" => "£"),
                "BND" => array("name" => "Brunei Dollar", "symbol" => "B$"),
                "BGN" => array("name" => "Bulgarian Lev", "symbol" => "Лв."),
                "BIF" => array("name" => "Burundian Franc", "symbol" => "FBu"),
                "KHR" => array("name" => "Cambodian Riel", "symbol" => "KHR"),
                "CAD" => array("name" => "Canadian Dollar", "symbol" => "$"),
                "CVE" => array("name" => "Cape Verdean Escudo", "symbol" => "$"),
                "KYD" => array("name" => "Cayman Islands Dollar", "symbol" => "$"),
                "XOF" => array("name" => "CFA Franc BCEAO", "symbol" => "CFA"),
                "XAF" => array("name" => "CFA Franc BEAC", "symbol" => "FCFA"),
                "XPF" => array("name" => "CFP Franc", "symbol" => "₣"),
                "CLP" => array("name" => "Chilean Peso", "symbol" => "$"),
                "CNY" => array("name" => "Chinese Yuan", "symbol" => "¥"),
                "COP" => array("name" => "Colombian Peso", "symbol" => "$"),
                "KMF" => array("name" => "Comorian Franc", "symbol" => "CF"),
                "CDF" => array("name" => "Congolese Franc", "symbol" => "FC"),
                "CRC" => array("name" => "Costa Rican ColÃ³n", "symbol" => "₡"),
                "HRK" => array("name" => "Croatian Kuna", "symbol" => "kn"),
                "CUC" => array("name" => "Cuban Convertible Peso", "symbol" => "$, CUC"),
                "CZK" => array("name" => "Czech Republic Koruna", "symbol" => "Kč"),
                "DKK" => array("name" => "Danish Krone", "symbol" => "Kr."),
                "DJF" => array("name" => "Djiboutian Franc", "symbol" => "Fdj"),
                "DOP" => array("name" => "Dominican Peso", "symbol" => "$"),
                "XCD" => array("name" => "East Caribbean Dollar", "symbol" => "$"),
                "EGP" => array("name" => "Egyptian Pound", "symbol" => "ج.م"),
                "ERN" => array("name" => "Eritrean Nakfa", "symbol" => "Nfk"),
                "EEK" => array("name" => "Estonian Kroon", "symbol" => "kr"),
                "ETB" => array("name" => "Ethiopian Birr", "symbol" => "Nkf"),
                "EUR" => array("name" => "Euro", "symbol" => "€"),
                "FKP" => array("name" => "Falkland Islands Pound", "symbol" => "£"),
                "FJD" => array("name" => "Fijian Dollar", "symbol" => "FJ$"),
                "GMD" => array("name" => "Gambian Dalasi", "symbol" => "D"),
                "GEL" => array("name" => "Georgian Lari", "symbol" => "ლ"),
                "DEM" => array("name" => "German Mark", "symbol" => "DM"),
                "GHS" => array("name" => "Ghanaian Cedi", "symbol" => "GH₵"),
                "GIP" => array("name" => "Gibraltar Pound", "symbol" => "£"),
                "GRD" => array("name" => "Greek Drachma", "symbol" => "₯, Δρχ, Δρ"),
                "GTQ" => array("name" => "Guatemalan Quetzal", "symbol" => "Q"),
                "GNF" => array("name" => "Guinean Franc", "symbol" => "FG"),
                "GYD" => array("name" => "Guyanaese Dollar", "symbol" => "$"),
                "HTG" => array("name" => "Haitian Gourde", "symbol" => "G"),
                "HNL" => array("name" => "Honduran Lempira", "symbol" => "L"),
                "HKD" => array("name" => "Hong Kong Dollar", "symbol" => "$"),
                "HUF" => array("name" => "Hungarian Forint", "symbol" => "Ft"),
                "ISK" => array("name" => "Icelandic KrÃ³na", "symbol" => "kr"),
                "INR" => array("name" => "Indian Rupee", "symbol" => "₹"),
                "IDR" => array("name" => "Indonesian Rupiah", "symbol" => "Rp"),
                "IRR" => array("name" => "Iranian Rial", "symbol" => "﷼"),
                "IQD" => array("name" => "Iraqi Dinar", "symbol" => "د.ع"),
                "ILS" => array("name" => "Israeli New Sheqel", "symbol" => "₪"),
                "ITL" => array("name" => "Italian Lira", "symbol" => "L,£"),
                "JMD" => array("name" => "Jamaican Dollar", "symbol" => "J$"),
                "JPY" => array("name" => "Japanese Yen", "symbol" => "¥"),
                "JOD" => array("name" => "Jordanian Dinar", "symbol" => "ا.د"),
                "KZT" => array("name" => "Kazakhstani Tenge", "symbol" => "лв"),
                "KES" => array("name" => "Kenyan Shilling", "symbol" => "KSh"),
                "KWD" => array("name" => "Kuwaiti Dinar", "symbol" => "ك.د"),
                "KGS" => array("name" => "Kyrgystani Som", "symbol" => "лв"),
                "LAK" => array("name" => "Laotian Kip", "symbol" => "₭"),
                "LVL" => array("name" => "Latvian Lats", "symbol" => "Ls"),
                "LBP" => array("name" => "Lebanese Pound", "symbol" => "£"),
                "LSL" => array("name" => "Lesotho Loti", "symbol" => "L"),
                "LRD" => array("name" => "Liberian Dollar", "symbol" => "$"),
                "LYD" => array("name" => "Libyan Dinar", "symbol" => "د.ل"),
                "LTL" => array("name" => "Lithuanian Litas", "symbol" => "Lt"),
                "MOP" => array("name" => "Macanese Pataca", "symbol" => "$"),
                "MKD" => array("name" => "Macedonian Denar", "symbol" => "ден"),
                "MGA" => array("name" => "Malagasy Ariary", "symbol" => "Ar"),
                "MWK" => array("name" => "Malawian Kwacha", "symbol" => "MK"),
                "MYR" => array("name" => "Malaysian Ringgit", "symbol" => "RM"),
                "MVR" => array("name" => "Maldivian Rufiyaa", "symbol" => "Rf"),
                "MRO" => array("name" => "Mauritanian Ouguiya", "symbol" => "MRU"),
                "MUR" => array("name" => "Mauritian Rupee", "symbol" => "₨"),
                "MXN" => array("name" => "Mexican Peso", "symbol" => "$"),
                "MDL" => array("name" => "Moldovan Leu", "symbol" => "L"),
                "MNT" => array("name" => "Mongolian Tugrik", "symbol" => "₮"),
                "MAD" => array("name" => "Moroccan Dirham", "symbol" => "MAD"),
                "MZM" => array("name" => "Mozambican Metical", "symbol" => "MT"),
                "MMK" => array("name" => "Myanmar Kyat", "symbol" => "K"),
                "NAD" => array("name" => "Namibian Dollar", "symbol" => "$"),
                "NPR" => array("name" => "Nepalese Rupee", "symbol" => "₨"),
                "ANG" => array("name" => "Netherlands Antillean Guilder", "symbol" => "ƒ"),
                "TWD" => array("name" => "New Taiwan Dollar", "symbol" => "$"),
                "NZD" => array("name" => "New Zealand Dollar", "symbol" => "$"),
                "NIO" => array("name" => "Nicaraguan CÃ³rdoba", "symbol" => "C$"),
                "NGN" => array("name" => "Nigerian Naira", "symbol" => "₦"),
                "KPW" => array("name" => "North Korean Won", "symbol" => "₩"),
                "NOK" => array("name" => "Norwegian Krone", "symbol" => "kr"),
                "OMR" => array("name" => "Omani Rial", "symbol" => ".ع.ر"),
                "PKR" => array("name" => "Pakistani Rupee", "symbol" => "₨"),
                "PAB" => array("name" => "Panamanian Balboa", "symbol" => "B/."),
                "PGK" => array("name" => "Papua New Guinean Kina", "symbol" => "K"),
                "PYG" => array("name" => "Paraguayan Guarani", "symbol" => "₲"),
                "PEN" => array("name" => "Peruvian Nuevo Sol", "symbol" => "S/."),
                "PHP" => array("name" => "Philippine Peso", "symbol" => "₱"),
                "PLN" => array("name" => "Polish Zloty", "symbol" => "zł"),
                "QAR" => array("name" => "Qatari Rial", "symbol" => "ق.ر"),
                "RON" => array("name" => "Romanian Leu", "symbol" => "lei"),
                "RUB" => array("name" => "Russian Ruble", "symbol" => "₽"),
                "RWF" => array("name" => "Rwandan Franc", "symbol" => "FRw"),
                "SVC" => array("name" => "Salvadoran ColÃ³n", "symbol" => "₡"),
                "WST" => array("name" => "Samoan Tala", "symbol" => "SAT"),
                "SAR" => array("name" => "Saudi Riyal", "symbol" => "﷼"),
                "RSD" => array("name" => "Serbian Dinar", "symbol" => "din"),
                "SCR" => array("name" => "Seychellois Rupee", "symbol" => "SRe"),
                "SLL" => array("name" => "Sierra Leonean Leone", "symbol" => "Le"),
                "SGD" => array("name" => "Singapore Dollar", "symbol" => "$"),
                "SKK" => array("name" => "Slovak Koruna", "symbol" => "Sk"),
                "SBD" => array("name" => "Solomon Islands Dollar", "symbol" => "Si$"),
                "SOS" => array("name" => "Somali Shilling", "symbol" => "Sh.so."),
                "ZAR" => array("name" => "South African Rand", "symbol" => "R"),
                "KRW" => array("name" => "South Korean Won", "symbol" => "₩"),
                "XDR" => array("name" => "Special Drawing Rights", "symbol" => "SDR"),
                "LKR" => array("name" => "Sri Lankan Rupee", "symbol" => "Rs"),
                "SHP" => array("name" => "St. Helena Pound", "symbol" => "£"),
                "SDG" => array("name" => "Sudanese Pound", "symbol" => ".س.ج"),
                "SRD" => array("name" => "Surinamese Dollar", "symbol" => "$"),
                "SZL" => array("name" => "Swazi Lilangeni", "symbol" => "E"),
                "SEK" => array("name" => "Swedish Krona", "symbol" => "kr"),
                "CHF" => array("name" => "Swiss Franc", "symbol" => "CHf"),
                "SYP" => array("name" => "Syrian Pound", "symbol" => "LS"),
                "STD" => array("name" => "São Tomé and Príncipe Dobra", "symbol" => "Db"),
                "TJS" => array("name" => "Tajikistani Somoni", "symbol" => "SM"),
                "TZS" => array("name" => "Tanzanian Shilling", "symbol" => "TSh"),
                "THB" => array("name" => "Thai Baht", "symbol" => "฿"),
                "TOP" => array("name" => "Tongan pa'anga", "symbol" => "$"),
                "TTD" => array("name" => "Trinidad & Tobago Dollar", "symbol" => "$"),
                "TND" => array("name" => "Tunisian Dinar", "symbol" => "ت.د"),
                "TRY" => array("name" => "Turkish Lira", "symbol" => "₺"),
                "TMT" => array("name" => "Turkmenistani Manat", "symbol" => "T"),
                "UGX" => array("name" => "Ugandan Shilling", "symbol" => "USh"),
                "UAH" => array("name" => "Ukrainian Hryvnia", "symbol" => "₴"),
                "AED" => array("name" => "United Arab Emirates Dirham", "symbol" => "إ.د"),
                "UYU" => array("name" => "Uruguayan Peso", "symbol" => "$"),
                "USD" => array("name" => "US Dollar", "symbol" => "$"),
                "UZS" => array("name" => "Uzbekistan Som", "symbol" => "лв"),
                "VUV" => array("name" => "Vanuatu Vatu", "symbol" => "VT"),
                "VEF" => array("name" => "Venezuelan BolÃvar", "symbol" => "Bs"),
                "VND" => array("name" => "Vietnamese Dong", "symbol" => "₫"),
                "YER" => array("name" => "Yemeni Rial", "symbol" => "﷼"),
                "ZMK" => array("name" => "Zambian Kwacha", "symbol" => "ZK")
        );


        if ($res == "code") {
                foreach ($currencies as $code => $value) {
                        if ($name == $code) {
                                return $code;
                        }
                }
        } else {
                foreach ($currencies as $code => $value) {
                        if ($name == $code) {
                                return $value["$res"];
                        }
                }
        }
}

//fontawesome array 
function SelectIcons($data = false)
{
        $IconsList = ["fa-500px", "fa-address-book", "fa-address-book-o", "fa-address-card", "fa-address-card-o", "fa-adjust", "fa-adn", "fa-align-center", "fa-align-justify", "fa-align-left", "fa-align-right", "fa-amazon", "fa-ambulance", "fa-american-sign-language-interpreting", "fa-anchor", "fa-android", "fa-angellist", "fa-angle-double-down", "fa-angle-double-left", "fa-angle-double-right", "fa-angle-double-up", "fa-angle-down", "fa-angle-left", "fa-angle-right", "fa-angle-up", "fa-apple", "fa-archive", "fa-area-chart", "fa-arrow-circle-down", "fa-arrow-circle-left", "fa-arrow-circle-o-down", "fa-arrow-circle-o-left", "fa-arrow-circle-o-right", "fa-arrow-circle-o-up", "fa-arrow-circle-right", "fa-arrow-circle-up", "fa-arrow-down", "fa-arrow-left", "fa-arrow-right", "fa-arrow-up", "fa-arrows", "fa-arrows-alt", "fa-arrows-h", "fa-arrows-v", "fa-asl-interpreting", "fa-assistive-listening-systems", "fa-asterisk", "fa-at", "fa-audio-description", "fa-automobile", "fa-backward", "fa-balance-scale", "fa-ban", "fa-bandcamp", "fa-bank", "fa-bar-chart", "fa-bar-chart-o", "fa-barcode", "fa-bars", "fa-bath", "fa-bathtub", "fa-battery", "fa-battery-0", "fa-battery-1", "fa-battery-2", "fa-battery-3", "fa-battery-4", "fa-battery-empty", "fa-battery-full", "fa-battery-half", "fa-battery-quarter", "fa-battery-three-quarters", "fa-bed", "fa-beer", "fa-behance", "fa-behance-square", "fa-bell", "fa-bell-o", "fa-bell-slash", "fa-bell-slash-o", "fa-bicycle", "fa-binoculars", "fa-birthday-cake", "fa-bitbucket", "fa-bitbucket-square", "fa-bitcoin", "fa-black-tie", "fa-blind", "fa-bluetooth", "fa-bluetooth-b", "fa-bold", "fa-bolt", "fa-bomb", "fa-book", "fa-bookmark", "fa-bookmark-o", "fa-braille", "fa-briefcase", "fa-btc", "fa-bug", "fa-building", "fa-building-o", "fa-bullhorn", "fa-bullseye", "fa-bus", "fa-buysellads", "fa-cab", "fa-calculator", "fa-calendar", "fa-calendar-check-o", "fa-calendar-minus-o", "fa-calendar-o", "fa-calendar-plus-o", "fa-calendar-times-o", "fa-camera", "fa-camera-retro", "fa-car", "fa-caret-down", "fa-caret-left", "fa-caret-right", "fa-caret-square-o-down", "fa-caret-square-o-left", "fa-caret-square-o-right", "fa-caret-square-o-up", "fa-caret-up", "fa-cart-arrow-down", "fa-cart-plus", "fa-cc", "fa-cc-amex", "fa-cc-diners-club", "fa-cc-discover", "fa-cc-jcb", "fa-cc-mastercard", "fa-cc-paypal", "fa-cc-stripe", "fa-cc-visa", "fa-certificate", "fa-chain", "fa-chain-broken", "fa-check", "fa-check-circle", "fa-check-circle-o", "fa-check-square", "fa-check-square-o", "fa-chevron-circle-down", "fa-chevron-circle-left", "fa-chevron-circle-right", "fa-chevron-circle-up", "fa-chevron-down", "fa-chevron-left", "fa-chevron-right", "fa-chevron-up", "fa-child", "fa-chrome", "fa-circle", "fa-circle-o", "fa-circle-o-notch", "fa-circle-thin", "fa-clipboard", "fa-clock-o", "fa-clone", "fa-close", "fa-cloud", "fa-cloud-download", "fa-cloud-upload", "fa-cny", "fa-code", "fa-code-fork", "fa-codepen", "fa-codiepie", "fa-coffee", "fa-cog", "fa-cogs", "fa-columns", "fa-comment", "fa-comment-o", "fa-commenting", "fa-commenting-o", "fa-comments", "fa-comments-o", "fa-compass", "fa-compress", "fa-connectdevelop", "fa-contao", "fa-copy", "fa-copyright", "fa-creative-commons", "fa-credit-card", "fa-credit-card-alt", "fa-crop", "fa-crosshairs", "fa-css3", "fa-cube", "fa-cubes", "fa-cut", "fa-cutlery", "fa-dashboard", "fa-dashcube", "fa-database", "fa-deaf", "fa-deafness", "fa-dedent", "fa-delicious", "fa-desktop", "fa-deviantart", "fa-diamond", "fa-digg", "fa-dollar", "fa-dot-circle-o", "fa-download", "fa-dribbble", "fa-drivers-license", "fa-drivers-license-o", "fa-dropbox", "fa-drupal", "fa-edge", "fa-edit", "fa-eercast", "fa-eject", "fa-ellipsis-h", "fa-ellipsis-v", "fa-empire", "fa-envelope", "fa-envelope-o", "fa-envelope-open", "fa-envelope-open-o", "fa-envelope-square", "fa-envira", "fa-eraser", "fa-etsy", "fa-eur", "fa-euro", "fa-exchange", "fa-exclamation", "fa-exclamation-circle", "fa-exclamation-triangle", "fa-expand", "fa-expeditedssl", "fa-external-link", "fa-external-link-square", "fa-eye", "fa-eye-slash", "fa-eyedropper", "fa-fa", "fa-facebook", "fa-facebook-f", "fa-facebook-official", "fa-facebook-square", "fa-fast-backward", "fa-fast-forward", "fa-fax", "fa-feed", "fa-female", "fa-fighter-jet", "fa-file", "fa-file-archive-o", "fa-file-audio-o", "fa-file-code-o", "fa-file-excel-o", "fa-file-image-o", "fa-file-movie-o", "fa-file-o", "fa-file-pdf-o", "fa-file-photo-o", "fa-file-picture-o", "fa-file-powerpoint-o", "fa-file-sound-o", "fa-file-text", "fa-file-text-o", "fa-file-video-o", "fa-file-word-o", "fa-file-zip-o", "fa-files-o", "fa-film", "fa-filter", "fa-fire", "fa-fire-extinguisher", "fa-firefox", "fa-first-order", "fa-flag", "fa-flag-checkered", "fa-flag-o", "fa-flash", "fa-flask", "fa-flickr", "fa-floppy-o", "fa-folder", "fa-folder-o", "fa-folder-open", "fa-folder-open-o", "fa-font", "fa-font-awesome", "fa-fonticons", "fa-fort-awesome", "fa-forumbee", "fa-forward", "fa-foursquare", "fa-free-code-camp", "fa-frown-o", "fa-futbol-o", "fa-gamepad", "fa-gavel", "fa-gbp", "fa-ge", "fa-gear", "fa-gears", "fa-genderless", "fa-get-pocket", "fa-gg", "fa-gg-circle", "fa-gift", "fa-git", "fa-git-square", "fa-github", "fa-github-alt", "fa-github-square", "fa-gitlab", "fa-gittip", "fa-glass", "fa-glide", "fa-glide-g", "fa-globe", "fa-google", "fa-google-plus", "fa-google-plus-circle", "fa-google-plus-official", "fa-google-plus-square", "fa-google-wallet", "fa-graduation-cap", "fa-gratipay", "fa-grav", "fa-group", "fa-h-square", "fa-hacker-news", "fa-hand-grab-o", "fa-hand-lizard-o", "fa-hand-o-down", "fa-hand-o-left", "fa-hand-o-right", "fa-hand-o-up", "fa-hand-paper-o", "fa-hand-peace-o", "fa-hand-pointer-o", "fa-hand-rock-o", "fa-hand-scissors-o", "fa-hand-spock-o", "fa-hand-stop-o", "fa-handshake-o", "fa-hard-of-hearing", "fa-hashtag", "fa-hdd-o", "fa-header", "fa-headphones", "fa-heart", "fa-heart-o", "fa-heartbeat", "fa-history", "fa-home", "fa-hospital-o", "fa-hotel", "fa-hourglass", "fa-hourglass-1", "fa-hourglass-2", "fa-hourglass-3", "fa-hourglass-end", "fa-hourglass-half", "fa-hourglass-o", "fa-hourglass-start", "fa-houzz", "fa-html5", "fa-i-cursor", "fa-id-badge", "fa-id-card", "fa-id-card-o", "fa-ils", "fa-image", "fa-imdb", "fa-inbox", "fa-indent", "fa-industry", "fa-info", "fa-info-circle", "fa-inr", "fa-instagram", "fa-institution", "fa-internet-explorer", "fa-intersex", "fa-ioxhost", "fa-italic", "fa-joomla", "fa-jpy", "fa-jsfiddle", "fa-key", "fa-keyboard-o", "fa-krw", "fa-language", "fa-laptop", "fa-lastfm", "fa-lastfm-square", "fa-leaf", "fa-leanpub", "fa-legal", "fa-lemon-o", "fa-level-down", "fa-level-up", "fa-life-bouy", "fa-life-buoy", "fa-life-ring", "fa-life-saver", "fa-lightbulb-o", "fa-line-chart", "fa-link", "fa-linkedin", "fa-linkedin-square", "fa-linode", "fa-linux", "fa-list", "fa-list-alt", "fa-list-ol", "fa-list-ul", "fa-location-arrow", "fa-lock", "fa-long-arrow-down", "fa-long-arrow-left", "fa-long-arrow-right", "fa-long-arrow-up", "fa-low-vision", "fa-magic", "fa-magnet", "fa-mail-forward", "fa-mail-reply", "fa-mail-reply-all", "fa-male", "fa-map", "fa-map-marker", "fa-map-o", "fa-map-pin", "fa-map-signs", "fa-mars", "fa-mars-double", "fa-mars-stroke", "fa-mars-stroke-h", "fa-mars-stroke-v", "fa-maxcdn", "fa-meanpath", "fa-medium", "fa-medkit", "fa-meetup", "fa-meh-o", "fa-mercury", "fa-microchip", "fa-microphone", "fa-microphone-slash", "fa-minus", "fa-minus-circle", "fa-minus-square", "fa-minus-square-o", "fa-mixcloud", "fa-mobile", "fa-mobile-phone", "fa-modx", "fa-money", "fa-moon-o", "fa-mortar-board", "fa-motorcycle", "fa-mouse-pointer", "fa-music", "fa-navicon", "fa-neuter", "fa-newspaper-o", "fa-object-group", "fa-object-ungroup", "fa-odnoklassniki", "fa-odnoklassniki-square", "fa-opencart", "fa-openid", "fa-opera", "fa-optin-monster", "fa-outdent", "fa-pagelines", "fa-paint-brush", "fa-paper-plane", "fa-paper-plane-o", "fa-paperclip", "fa-paragraph", "fa-paste", "fa-pause", "fa-pause-circle", "fa-pause-circle-o", "fa-paw", "fa-paypal", "fa-pencil", "fa-pencil-square", "fa-pencil-square-o", "fa-percent", "fa-phone", "fa-phone-square", "fa-photo", "fa-picture-o", "fa-pie-chart", "fa-pied-piper", "fa-pied-piper-alt", "fa-pied-piper-pp", "fa-pinterest", "fa-pinterest-p", "fa-pinterest-square", "fa-plane", "fa-play", "fa-play-circle", "fa-play-circle-o", "fa-plug", "fa-plus", "fa-plus-circle", "fa-plus-square", "fa-plus-square-o", "fa-podcast", "fa-power-off", "fa-print", "fa-product-hunt", "fa-puzzle-piece", "fa-qq", "fa-qrcode", "fa-question", "fa-question-circle", "fa-question-circle-o", "fa-quora", "fa-quote-left", "fa-quote-right", "fa-ra", "fa-random", "fa-ravelry", "fa-rebel", "fa-recycle", "fa-reddit", "fa-reddit-alien", "fa-reddit-square", "fa-refresh", "fa-registered", "fa-remove", "fa-renren", "fa-reorder", "fa-repeat", "fa-reply", "fa-reply-all", "fa-resistance", "fa-retweet", "fa-rmb", "fa-road", "fa-rocket", "fa-rotate-left", "fa-rotate-right", "fa-rouble", "fa-rss", "fa-rss-square", "fa-rub", "fa-ruble", "fa-rupee", "fa-s15", "fa-safari", "fa-save", "fa-scissors", "fa-scribd", "fa-search", "fa-search-minus", "fa-search-plus", "fa-sellsy", "fa-send", "fa-send-o", "fa-server", "fa-share", "fa-share-alt", "fa-share-alt-square", "fa-share-square", "fa-share-square-o", "fa-shekel", "fa-sheqel", "fa-shield", "fa-ship", "fa-shirtsinbulk", "fa-shopping-bag", "fa-shopping-basket", "fa-shopping-cart", "fa-shower", "fa-sign-in", "fa-sign-language", "fa-sign-out", "fa-signal", "fa-signing", "fa-simplybuilt", "fa-sitemap", "fa-skyatlas", "fa-skype", "fa-slack", "fa-sliders", "fa-slideshare", "fa-smile-o", "fa-snapchat", "fa-snapchat-ghost", "fa-snapchat-square", "fa-snowflake-o", "fa-soccer-ball-o", "fa-sort", "fa-sort-alpha-asc", "fa-sort-alpha-desc", "fa-sort-amount-asc", "fa-sort-amount-desc", "fa-sort-asc", "fa-sort-desc", "fa-sort-down", "fa-sort-numeric-asc", "fa-sort-numeric-desc", "fa-sort-up", "fa-soundcloud", "fa-space-shuttle", "fa-spinner", "fa-spoon", "fa-spotify", "fa-square", "fa-square-o", "fa-stack-exchange", "fa-stack-overflow", "fa-star", "fa-star-half", "fa-star-half-empty", "fa-star-half-full", "fa-star-half-o", "fa-star-o", "fa-steam", "fa-steam-square", "fa-step-backward", "fa-step-forward", "fa-stethoscope", "fa-sticky-note", "fa-sticky-note-o", "fa-stop", "fa-stop-circle", "fa-stop-circle-o", "fa-street-view", "fa-strikethrough", "fa-stumbleupon", "fa-stumbleupon-circle", "fa-subscript", "fa-subway", "fa-suitcase", "fa-sun-o", "fa-superpowers", "fa-superscript", "fa-support", "fa-table", "fa-tablet", "fa-tachometer", "fa-tag", "fa-tags", "fa-tasks", "fa-taxi", "fa-telegram", "fa-television", "fa-tencent-weibo", "fa-terminal", "fa-text-height", "fa-text-width", "fa-th", "fa-th-large", "fa-th-list", "fa-themeisle", "fa-thermometer", "fa-thermometer-0", "fa-thermometer-1", "fa-thermometer-2", "fa-thermometer-3", "fa-thermometer-4", "fa-thermometer-empty", "fa-thermometer-full", "fa-thermometer-half", "fa-thermometer-quarter", "fa-thermometer-three-quarters", "fa-thumb-tack", "fa-thumbs-down", "fa-thumbs-o-down", "fa-thumbs-o-up", "fa-thumbs-up", "fa-ticket", "fa-times", "fa-times-circle", "fa-times-circle-o", "fa-times-rectangle", "fa-times-rectangle-o", "fa-tint", "fa-toggle-down", "fa-toggle-left", "fa-toggle-off", "fa-toggle-on", "fa-toggle-right", "fa-toggle-up", "fa-trademark", "fa-train", "fa-transgender", "fa-transgender-alt", "fa-trash", "fa-trash-o", "fa-tree", "fa-trello", "fa-tripadvisor", "fa-trophy", "fa-truck", "fa-try", "fa-tty", "fa-tumblr", "fa-tumblr-square", "fa-turkish-lira", "fa-tv", "fa-twitch", "fa-twitter", "fa-twitter-square", "fa-umbrella", "fa-underline", "fa-undo", "fa-universal-access", "fa-university", "fa-unlink", "fa-unlock", "fa-unlock-alt", "fa-unsorted", "fa-upload", "fa-usb", "fa-usd", "fa-user", "fa-user-circle", "fa-user-circle-o", "fa-user-md", "fa-user-o", "fa-user-plus", "fa-user-secret", "fa-user-times", "fa-users", "fa-vcard", "fa-vcard-o", "fa-venus", "fa-venus-double", "fa-venus-mars", "fa-viacoin", "fa-viadeo", "fa-viadeo-square", "fa-video-camera", "fa-vimeo", "fa-vimeo-square", "fa-vine", "fa-vk", "fa-volume-control-phone", "fa-volume-down", "fa-volume-off", "fa-volume-up", "fa-warning", "fa-wechat", "fa-weibo", "fa-weixin", "fa-whatsapp", "fa-wheelchair", "fa-wheelchair-alt", "fa-wifi", "fa-wikipedia-w", "fa-window-close", "fa-window-close-o", "fa-window-maximize", "fa-window-minimize", "fa-window-restore", "fa-windows", "fa-won", "fa-wordpress", "fa-wpbeginner", "fa-wpexplorer", "fa-wpforms", "fa-wrench", "fa-xing", "fa-xing-square", "fa-y-combinator", "fa-y-combinator-square", "fa-yahoo", "fa-yc", "fa-yc-square", "fa-yelp", "fa-yen", "fa-yoast", "fa-youtube", "fa-youtube-play", "fa-youtube-square"];

        foreach ($IconsList as $code => $name) {
                if ($code == $data) {
                        $selected = "selected=''";
                } else {
                        $selected = "";
                }
                echo "
                <option value='$name' $selected>$name <i class='fa $name'></i></option>";
        }
}

//activation & deactivation options
function SelectStatus($data)
{
        if ($data == "1" or $data == "Active" or $data == "Active" or $data == 1) { ?>
                <option value="1" selected="">Active</option>
                <option value="2">Inactive</option>
        <?php } else { ?>
                <option value="1">Active</option>
                <option value="2" selected="">Inactive</option>
        <?php }
}

//no data found View
function NoDataTableView($title, $columns)
{ ?>
        <tr>
                <td colspan="<?php echo $columns; ?>" align="center"><b class="h4 p-3" style="padding:1rem !important;"><?php echo $title; ?></b></td>
        </tr>
<?php }

//request input data
function ProvideInput($method, $type, $name, $value = true, $security = true, $hidden = true, $attributes)
{
        //method
        if ($method == "GET") {
                $ReturnValue = GET($name);
        } elseif ($method == "POST") {
                $ReturnValue = POST($name);
        } else {
                $ReturnValue = "null";
        }

        //secuirty
        if ($security == true) {
                $ReturnValue = $ReturnValue;
        } else {
                $ReturnValue = SECURE($ReturnValue, "d");
        }

        //defuault value
        if ($value == true) {
                $ReturnValue = $ReturnValue;
        } else {
                $ReturnValue = $value;
        }

        //attributes
        $attibute = "";
        if ($attributes != false) {
                foreach ($attributes as $key => $value) {
                        $attibute .= $key . "='" . $value . "'";
                }
        } else {
                $attibute = "";
        }

        //hidden status
        if ($hidden == true) {
                $hidden = "hidden=''";
        } else {
                $hidden = "";
        }
?>
        <input type=" <?php echo $type; ?>" <?php echo $hidden; ?> name="<?php echo $name; ?>" value="<?php echo $ReturnValue; ?>" <?php echo $attibute; ?>>
        <?php }


//function for list of all countries
function ALLCOUNTRIES($default = null, $suggest = false)
{
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        foreach ($countries as $country) {
                if ($country == $default) {
                        $selected = "selected";
                } else {
                        $selected = "";
                }
                if ($suggest == false) { ?>
                        <option value="<?php echo $country; ?>" <?php echo $selected; ?>><?php echo $country; ?></option>
                <?php
                } else {
                ?>
                        <option value="<?php echo $country; ?>" <?php echo $selected; ?>></option>
        <?php
                }
        }
}

//form start section
function Form_start($Formname, $action, $method, $encrptype = "", array $formattribute)
{
        global $Formname;
        ?>
        <form action="<?php echo CONTROLLER . "/" . $action; ?>" method="<?php echo $method; ?>" enctype="<?php echo $encrptype; ?>" <?php echo LOOP_TagsAttributes($formattribute); ?>>
        <?php
        FormPrimaryInputs(true);
}

//form end
function Form_end()
{
        ?>
        </form>
<?php
}


//function 
function SelectInputOptions(array $inputoptions, $select = null)
{
        foreach ($inputoptions as $value) {
                if ($value == $select) {
                        $selected = "selected";
                } else {
                        $selected = "";
                }
                echo "<option value='$value' $selected>$value</option>";
        }
}

//input types
define("INPUT_TYPES", array("text", "url", "email", "tel", "date", "time", "number", "datetime-local", "color", "month", "week", "textarea", "file"));
