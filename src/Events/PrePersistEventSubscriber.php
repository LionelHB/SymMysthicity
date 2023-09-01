<?php

namespace App\Events;


use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Entity\User; 

class PrePersistEventSubscriber implements EventSubscriber
{


    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof User) { // Remplacez "YourEntity" par le nom de votre entité
            // Votre logique de pré-persist ici
        }
    }
}
