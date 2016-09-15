<?php

namespace Apploud\ScrobblerClient\Requests;

use Httpful\Http;

class AddCommentRequest extends BaseRequest
{

	/**
	 * @param string $mediaId Instagram id of commented media
	 * @param string $text Comment text
	 * @param string $accessToken
	 * @param array|NULL $params
	 */
	public function __construct($mediaId, $text, $accessToken, $params = array())
	{
		$this->method = Http::POST;
		$this->requiresAuth = true;
		$this->endpoint = '/media/' . rawurlencode($mediaId) . '/comments';
		$this->body = ['text' => $text];
		if (!$params) {
			$params = ['token' => $accessToken];
		} else {
			$params = array_merge($params, ['token' => $accessToken]);
		}
		$this->params = $params;
	}

}
