<?php 

$file_handle = fopen("quant-cast-top-million.txt", "r");

while (!feof ($fiel_handle)) {
  $line = fgets($file_handle);
  if (preg_match('/ \d+/', $line)) {
    # if it starts with some amount of digits
    $tmp = explode("\t", $line);
    $rank = trim($tmp[0]);
    $url = trim($tmp[1]);
    if ($url != 'Hidden profile') {
      #Hidden profile appears sometimes just ignore then echo $
    }
  }
}
fclose($file_handle); 