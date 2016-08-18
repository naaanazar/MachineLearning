<?php

namespace liw\Test\Selenium;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use liw\Test\Selenium\ExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\Remote\LocalFileDetector;
use liw\Test\Selenium\LoginPage;
use liw\Test\Selenium\RegistrationPage;

class HomeTest extends \PHPUnit_Framework_TestCase
{
   
    
  /*  public function testHomeWork()
    {
        $host = 'http://192.168.1.153:9515';
        $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        $loginPage = new LoginPage($driver);
        $loginPage->open();
        $loginPage->login('NataliaRich', 'qwerty03');
        
        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("NataliaRich's Profile - Users at Crowdin"));
        $createProject = $this->driver->findElement(WebDriverBy::xpath("//*[@id='instruction-for-creating-projects']/div/div/div[1]/div/div/a[1]"));
        $createProject->click();
        
        $nameProject = $this->driver->findElement(WebDriverBy::id('project_name'));
        $nameProject->sendKeys("NataliaRichProject");
        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("Create Project - Crowdin"));
        $sourceLanguage = $this->driver->findElement(WebDriverBy::xpath("//*[@id='project_source_language_chzn']/a/span"));
        $sourceLanguage->click();
        $sourceLanguage = $this->driver->findElement(WebDriverBy::xpath("//*[@id='project_source_language_chzn']/div/div/input"));
        $sourceLanguage->sendKeys("Ukrainian");
        $sourceLanguage->click();
        
        $otherLanguage = $this->driver->findElement(WebDriverBy::xpath("//*[@id='target_languages_filter']/div/input"));
        $otherLanguage->click();
        $otherLanguage->sendKeys("Albanian");
        
        $buttonCreate = $this->driver->findElement(WebDriverBy::id('create_project'));
        $buttonCreate->click();
        
        
        
    }*/
    
    /*public function testDeleteProject()
    {
        $host = 'http://192.168.1.153:9515';
        $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        $loginPage = new LoginPage($driver);
        $loginPage->open();
        $loginPage->login('NataliaRich', 'qwerty03');
        
        $this->driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("//*[@id='project-195817']/div/div/div/div/div[3]/div/div[4]/a")));
        
        $menuBar = $this->driver->findElement(WebDriverBy::xpath("//*[@id='project-195817']/div/div/div/div/div[3]/div/div[4]/a"));
        $menuBar->click();
        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[@id='project-195817']/div/div/div/div/div[3]/div/div[4]/ul/li[4]/a/span")));
        $delProject = $this->driver->findElement(WebDriverBy::xpath("//*[@id='project-195817']/div/div/div/div/div[3]/div/div[4]/ul/li[4]/a/span"));
        $delProject->click();
       // $this->driver->wait()->until(WebDriverExpectedCondition::titleContains('Delete Project'));
        $delProjectWhy = $this->driver->findElement(WebDriverBy::xpath("//*[@id='deleting_reason_text']"));
        $delProjectWhy->sendKeys("I don't need this project yet!");
        
        $delProjectButton = $this->driver->findElement(WebDriverBy::cssSelector('body > div.ui-dialog.ui-widget.ui-widget-content.ui-corner-all.ui-draggable.ui-dialog-buttons > div.ui-dialog-buttonpane.ui-widget-content.ui-helper-clearfix > div > button:nth-child(2) > span'));
        $delProjectButton->click();
        
    }
    
    public function testDeleteUser()
    {
        $host = 'http://192.168.1.153:9515';
        $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        $loginPage = new LoginPage($driver);
        $loginPage->open();
        $loginPage->login('NataliaRich', 'qwerty03');
        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("NataliaRich's Profile - Users at Crowdin"));
        
        $findSettings = $this->driver->findElement(WebDriverBy::xpath("//*[@id='settings-menu-item']/div"));
        $findSettings->click();
        
        $findRemoveAccount = $this->driver->findElement(WebDriverBy::xpath("//*[@id='account-settings-tabs']/li[9]/a"));
        $findRemoveAccount->click();
        
        $findRemoveAccountButton = $this->driver->findElement(WebDriverBy::xpath("//*[@id='remove_user_account']"));
        $findRemoveAccountButton->click();
        
        $delProjectWhy = $this->driver->findElement(WebDriverBy::xpath("//*[@id='deleting_reason_text']"));
        $delProjectWhy->sendKeys("I don't need this account!");
        
        $delProjectButton = $this->driver->findElement(WebDriverBy::cssSelector('body > div.ui-dialog.ui-widget.ui-widget-content.ui-corner-all.ui-draggable.ui-dialog-buttons > div.ui-dialog-buttonpane.ui-widget-content.ui-helper-clearfix > div > button:nth-child(2) > span'));
        $delProjectButton->click();
    }*/
    
    /*public function testRenameUser()
    {
        $host = 'http://192.168.1.153:9515';
        $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        $loginPage = new LoginPage($driver);
        $loginPage->open();
        $loginPage->login('NataliaRich', 'qwerty03');
        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("NataliaRich's Profile - Users at Crowdin"));
        
        $findSettings = $this->driver->findElement(WebDriverBy::xpath("//*[@id='settings-menu-item']/div"));
        $findSettings->click();
        
        $findRename = $this->driver->findElement(WebDriverBy::xpath("//*[@id='real_name']"));
        $findRename->sendKeys("NataliaR");
        
        $findRemoveAccountButton = $this->driver->findElement(WebDriverBy::cssSelector('#user-profile-account > form > div:nth-child(1) > div > div > button'));
        $findRemoveAccountButton->click();
              
    }*/
    
