<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DatasetGenerator
 *
 * @author NAZAR
 */

namespace App\Library\Generators;

class DatasetGenerator
{
    private $title = array(
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
    );

    public $targetFile;
    private $file;
    public $rowsCount = 15000;
    public $total = 0;
    public $percents = 0;
    public $dataArray = [];

    public function __construct()
    {
        $this->targetFile = public_path() . '/datasets/dataset.csv';
        $this->file = fopen($this->targetFile, 'w+');
    }

    public function __destruct()
    {
        fclose($this->file);
    }

    public function feed()
    {
        $this->write($this->title);
        $purchase = rand(0, 1);
        for ($i = 0; $i < $this->rowsCount; $i++) {
            $email_custom_domain = rand(0, 1);
            $same_email_domain_count = rand(0, 200);
            $projects_count = rand(1, 100);
            $stringsCount = rand(0, 100);
            $country = $this->getCountry(rand(0, 9));

            $has_private_project = $this->hasPrivateProject($purchase);
            $members_count = $this->membersСount($has_private_project);
            $purchase = $this->getPurchasing($country, $members_count);

            $same_login = $this->hasSameLoginAndProjectName($purchase);
            $days_after_login = $this->daysAfterLogin($purchase);


            array_push($this->dataArray, [
                $email_custom_domain,       // email custom domain
                $same_email_domain_count,   // same email domain count
                $projects_count,            // projects count
                $stringsCount,              // strings count. more is better
                $members_count,             // members count. less is better, 20-30 translators is optimal for private projects
                $has_private_project,       // has_private_project
                $same_login,                // same_login_and_project_name
                $days_after_login,          // days_after_last_login
                $country,                   // country
                $purchase                   // purchasing
            ]);
        }
        $this->countStats();
        $this->writeArray();
        
    }

    private function hasSameLoginAndProjectName($purchase)
    {
      $rand = rand(1, 100);

      if($purchase == 1 && in_array($rand, range(1, 8))) {
        return 1;
      } else {
        return rand(0, 1);
      }
    }

    private function membersСount($has_private_project)
    {
      if($has_private_project == 1) {
        return rand(1, 50);
      } else {
        return rand(1, 1000);
      }
    }

    private function daysAfterLogin($purchase = 0)
    {
      $rand = rand(1, 100);

      if($purchase != 1) {
        return rand(0, 30);
      } else {
        return rand(0, 7);
      }
    }

    private function hasPrivateProject($purchase)
    {
      $rand = rand(1, 100);

      if($purchase == 1 && in_array($rand, range(1, 70))) {
        return 1;
      } else {
        return rand(0, 1);
      }
    }

    private function getPurchasing($country, $members_count = 8)
    {
        $random = rand(1, 100);
        $randForMembers = rand(1, 100);

        if ($country === 'USA' && in_array($random, range(1, 70))) {
            if(in_array($members_count, range(1, 40)) && in_array($randForMembers, range(1, 50))) {
                return 1;
            } else {
                return rand(0, 1);
            }
        }

        if ($country === 'China' && in_array($random, range(1, 40))) {
            if(in_array($members_count, range(1, 45)) && in_array($randForMembers, range(1, 45))) {
                return 1;
            } else {
                return rand(0, 1);
            }
        }

        if ($country === 'Germany' && in_array($random, range(1, 60))) {
            if(in_array($members_count, range(1, 40)) && in_array($randForMembers, range(1, 29))) {
                return 1;
            } else {
                return 1;
            }
        }

        if ($country === 'Japan' && in_array($random, range(1, 20))) {
            if(in_array($members_count, range(1, 40)) && in_array($randForMembers, range(1, 38))) {
                return 1;
            } else {
                return rand(0, 1);
            }
        }

        if ($country === 'Saudi Arabia' && in_array($random, range(1, 90))) {
            if(in_array($members_count, range(1, 40)) && in_array($randForMembers, range(1, 80))) {
                return 1;
            } else {
                return rand(0, 1);
            }
        }

        if ($country === 'Ukraine' && in_array($random, range(1, 50))) {
            if(in_array($members_count, range(1, 30)) && in_array($randForMembers, range(1, 47))) {
                return 0;
            } else {
                return rand(0, 1);
            }
        }

        if ($country === 'Polland' && in_array($random, range(1, 35))) {
            if(in_array($members_count, range(1, 21)) && in_array($randForMembers, range(1, 18))) {
                return 1;
            } else {
                return rand(0, 1);
            }
        }

        if ($country === 'Italy' && in_array($random, range(1, 25))) {
            if(in_array($members_count, range(1, 20)) && in_array($randForMembers, range(1, 30))) {
                return 1;
            } else {
                return rand(0, 1);
            }
        }

        if ($country === 'France' && in_array($random, range(1, 55))) {
            if(in_array($members_count, range(1, 40)) && in_array($randForMembers, range(1, 67))) {
                return 1;
            } else {
                return rand(0, 1);
            }
        }

        if ($country === 'Spain' && in_array($random, range(1, 43))) {
            if(in_array($members_count, range(1, 55)) && in_array($randForMembers, range(1, 70))) {
                return 1;
            } else {
                return rand(0, 1);
            }
        }

        return 0;
    }

    private function getCountry($index)
    {
        $countries = array(
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
        );

        return $countries[$index];
    }

    private function write($data)
    {
        fputcsv($this->file, $data);
    }

    private function writeArray()
    {
        foreach($this->dataArray as $record) {
            fputcsv($this->file, $record);
        }
    }

    private function countStats()
    {
        foreach($this->dataArray as $record) {
            if($record[9] == 1) {
                $this->total++;
            }
        }

        $this->percents = $this->total * 100 / $this->rowsCount;
    }
}
