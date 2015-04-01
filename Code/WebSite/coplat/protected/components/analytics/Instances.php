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
 }
 
