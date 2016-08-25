<?php

class DatasetFeeder
{
    private $title = array(
        'email_custom_domain',
        'same_email_domain_count',
        'projects_count',
        'strings_count', // more is better
        'members_count', // less is better, 20-30 translators is optimal for private projects
        'has_private_project', // new feature
        'same_login_and_project_name',
        'days_after_last_login', // new feature, 20 days - will not buy
        'country',
        'purchase' // 30% of purchasing
    );

    private $targetFile = 'dataset.csv';
    private $file;

    private $rowsCount = 10000;

    public function __construct()
    {
        $this->file = fopen($this->targetFile, 'w+');
    }

    public function __destruct()
    {
        fclose($this->file);
    }

    public function feed()
    {
        $this->write($this->title);

        for ($i = 0; $i < $this->rowsCount; $i++) {
            $stringsCount = rand(0, 100);
            $country = $this->getCountry(rand(1, 100));
            $purchase = $this->getPurchasing($country);
            $sameLog = $this->sameLogin(10);

            $this->write(array(
                rand(0, 1), // email custom domain
                rand(0, 1000), // same email domain count
                rand(1, 100), // projects count
                $stringsCount, // strings count. more is better
                rand(1, 1000), // members count. less is better, 20-30 translators is optimal for private projects
                rand(0, 1),// has_private_project
                $sameLog, // same_login_and_project_name
                rand(0, 365),// days_after_last_login
                $country, // country
                $purchase // purchasing
            ));
        }
    }

    private function getPurchasing($country)
    {
        $random = rand(1, 100);

        if ($country === 'USA' && in_array($random, range(1, 70))) {
            return 1;
        }

        if ($country === 'China' && in_array($random, range(1, 40))) {
            return 1;
        }

        if ($country === 'Germany' && in_array($random, range(1, 60))) {
            return 1;
        }

        if ($country === 'Japan' && in_array($random, range(1, 20))) {
            return 1;
        }

        if ($country === 'Saudi Arabia' && in_array($random, range(1, 90))) {
            return 1;
        }

        if ($country === 'Ukraine' && in_array($random, range(1, 50))) {
            return 1;
        }

        if ($country === 'Polland' && in_array($random, range(1, 35))) {
            return 1;
        }

        if ($country === 'Italy' && in_array($random, range(1, 25))) {
            return 1;
        }

        if ($country === 'France' && in_array($random, range(1, 55))) {
            return 1;
        }

        if ($country === 'Spain' && in_array($random, range(1, 43))) {
            return 1;
        }

        return 0;
    }

    private function getCountry($index)
    {
        if (in_array($index, range(1, 30))) {
            return 'USA';
        }

        if (in_array($index, range(31, 40))) {
            return 'China';
        }

        if (in_array($index, range(41, 50))) {
            return 'Germany';
        }

        if (in_array($index, range(51, 60))) {
            return 'Japan';
        }

        if (in_array($index, range(61, 70))) {
            return 'Saudi Arabia';
        }

        if (in_array($index, range(71, 75))) {
            return 'Ukraine';
        }

        if (in_array($index, range(76, 80))) {
            return 'Polland';
        }

        if (in_array($index, range(81, 85))) {
            return 'Italy';
        }

        if (in_array($index, range(86, 90))) {
            return 'France';
        }

        if (in_array($index, range(91, 100))) {
            return 'Spain';
        }

//        $countries = array('USA', 'China', 'Germany', 'Japan', 'Saudi Arabia', 'Ukraine', 'Polland', 'Italy', 'France', 'Spain');
//        return $countries[$index];
    }

    private function write($data)
    {
        fputcsv($this->file, $data);
    }


    private function sameLogin($len)
    {

        $word = array_merge(range('a', 'z'), range('A', 'Z'));
        shuffle($word);
        return substr(implode($word), 0, $len);
    }


}

$datasetFeeder = new DatasetFeeder();
$datasetFeeder->feed();