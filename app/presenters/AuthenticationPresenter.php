<?php

declare(strict_types=1);

namespace App\Presenters;

use Auth0\SDK\Auth0;
use Nette\Application\ForbiddenRequestException;
use Tracy\Debugger;
use Nette\Http\IResponse;
use Nette\Application\UI\Presenter;
use Nette\Security\AuthenticationException;

class AuthenticationPresenter extends Presenter
{
	private Auth0 $auth0;

	public function __construct(Auth0 $auth0)
	{
		parent::__construct();

		$this->auth0 = $auth0;
	}

	public function actionLogin()
	{
		$this->auth0->login();
	}

	public function actionLogout()
	{
		$this->auth0->logout();
		$this->getUser()->logout();

		$this->redirect('Homepage:');
	}

	public function actionCallback($code): void
	{
		try {
			$this->getUser()->login($code);

			$this->redirect('Homepage:');
		} catch (AuthenticationException $e) {
			Debugger::log($e, Debugger::ERROR);
			throw new ForbiddenRequestException('User not authenticated', IResponse::S403_FORBIDDEN, $e);
		}
	}
}