   /* public function testRenameProj()
    {
        $host = 'http://192.168.1.153:9515';
        $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        $loginPage = new LoginPage($driver);
        $loginPage->open();
        $loginPage->login('NataliaRich', 'qwerty03');
        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("NataliaRich's Profile - Users at Crowdin"));
        
        $findSettings = $this->driver->findElement(WebDriverBy::xpath("//*[@id='project-195916']/div/div/div/div/div[3]/div/div[3]/a"));
        $findSettings->click();
        $this->driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath("//*[@id='tabs-list']/li[1]/a")));
        
        $findSettingsGeneral = $this->driver->findElement(WebDriverBy::xpath("//*[@id='tabs-list']/li[1]/a"));
        $findSettingsGeneral->click();
        
        $projectName = $this->driver->findElement(WebDriverBy::id('project_name'));
        $projectName->sendKeys("1");
                
        $findUpgradeButton = $this->driver->findElement(WebDriverBy::cssSelector('#ps-general > div > fieldset:nth-child(1) > div:nth-child(1) > div > div.update-btn-space > button'));
        $findUpgradeButton->click();
        
    }*/
    
    /*public function testRegistration()
    {
        $keyboard =  $this->driver->getKeyBoard();
        $element = $this->driver->findElement(WebDriverBy::linkText('Sign up'));
        $element->click();

        $this->assertEquals('https://crowdin.com/join', $this->driver->getCurrentURL());
        $this->assertEquals('Sign up for Crowdin', $this->driver->getTitle());
        
        $element = $this->driver->findElement(WebDriverBy::cssSelector('#login-register-div > div.login-register > div.right-col.signin-social > div > a.btn.btn-default.btn-sso.btn-fcbk-signup > span'));
        $element->click();
        
        $mailInput = $this->driver->findElement(WebDriverBy::id('email'));
        $mailInput->sendKeys("maryevans111111@gmail.com");

        $passwordInput = $this->driver->findElement(WebDriverBy::id('pass'));
        $passwordInput->sendKeys("377482433");
        
        $signIn = $this->driver->findElement(WebDriverBy::cssSelector('#loginbutton'));
        $signIn->click();
    
        $keyboard->pressKey(WebDriverKeys::ESCAPE);
        $keyboard->releaseKey(WebDriverKeys::ESCAPE);
        $acceptContinue = $this->driver->findElement(WebDriverBy::cssSelector('#platformDialogForm > div._5lnf.uiOverlayFooter._5a8u._5eh1 > table > tbody > tr > td._51m-.uiOverlayFooterButtons._51mw > button._42ft._4jy0.layerConfirm._1flv._51_n.autofocus.uiOverlayButton._4jy5._4jy1.selected._51sy'));
        $acceptContinue->click();
        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("maryevans111111's Profile - Users at Crowdin"));
    }*/
    
    public function testInvite()
    {
        $host = 'http://192.168.2.134:9515';
        $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        $loginPage = new LoginPage($driver);
        $loginPage->open();
        $loginPage->login('NataliaRich', 'qwerty03');
        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("NataliaRich's Profile - Users at Crowdin"));
        
       /* $findSettings = $this->driver->findElement(WebDriverBy::cssSelector("#project-195916 > div > div > div > div > div.table-cell.buttons-here > div > div:nth-child(3) > a > i"));
        $findSettings->click();
        //$this->driver->wait()->until(ExpectedCondition::pageIsReady());
        
        $findTranslators = $this->driver->findElement(WebDriverBy::cssSelector("#tabs-list > li:nth-child(4) > a"));
        $findTranslators->click();
        
        $findInvite = $this->driver->findElement(WebDriverBy::cssSelector("#invite_translators"));
        $findInvite->click();
        
        $findLink = $this->driver->findElement(WebDriverBy::cssSelector("#other-ways-link"));
        $findLink->click();
        
        $socialMedia = $this->driver->findElement(WebDriverBy::cssSelector("#invite_translators_tabs > ul > li.nav-tab.show-role-translator > a"));
        $socialMedia->click();
        
        $googleClick = $this->driver->findElement(WebDriverBy::cssSelector("#invite_translators_social_networks > div > div > div > a.btn.ggl_btn"));
        $googleClick->click();
        
        $current_handle = $this->driver->getWindowHandle();
        $this->driver->switchTo()->window(end($this->driver->getWindowHandles()));
        $mailText = $this->driver->findElement(WebDriverBy::cssSelector("#Email"));
        $mailText->sendKeys("nataliarichards123@gmail.com");
        $mailClick = $this->driver->findElement(WebDriverBy::cssSelector("#next"));
        $mailClick->click();
        $passText = $this->driver->findElement(WebDriverBy::cssSelector("#Passwd"));
        $passText->sendKeys("377482433");
        $passClick = $this->driver->findElement(WebDriverBy::cssSelector("#signIn"));
        $passClick->click();
        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs('Спільний доступ у службі Google+'));
        $okClick = $this->driver->findElement(WebDriverBy::xpath('/html/body/div[1]/div[2]/div[2]/table/tbody/tr/td[1]/div[2]'));
        $okClick->click();
        
        $this->driver->switchTo()->window($current_handle);*/
    }
}
