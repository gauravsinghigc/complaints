<?php
//custom invoice id
define("INVOICE_ID", "INV-" . date("Y") . "/" . date("Y", strtotime("+1 year")) . "/" . date("m") . "/" . rand(11111, 999999));

//list of all banks
define("BANK_LIST", array(
 "Bank of Baroda", "Bank of India", "Bank of Maharashtra", "Canara Bank", "Central Bank of India", "Indian Bank", "Indian Overseas Bank", "Punjab & Sind Bank",
 "Punjab National Bank", "State Bank of India", "UCO Bank", "Union Bank of India", "Axis Bank Ltd.", "Bandhan Bank Ltd.", "CSB Bank Ltd.", "City Union Bank Ltd",
 "DCB Bank Ltd", "Dhanlaxmi Bank Ltd.", "Federal Bank Ltd.", "HDFC Bank Ltd", "ICICI Bank Ltd.", "Induslnd Bank Ltd", "IDFC First Bank Ltd.", "Jammu & Kashmir Bank Ltd.",
 "Karnataka Bank Ltd.", "Karur Vysya Bank Ltd.", "Kotak Mahindra Bank Ltd", "	Lakshmi Vilas Bank Ltd.", "Nainital Bank Ltd.", "RBL Bank Ltd.", "South Indian Bank Ltd.", "Tamilnad Mercantile Bank Ltd.",
 "YES Bank Ltd.", "IDBI Bank Ltd.", "Au Small Finance Bank Limited", "Capital Small Finance Bank Limited", "Equitas Small Finance Bank Limited",
 "Suryoday Small Finance Bank Limited", "Ujjivan Small Finance Bank Limited", "Utkarsh Small Finance Bank Limited", "ESAF Small Finance Bank Limited",
 "Fincare Small Finance Bank Limited", "Jana Small Finance Bank Limited", "North East Small Finance Bank Limited", "Shivalik Small Finance Bank Limited",
 "India Post Payments Bank Limited", "Fino Payments Bank Limited", "Paytm Payments Bank Limited", "Airtel Payments Bank Limited", "Andhra Pragathi Grameena Bank",
 "Andhra Pradesh Grameena Vikas Bank", "Arunachal Pradesh Rural Bank", "Aryavart Bank", "Assam Gramin Vikash Bank", "Bangiya Gramin Vikas Bank",
 "Baroda Gujarat Gramin Bank", "Baroda Rajasthan Kshetriya Gramin Bank", "Baroda UP Bank", "Chaitanya Godavari Grameena Bank", "Chhattisgarh Rajya Gramin Bank",
 "Dakshin Bihar Gramin Bank", "Ellaquai Dehati Bank", "Himachal Pradesh Gramin Bank", "J&K Grameen Bank", "Jharkhand Rajya Gramin Bank", "Karnataka Vikas Grameena Bank",
 "Kerala Gramin Bank", "Madhya Pradesh Gramin Bank", "Madhyanchal Gramin Bank", "Maharashtra Gramin Bank", "Manipur Rural Bank", "Meghalaya Rural Bank", "Mizoram Rural Bank",
 "Nagaland Rural Bank", "Odisha Gramya Bank", "Paschim Banga Gramin Bank", "Prathama UP Gramin Bank", "Puduvai Bharathiar Grama Bank", "Punjab Gramin Bank",
 "Rajasthan Marudhara Gramin Bank", "Saptagiri Grameena Bank", "Sarva Haryana Gramin Bank", "Saurashtra Gramin Bank", "Tamil Nadu Grama Bank", "Telangana Grameena Bank", "Tripura Gramin Bank",
 "Utkal Grameen bank", "Uttar Bihar Gramin Bank", "Uttarakhand Gramin Bank", "Uttarbanga Kshetriya Gramin Bank", "Vidharbha Konkan Gramin Bank", "Australia and New Zealand Banking Group Ltd.",
 "Westpac Banking Corporation", "Bank of Bahrain & Kuwait BSC", "AB Bank Ltd.", "Sonali Bank Ltd.", "Bank of Nova Scotia", "Industrial & Commercial Bank of China Ltd.",
 "BNP Paribas", "Credit Agricole Corporate & Investment Bank", "Societe Generale", "Deutsche Bank", "HSBC Ltd", "	PT Bank Maybank Indonesia TBK", "Mizuho Bank Ltd.", "Sumitomo Mitsui Banking Corporation", "MUFG Bank, Ltd.",
 "Cooperatieve Rabobank U.A.", "Doha Bank", "Qatar National Bank", "JSC VTB Bank", "Sberbank", "United Overseas Bank Ltd", "FirstRand Bank Ltd", "Shinhan Bank",
 "Woori Bank", "KEB Hana Bank", "Industrial Bank of Korea", "Kookmin Bank", "Bank of Ceylon", "Credit Suisse A.G", "CTBC Bank Co., Ltd.", "Krung Thai Bank Public Co. Ltd.",
 "Abu Dhabi Commercial Bank Ltd.", "Mashreq Bank PSC", "First Abu Dhabi Bank PJSC", "Emirates Bank NBD", "Barclays Bank Plc.", "Standard Chartered Bank",
 "NatWest Markets Plc", "American Express Banking Corporation", "Bank of America", "Citibank N.A.", "J.P. Morgan Chase Bank N.A.", "SBM Bank (India) Limited", "DBS Bank India Limited",
 "Bank of China Ltd."
));


//define gst types
define("GST_TYPE", array("null", "IGST", "SGST", "CGST"));

//define gst types
define("GST_PERCENTAGE", array("0", "5", "12", "18", "28"));
