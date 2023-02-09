<?php

namespace App\Rules;

use App\Enums\RouteNameEnum;
use Closure;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class RouteNameRule implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure(string): PotentiallyTranslatedString $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail): void
    {
        if (!RouteNameEnum::getRouteNames()->contains("slug", $value)) {
            $fail("İşlev kayıtlı değildir !");
        }
    }
}
