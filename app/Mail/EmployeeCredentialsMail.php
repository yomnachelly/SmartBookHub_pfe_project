<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployeeCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $employee;
    public $plainPassword;

    /**
     * Create a new message instance.
     *
     * @param User $employee
     * @param string $plainPassword
     */
    public function __construct(User $employee, $plainPassword)
    {
        $this->employee = $employee;
        $this->plainPassword = $plainPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bienvenue chez Smart Book Hub - Vos identifiants employé')
                    ->view('emails.employee_credentials');
    }
}