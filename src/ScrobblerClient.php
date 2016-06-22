<?php

namespace Apploud\ScrobblerClient;

use Apploud\ScrobblerClient\Requests\MediaRequest;

class MediaGetter
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
	 * @param string $accessToken
	 * @param int|NULL $lastId
	 * @param string|NULL $type
	 * @param int|NULL $count
	 * @param int|NULL $pageLimit
	 * @return Responses\MediaResponse
	 */
	public function getMediaForTag($tag, $accessToken, $lastId = NULL, $type = NULL, $count = NULL, $pageLimit = NULL)
	{
		$params = [
			'lastId' => $lastId,
			'type' => $type,
			'count' => $count,
			'pageLimit' => $pageLimit
		];
		$params = array_filter($params);
		$request = new MediaRequest($tag, $accessToken, $params);
		return $request->send($this->baseUri, $this->httpAuth);
	}

}
