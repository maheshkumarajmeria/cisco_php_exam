<?php
  $dir ="c:";
  $free = round(disk_free_space($dir)/1048576);
  $total = round(disk_total_space($dir)/1048576);
  $used = $total - $free;
  echo "$used MB used";
?>