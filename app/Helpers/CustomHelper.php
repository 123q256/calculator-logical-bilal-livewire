<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('getDatabaseData')) {
    function getDatabaseData() {
        $allcategories = DB::table('categories')->select('cat_name','is_del', 'img', 'cat_time','cat_id')->where('is_del', 0)->get();
        return $allcategories;
    }
}
if (!function_exists('gcd')) {
    function gcd($a, $b) {
        $a = abs($a); $b = abs($b);
        if ($a < $b) { list($b, $a) = array($a, $b); }
        if ($b == 0) return 1;
        $r = $a % $b;
        while ($r > 0) {
            $a = $b;
            $b = $r;
            $r = $a % $b;
        }
        return $b;
    }
}

if (!function_exists('lcmofn')) {
    function lcmofn($numbers, $n) {
        if (empty($numbers)) return 0;
        $ans = $numbers[0];
        for ($i = 1; $i < $n; $i++) {
            $ans = (($numbers[$i] * $ans) / (gcd($numbers[$i], $ans)));
        }
        return $ans;
    }
}

if (!function_exists('reduce')) {
    function reduce($num, $den) {
        $g = gcd($num, $den);
        return array($num / $g, $den / $g);
    }
}
