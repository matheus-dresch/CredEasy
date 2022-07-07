<?php

namespace Sicredi\Credeasy\Repository;

use Doctrine\ORM\EntityRepository;
use Sicredi\Credeasy\Entity\Cliente;

class ClienteRepository extends EntityRepository
{

    public function create(Cliente $cliente)
    {
        $em = $this->getEntityManager();

        $em->persist($cliente);
        $em->flush();
    }
}