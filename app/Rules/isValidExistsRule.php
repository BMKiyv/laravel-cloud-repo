<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Photo;

class isValidExistsRule implements Rule
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
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $filename = $value->file->getClientOriginalName();
        $names = Photo::pluck('filename');
       static $answer = false;
        foreach($names as $name){
            global $answer,$filename;
          $name==$filename?$answer = true: $answer = false;
        }
        return $answer;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The file :attribute.';
    }
}
