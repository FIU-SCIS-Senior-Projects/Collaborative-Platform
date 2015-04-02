<?php
 
class Header {



      protected $m_headerList = array();

      /** Projected header counts for this entry */
      protected $m_projectedHeaderCounts;

      /**
       * Add a tree node into the list for this header entry.
       * 
       * @param toAdd the node to add.
       */
      
      function Header()
      {
          $this->m_projectedHeaderCounts = new ShadowCounts();
      }
      
      function addToList($toAdd) 
      {
        $this->m_headerList[] = $toAdd;
      }

      
      function getHeaderList() 
      {
        return $this->m_headerList;
      }

      /**
       * Get the projected counts for this header entry.
       * 
       * @return the projected counts for this header entry.
       */
      function getProjectedCounts() 
      {
        return $this->m_projectedHeaderCounts;
      }
    }
