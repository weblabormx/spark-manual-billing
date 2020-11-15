<?php

namespace WeblaborMx\SparkManualBilling\Traits;

trait BillableExtras
{
    /**
     * Attributes
     */

    public function getPlanNameAttribute()
    {
    	if($this->onGenericTrial()) {
    		$plan = 'Trial';
    	} else {
    		$plan = $this->sparkPlan()->name;	
    	}
    	return __($plan);
    }

    public function getPlanDateAttribute()
    {
    	if($this->onGenericTrial()) {
    		return $this->trial_ends_at->format('Y-m-d');
    	} else if(!$this->subscribed()) {
    		return;
    	}
    	$subscription = $this->subscriptions()->active()->orderBy('ends_at', 'desc')->first();
    	return $subscription->ends_at->format('Y-m-d');
    }
}
