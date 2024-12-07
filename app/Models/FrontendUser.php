<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;


class FrontendUser extends Model
{
    use HasFactory, HasApiTokens;
    protected $fillable = ['phone', 'otp', 'otp_expires_at', 'name', 'email', 'user_type', 'profile_image', 'status'];

    protected $hidden = ['otp'];

    public function otpExpired()
    {
        $carbonDate = Carbon::parse($this->otp_expires_at);

        return $this->otp_expires_at && $carbonDate->isPast();
    }
}
