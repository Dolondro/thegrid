# thegrid
Abstraction for creating a grid of content in a terminal window

Ever wanted to create say, a game of chess in PHP in the terminal, but couldn't be bothered to make a grid? No? I thought not.

If you did decide you wanted to do such a thing, this project might be helpful to you. It uses all the assorted box character
unicode stuff to generate a half reasonable grid.

    // Usage is something like this
    $gridRenderer = \Dolondro\TheGrid\GridRenderer::create();
    $gridRenderer->render([[
      "Cell1"
    ]]);
    
There's a half baked example which gives you a decent idea of how to use it in examples/test.php and if you need guidance and here's a copied comment that explains what the format of a cell should look like:

    // Create expects a multi-dimensional array. Each "cell" in the array should either be:
    // 1. null    (will result in nothing being rendered)
    // 2. a value (like the number 5 or what have you)
    // 3. an array like so: [$value, $colour]. Colour should be in ansi style format (like "\033[31m").
    //    a comprehensive list of them can be accessed directly from Color::COLOR_BLAH
    
Good luck have have fun!
