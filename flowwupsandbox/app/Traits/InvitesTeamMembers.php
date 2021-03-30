<?php
namespace App\Traits;
use App\Notifications\InviteTeamMember;

trait InvitesTeamMembers {
    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailInviteNotification() {
        $this->notify(new InviteTeamMember);
    }
}