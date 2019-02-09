<?php

class ErrorController extends Controllers {

	public function E404() {
		echo "Page does not exists";
		http_response_code(404);
	}

}