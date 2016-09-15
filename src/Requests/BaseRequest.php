<?php

namespace Apploud\ScrobblerClient\Requests;

use Apploud\ScrobblerClient\Exceptions\InvalidArgumentException;
use Apploud\ScrobblerClient\Responses\BaseResponse;
use Httpful\Mime;
use Httpful\Request;

abstract class BaseRequest
{

	/** @var string */
	protected $method;

	/** @var bool */
	protected $requiresAuth;

	/** @var string */
	protected $endpoint;

	/** @var array */
	protected $params;

	/** @var mixed */
	protected $body;

	/**
	 * @param string $baseUri
	 * @param array|NULL $httpAuth
	 * @return BaseResponse
	 * @throws InvalidArgumentException
	 */
	public function send($baseUri, array $httpAuth = NULL)
	{
		$request = Request::init($this->method)->uri(self::getUri($baseUri, $this->endpoint, $this->params));
		if ($this->body) {
			$request->body(json_encode($this->body), Mime::JSON);
		}
		if ($this->requiresAuth) {
			if (!is_array($httpAuth) || !array_key_exists('username', $httpAuth) || !array_key_exists('password', $httpAuth)) {
				throw new InvalidArgumentException('This request requires authentication and supplied httpAuth is not an array or does not contain proper keys');
			}
			$request->authenticateWith($httpAuth['username'], $httpAuth['password']);
		}
		return new BaseResponse($request->expects(Mime::JSON)->send());
	}

	/**
	 * @param string $baseUri
	 * @param string $endpoint
	 * @param array|NULL $params
	 * @return string
	 */
	public static function getUri($baseUri, $endpoint, array $params = NULL)
	{
		if ($params) {
			$params = '?' . http_build_query($params, '', '&', PHP_QUERY_RFC3986);
		} else {
			$params = '';
		}
		return $baseUri . $endpoint . $params;
	}

}
