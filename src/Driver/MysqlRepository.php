<?php
namespace src\Driver;

include_once 'src/Entity/Und.php';

use src\Entity\Und;

class MysqlRepository implements RepositoryInterface
{

    private $conn;
    
    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
    }

    public function read($query=null)
    {
        $query = (!is_null($query) ? " WHERE {$query}" : null);
        $sql = "SELECT * FROM lcp_und{$query}";
        $result = $this->conn->query($sql);
        $result = $result->fetchAll(\PDO::FETCH_ASSOC);
        
        foreach ($result as $r):
            $u = new Und();
            $u->setId($r['id']);
            $u->setNome($r['nome']);
            $u->setSigla($r['sigla']);
            $all[] = $u;
        endforeach;
        
        return $all;
    }

    public function create(Und $und)
    {
        $sql = "INSERT INTO cmp_und(nome, sigla) VALUES(:nome, :sigla)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nome", $und->getNome());
        $stmt->bindParam(":sigla", $und->getSigla());
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function update(Und $und, $id)
    {}

    public function delete($id)
    {}
}

