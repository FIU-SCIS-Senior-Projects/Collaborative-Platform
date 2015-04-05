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
    public static function cmp($itemA, $itemB)
    {
       if ($itemA->getFrequency() == $itemB->getFrequency()) 
       {
          return -1 * strcmp($itemA->getAttribute()->name(), $itemB->getAttribute()->name());
       }
       if ($itemB->getFrequency() < $itemA->getFrequency()) 
       {
         return -1;
       }
       return 1;
    }
    
    public function getAttribute()
    {
        return $this->m_attribute;
    }
    
   public function compareTo($comp) 
   {
    if ($this->m_frequency == $comp->getFrequency()) 
    {
      // sort by name
      return -1 * strcmp($this->getAttribute()->name(), $comp->getAttribute()->name());
    }
    if ($this->getFrequency() < $comp->getFrequency()) 
    {
      return -1;
    }
    return 1;
  }
		
}