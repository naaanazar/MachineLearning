<?php

namespace Projarr\Test\App;

class TestSortBubbleRew {

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

        public function sortBubbleRew()
    {
        for ($q=0; $q<$this->arrayHeight; $q++) {                        

        /**
         * йдем по рядках
         */
            for ($w=0; $w<$this->arrayLength; $w++) {

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
                        if ($this->array[$i][$j] > $this->array[$i][$j-1]) {

                            /**
                             *  перевіряєм в рядку який елемент менший і при потребі міняєм їх місцями
                             */
                            $tr = $this->array[$i][$j];
                            $this->array[$i][$j] = $this->array[$i][$j-1];
                            $this->array[$i][$j-1] = $tr;
                        } elseif (($i <> $this->arrayHeight-1) && ($this->array[$i][$this->arrayLength-1] < $this->array[$i+1][0])) {

                            /**
                             * якщо ми в не останьому рядку то перевіряємо чи останій елемент рядка більший від першого елемента наступного рядка, якщо так то міняєм їх місцями
                             */
                            $t = $this->array[$i][$this->arrayLength-1];
                            $this->array[$i][$this->arrayLength-1] = $this->array[$i+1][0];
                            $this->array[$i+1][0] = $t;
                        }
                    }
                }
            }
        }
    }
}
