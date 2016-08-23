<?php

namespace Apploud\ScrobblerClient\Requests;

use Apploud\ScrobblerClient\Exceptions\InvalidArgumentException;
use Apploud\ScrobblerClient\Responses\BaseResponse;
use Apploud\ScrobblerClient\Responses\MediaResponse;
use Httpful\Http;

class AddCommentRequest extends BaseRequest
{

	/**
	 * @param string $tag
	 * @param string $accessToken
	 * @param array|NULL $params
	 */
	public function __construct($mediaId, $text, $accessToken, $params = array())
	{
		$this->method = Http::POST;
		$this->requiresAuth = true;
		$this->endpoint = '/media/' . rawurlencode($mediaId) . '/comments';
		$this->body = json_encode(["text" => $text]);
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
	 * @return BaseResponse
	 * @throws InvalidArgumentException
	 */
	public function send($baseUri, array $httpAuth = NULL)
	{
		return parent::send($baseUri, $httpAuth);
	}

}
