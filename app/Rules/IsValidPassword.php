<?php

namespace App\Rules;
use Illuminate\Support\Str;

use Illuminate\Contracts\Validation\Rule;

class IsValidPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function passes($attribute, $value)
    {
        $this->lengthPasses = (Str::length($value) >= 8);
        $this->uppercasePasses = (Str::lower($value) !== $value);
        $this->numericPasses = ((bool)preg_match('/[0-9]/', $value));
        $this->specialCharacterPasses = ((bool)preg_match('/[^A-Za-z0-9]/', $value));

        return ($this->lengthPasses && $this->uppercasePasses && $this->numericPasses && $this->specialCharacterPasses);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        switch (true) {
            case !$this->uppercasePasses
                && $this->numericPasses
                && $this->specialCharacterPasses:
                return 'The :attribute must be at least 8 characters and contain at least 1 uppercase character.';

            case !$this->numericPasses
                && $this->uppercasePasses
                && $this->specialCharacterPasses:
                return 'The :attribute must be at least 8 characters and contain at least 1 number.';

            case !$this->specialCharacterPasses
                && $this->uppercasePasses
                && $this->numericPasses:
                return 'The :attribute must be at least 8 characters and contain at least 1 special character.';

            case !$this->uppercasePasses
                && !$this->numericPasses
                && $this->specialCharacterPasses:
                return 'The :attribute must be at least 8 characters and contain at least 1 uppercase character and 1 number.';

            case !$this->uppercasePasses
                && !$this->specialCharacterPasses
                && $this->numericPasses:
                return 'The :attribute must be at least 8 characters and contain at least 1 uppercase character and 1 special character.';

            case !$this->uppercasePasses
                && !$this->numericPasses
                && !$this->specialCharacterPasses:
                return 'The :attribute must be at least 8 characters and contain at least 1 uppercase character, 1 number, and 1 special character.';

            default:
                return 'The :attribute must be at least 8 characters.';
        }
    }
}
