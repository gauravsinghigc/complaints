<?php
//label
function Label($text, array $attributes)
{ ?>
 <label <?php LOOP_TagsAttributes($attributes); ?>><?php echo $text; ?></label>
<?php }
