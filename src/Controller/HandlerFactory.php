<?php

declare(strict_types=1);

namespace src\Controller;

require_once 'src/UseCase/Service.php';
require_once 'src/Driver/Repository/MysqlRepository.php';
require_once 'libs/Html/HtmlTagTable.php';
require_once 'libs/Sql/SqlRead.php';

use Psr\Container\ContainerInterface;
use src\UseCase\Service;
use libs\Html\HtmlTagTable;
use libs\Sql\SqlRead;
use src\Entity\Simple\Produto;
use src\Entity\Simple\ProdutoTipo;
use src\Entity\Simple\Mercadoria;
use src\Entity\Simple\Unidade;
use src\Entity\Simple\EmbalagemTipo;
use src\Entity\Simple\Embalagem;
use src\Driver\Repository\MysqlRepository;
use Traits\EntityHandlerTrait;

class HandlerFactory
{
    use EntityHandlerTrait;
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $repo = $container->get(MysqlRepository::class);
        
        $servive = new Service($repo);        
        $ctrl = new $requestedName($servive);
        
        $response = array();
        
        $entity = $container->getEntity();
        
        $sql = require "src/Driver/Sql/{$this->getTableName($entity)}/Read.php";
        
        foreach ($servive->read($sql) as $i=>$line)
        {
            $response[$i]['Unidade'] = $line->getNome();
            $response[$i]['Sigla'] = $line->getSigla();
        }
        
        return $ctrl->handle(new HtmlTagTable('table', $response));
    }
    
    private function getSql(ContainerInterface $container, $requestedName)
    {
        $entity = $container->getEntity();
        $sql = new SqlRead($entity);
        
        switch ($entity->getTableName()) {
            case 'lcp_und':
                $sql->setOrder('nome');
                break;
            
            case 'lcp_pdt_tp':
                $sql->setOrder('nome');
                break;
                
            case 'lcp_emb':
                $sql->setJoin(new Unidade(), "lcp_emb.unidade=lcp_und.id");
                $sql->setJoin(new EmbalagemTipo(), "lcp_emb.tipo=lcp_emb_tp.id");
                $sql->setOrder('lcp_emb_tp.nome');
                break;
                
            case 'lcp_pdt':
                $sql->setJoin(new ProdutoTipo(), "lcp_pdt.tipo=lcp_pdt_tp.id");
                $sql->setOrder('lcp_pdt.nome');
                break;
                
            case 'lcp_mcd':
                $sql->setJoin(new Produto(), "lcp_mcd.produto=lcp_pdt.id");
                $sql->setJoin(new ProdutoTipo(), "lcp_pdt.tipo=lcp_pdt_tp.id");
                $sql->setJoin(new Embalagem(), "lcp_mcd.embalagem=lcp_emb.id");
                $sql->setJoin(new Unidade(), "lcp_emb.unidade=lcp_und.id");
                $sql->setJoin(new EmbalagemTipo(), "lcp_emb.tipo=lcp_emb_tp.id");
                $sql->setConcat(array(
                    'lcp_pdt.nome', 
                    'lcp_emb_tp.nome', 
                    'lcp_emb.capacidade', 
                    'lcp_und.sigla'
                    ), 'mcdNome');
                $sql->setOrder('mcdNome');
                break;
                
            case 'lcp_hst':
                $sql->setJoin(new Mercadoria(), "lcp_hst.mercadoria=lcp_mcd.id");
                $sql->setJoin(new Produto(), "lcp_mcd.produto=lcp_pdt.id");
                $sql->setJoin(new ProdutoTipo(), "lcp_pdt.tipo=lcp_pdt_tp.id");
                $sql->setJoin(new Embalagem(), "lcp_mcd.embalagem=lcp_emb.id");
                $sql->setJoin(new Unidade(), "lcp_emb.unidade=lcp_und.id");
                $sql->setJoin(new EmbalagemTipo(), "lcp_emb.tipo=lcp_emb_tp.id");
                $sql->setConcat(array(
                    'lcp_pdt.nome',
                    'lcp_emb_tp.nome',
                    'lcp_emb.capacidade',
                    'lcp_und.sigla'
                ), 'mcdNome');
                $sql->setOrder('mcdNome');
                $sql->setLimit(5);
                break;
        }
        
        return $sql;
    }
}

