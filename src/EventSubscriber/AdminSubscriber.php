<?php

namespace App\EventSubscriber; // Un event subscriber est une classe qui écoute des événements et réagit en conséquence

use App\Entity\Club;
use App\Entity\Continent;
use App\Entity\Pays;
use App\Entity\Question;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AdminSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setCreatedAt'],
            BeforeEntityUpdatedEvent::class => ['setUpdateAt'],
        ];
    }

    public function setCreatedAt(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Club) && !($entity instanceof Continent) && !($entity instanceof Pays) && !($entity instanceof Question)) {
            return;
        }
        $entity->setCreatedAt(new \DateTimeImmutable());
    }

    public function setUpdateAt(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Club) && !($entity instanceof Continent) && !($entity instanceof Pays) && !($entity instanceof Question)) {
            return;
        }
        $entity->setUpdateAt(new \DateTimeImmutable());
    }
}
