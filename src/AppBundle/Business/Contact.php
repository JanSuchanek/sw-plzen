<?php

namespace AppBundle\Business;

use AppBundle\Entity;
use Doctrine\ORM\EntityManager;

class Contact
{
    private $em;

    public function __construct(EntityManager $em)
    {
            $this->em = $em;
    }

    public function save(Entity\Contact $contact)
    {
        $this->em->persist($contact);
        $this->em->flush();
    }

    public function findAll()
    {
        $repository = $this->em->getRepository('AppBundle:Contact');
        return $repository->findAll();
    }
}