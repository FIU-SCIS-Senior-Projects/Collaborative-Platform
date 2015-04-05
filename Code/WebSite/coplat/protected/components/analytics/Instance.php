<?php

 class Instance
 {
     protected $m_AttValues;
    // protected $m_Dataset;
     
     public function Instance($numAttributes) 
     {
      $this->m_AttValues = array_fill(0,$numAttributes, NAN);    
    //  $this->m_Dataset = null;
     }
     
     public function numAttributes() 
     {
      return count($this->m_AttValues);
     }

     public function numValues() 
     {
      return count($this->m_AttValues);
     } 

    public function setValue($attrib, $value) 
    {
      $this->m_AttValues[$attrib->index()] = $value;
    }

    public function value($attIndex) 
    {
     return $this->m_AttValues[$attIndex];
    }
    
    public function isMissing($attIndex) 
    {
      return is_nan($this->m_AttValues[$attIndex]);
    }

}

