<?php

 class FPTreeRoot extends FPTreeNode
 {
     
     protected $m_headerTable; // //HashMap<BinaryItem, Header>
     
     public function FPTreeRoot()
     {
       $this->m_headerTable = new HashMap();
       parent::FPTreeNode(null,null);  
     }
     
     public function addItemSet2($itemSet, $incr) 
     {
      parent::addItemSet($itemSet, $this->m_headerTable, $incr);
     }
     
     public function isEmpty($recursionLevel) 
     {
         
        foreach ($this->m_children->values() as $c)  // for (FPTreeNode c : m_children.values()) 
        {
          if ($c->getProjectedCount($recursionLevel) > 0) 
          {
            return false;
          }
        }
        return true;
     }
     
    public function getHeaderTable() 
    {
      return $this->m_headerTable;
    }
     
 }

