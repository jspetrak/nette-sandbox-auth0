<?php

	namespace App\Extensions;

	use \Nette\DI\CompilerExtension;

	class Auth0Extension extends CompilerExtension {

		public $defaults = [
			'response_mode' => 'query',
			'response_type' => 'code',
			'persist_user' => true,
			'persist_access_token' => false,
			'persist_refresh_token' => false,
			'persist_id_token' => false,
			'debug' => false,
		];

		public function loadConfiguration() {
			$builder = $this->getContainerBuilder();
			$config = $this->getConfig($this->defaults);

			$builder
				->addDefinition('auth0')
				->setClass('Auth0\SDK\Auth0')
				->setArguments([$config]);
		}

	}

?>