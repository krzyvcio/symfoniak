<?php


namespace App\Application\Service;

use App\Domain\Entity\User;

class FakeEmailService
{
    public function sendEmail(User $user): bool
    {
        // Logika wysyłania fałszywego e-maila
        // Na potrzeby przykładu, po prostu wyświetlimy komunikat i zwrócimy true
        echo sprintf("Wysłano e-mail do %s (%s)\n", $user->getFirstName(), $user->getEmail());
        return true;
    }
}
