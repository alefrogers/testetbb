<?php

namespace App\Model\Investments;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class InvestmentsSimulation extends Model {

    protected $table = 'investments_simulations';
    protected $guarded = ['id'];
    protected $appends = ['total_period', 'client_income', 'agency_income', 'total_income'];

    function type() {
        return $this->hasOne('App\Model\Investments\InvestmentsType', 'id', 'id_type');
    }

    function applications() {
        return $this->hasMany('App\Model\Investments\InvestmentsSimulationApplications', 'id_simulation', 'id');
    }

    public function getTotalPeriodAttribute() {
        $first_application = $this->applications()->orderBy('date_application', 'ASC')->first();
        $date_application = new DateTime($first_application->date_application);

        $total = $date_application->diff(new DateTime(date('Y-m-d')));

        return $total->format('%a');
    }

    public function getClientIncomeAttribute() {
        $type = $this->type;
        $applications = $this->applications()->orderBy('date_application', 'ASC')->get();
        $profitability_real = ($type->profitability - $type->rate) / 100;    
        
        return $this->calculeIncome($profitability_real, $type, $applications);        
    }
    
    public function getAgencyIncomeAttribute() {
        $type = $this->type;
        $applications = $this->applications()->orderBy('date_application', 'ASC')->get();
        $profitability_real = $type->rate / 100;    
        
        return $this->calculeIncome($profitability_real, $type, $applications);        
    }
    
    public function getTotalIncomeAttribute() {
        $type = $this->type;
        $applications = $this->applications()->orderBy('date_application', 'ASC')->get();
        $profitability_real = $type->profitability / 100;    
        
        return $this->calculeIncome($profitability_real, $type, $applications);        
    }
    
    
    function calculeIncome($profitability_real, $type, $applications){        
        $days_income = 0;
        $value_income = 0;        

        if (count($applications) > 1) {
            $valueApplication = 0;

            foreach ($applications as $key => $value) {
                $date_application = new DateTime($value->date_application);
                
                if (($key + 1) <= (count($applications) - 1)) {
                    $diff = $date_application->diff(new DateTime($applications[$key + 1]->date_application));
                }else{
                    $diff = $date_application->diff(new DateTime(date('Y-m-d')));
                }
                
                $valueApplication += $value->val_application;
                
                $days_income = $diff->format('%a') / $type->application_days;                
                $value_income += ($valueApplication * $profitability_real) * $days_income; 
            }
        } else {
            $days_income = $this->total_period / $type->application_days;
            $value_income = ($this->applications->sum('val_application') * $profitability_real) * $days_income;
        }


        return $value_income;
    }

}
