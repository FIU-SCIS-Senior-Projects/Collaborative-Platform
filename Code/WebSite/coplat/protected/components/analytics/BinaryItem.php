<?php
class BinaryItem
{
    protected $m_valueIndex;
    protected $m_attribute;
    protected $m_frequency = 0;
            
    function  BinaryItem($att, $valueIndex)
    {
        $this->m_attribute = $att;
        /*if ($this->m_attribute->numValues() == 1)
        {
            $this->m_valueIndex = 0;
        }
        else
        {*/
            $this->m_valueIndex = $valueIndex;
       // }			
    }
    
    public function increaseFrequency() 
    {
     $this->m_frequency++;
    }
    
    public function getFrequency() 
    {
       return  $this->m_frequency;
    }
    
    //Ensures that items will be sorted in descending order of frequency.
    public function cmp($itemA, $itemB)
    {
       if ($itemA->m_frequency == $itemB->getFrequency()) 
       {
          return -1 * strcmp($itemA->m_attribute->name(), $itemB->m_attribute->name());
       }
       if ($itemB->getFrequency() < $itemA->m_frequency) 
       {
         return -1;
       }
       return 1;
    }
    
    
   public function compareTo($comp) 
   {
    if ($this->m_frequency == $comp->getFrequency()) 
    {
      // sort by name
      return -1 * strcmp($this->m_attribute->name(), $comp->getAttribute()->name());
    }
    if ($comp->getFrequency() < $comp->m_frequency) 
    {
      return -1;
    }
    return 1;
  }
		
}