<?php

namespace Projarr\App;

class SortVertical extends CreateArray {

    public function __construct() {
        parent::__construct();
    }

    public function sortArr()
    {
        echo"Sort Vert <br >";
        for ($q=0; $q<$this->arrayLength; $q++) {

        /**
         * йдем по стовбцях
         */
            for ($w=0; $w<$this->arrayHeight; $w++) {

            /**
             * йдем по рядках
             */
                for ($j = 0; $j < $this->arrayLength; $j++) {

                /**
                 * йдем по стовбцях
                 */
                    for ($i = 1; $i < $this->arrayHeight; $i++) {

                    /**
                     * йдем по рядках
                     */
                        if ($this->newArr[$i][$j] < $this->newArr[$i-1][$j]) {

                            /**
                             *  перевіряєм в стовбці який елемент менший і при потребі міняєм їх місцями
                             */
                            $tr = $this->newArr[$i][$j];
                            $this->newArr[$i][$j] = $this->newArr[$i-1][$j];
                            $this->newArr[$i-1][$j] = $tr;
                        } elseif (($j <> $this->arrayLength-1) && ($this->newArr[$this->arrayHeight-1][$j] > $this->newArr[0][$j+1])) {

                            /**
                             * якщо ми в не останьому стовбці то перевіряємо чи останій елемент стовбця більший від першого елемента наступного стовбця, якщо так то міняєм їх місцями
                             */
                            $t = $this->newArr[$this->arrayHeight-1][$j];
                            $this->newArr[$this->arrayHeight-1][$j] = $this->newArr[0][$j+1];
                            $this->newArr[0][$j+1] = $t;
                        }
                    }
                }
            }
        }
    }
}
