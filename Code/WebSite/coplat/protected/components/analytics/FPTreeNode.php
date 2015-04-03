<?php

class FPTreeNode
{
    protected $m_parent;
    protected $m_item;
    
    protected $m_children; // protected Map<BinaryItem, FPTreeNode> m_children = new HashMap<BinaryItem, FPTreeNode>();
    
    protected $m_projectedCounts; // = new ShadowCounts();
    
    public function FPTreeNode($parent, $item) 
    {
      $this->m_projectedCounts = new ShadowCounts();
      $this->m_children = new HashMap();
      $this->m_parent = $parent;
      $this->m_item = $item;
    }
    
     //Map<BinaryItem, FPTreeRoot.Header> headerTable
    public function addItemSet($itemSet, $headerTable, $incr) 
    { 

     // Iterator<BinaryItem> i = itemSet.iterator();
        
        if (count($itemSet) >= 1)
        {
            $first = $itemSet[0];
            $aChild;
            if (!$this->m_children->offsetExists($first)) 
            {
               // not in the tree, so add it.
               $aChild = new FPTreeNode($this, $first);
               $this->m_children->offsetSet($first, $aChild);

               // update the header
               if (!$headerTable->offsetExists($first)) 
               {
                  $headerTable->offsetSet($first, new Header());
               }

               // append new node to header list
               $headerTable->offsetGet($first)->addToList($aChild);
             } 
             else 
             {
               // get the appropriate child node
               $aChild = $this->m_children->offsetGet($first);
             }

             // update counts in header table
              $headerTable->offsetGet($first)->getProjectedCounts()->increaseCount(0, $incr);

             // increase the child's count
             $aChild->increaseProjectedCount(0, $incr);

              // proceed recursively
             array_shift($itemSet); // itemSet.remove(first);

            $aChild->addItemSet($itemSet, $headerTable, $incr);
            
        }        
      
    }
    
    public function increaseProjectedCount($recursionLevel, $incr) 
    {
      $this->m_projectedCounts->increaseCount($recursionLevel, $incr);
    }
    
    public function getProjectedCount($recursionLevel) 
    {
      return $this->m_projectedCounts->getCount($recursionLevel);
    }
    
     public function getParent() 
    {
      return $this->m_parent;
    }
    
     public function getItem() 
     {
      return $this->m_item;
    }
    
    public function removeProjectedCount($recursionLevel) 
    {
      $this->m_projectedCounts->removeCount($recursionLevel);
    }
    
}

