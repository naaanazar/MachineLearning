<?php

namespace Projarr\Test\Selenium\Classes;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;


class ProjectWork {
    
    protected $driver;

    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    public function open()
    {
        return $this->driver->get('https://crowdin.com/profile');
    }

    public function createProject()
    {
        $createProject = $this->driver->findElement(WebDriverBy::xpath("//*[@id='instruction-for-creating-projects']/div/div/div[1]/div/div/a[1]"));
        $createProject->click();

        $projectName = $this->driver->findElement(WebDriverBy::id('project_name'));
        $projectName->clear();
        $name = 'qwerty'.rand(0, 10000);
        $projectName->sendKeys($name); //вводим логін

        $selectLenguage = $this->driver->findElement(WebDriverBy::xpath("//*[@id='project_source_language_chzn']/a/span"));
        $selectLenguage->click();
        $selectLeng = $this->driver->findElement(WebDriverBy::xpath("//*[@id='project_source_language_chzn']/div/div/input"));
        $selectLeng->sendKeys('Ukraine');

        $keyboard =  $this->driver->getKeyBoard();
        $keyboard->sendKeys(array(WebDriverKeys::ENTER));

        $selectLenguageTarget1 = $this->driver->findElement(WebDriverBy::xpath("//*[@id='target_languages_list']/div/ul/li[2]"));
        $selectLenguageTarget1->click();
        $selectLenguageTarget2 = $this->driver->findElement(WebDriverBy::xpath("//*[@id='target_languages_list']/div/ul/li[5]"));
        $selectLenguageTarget2->click();


        $createProjectFinish = $this->driver->findElement(WebDriverBy::id('create_project'));
        $createProjectFinish->click();

//        sleep(5);

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[@id='project_files_list']/div/div/div/div[3]/div[2]/p[1]/a")));
        $addSample = $this->driver->findElement(WebDriverBy::xpath("//*[@id='project_files_list']/div/div/div/div[3]/div[2]/p[1]/a"));
        $addSample->click();

//        sleep(2);

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[@id='project_files_list']/div/div[2]/div/div[4]/span/span[2]/span")));
        $translations = $this->driver->findElement(WebDriverBy::xpath("//*[@id='tabs-list']/li[2]/a"));
        $translations->click();


        $translationProgress = $this->driver->findElement(WebDriverBy::xpath("//*[@id='translation_progress']/tbody/tr[1]/td[1]/a"));
        $translationProgress->click();

        $openFile = $this->driver->findElement(WebDriverBy::xpath("//*[@id='node_2']/div/div[4]/a"));
        $openFile->click();
    }

    public function renameProject()
    {
        $menu = $this->driver->findElement(WebDriverBy::id('project-menu-item'));
        $menu->click();

        $setting = $this->driver->findElement(WebDriverBy::xpath("//*[@id='project-files-list']/li[4]/a"));
        $setting->click();

//        sleep(2);

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[@id='tabs-list']/li[1]/a")));
        $geleral = $this->driver->findElement(WebDriverBy::xpath("//*[@id='tabs-list']/li[1]/a"));
        $geleral->click();

        $newName = 'qwerty'.rand(0, 10000);

        $name = $this->driver->findElement(WebDriverBy::id('project_name'));
        $name->clear();
        $name->sendKeys($newName);
//        sleep(5);
        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[@id='ps-general']/div/fieldset[1]/div[1]/div/div[1]/button")));
        $update = $this->driver->findElement(WebDriverBy::xpath("//*[@id='ps-general']/div/fieldset[1]/div[1]/div/div[1]/button"));
        $update->click();
//        sleep(5);
        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[@id='wrap']/div[6]/div/div[1]/div/a[3]")));
        $goToProject = $this->driver->findElement(WebDriverBy::xpath("//*[@id='wrap']/div[6]/div/div[1]/div/a[3]"));
        $goToProject->click();
    }
}
