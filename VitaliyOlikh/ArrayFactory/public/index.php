<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Array Factory</title>
    <link rel="stylesheet" href="css/main.css"/>
</head>
<body>
    <div class="container">
        <h2>Array Factory Pattern</h2>
        <?php

            ini_set('display_erroros', 1);

            require __DIR__ . '/../vendor/autoload.php';

            use project\application\ArrayFactory;
            use project\application\ArrayGenerate\ArrayGenerator;

            $sorterFactory = new ArrayFactory();

            foreach ($sorterFactory::getAllType() as $type) {
                $sorter = $sorterFactory->getSorter($type);

                $sorter->ArrayFeel(5);
                $sorter->sort();
                $sorter->display();
            }
        ?>
    </div>
</body>
</html>