<?php
$content = file_get_contents('d:/wamp64/www/calculator-logical-bilal-livewire/app/Models/Construction.php');
$lines = explode("\n", $content);
$open = 0;
$close = 0;
for ($i = 0; $i < 309; $i++) {
    $line = $lines[$i];
    $open += substr_count($line, '{');
    $close += substr_count($line, '}');
}
echo "Lines 1-309: Open=$open, Close=$close\n";
