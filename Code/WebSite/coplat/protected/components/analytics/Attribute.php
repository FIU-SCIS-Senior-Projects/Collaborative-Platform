<?php

class Attribute
 {
     protected $m_Name;
     protected $m_Index;
     
     public function Attribute($attributeName, $m_Index)
     {
         $this->m_Name = $attributeName;
         $this->m_Index = $m_Index;
     }
     
     public function index()
     {
         return $this->m_Index;
     }
     
     public function name()
     {
         return $this->m_Name;
     }
 }


