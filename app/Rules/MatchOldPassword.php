<?php

namespace App\Rules;
use Hash;
use Illuminate\Contracts\Validation\Rule;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class MatchOldPassword implements Rule
{

    /**
     * Create a new rule instance.
     *
     * @return void
     */
 

    protected $employerId;
    protected $currentPassword;

    public function __construct($employerId, $currentPassword)
    {
        $this->employerId = $employerId;
        $this->currentPassword = $currentPassword;
    }

    public function passes($attribute, $value)
    {
        // Check if values match the old password
        $user = DB::table('admins')->where('id', $this->employerId)->first();

        if (!$user) {
            return false;
        }

        // Check if the current password matches
        if ($attribute === 'current_password') {
            return Hash::check($this->currentPassword, $user->password);
        }

        return false;
    }

    public function message()
    {
        return 'The provided credentials are incorrect.';
    }
}
