<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class EventIdCorrectValidator implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // $eventId = Carbon::parse($value);
        // $finishTime->isAfter($startTime);
        if (!DB::table('event_types')->where('id', $value)->exists()) {
            $fail('Unknown event ID');
        }
    }
    
    
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    // public function validate(string $attribute, mixed $value, Closure $fail): void
    // {
    //     $eventId = Carbon::parse($value);
    //     return DB::table('event_types')->where('id', $eventId)->exists();
    // }
}
