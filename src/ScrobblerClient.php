<?php

namespace Apploud\ScrobblerClient;

use Apploud\ScrobblerClient\Exceptions\InvalidStateException;
use Apploud\ScrobblerClient\Requests\AccessTokenRequest;
use Apploud\ScrobblerClient\Requests\BaseRequest;
use Apploud\ScrobblerClient\Requests\MediaRequest;

class ScrobblerClient
{

	/** @var string */
	protected $baseUri;

	/** @var array */
	protected $httpAuth;

	/** @var string */
	protected $accessToken;

	/**
	 * @param string $baseUri
	 */
	public function __construct($baseUri)
	{
		$this->baseUri = $baseUri;
	}

	/**
	 * @param string $baseUri
	 * @return $this
	 */
	public function setBaseUri($baseUri)
	{
		$this->baseUri = $baseUri;
		return $this;
	}

	/**
	 * @param string $accessToken
	 * @return $this
	 */
	public function setAccessToken($accessToken)
	{
		$this->accessToken = $accessToken;
		return $this;
	}

	/**
	 * @param string $username
	 * @param string $password
	 * @return $this
	 */
	public function setAuthCredentials($username, $password)
	{
		$this->httpAuth = ['username' => $username, 'password' => $password];
		return $this;
	}

	/**
	 * @param string $tag
	 * @param int|NULL $lastId
	 * @param string|NULL $type
	 * @param int|NULL $count
	 * @param int|NULL $pageLimit
	 * @return Responses\MediaResponse
	 * @throws InvalidStateException
	 */
	public function getMediaForTag($tag, $lastId = NULL, $type = NULL, $count = NULL, $pageLimit = NULL)
	{
		if (!$this->accessToken) {
			throw new InvalidStateException('Access token must be set before calling getMediaForTag (see setAccessToken method).');
		}
		$params = [
			'lastId' => $lastId,
			'type' => $type,
			'count' => $count,
			'pageLimit' => $pageLimit
		];
		$params = array_filter($params);
		$request = new MediaRequest($tag, $this->accessToken, $params);
		return $request->send($this->baseUri, $this->httpAuth);
	}

	/**
	 * @param string $key
	 * @return string
	 * @throws Exceptions\InvalidStateException
	 */
	public function getAccessToken($key)
	{
		$request = new AccessTokenRequest($key);
		$response = $request->send($this->baseUri, $this->httpAuth);
		return $response->getAccessToken();
	}

	/**
	 * @param string $redirUrl
	 * @return string
	 */
	public function getAuthorizationUrl($redirUrl)
	{
		return BaseRequest::getUri($this->baseUri, '/token/authorize', ['redirUrl' => $redirUrl]);
	}

}
