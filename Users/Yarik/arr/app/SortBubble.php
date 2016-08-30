<?php

namespace Projarr\App;

class SortBubble extends CreateArray {

    public function __construct() {
        parent::__construct();
    }

    public function sortArr()
    {
        echo"Sort Bubble <br >";
        for ($q=0; $q<$this->arrayHeight; $q++) {                        

            /**
             * йдем по рядках
             */
            for ($w=0; $w < $this->arrayLength; $w++) {

                /**
                 * йдем по стовбцях
                 */
                for ($i = 0; $i < $this->arrayHeight; $i++) {            

                /**
                 * йдем по рядках
                 */
                    for ($j = 1; $j < $this->arrayLength; $j++) {        

                    /**
                     * йдем по стовбцях
                     */
                        if ($this->newArr[$i][$j] < $this->newArr[$i][$j-1]) {
                            /**
                             *  перевіряєм в рядку який елемент менший і при потребі міняєм їх місцями
                             */
                            $tr = $this->newArr[$i][$j];
                            $this->newArr[$i][$j] = $this->newArr[$i][$j-1];
                            $this->newArr[$i][$j-1] = $tr;
                        } elseif (($i <> $this->arrayHeight-1) && ($this->newArr[$i][$this->arrayLength-1] > $this->newArr[$i+1][0])) {
                            /**
                             * якщо ми в не останьому рядку то перевіряємо чи останій елемент рядка більший від першого елемента наступного рядка, якщо так то міняєм їх місцями
                             */
                            $t = $this->newArr[$i][$this->arrayLength - 1];
                            $this->newArr[$i][$this->arrayLength - 1] = $this->newArr[$i + 1][0];
                            $this->newArr[$i + 1][0] = $t;
                        }
                    }
                }
            }
        }
    }
}
