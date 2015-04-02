<?php

class FrequentItemSets
{
        protected $m_sets = array();
        protected $m_numberOfTransactions; //new ArrayList<FrequentBinaryItemSet>();


        function  FrequentItemSets($numTransactions)
        {
                $this->m_numberOfTransactions  = $numTransactions;
        }

        function getItemSet($index) 
        {
        return $this->m_sets[$index];
      }

        function getNumberOfTransactions()
        {
                return $this->m_numberOfTransactions;
        }

        function addItemSet($setToAdd) 
        {
        $this->m_sets[] = $setToAdd;
       }

        function size()
        {
                return count($this->m_sets);
        }	

        function compare($one, $two) 
        {
        $compOne = $one->getItems();
        $compTwo = $two->getItems();

        // if (one.getSupport() == two.getSupport()) {
        // if supports are equal then list shorter item sets before longer
        // ones
        if (count($compOne) < count ($compTwo))
                {
          return -1;
        }
                elseif (count($compOne) > count($compTwo)) 
                {
          return 1;
        } 
                else 
                {
          // compare items
                      $i = -1;
          foreach ($compOne as $oneI) 
                      {
                              $i++;
                              $twoI = $compTwo[$i];
              $result = $oneI->compareTo($twoI);
              if ($result != 0) 
                              {
               return $result;
              }
          }
          return 0; // equal
         }       
      }

        function sort()
        {
                 uasort($this->m_sets, array($this, 'compare'));
        }

        function getSet()
        {
                return $this->m_sets; // ArrayList<FrequentBinaryItemSet>()
        }

}
