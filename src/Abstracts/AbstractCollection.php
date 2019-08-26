<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - AbstractCollection.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Abstracts;

/**
 * Class AbstractCollection
 * @package Biscolab\GoogleMaps\Abstracts
 */
abstract class AbstractCollection implements \Iterator
{

	/**
	 * @var array
	 */
	protected $items = [];

	/**
	 * @var int
	 */
	protected $index = 0;

	/**
	 * AbstractCollection constructor.
	 *
	 * @param null|array $items
	 */
	public function __construct(?array $items = [])
	{

		$this->setItems($items);
	}

	/**
	 * @param array $items
	 *
	 * @return AbstractCollection
	 */
	protected function setItems(?array $items = [])
	{

		if (is_array($items) && count($items)) {
			foreach ($items as $item) {
				$this->addItem($item);
			}
		}

		return $this;
	}

	/**
	 * @param $item
	 *
	 * @return AbstractCollection
	 */
	public function addItem($item)
	{

		$item = $this->parseItem($item);
		array_push($this->items, $item);

		return $this;
	}

	/**
	 * @param $item
	 *
	 * @return mixed
	 */
	protected function parseItem($item)
	{

		return $item;
	}

	/**
	 * @return string
	 */
	public function toJson(): string
	{

		return json_encode($this->toArray());
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{

		return $this->items;
	}

	/**
	 * @return string
	 */
	public function __toString(): string
	{

		return implode(',', $this->toArray());
	}

	/**
	 * Return the current position of the index
	 *
	 * @return int
	 */
	public function position(): int
	{

		return $this->index;
	}

	/**
	 * Return the current object
	 *
	 * @return mixed|null
	 */
	public function current()
	{

		return $this->get($this->index);
	}

	/**
	 * @param $index
	 *
	 * @return mixed|null
	 */
	public function get(int $index)
	{

		return isset($this->items[$index]) ? $this->items[$index] : null;
	}

	/**
	 * Move index to first position and return current element
	 *
	 * @return mixed|null
	 */
	public function first()
	{

		return $this->seek();
	}

	/**
	 * Move index to next position and return current element
	 *
	 * @return mixed|null
	 */
	public function next()
	{

		return $this->seek(++$this->index);
	}

	/**
	 * Return current key/index
	 *
	 * @return mixed|null
	 */
	public function key()
	{

		return $this->index;
	}

	/**
	 * Return current key/index
	 *
	 * @return mixed|null
	 */
	public function valid()
	{

		return !empty($this->current());
	}

	/**
	 * Move index to first position and return current element
	 *
	 * @return mixed|null
	 */
	public function rewind()
	{

		return $this->first();
	}

	/**
	 * Move the index at the specified position
	 *
	 * @param int|null $index
	 *
	 * @return mixed|null
	 */
	public function seek(?int $index = 0)
	{

		$this->index = ($index < $this->count()) ? $index : $this->getLastIndex();

		return $this->get(intval($this->index));
	}

	/**
	 * @return int
	 */
	public function count(): int
	{

		return count($this->items);
	}

	/**
	 * @return int
	 */
	public function getLastIndex(): int
	{

		$last_position = $this->count() - 1;

		return ($last_position) < 0 ? 0 : $last_position;
	}

	/**
	 * Move index at the end of collection and return current element
	 *
	 * @return mixed|null
	 */
	public function last()
	{

		return $this->seek($this->getLastIndex());
	}

}