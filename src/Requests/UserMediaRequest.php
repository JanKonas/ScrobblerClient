<?php

namespace Apploud\ScrobblerClient\Requests;

use Apploud\ScrobblerClient\Exceptions\InvalidArgumentException;
use Apploud\ScrobblerClient\Responses\MediaResponse;
use Httpful\Http;

class UserMediaRequest extends BaseRequest
{

	/**
	 * @param string $userId
	 * @param string $accessToken
	 * @param array|NULL $params
	 */
	public function __construct($userId, $accessToken, array $params = NULL)
	{
		$this->method = Http::GET;
		$this->requiresAuth = true;
		$this->endpoint = '/media/user/' . rawurlencode($userId);
		if (!$params) {
			$params = ['token' => $accessToken];
		} else {
			$params = array_merge($params, ['token' => $accessToken]);
		}
		$this->params = $params;
	}

	/**
	 * @param string $baseUri
	 * @param array|NULL $httpAuth
	 * @return MediaResponse
	 * @throws InvalidArgumentException
	 */
	public function send($baseUri, array $httpAuth = NULL)
	{
		return new MediaResponse(parent::send($baseUri, $httpAuth));
	}

}
