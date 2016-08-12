<?php

namespace arr\app\triada;

/**
 * Description of Triada
 *
 * @author Nazar
 */
class Triada
{
    private $filePath = "sample.txt";
    private $endCharacters = array(".", "!", "?");
    private $sentence;
    private $text;
    private $words = array();
    private $sentencesQuantity;

    public function __construct()
    {
        $this->text = file_get_contents($this->filePath, true);
        $this->sentencesQuantity = $this->countSentences();
        echo $this->sentencesQuantity . "<br>";


        for($i = 0; $i < $this->sentencesQuantity; $i++) {
            $this->getSentence();
            $this->makeTriada();
        }
                
    }

    public function countSentences()
    {
        $text = file_get_contents($this->filePath, true);
        $cnt = 0;
        foreach ($this->endCharacters as $character) {
            
            $cnt += substr_count($text, $character);
        }

        return $cnt;
    }

    public function getSentence()
    {
        $sentenceEnd;
        foreach ($this->endCharacters as $character) {
            $sentenceEnd = strpos($this->text, $character);
            break;
        }

        $this->sentence = substr($this->text, 0, $sentenceEnd);
        $this->text = substr(str_replace($this->sentence, "", $this->text), 2);
        echo $this->text;

    }

    public function makeTriada()
    {
        $row = array();
        $this->sentence = preg_replace("/[[:punct:]]/", "", $this->sentence);
        $this->words = explode(" ", $this->sentence);

        for($i = 0; $i < count($this->words); $i++) {

            if($i == 0) {
                $row = array('_{EMPTY}_', '_{EMPTY}_', $this->words[$i]);
            } elseif ($i == 1) {
                $row = array('_{EMPTY}_', $this->words[$i-1], $this->words[$i]);
            } else {
                $row = array($this->words[$i-2], $this->words[$i-1], $this->words[$i]);
            }

            echo "<pre>";
                print_r($row);
            echo "</pre>";

            $this->writeInCsv($row);
            $row = array();

        }

    }



    public function writeInCsv($row)
    {
        $fp = fopen('file.csv', 'a') or die("Unable to open file!");
        fputcsv($fp, $row);
        fclose($fp);
    }
}
