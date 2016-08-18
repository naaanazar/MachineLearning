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

        use project\application\ArrayDB;
        use project\application\ArrayFactory;

        $arrayDB = new ArrayDB();
        $sorterFactory = new ArrayFactory();

        foreach ($sorterFactory::getAllType() as $type) {
            $sorter = $sorterFactory->getSorter($type);

            $arrayDB->connectDB();
            $sorter->arrayFeel(5);
            $sorter->sort();
            $sorter->displayDB();
        }
        ?>
    </div>
</body>
</html>