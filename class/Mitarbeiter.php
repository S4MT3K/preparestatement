<?php

class Mitarbeiter
{
    private int|null $id;
    private string|null $vorname;
    private string|null $nachname;
    private int|null $abteilungsid;

    /**
     * @param int|null $id
     * @param string|null $vorname
     * @param string|null $nachname
     */
    public function __construct(int $id = null, string $vorname = null, string $nachname = null, int $abteilungsid = null)
    {
        if (isset($id))
        {
            $this->id = $id;
            $this->vorname = $vorname;
            $this->nachname = $nachname;
            $this->abteilungsid = $abteilungsid;
        }
    }

    public function getVorname(): string
    {
        return $this->vorname;
    }

    public function getNachname(): string
    {
        return $this->nachname;
    }

    public function setVorname(string $vorname): void
    {
        $this->vorname = $vorname;
    }

    public function setNachname(string $nachname): void
    {
        $this->nachname = $nachname;
    }

    public function setMitarbeiterId(int $id): void
    {
        $this->id = $id;
    }

    public function getMitarbeiterId(): int
    {
        return $this->id;
    }

    public function getAbteilungsId(): ?int
    {
        return $this->abteilungsid;
    }

    public function getAbteilungAsString(): string
    {
        $abtId = $this->getAbteilungsId();
        $pdo = DBConn::getConn();
        $stmt = $pdo->prepare("SELECT name from abteilung WHERE id = :abteilungsid");
        $stmt->bindParam(':abteilungsid', $abtId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return (!empty ($result['name'])) ? $result['name'] : 'N:A' ;
    }

    public function setAbteilungsId(?int $abteilungsid): void
    {
        $this->abteilungsid = $abteilungsid;
    }

    public function createObject(string $vrnm, string $nchnm, int $abtid) : Mitarbeiter
    {
        $this->vorname = $vrnm;
        $this->nachname = $nchnm;

        $pdo = DBConn::getConn();

        $stmt = $pdo->prepare("INSERT INTO mitarbeiter (vorname, nachname, abteilungsid) VALUES (:vorname, :nachname, :abtid)");

        $vornmame = $vrnm;
        $nachname = $nchnm;
        $abteilungsid = $abtid;

        $stmt->execute([':vorname' => $vornmame, ':nachname' => $nachname, ':abtid' => $abteilungsid]);
        $id = $pdo->lastInsertId();
        return new Mitarbeiter($id, $vornmame, $nachname, $abteilungsid);
    }

//    private static function setForeignConstraints($mitId, $abtId): void
//    {
//        $pdo = DBConn::getConn();
//        $stmt = $pdo->prepare("INSERT INTO mitabt (mitarbeiterid, abteilungsid) VALUES (:mitarbeiterid, :abteilungsid)");
//        $stmt->bindParam(':mitarbeiterid', $mitId, PDO::PARAM_INT);
//        $stmt->bindParam(':abteilungsid', $abtId, PDO::PARAM_INT);
//        $stmt->execute();
//    }

    /**
     * @return Mitarbeiter[]
     */

    public function getAllAsObjects() : array
    {
        $pdo = DBConn::getConn();
        $stmt = $pdo->prepare("SELECT * FROM mitarbeiter");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Mitarbeiter');
    }

    public function getObjectById(int $id): Mitarbeiter
    {
        $pdo = DBConn::getConn();
        $stmt = $pdo->prepare("SELECT * FROM mitarbeiter WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject('Mitarbeiter');
    }

    public function deleteObject(int $id) : void
    {
        $pdo = DBConn::getConn();
        $stmt = $pdo->prepare("DELETE FROM mitarbeiter WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateObject(): void
    {
        try {
            $pdo = DBConn::getConn();
            $stmt = $pdo->prepare("UPDATE mitarbeiter SET vorname = :vorname, nachname = :nachname, abteilungsid = :abtid  WHERE id = :id");
            $stmt->bindParam(':vorname', $this->vorname);
            $stmt->bindParam(':nachname', $this->nachname);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':abtid', $this->abteilungsid);
            $stmt->execute();
        } catch (Exception $e) {
            // Handle the exception appropriately, e.g., log the error
            echo "Fehler beim Aktualisieren des Mitarbeiters: " . $e->getMessage();
        }
    }
}
