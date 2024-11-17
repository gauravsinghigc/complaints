<?php
//get user address 
function UserAddress($CustomerId)
{
 $UserStreetAddress = FETCH("SELECT * FROM user_addresses where UserAddressUserId='$CustomerId'", "UserStreetAddress");
 $UserLocality = FETCH("SELECT * FROM user_addresses where UserAddressUserId='$CustomerId'", "UserLocality");
 $UserCity = FETCH("SELECT * FROM user_addresses where UserAddressUserId='$CustomerId'", "UserCity");
 $UserState = FETCH("SELECT * FROM user_addresses where UserAddressUserId='$CustomerId'", "UserState");
 $UserCountry = FETCH("SELECT * FROM user_addresses where UserAddressUserId='$CustomerId'", "UserCountry");
 $UserPincode = FETCH("SELECT * FROM user_addresses where UserAddressUserId='$CustomerId'", "UserPincode");
 $UserAddressType = FETCH("SELECT * FROM user_addresses where UserAddressUserId='$CustomerId'", "UserAddressType");

 $CompleteAddress = "($UserAddressType)<br>$UserStreetAddress $UserLocality $UserCity $UserState $UserCountry $UserPincode";

 return $CompleteAddress;
}

//user salutation 
define("SALUTATION", array("Mr.", "Mrs.", "Miss", "M/s", "Prof", "Dr."));
