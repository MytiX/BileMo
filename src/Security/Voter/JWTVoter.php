<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class JWTVoter extends Voter
{
    public function supports(string $attribute, mixed $subject): bool
    {
        return false;
    }

    public function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        return false;
    }

}