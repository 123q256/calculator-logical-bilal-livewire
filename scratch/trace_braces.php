<?php
$content = file_get_contents('d:/wamp64/www/calculator-logical-bilal-livewire/app/Models/Construction.php');
$lines = explode("\n", $content);
$open = 0;
$close = 0;
for ($i = 89; $i < 308; $i++) {
    $line = $lines[$i];
    $open += substr_count($line, '{');
    $close += substr_count($line, '}');
    echo "Line " . ($i+1) . ": O=$open, C=$close | $line\n";
}
