<?php

namespace App\Service;

use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class EmailWriter
{
    public function getVerificationEmail(string $email, string $name, int $id, string $code): Email
    {
        $domain = $_ENV["APP_PROD_DOMAIN"];
        $link = "{$domain}/verify-user?userID={$id}&code={$code}";

        return (new Email())
            ->from(new Address('no-reply@test.de', "SkyGateCaseStudy"))
            ->to(new Address($email, $name))
            ->subject('Verify your registration!')
            ->text("Please verify your registration by following this link: {$link}")
            ->html("Please verify your registration by following this link: <a href=\"{$link}\">{$link}</a>");
    }
}
