<?php

namespace App\Exception;

use Symfony\Component\Security\Core\Exception\AccountStatusException;

class AccountNotActiveException extends AccountStatusException
{

    public function getMessageKey()
    {
        return 'Account is not active.';
    }

}
