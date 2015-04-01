<?php
 
 class FPGrowth 
 {
    protected $m_numRulesToFind = 10;
    protected $m_upperBoundMinSupport = 1.0;
    protected $m_lowerBoundMinSupport = 0.1;
    protected $m_delta = 0.5;
    protected $m_numInstances;
    protected $m_offDiskReportingFrequency = 10000;
    protected $m_positiveIndex = 2;
    protected $m_metric = METRIC_TYPE::CONFIDENCE;
    protected $m_metricThreshold = 0.9;
    protected $m_largeItemSets;
    protected $m_rules;
    protected $m_maxItems = -1;
    protected $m_mustContainOR = false;
  	   
    private static function nextSubset($subset)
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
             if (!$subset[i]) 
                 {
                   $consequence[] = $items[i];
             }
           }
          return $consequence;
     }

     public function  generateRulesBruteForce($largeItemSets,
                                             $metricToUse,
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
              $frequencyLookup.offsetSet($fis->getItems(), $fis->getSupport());
              if (count($fis.getItems()) > 1) 
              {
                    // generate all the possible subsets for the premise
                    $subset = array_fill(0,count($fis->getItems()), false);  //array[fis.getItems().size()];
                $premise = null;
                    $consequence = null;
                    while (($premise = $this->getPremise($fis, $subset)) != null) 
                    {
                             if (count($premise) > 0 && count($premise) < count($fis->getItems())) 
                             {
                                    $consequence = $this->getConsequence($fis, $subset);
                                    $totalSupport = $fis->getSupport();
                                    $supportPremise = $frequencyLookup->offsetGet($premise);
                                    $supportConsequence = $frequencyLookup->get($consequence);

                                    // a candidate rule
                                    $candidate = new DefaultAssociationRule($premise,
                                                    $consequence, 
                                                                                                                    $metricToUse, 
                                                                                                                    $supportPremise,
                                                                            $supportConsequence, 
                                                                                                                    $totalSupport, 
                                                                                                                    $totalTransactions);
                                    if ($candidate->getPrimaryMetricValue() > $metricThreshold  && 
                                        $candidate->getTotalSupport() >= $lowerBoundMinSuppAsInstances && 
                                            $candidate->getTotalSupport() <= $upperBoundMinSuppAsInstances) {
                                      // accept this rule
                                      $rules[] = candidate;
                                    }
                              }
                            nextSubset($subset);
                    }
               }			

            }
    return rules;
    }
	
    public static function pruneRules($rulesToPrune,
                                      $itemsToConsider,
                                      $useOr) 
    {
       $result = array(); //new ArrayList<AssociationRule>();

            foreach ($rulesToPrune as $r ) 
            {
              if ($r.containsItems($itemsToConsider, $useOr)) 
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

			if ($inst instanceof SparseInstance) 
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
			} 
			else 
			{
				$containsCount = 0;
				for ($i = 0; $i < count($transactionsMustContainIndexes); $i++) 
				{
					if ($transactionsMustContainIndexes[$i]) 
					{
						if ($inst.value($i) == $this->m_positiveIndex - 1) 
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
			}

		return result;
		}

		
    private function processSingleton($current,
                                          $singletons)
		{
			if ($current instanceof SparseInstance) 
			{
				for ( $j = 0; $j < $current->numValues(); $j++) 
				{
					$attIndex = $current->index($j);
                    $singletons[$attIndex]->increaseFrequency();
				}
			} 
			else 
			{
				for ($j = 0; $j < $current->numAttributes(); $j++) 
				{
					if (!$current->isMissing($j)) 
					{
						if ($current->attribute($j)->numValues() == 1 || $current->value($j) == $this->m_positiveIndex - 1) 
						{
							$singletons[$j]->increaseFrequency();
						}
					}
				}
			}
		}
			
		
    protected function  getSingletons($source)
		{
			$singletons = array();
			$data = null;
			
			if ($source instanceof Instances) 
			{
     			$data = $source;
		    } 
			elseif ($source instanceof ArffLoader) 
			{
				$data = $source->getStructure();
			}
			
			for ($i = 0; $i < $data->numAttributes(); $i++) 
			{
				$singletons[] = new BinaryItem($data->attribute($i), $this->m_positiveIndex - 1);
			}
			
			if ($source instanceof Instances) 
			{
				// set the number of instances
				$this->m_numInstances = $data->numInstances();
				
				for ($i = 0; i < $data->numInstances(); $i++) 
				{
					$current = $data->instance($i);
					processSingleton($current, $singletons);
				}
			} 
			elseif ($source instanceof ArffLoader) 
			{
				$loader = $source;
				$current = null;
				$count = 0;
				while (($current = $loader->getNextInstance($data)) != null) 
				{
					processSingleton($current, $singletons);
					$count++;
				}
				
				// set the number of instances
				$this->m_numInstances = $count;
				$loader->reset();
			}
		return $singletons;
        }
		
		 
    private function insertInstance($current,
		                    $singletons, 
				    $tree,
				    $minSupport)
   {
			
			$transaction = array(); // new ArrayList<BinaryItem>();
			
			if ($current instanceof SparseInstance) 
			{
				for ($j = 0; $j < $current->numValues(); $j++) 
				{
					$attIndex = $current->index($j);
					if ($singletons[$attIndex]->getFrequency() >= $minSupport) 
					{
						$transaction[] = $singletons[$attIndex];
					}
				}
				Collections.sort($transaction);
				$tree->addItemSet($transaction, 1);
			} 
			else 
			{
				for ($j = 0; $j < $current->numAttributes(); $j++) 
				{
					if (!$current->isMissing($j)) 
					{
						if ($current->attribute($j)->numValues() == 1
            || current.value(j) == m_positiveIndex - 1) {
            if (singletons.get(j).getFrequency() >= minSupport) {
              transaction.add(singletons.get(j));
            }
          }
        }
      }
      Collections.sort(transaction);
      tree.addItemSet(transaction, 1);
    }
			
			
			
   }	   

    public function buildAssociations($source) //Instances
    {
        $breakOnNext = false;
        $singletons = getSingletons($source);
        
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
         $deltaAsFraction =  $this->m_delta;
       }
       else
       {
         $deltaAsFraction = $this->m_delta;
       }
       
       $currentSupport = 1.0;
       
       do {
           $currentSupportAsInstances = ($currentSupport > 1) ? $currentSupport: ceil($currentSupport * $this->m_numInstances);
             
           $tree = buildFPTree($singletons, $source,$currentSupportAsInstances);
           $largeItemSets = new FrequentItemSets($this->m_numInstances);

           // mine the tree
           $conditionalItems = new FrequentBinaryItemSet(array(), 0);
           mineTree($tree, $largeItemSets, 0, $conditionalItems, $currentSupportAsInstances);
           $this->m_largeItemSets = $largeItemSets;
           
          // save memory
           $tree = null;
           
           $this->m_rules = generateRulesBruteForce($this->m_largeItemSets,
                                                    $this->m_metric,
                                                    $this->m_metricThreshold, 
                                                    $upperBoundMinSuppAsInstances,
                                                    $lowerBoundMinSuppAsInstances, 
                                                    $this->m_numInstances);
    
     
      if (!$this->m_findAllRulesForSupportLevel) {
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
      } else {
        // just break out of the loop as we are just finding all rules
        // with a minimum support + metric
        break;
      }
    } while (count($this->m_rules) < $this->m_numRulesToFind);
       
       
               
    }
	   
   }


