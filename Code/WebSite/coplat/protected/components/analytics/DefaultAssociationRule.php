<?php

class DefaultAssociationRule {
      
     /*  private $m_stringVal;

           
    public function toString() 
    {
      return $this->m_stringVal;
    }
    

    
    public function toStringMetric($premiseSupport, $consequenceSupport,
                                   $totalSupport, $totalTransactions) 
     {
      return $this->m_stringVal.":(".$this->compute($premiseSupport, $consequenceSupport,
                                                    $totalSupport, $totalTransactions).")";
    }*/

  
  /** The premise of the rule */
  protected $m_premise; //Collection<Item> 
  
  /** The consequence of the rule */
  protected $m_consequence; // Collection<Item>
  
  /** The support for the premise */
  protected $m_premiseSupport;
  
  /** The support for the consequence */
  protected $m_consequenceSupport;
  
  /** The total support for the item set (premise + consequence) */
  protected $m_totalSupport;
  
  /** The total number of transactions in the data */
  protected $m_totalTransactions;

  public function  DefaultAssociationRule($premise, 
                                $consequence,
                                $premiseSupport, $consequenceSupport,
                                $totalSupport, $totalTransactions) {
    $this->m_premise = $premise;
    $this->m_consequence = $consequence;
    $this->m_premiseSupport = $premiseSupport;
    $this->m_consequenceSupport = $consequenceSupport;
    $this->m_totalSupport = $totalSupport;
    $this->m_totalTransactions = $totalTransactions;
  }
  
  /* (non-Javadoc)
   * @see weka.associations.AssociationRule#getPremise()
   */
  public function getPremise() {
    return  $this->m_premise;
  }
  
  /* (non-Javadoc)
   * @see weka.associations.AssociationRule#getConsequence()
   */
  public function getConsequence() {
    return  $this->m_consequence;
  }
  
    //confidence based
  public function compute($premiseSupport, $consequenceSupport, 
                            $totalSupport, $totalTransactions) {
        
        return $totalSupport / $premiseSupport;
   } 
 
  public function getPrimaryMetricValue() {
    return $this->compute($this->m_premiseSupport, $this->m_consequenceSupport, 
        $this->m_totalSupport, $this->m_totalTransactions);
  }
    
 
  public function getPremiseSupport() 
  {
    return $this->m_premiseSupport;
  }
  
  /* (non-Javadoc)
   * @see weka.associations.AssociationRule#getConsequenceSupport()
   */
  public function getConsequenceSupport() 
  {
    return $this->m_consequenceSupport;
  }
  
  /* (non-Javadoc)
   * @see weka.associations.AssociationRule#getTotalSupport()
   */
  public function getTotalSupport() 
  {
    return $this->m_totalSupport;
  }
  
  /* (non-Javadoc)
   * @see weka.associations.AssociationRule#getTotalTransactions()
   */
  public function getTotalTransactions() 
  {
    return $this->m_totalTransactions;
  }
              
  /**
   * Get a textual description of this rule.
   * 
   * @return a textual description of this rule.
   */
  /*public String toString() {
    StringBuffer result = new StringBuffer();
    
    result.append(m_premise.toString() + ": " + m_premiseSupport 
        + " ==> " + m_consequence.toString() + ": " + m_totalSupport 
        + "   ");
    for (DefaultAssociationRule.METRIC_TYPE m : METRIC_TYPE.values()) {
      if (m.equals(m_metricType)) {
        result.append("<" + 
            m.toStringMetric(m_premiseSupport, m_consequenceSupport, 
                m_totalSupport, m_totalTransactions) + "> ");
      } else {
        result.append("" + 
            m.toStringMetric(m_premiseSupport, m_consequenceSupport, 
                m_totalSupport, m_totalTransactions) + " ");
      }
    }
    return result.toString();
  }*/
}

