<?php

namespace Apploud\ScrobblerClient\Responses;

use Httpful\Response;

class BaseResponse
{

	/** @var Response */
	protected $response;

	/**
	 * @param Response $response
	 */
	public function __construct(Response $response)
	{
		$this->response = $response;
	}

	/**
	 * @return bool
	 */
	public function isOk()
	{
		return !$this->response->hasErrors();
	}

}
