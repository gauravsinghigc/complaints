<?php
//formstart
Form_start("test", "test", "post", "multipart/form-data", [
 "class" => "row mb-10px"
]);

Input(
 [
  "class" => "row mb-10px",
 ],
 [
  "class" => "form-group col-md-6"
 ],
 [
  "for" => "CustomerName",
  "label" => "Customer Name",
  "req" => true
 ],
 [
  "type" => "text",
  "name" => "customer_name",
  "id" => "customer_name",
  "class" => "form-control",
  "placeholder" => "Customer Name",
  "required" => "",
 ]
);


Form_end();
