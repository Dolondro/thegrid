<?php

chdir(__DIR__);
include("../vendor/autoload.php");

//$grid = new \Dolondro\Grid\Grid();
//$grid->render([["hello"]]);
$gridRenderer = \Dolondro\Grid\GridRenderer::create();

$grid = [
    [["Rk", \Dolondro\Grid\Cell::COLOR_GREEN], ["Kn", \Dolondro\Grid\Cell::COLOR_BLUE], "Bi", "Qu", "Ki", "Bi", "Kn", "Rk"],
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

$array = $gridRenderer->render($grid, \Dolondro\Grid\GridRenderer::RENDER_ARRAY);

foreach ($array as $key => $value) {
    $array[$key] = $value."     ".$value;
}

echo implode($array, "\n")."\n";


