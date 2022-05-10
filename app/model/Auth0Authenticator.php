<?php

declare(strict_types=1);

namespace App\Model;

use Auth0\SDK\Auth0;
use Nette\Security\Authenticator;
use Nette\Security\Identity;
use Nette\Security\IIdentity;
use Nette\Security\AuthenticationException;

class Auth0Authenticator implements Authenticator
{
	private Auth0 $auth0;

	public function __construct(Auth0 $auth0) {
		$this->auth0 = $auth0;
	}

	/**
	 * @param $args [0] Authorization Code
	 * @throws AuthenticationException
	 */
	public function authenticate($user, $password) : IIdentity {
		if ($this->auth0->exchange()) {
			return new Identity($this->auth0->getUser()['email'], null, $this->auth0->getUser());
		} else {
			throw new AuthenticationException('Auth0 code not exchanged successfully; user not authenticated.');
		}
	}
}
