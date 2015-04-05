<?php
 
 class FPGrowth 
 {
    public $m_numRulesToFind = 10;
    public $m_upperBoundMinSupport = 1.0;
    public $m_lowerBoundMinSupport = 0.1;
    protected $m_delta = 0.05;
    protected $m_numInstances;
    protected $m_offDiskReportingFrequency = 10000;
    protected $m_positiveIndex = 1;
   // protected $m_metric = METRIC_TYPE::CONFIDENCE;
    protected $m_metricThreshold = 0.9;
    protected $m_largeItemSets;
    protected $m_rules;
    protected $m_maxItems = -1;
    protected $m_mustContainOR = false;
	
	
	 private static function nextSubset(&$subset)
    {
        for($i = 0; $i < count($subset); $i++)
        {
               if (!$subset[$i])
               {
                       $subset[$i] = true;
                       break;				  
               }
               else
               {
                       $subset[$i] = false; 
               }			   
        }
    }
	
	
	 private static function getPremise($fis, $subset)
    {
            $ok = false;
            for ($i = 0; $i< count($subset); $i++)
            {
                    if(!$subset[$i])
                    {
                            $ok = true;
                            break;
                    }
            }

            if (!$ok)
            {
                    return null;
            }
            $premise = array();
            $items = $fis->getItems();

            for($i = 0; $i < count($subset); $i++)
            {
                    if ($subset[$i])
                    {
                           $premise[] = $items[$i];
                    }
            }
            return $premise;		   
    }
		
	private static function getConsequence($fis,$subset) 
    {
         $consequence = array(); // new ArrayList<Item>();
         $items = $fis->getItems(); // = new ArrayList<Item>(fis.getItems());

           for ($i = 0; $i < count($subset); $i++) 
           {
             if (!$subset[$i]) 
                 {
                   $consequence[] = $items[$i];
             }
           }
          return $consequence;
     }
	 
	 
    public static function pruneRules($rulesToPrune,
                                      $itemsToConsider,
                                      $useOr) 
    {
       $result = array(); //new ArrayList<AssociationRule>();

            foreach ($rulesToPrune as $r ) 
            {
              if ($r->containsItems($itemsToConsider, $useOr)) 
              {
                    $result[] = $r;
              }
            }
    return $result;
    }
	
   private function passesMustContain($inst,
		                                   $transactionsMustContainIndexes,
		                                   $numInTransactionsMustContainList) 
	   {
		  $result = false;

			/*if ($inst instanceof SparseInstance) 
			{
				$containsCount = 0;
				for ($i = 0; $i < $inst->numValues(); $i++) 
				{
					$attIndex = $inst->index($i);
					if ($this->m_mustContainOR) 
					{
						if ($transactionsMustContainIndexes[$attIndex]) 
						{
							// break here since the operator is OR and this
							// instance contains at least one of the items
							return true;
						}
					} 
					else 
					{
						if ($transactionsMustContainIndexes[$attIndex]) 
						{
							$containsCount++;
						}
					}
				}
				

     			if (!$this->m_mustContainOR) 
				{
					if ($containsCount == $numInTransactionsMustContainList) 
					{
						return true;
					}
				}
			} */
			//else 
			//{
				$containsCount = 0;
				for ($i = 0; $i < count($transactionsMustContainIndexes); $i++) 
				{
					if ($transactionsMustContainIndexes[$i]) 
					{
						if ($inst->value($i) == $this->m_positiveIndex) 
						{
							if ($this->m_mustContainOR) 
							{
								// break here since the operator is OR and
								// this instance contains at least one of the
								// requested items
								return true;
							} 
							else 
							{
								$containsCount++;
							}
						}
					}
				}
				
				if (!$this->m_mustContainOR) 
				{
					if ($containsCount == $numInTransactionsMustContainList) 
					{
						return true;
					}
				}
			//}

		return result;
		}
    
    
     public function  generateRulesBruteForce($largeItemSets,
                                             $metricThreshold,
                                             $upperBoundMinSuppAsInstances,
                                             $lowerBoundMinSuppAsInstances,
                                             $totalTransactions) 
    {

            $rules = array(); // new ArrayList<AssociationRule>();
            $largeItemSets->sort();

            $frequencyLookup = new HashMap();//   new HashMap<Collection<BinaryItem>, Integer>();

            $frequentBinaryItemset = $largeItemSets->getSet();
            // process each large item set
            foreach ($frequentBinaryItemset as $fis) 
            {
              $frequencyLookup->offsetSet($fis->getItems(), $fis->getSupport());
              if (count($fis->getItems()) > 1) 
              {
                    // generate all the possible subsets for the premise
                $subset = array_fill(0,count($fis->getItems()), false);  //array[fis.getItems().size()];
                $premise = null;
                    $consequence = null;
                    while (!is_null($premise = $this->getPremise($fis, $subset))) 
                    {
                             if (count($premise) > 0 && count($premise) < count($fis->getItems())) 
                             {
                                    $consequence = $this->getConsequence($fis, $subset);
                                    $totalSupport = $fis->getSupport();
                                    $supportPremise = $frequencyLookup->offsetGet($premise);
                                    $supportConsequence = $frequencyLookup->offsetGet($consequence);

                                    // a candidate rule
                                    $candidate = new DefaultAssociationRule($premise,
                                                                            $consequence, 
                                                                            $supportPremise,
                                                                            $supportConsequence, 
                                                                            $totalSupport, 
                                                                            $totalTransactions);
                                    if ($candidate->getPrimaryMetricValue() > $metricThreshold  && 
                                        $candidate->getTotalSupport() >= $lowerBoundMinSuppAsInstances && 
                                        $candidate->getTotalSupport() <= $upperBoundMinSuppAsInstances) {
                                      // accept this rule
                                      $rules[] = $candidate;
                                    }
                              }
                          $this->nextSubset($subset);
                    }
               }			

            }
    return $rules;
    }
    
    
    protected function mineTree($tree, 
                                $largeItemSets,
                                $recursionLevel, 
                                $conditionalItems, 
                                $minSupport) 
    {

    if (!$tree->isEmpty($recursionLevel)) 
    {
      if ($this->m_maxItems > 0 && $recursionLevel >= $this->m_maxItems) 
      {
        // don't mine any further
        return;
      }

      $headerTable = $tree->getHeaderTable();
      $keys = $headerTable->keys();
      // System.err.println("Number of freq item sets collected " +
      // largeItemSets.size());
      foreach ($keys as $item) 
      {

        $itemHeader = $headerTable->offsetGet($item);

        // check for minimum support at this level
       $support = $itemHeader->getProjectedCounts()->getCount($recursionLevel);
       if ($support >= $minSupport) 
        {
          // process header list at this recursion level
          foreach ($itemHeader->getHeaderList() as $n)  
          {
            // push count up path to root
            $currentCount = $n->getProjectedCount($recursionLevel);
            if ($currentCount > 0) 
            {
              $temp = $n->getParent();
              while ($temp != $tree) 
              {
                // set/increase for the node
                $temp->increaseProjectedCount($recursionLevel + 1, $currentCount);

                // set/increase for the header table
                $headerTable->offsetGet($temp->getItem())->getProjectedCounts()->increaseCount($recursionLevel + 1, $currentCount);

                $temp = $temp->getParent();
              }
            }
          }

          $newConditional = clone $conditionalItems;

          // this item gets added to the conditional items
         $newConditional->addItem($item);
         $newConditional->setSupport($support);

          // now add this conditional item set to the list of large item sets
         $largeItemSets->addItemSet($newConditional);

          // now recursively process the new tree
          $this->mineTree($tree, $largeItemSets, $recursionLevel + 1, $newConditional,$minSupport);

          // reverse the propagated counts
         foreach ($itemHeader->getHeaderList() as $n) 
         {
            $temp = $n->getParent();
            while ($temp != $tree) 
            {
              $temp->removeProjectedCount($recursionLevel + 1);
              $temp = $temp->getParent();
            }
         }

          // reverse the propagated counts in the header list
          // at this recursion level
          foreach ( $headerTable->values() as $h) 
          {
            $h->getProjectedCounts()->removeCount($recursionLevel + 1);
          }
        } 
     }
    }
  }
    
    
    private function processSingleton($currentInstance, $singletons)
    {          
        for ($j = 0; $j < $currentInstance->numAttributes(); $j++) 
        {
            if (!$currentInstance->isMissing($j)) 
            {
                if ($currentInstance->value($j) == $this->m_positiveIndex) 
                {
                        $singletons[$j]->increaseFrequency();
                }
            }
        } 
     }
    
    protected function getSingletons($source)
    {
        $singletons = array();
        for ($i = 0; $i < $source->numAttributes(); $i++) 
        {
           $singletons[] = new BinaryItem($source->attribute($i), $this->m_positiveIndex);
        }

        // set the number of instances
        $this->m_numInstances = $source->numInstances();
        for ($i = 0; $i < $source->numInstances(); $i++) 
        {
            $current = $source->instance($i);
            $this->processSingleton($current, $singletons);
        }
        return $singletons;
    }

     private function insertInstance($current,
		                    $singletons, 
				    $tree,
				    $minSupport)
   {
	$transaction = array(); // new ArrayList<BinaryItem>();
			
	for ($j = 0; $j < $current->numAttributes(); $j++) 
	{
	    if (!$current->isMissing($j)) 
	    {
		if ($current->value($j) == $this->m_positiveIndex) 
                {
                   if ($singletons[$j]->getFrequency() >= $minSupport) 
                   {
                       $transaction[] = $singletons[$j];
                   }
                }
            }
        }
        
        usort($transaction, array('BinaryItem', 'cmp'));
        $tree->addItemSet2($transaction, 1);
      }      
      
    
    protected function buildFPTree($singletons,$dataSource, $minSupport)
    {
      $tree = new FPTreeRoot();
      for ($i = 0; $i < $dataSource->numInstances(); $i++) 
      {
         $this->insertInstance($dataSource->instance($i), $singletons, $tree, $minSupport);
      }
      return $tree;        
    }
    
    public function buildAssociations($source) //Instances
    {
        $breakOnNext = false;
        $singletons = $this->getSingletons($source);
        
        if ($this->m_upperBoundMinSupport > 1)
        {
            $upperBoundMinSuppAsInstances = $this->m_upperBoundMinSupport;
        }
        else
        {
            $upperBoundMinSuppAsInstances = ceil($this->m_upperBoundMinSupport * $this->m_numInstances);
        }

        if ($this->m_lowerBoundMinSupport > 1)
        {
           $lowerBoundMinSuppAsInstances =  $this->m_lowerBoundMinSupport;
        }
        else
        {
            $lowerBoundMinSuppAsInstances = ceil($this->m_lowerBoundMinSupport * $this->m_numInstances);
        }
      
       if ($this->m_lowerBoundMinSupport > 1)
       {
           $lowerBoundMinSuppAsFraction =  $this->m_lowerBoundMinSupport / $this->m_numInstances;
       }
       else
       {
           $lowerBoundMinSuppAsFraction =$this->m_lowerBoundMinSupport ;
       }
       
       if ($this->m_delta > 1)
       {
         $deltaAsFraction =  $this->m_delta / $this->m_numInstances;
       }
       else
       {
         $deltaAsFraction = $this->m_delta;
       }
       
       $currentSupport = 1.0;
       
       do {
           $currentSupportAsInstances = ($currentSupport > 1) ? $currentSupport: ceil($currentSupport * $this->m_numInstances);
             
           $tree = $this->buildFPTree($singletons, $source,$currentSupportAsInstances);
           $largeItemSets = new FrequentItemSets($this->m_numInstances);

           // mine the tree
            $conditionalItems = new FrequentBinaryItemSet(array(), 0);
            $this->mineTree($tree, $largeItemSets, 0, $conditionalItems, $currentSupportAsInstances);
            $this->m_largeItemSets = $largeItemSets;
           
          // save memory
           $tree = null;
           
           $this->m_rules = $this->generateRulesBruteForce($this->m_largeItemSets,
                                                    $this->m_metricThreshold, 
                                                    $upperBoundMinSuppAsInstances,
                                                    $lowerBoundMinSuppAsInstances, 
                                                    $this->m_numInstances);
    
     
      //if (!$this->m_findAllRulesForSupportLevel) {
        if ($breakOnNext) {
          break;
        }
        $currentSupport -= $deltaAsFraction;
        // System.err.println("currentSupport " + currentSupport +
        // " lowBoundAsFrac " + lowerBoundMinSuppAsFraction);
        
        if ($currentSupport < $lowerBoundMinSuppAsFraction) {
          if ($currentSupport + $deltaAsFraction > $lowerBoundMinSuppAsFraction) {
            // ensure that the lower bound does get evaluated
            $currentSupport = $lowerBoundMinSuppAsFraction;
            $breakOnNext = true;
          } else {
            break;
          }
        }
      //} else {
        // just break out of the loop as we are just finding all rules
        // with a minimum support + metric
      //  break;
      //}
    } while (count($this->m_rules) < $this->m_numRulesToFind);
       
       
               
    }

    
    public function getRules()
    {
        return  array_slice ($this->m_rules, 0, $this->m_numRulesToFind) ;
    }
   }


