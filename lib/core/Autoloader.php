<?php

class Autoloader {

	public function __construct() {

		$this->loadGlobalFunctions();

		$this->loadVendor();

		$this->loadAppClasses();

		$this->loadRoutes();

		$this->loadDatabase();
	}

	private function loadVendor() {

		require_once "vendor/autoload.php";
	}

	private function loadRoutes() {

		require_once APP_PATH . "http/routes.php";
	}

	private function loadGlobalFunctions() {

		require_once CORE_PATH . "functions.php";
	}

	private function loadDatabase() {

		require_once CORE_PATH . "database.php";
	}

	private function loadAppClasses() {

		spl_autoload_register(function($className){

			if (substr($className, 0, 5) === "core\\") {
				$className = "lib\\" . $className;
			}

			require_once preg_replace("/\\\\/", "/", $className) . ".php";
		});
	}
}
