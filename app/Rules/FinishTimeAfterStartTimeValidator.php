<?php

namespace App\Rules;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Validation\ValidationRule;

class FinishTimeAfterStartTimeValidator implements ValidationRule
{
    const DATE_FORMAT = "Y-m-d" ;
    public function __construct($params)
{
    $this->params = $params;
}
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $startTime = Carbon::createFromFormat(self::DATE_FORMAT, $this->params);
        $finishTime = Carbon::createFromFormat(self::DATE_FORMAT, $value);

        // $finishTime->isAfter($startTime);
        if (($finishTime->isBefore($startTime))) {
            $fail('Event cant end before starting');
        }
    }
    public function passes($attribute, $value)
    {
       
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    // public function validate(string $attribute, mixed $value, Closure $fail): void
    // {
    //     //
    // }
}
