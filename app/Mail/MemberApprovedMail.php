<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MemberApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $member;
    public $token;

    public function __construct($member, string $token)
    {
        $this->member = $member;
        $this->token  = $token;
    }

    public function build()
    {
        return $this
            ->subject('Pendaftaran Member Disetujui, Set Password Akun Anda')
            ->view('emails.member.approved');
    }
}
