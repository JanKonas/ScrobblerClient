<?php

namespace Apploud\ScrobblerClient;

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

}
