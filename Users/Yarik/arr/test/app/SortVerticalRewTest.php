<?php

namespace Projarr\Test\App;

class SortVerticalRew {

    public $array = array();
    private $arrayHeight = 0;
    private $arrayLength = 0;

    public function setArrayDimensions($arrayHeight, $arrayLength)
    {
        $this->arrayHeight = $arrayHeight;
        $this->arrayLength = $arrayLength;
    }

    public function setArray($array)
    {
        $this->array = $array;
    }

        public function sortVerticalRew()
    {
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
                        if ($this->array[$i][$j] > $this->array[$i-1][$j]) {

                            /**
                             *  перевіряєм в рядку який елемент менший і при потребі міняєм їх місцями
                             */
                            $tr = $this->array[$i][$j];
                            $this->array[$i][$j] = $this->array[$i-1][$j];
                            $this->array[$i-1][$j] = $tr;
                        } elseif (($j <> $this->arrayLength-1) && ($this->array[$this->arrayHeight-1][$j] < $this->array[0][$j+1])) {

                            /**
                             * якщо ми в не останьому рядку то перевіряємо чи останій елемент рядка більший від першого елемента наступного рядка, якщо так то міняєм їх місцями
                             */
                            $t = $this->array[$this->arrayHeight-1][$j];
                            $this->array[$this->arrayHeight-1][$j] = $this->array[0][$j+1];
                            $this->array[0][$j+1] = $t;
                        }
                    }
                }
            }
        }
    }
}