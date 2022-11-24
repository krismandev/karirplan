<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Notifications\ResetPassword; // Custom Email Reset Text
use Illuminate\Notifications\Messages\MailMessage; // Custom Email Reset Text

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'tglLahir', 'id_jab', 'id_pend', 'tglJadi', 'serdos',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

   // protected $table        = 'siakad.users';
   // protected $primaryKey   = 'id';
   // protected $guarded      = [];

    public function sendPasswordResetNotification($token) {
        $this->notify(new ResetKataSandi($token));
    }
}

class ResetKataSandi extends ResetPassword
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Anda menerima email ini karena adanya permintaan "Peresetan Kata Sandi" yang Anda ajukan.')
            ->action('Reset Kata Sandi', url(config('app.url') . route('password.reset', $this->token, false)))
            ->line('Jika Anda merasa tidak pernah mengajukan permintaan tersebut, silahkan abaikan email ini.');
    }
}