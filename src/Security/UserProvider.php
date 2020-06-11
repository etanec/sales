<?php

namespace App\Security;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use App\Entity\User;

class UserProvider implements UserProviderInterface
{
    private $_users;

    public function __construct(array $_users)
    {
        $this->users = $_users;
    }

    public function loadUserByUsername($username): ?User
    {
        if (\array_key_exists($username, $this->users)) {
            $user = new User();
            $user->setUsername($username);
            $user->setFullName($this->users[$username]['full_name']);
            $user->setEmail($this->users[$username]['email']);
            $user->setPassword($this->users[$username]['password']);
            $user->setRoles($this->users[$username]['roles']);

            return $user;
        }

        return null;

    }

    public function refreshUser(UserInterface $user): User
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Invalid user class "%s".', get_class($user)));
        }

        return $user;
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }
}
