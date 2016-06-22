<?php

namespace Apploud\ScrobblerClient\Responses;

use Apploud\ScrobblerClient\Exceptions\InvalidStateException;

class MediaResponse extends BaseResponse
{

	/**
	 * @param BaseResponse $that
	 */
	public function __construct(BaseResponse $that)
	{
		parent::__construct($that->response);
	}

	/**
	 * @return array
	 * @throws InvalidStateException
	 */
	public function getMedia()
	{
		if (!$this->isOk()) {
			throw new InvalidStateException('Cannot get media, this response has errors');
		}
		return $this->response->body->media ?: [];
	}

	/**
	 * @return int|NULL
	 * @throws InvalidStateException
	 */
	public function getLastId()
	{
		if (!$this->isOk()) {
			throw new InvalidStateException('Cannot get last id, this response has errors');
		}
		return $this->response->body->lastId ?: NULL;
	}

	/**
	 * @return bool
	 * @throws InvalidStateException
	 */
	public function isLast()
	{
		if (!$this->isOk()) {
			throw new InvalidStateException('Cannot determine whether last, this response has errors');
		}
		return (bool) $this->response->body->lastResults;
	}

}
