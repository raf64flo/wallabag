<?php

use Composer\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;
use Wallabag\CoreBundle\Event\EntryDeletedEvent;
use Wallabag\CoreBundle\Event\EntryTaggedEvent;
use Wallabag\CoreBundle\Event\EntryUpdatedEvent;

class ChangesSubscriber implements EventSubscriberInterface
{
    /** @var LoggerInterface $logger */
    private $logger;

    /** @var EntityManager $em */
    private $em;

    public function __construct(EntityManager $em, LoggerInterface $logger)
    {
        die;
        $this->logger = $logger;
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return [
            EntryUpdatedEvent::NAME => 'onEntryUpdated',
            EntryDeletedEvent::NAME => 'onEntryDeleted',
            EntryTaggedEvent::NAME => 'onEntryTagged',
        ];
    }

    /**
     * @param EntryUpdatedEvent $event
     */
    public function onEntryUpdated(EntryUpdatedEvent $event)
    {
        $change = new Change(Change::MODIFIED_TYPE, $event->getEntry()->getId());

        $this->em->persist($change);
        $this->em->flush();

        $this->logger->debug('saved updated entry '.$event->getEntry()->getId().' event ');
    }

    /**
     * @param EntryDeletedEvent $event
     */
    public function onEntryRemoved(EntryDeletedEvent $event)
    {
        $change = new Change(Change::DELETION_TYPE, $event->getEntry()->getId());

        $this->em->persist($change);
        $this->em->flush();

        $this->logger->debug('saved removed entry '.$event->getEntry()->getId().' event ');
    }

    /**
     * @param EntryTaggedEvent $event
     */
    public function onEntryTagged(EntryTaggedEvent $event)
    {
        $change = new Change(Change::CHANGED_TAG_TYPE, $event->getEntry()->getId());

        $this->em->persist($change);
        $this->em->flush();

        $this->logger->debug('saved (un)tagged entry '.$event->getEntry()->getId().' event ');
    }
}
