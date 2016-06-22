<?php

namespace Apploud\ScrobblerClient\Responses;

use Apploud\ScrobblerClient\Exceptions\InvalidStateException;

class AccessTokenResponse extends BaseResponse
{

	/**
	 * @param BaseResponse $that
	 */
	public function __construct(BaseResponse $that)
	{
		parent::__construct($that->response);
	}

	/**
	 * @return string
	 * @throws InvalidStateException
	 */
	function getAccessToken()
	{
		if (!$this->isOk()) {
			throw new InvalidStateException('Cannot get access token, this response has errors');
		}
		return $this->response->body->token;
	}

}
