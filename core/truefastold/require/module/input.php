<?php

//function for input fields for forms
function Input(array $formcontainer, array $formgroup, array $label, array $input)
{
 if ($label['req'] == true) {
  $req = "<span class='text-danger'>*</span>";
 } else {
  $req = "";
 }
?>
 <div <?php echo LOOP_TagsAttributes($formcontainer); ?>>
  <div <?php echo LOOP_TagsAttributes($formgroup); ?>>
   <label <?php echo LOOP_TagsAttributes($label); ?>><?php echo $label['label']; ?> <?php echo $req; ?></label>
   <input <?php echo LOOP_TagsAttributes($input); ?>>
  </div>
 </div>
<?php
}
