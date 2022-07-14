<?php

namespace App\Service;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class PasswordHasher
{
    public function getHasher(): PasswordHasherInterface
    {
        $factory = new PasswordHasherFactory([
            'auto' => ['algorithm' => 'auto'],
        ]);
        return $factory->getPasswordHasher('common');
    }
}
