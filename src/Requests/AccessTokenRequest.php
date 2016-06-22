<?php

namespace Apploud\ScrobblerClient\Requests;

use Apploud\ScrobblerClient\Exceptions\InvalidArgumentException;
use Apploud\ScrobblerClient\Responses\AccessTokenResponse;
use Httpful\Http;

class AccessTokenRequest extends BaseRequest
{

	/**
	 * @param string $key
	 */
	public function __construct($key)
	{
		$this->method = Http::GET;
		$this->requiresAuth = true;
		$this->endpoint = '/token/get';
		$this->params = ['key' => $key];
	}

	/**
	 * @param string $baseUri
	 * @param array|NULL $httpAuth
	 * @return AccessTokenResponse
	 * @throws InvalidArgumentException
	 */
	public function send($baseUri, array $httpAuth = NULL)
	{
		return new AccessTokenResponse(parent::send($baseUri, $httpAuth));
	}

}
