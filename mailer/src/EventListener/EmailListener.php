<?php

namespace App\EventListener;

use App\Entity\Mails;
use App\Services\Mailer;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class EmailListener
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param LifecycleEventArgs $args
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Mails) {
            return;
        }

        $this->mailer->send($entity);
        $entity->setSentAt(new \DateTime());

        $args->getObjectManager()->persist($entity);
        $args->getObjectManager()->flush();
    }
}
