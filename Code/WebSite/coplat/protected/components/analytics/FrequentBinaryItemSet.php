<?php

 class FrequentBinaryItemSet 
{

      protected $m_items;
      protected $m_support;
	  
	  function compareTo($a, $comp)
	  {
            if ($a->getFrequency() == $comp->getFrequency())
            {
                    return -1 * strcmp($a->m_attribute->name,$comp->m_attribute->name);
            }
            else if ($comp->getFrequency() < $a->getFrequency())
            {
                    return -1;
            }
            return 1;			
	  }
          
         function FrequentBinaryItemSet($items, $support) 
         {
         $this->m_items = $items;
         $this->m_support = $support;
         uasort($this->m_items, array($this, 'compareTo'));  //Collections.sort($m_items);
         }
	  
      function addItem($i) 
      {
         $this->m_items[] = $i;
         uasort($this->m_items, array($this, 'compareTo')); //   Collections.sort($m_items);
       }
  
      function setSupport($support) 
      {
         $this->m_support = $support;
      }
   
      function getSupport() 
      {
        return  $this->m_support;
      }

     function getItems() 
     {
      return  $this->m_items;
     }

     function getItem($index) 
     {
      return  $this->m_items[$index];
     }

     function numberOfItems() 
     {
      return count($this->m_items);
     }
   }