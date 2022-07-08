<?php

namespace Sicredi\Credeasy\Repository;

use Doctrine\ORM\EntityRepository;

class EmprestimoRepository extends EntityRepository
{
    public function getMostRecent(string $cpf)
    {
        $query = $this->createQueryBuilder('e.id')
            ->where("e.clienteCpf = $cpf")
            ->orderBy('e.dataSolicitacao', 'DESC')
            ->setMaxResults(1)
            ->getDQL();
            // ->getQuery()
            // ->getOneOrNullResult();

        return $this->getEntityManager()->createQuery($query)->getResult();
    }
}