<?php

class ShadowCounts {



    private $m_counts = array(); // = new ArrayList<Integer>();

    /**
     * Get the count at the specified recursion depth.
     * 
     * @param recursionLevel the depth of the recursion.
     * @return the count.
     */
    public function getCount($recursionLevel) 
    {
      if ($recursionLevel >= count($this->m_counts)) 
      {
        return 0;
      } else
      {
        return $this->m_counts[$recursionLevel];
      }
    }

    /**
     * Increase the count at a given recursion level.
     * 
     * @param recursionLevel the level at which to increase the count.
     * @param incr the amount by which to increase the count.
     */
    public function increaseCount($recursionLevel,$incr) 
    {
      // basically treat the list like a stack where we
      // can add a new element, or increment the element
      // at the top

      if ($recursionLevel == count($this->m_counts)) 
      {
        // new element
         $this->m_counts[] = $incr;
      } else if ($recursionLevel == count($this->m_counts) - 1) 
      {
        // otherwise increment the top
        $n = $this->m_counts[$recursionLevel]; //.intValue();
        $this->m_counts[$recursionLevel] =  ($n + $incr);
      }
    }

    /**
     * Remove the count at the given recursion level.
     * 
     * @param recursionLevel the level at which to remove the count.
     */
    public function removeCount($recursionLevel) 
    {
      if ($recursionLevel < count($this->m_counts)) 
      {
       unset($this->m_counts[$recursionLevel]);
      }
    }
  }
