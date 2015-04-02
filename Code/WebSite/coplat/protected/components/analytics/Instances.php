<?php

 class Instances
 {
     protected $m_Attributes; ///ArrayList<Attribute>
     protected $m_Instances;  //ArrayList<Instance> m_Instances;
     
     function Instances($attributesCol,$instancesCol )
     {
          $this->m_Attributes = $attributesCol;
          $this->m_Instances = $instancesCol;
     }
     
     function numAttributes() 
     {
         return count($this->m_Attributes);
     }
     
     function attribute($index) 
     {
       $test = $this->m_Attributes;
       
      return $test[$index];
     }
     
     function numInstances() 
     {
         return count($this->m_Instances);
     }
     
     function instance($index) 
     {
	return $this->m_Instances[$index]; //  .get(index);
     }	
     
     
 }
 
