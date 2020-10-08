<?php

namespace App\Entity;

class Search
{
	/**
	 * @var string|null
	 */
	private $searchTitre;

	/**
	 * @var string|null
	 */
	private $searchPrix;

	/**
	 * @var string|null
	 */
	private $searchCategorie;

	/**
	 * @var string|null
	 */
	private $searchType;

	/**
	 * @return string|null
	 */
	public function getSearchTitre(): ?string
	{
		return $this->searchTitre;
	}

	/**
	 * @param string|null $search
	 * @return Search
	 */
	public function setSearchTitre(string $search): Search
	{
		$this->searchTitre = $search;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getSearchPrix(): ?string
	{
		return $this->searchPrix;
	}

	/**
	 * @param string|null $search
	 * @return Search
	 */
	public function setSearchPrix(string $search): Search
	{
		$this->searchPrix = $search;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getSearchCategorie(): ?string
	{
		return $this->searchCategorie;
	}

	/**
	 * @param string|null $search
	 * @return Search
	 */
	public function setSearchCategorie(string $search): Search
	{
		$this->searchCategorie = $search;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getSearchType(): ?string
	{
		return $this->searchType;
	}

	/**
	 * @param string|null $search
	 * @return Search
	 */
	public function setSearchType(string $search): Search
	{
		$this->searchType = $search;
		return $this;
	}

}