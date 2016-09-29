<?php

/**
 * Description of DatasetGenerator
 *
 * @author NAZAR
 */

namespace App\Library\Generators;

class DatasetGenerator
{
    const MAX_ROWS_COUNT = 100000;

    private $title = [
        'email_custom_domain',
        'same_email_domain_count',
        'projects_count',
        'strings_count',                // more is better
        'members_count',                // less is better, 20-30 translators is optimal for private projects
        'has_private_project',          // new feature
        'same_login_and_project_name',
        'days_after_last_login',        // new feature, 20 days - will not buy
        'country',
        'purchase'                      // 30% of purchasing
    ];

    private $targetFile;
    private $file;

    private $rowsCount = 0;
    private $total = 0;
    private $percents = 0;

    private $dataArray = [];

    public function __construct()
    {
        $this->targetFile = public_path().'/datasets/dataset.csv';

        if (file_exists($this->targetFile)) {
            chmod($this->targetFile, 755);
        }         
   
        $this->file = fopen($this->targetFile, 'w');
    }

    public function __destruct()
    {
        fclose($this->file);
    }

    public function setRowsCount($rowsCount)
    {
        if ((int)$rowsCount > self::MAX_ROWS_COUNT) {
            $this->rowsCount = self::MAX_ROWS_COUNT;
        } else {
            $this->rowsCount = (int)$rowsCount;
        }
    }

    public function getRowsCount()
    {
        return $this->rowsCount;
    }
    
    public function getTotal()
    {
        return $this->total;
    }
    
    public function getPurchasePersentage()
    {
        return $this->percents;
    }
    
    public function getTargetFile()
    {
        return $this->targetFile;
    }

    public function generate()
    {
        $this->write($this->title);
        $purchase = rand(0, 1);

        for ($i = 0; $i < $this->rowsCount; $i++) {
            $emailCustomDomain = rand(0, 1);
            $sameEmailDomainCount = rand(0, 200);
            $projectsCount = rand(1, 100);
            $stringsCount = rand(0, 100);
            $country = $this->getCountry(rand(0, 9));

            $hasPrivateProject = $this->hasPrivateProject($purchase);
            $membersCount = $this->membersСount($hasPrivateProject);
            $purchase = $this->getPurchasing($country, $membersCount);

            $sameLogin = $this->hasSameLoginAndProjectName($purchase);
            $daysAfterLogin = $this->daysAfterLogin($purchase);

            array_push($this->dataArray, [
                $emailCustomDomain,
                // email custom domain
                $sameEmailDomainCount,
                // same email domain count
                $projectsCount,
                // projects count
                $stringsCount,
                // strings count. more is better
                $membersCount,
                // members count. less is better, 20-30 translators is optimal for private projects
                $hasPrivateProject,
                // has_private_project
                $sameLogin,
                // same_login_and_project_name
                $daysAfterLogin,
                // days_after_last_login
                $country,
                // country
                $purchase
                // purchasing
            ]);
        }
        $this->countStats();
        $this->writeArray();
    }

    private function hasSameLoginAndProjectName($purchase)
    {
        $rand = rand(1, 100);

        if ($purchase == 1 && in_array($rand, range(1, 8))) {
            return 1;
        } else {
            return rand(0, 1);
        }
    }

    private function membersСount($hasPrivateProject)
    {
        if ($hasPrivateProject == 1) {
            return rand(1, 50);
        } else {
            return rand(1, 1000);
        }
    }

    private function daysAfterLogin($purchase = 0)
    {
        if ($purchase != 1) {
            return rand(0, 30);
        } else {
            return rand(0, 7);
        }
    }

    private function hasPrivateProject($purchase)
    {
        if ($purchase == 1 && in_array(rand(1, 100), range(1, 70))) {
            return 1;
        } else {
            return rand(0, 1);
        }
    }

    private function getPurchasing($country, $membersCount = 8)
    {
        $random         = rand(1, 100);
        $randForMembers = rand(1, 100);

        if ($country === 'USA' && in_array($random, range(1, 70))) {
            if (in_array($membersCount, range(1, 40)) && in_array($randForMembers, range(1, 50))) {
                return 1;
            } else {
                return rand(0, 1);
            }
        }

        if ($country === 'China' && in_array($random, range(1, 40))) {
            if (in_array($membersCount, range(1, 45)) && in_array($randForMembers, range(1, 45))) {
                return 1;
            } else {
                return rand(0, 1);
            }
        }

        if ($country === 'Germany' && in_array($random, range(1, 60))) {
            if (in_array($membersCount, range(1, 40)) && in_array($randForMembers, range(1, 29))) {
                return 1;
            } else {
                return 1;
            }
        }

        if ($country === 'Japan' && in_array($random, range(1, 20))) {
            if (in_array($membersCount, range(1, 40)) && in_array($randForMembers, range(1, 38))) {
                return 1;
            } else {
                return rand(0, 1);
            }
        }

        if ($country === 'Saudi Arabia' && in_array($random, range(1, 90))) {
            if (in_array($membersCount, range(1, 40)) && in_array($randForMembers, range(1, 80))) {
                return 1;
            } else {
                return rand(0, 1);
            }
        }

        if ($country === 'Ukraine' && in_array($random, range(1, 50))) {
            if (in_array($membersCount, range(1, 30)) && in_array($randForMembers, range(1, 47))) {
                return 0;
            } else {
                return rand(0, 1);
            }
        }

        if ($country === 'Polland' && in_array($random, range(1, 35))) {
            if (in_array($membersCount, range(1, 21)) && in_array($randForMembers, range(1, 18))) {
                return 1;
            } else {
                return rand(0, 1);
            }
        }

        if ($country === 'Italy' && in_array($random, range(1, 25))) {
            if (in_array($membersCount, range(1, 20)) && in_array($randForMembers, range(1, 30))) {
                return 1;
            } else {
                return rand(0, 1);
            }
        }

        if ($country === 'France' && in_array($random, range(1, 55))) {
            if (in_array($membersCount, range(1, 40)) && in_array($randForMembers, range(1, 67))) {
                return 1;
            } else {
                return rand(0, 1);
            }
        }

        if ($country === 'Spain' && in_array($random, range(1, 43))) {
            if (in_array($membersCount, range(1, 55)) && in_array($randForMembers, range(1, 70))) {
                return 1;
            } else {
                return rand(0, 1);
            }
        }

        return 0;
    }

    private function getCountry($index)
    {
        $countries = [
            'USA',
            'China',
            'Germany',
            'Japan',
            'Saudi Arabia',
            'Ukraine',
            'Polland',
            'Italy',
            'France',
            'Spain'
        ];

        return $countries[$index];
    }

    private function write($data)
    {
        fputcsv($this->file, $data);
    }

    private function writeArray()
    {
        foreach ($this->dataArray as $record) {
            fputcsv($this->file, $record);
        }
    }

    private function countStats()
    {
        foreach ($this->dataArray as $record) {
            if ($record[9] == 1) {
                $this->total++;
            }
        }

        $this->percents = $this->total * 100 / $this->rowsCount;
    }
}
