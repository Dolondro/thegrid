<?php

chdir(__DIR__);
include("../vendor/autoload.php");

//$grid = new \Dolondro\TheGrid\Grid();
//$grid->render([["hello"]]);
$gridRenderer = \Dolondro\TheGrid\GridRenderer::create();

$grid = [
    [["Rk", \Dolondro\TheGrid\Cell::COLOR_GREEN], ["Kn", \Dolondro\TheGrid\Cell::COLOR_BLUE], "Bi", "Qu", "Ki", "Bi", "Kn", "Rk"],
    ["P", "P","P", "P","P", "P","P", "P",],
    [null, null, null, null, null, null, null, null],
    [null, null, null, null, null, null, null, null],
    [null, null, null, null, null, null, null, null],
    [null, null, null, null, null, null, null, null],
    ["P", "P","P", "P","P", "P","P", "P"],
    ["Rk", "Kn", "Bi", "Qu", "Ki", "Bi", "Kn", "Rk"]
];


echo $gridRenderer->render($grid);

echo "\n\n\n";

$array = $gridRenderer->render($grid, \Dolondro\TheGrid\GridRenderer::RENDER_ARRAY);

foreach ($array as $key => $value) {
    $array[$key] = $value."     ".$value;
}

echo implode($array, "\n")."\n";


