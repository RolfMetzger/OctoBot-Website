<?php
namespace App\Security;

use App\Entity\User as AppUser;
use App\Exception\AccountDeletedException;
use App\Exception\AccountNotActiveException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Psr\Log\LoggerInterface;

class UserChecker implements UserCheckerInterface
{

    public function checkPreAuth(UserInterface $user)
    {

        if (!$user instanceof AppUser) {
            throw new UnsupportedUserException();
        }

        // user is not active, show a generic Account Not Active message.
        if (!$user->getIsActive()) {
            throw new AccountNotActiveException();
        }

      }

    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

        // // user account is expired, the user may be notified
        // if ($user->isExpired()) {
        //     throw new AccountExpiredException();
        // }
    }
}
