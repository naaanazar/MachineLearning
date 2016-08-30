<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Array Factory</title>
    <link rel="stylesheet" href="css/main.css"/>
</head>
<body>
    <div class="container">
        <h2>Array AJAX</h2>
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
        <div>
            <button id="standart">Standart Array</button>
            <button id="snake">Snake Array</button>
            <button id="spiral">Spiral Array</button>
        </div>
        <br>
        <div id="update"></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/common.js"></script>
</body>
</html>