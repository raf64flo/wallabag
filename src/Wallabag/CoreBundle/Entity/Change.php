<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Change.
 *
 * @ORM\Entity(repositoryClass="Wallabag\CoreBundle\Repository\ChangeRepository")
 * @ORM\Table(name="`change`")
 * @ORM\Entity
 */
class Change {

	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="type", type="integer")
	 */
	private $type;

	const DELETION_TYPE = 1;
	const MODIFIED_TYPE = 2;
	const CHANGED_TAG_TYPE = 3;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="entry_id", type="integer")
	 */
	private $entryID;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="timestamp", type="datetime")
	 */
	private $timestamp;

	function __construct($type, $entryId)
	{
		$this->type = $type;
		$this->entryID = $entryId;
		$this->timestamp = new \DateTime();
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return int
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @param int $type
	 */
	public function setType($type)
	{
		$this->type = $type;
	}

	/**
	 * @return DateTime
	 */
	public function getTimestamp()
	{
		return $this->timestamp;
	}

	/**
	 * @param DateTime $timestamp
	 */
	public function setTimestamp(DateTime $timestamp)
	{
		$this->timestamp = $timestamp;
	}

	/**
	 * @return int
	 */
	public function getEntryID()
	{
		return $this->entryID;
	}

	/**
	 * @param int $entryID
	 */
	public function setEntryID($entryID)
	{
		$this->entryID = $entryID;
	}
}