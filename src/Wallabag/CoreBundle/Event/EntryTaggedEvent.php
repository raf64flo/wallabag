<?php

namespace Wallabag\CoreBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Wallabag\CoreBundle\Entity\Entry;
use Wallabag\CoreBundle\Entity\Tag;

/**
 * This event is fired as soon as an entry was saved.
 */
class EntryTaggedEvent extends Event
{
	const NAME = 'entry.tagged';

	/** @var Entry */
	protected $entry;

	/** @var Tag[] */
	protected $tags;

	public function __construct(Entry $entry, $tags)
	{
		$this->entry = $entry;
	}

	public function getEntry()
	{
		return $this->entry;
	}

	public function getTags()
	{
		return $this->tags;
	}
}
