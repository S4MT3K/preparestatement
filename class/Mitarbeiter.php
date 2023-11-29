<?php

class Mitarbeiter
{
    private int|null $id;
    private string|null $vorname;
    private string|null $nachname;

    /**
     * @param int|null $id
     * @param string|null $vorname
     * @param string|null $nachname
     */
    public function __construct(int $id = null, string $vorname = null, string $nachname = null)
    {
        if (isset($id))
        {
            $this->id = $id;
            $this->vorname = $vorname;
            $this->nachname = $nachname;
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

    public function createMitarbeiter(string $vrnm, string $nchnm) : Mitarbeiter
    {
        $this->vorname = $vrnm;
        $this->nachname = $nchnm;

        $pdo = DBConn::getConn();

        $stmt = $pdo->prepare("INSERT INTO mitarbeiter (vorname, nachname) VALUES (:vorname, :nachname)");

        $vornmame = $vrnm;
        $nachname = $nchnm;

        $stmt->execute([':vorname' => $vornmame, ':nachname' => $nachname]);

        return new Mitarbeiter($pdo->lastInsertId(), $vornmame, $nachname);
    }

    /**
     * @return Mitarbeiter[]
     */

    public function getAllMitarbeiterAsObjects() : array
    {
        $pdo = DBConn::getConn();
        $stmt = $pdo->prepare("SELECT * FROM mitarbeiter");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Mitarbeiter');
    }

    public function getMitarbeiterById(int $id): Mitarbeiter
    {
        $pdo = DBConn::getConn();
        $stmt = $pdo->prepare("SELECT * FROM mitarbeiter WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject('Mitarbeiter');
    }

    public function deleteMitarbeiter(int $id) : void
    {
        $pdo = DBConn::getConn();
        $stmt = $pdo->prepare("DELETE FROM mitarbeiter WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateMitarbeiter(): void
    {
        try {
            $pdo = DBConn::getConn();
            $stmt = $pdo->prepare("UPDATE mitarbeiter SET vorname = :vorname, nachname = :nachname WHERE id = :id");
            $stmt->bindParam(':vorname', $this->vorname);
            $stmt->bindParam(':nachname', $this->nachname);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
        } catch (Exception $e) {
            // Handle the exception appropriately, e.g., log the error
            echo "Fehler beim Aktualisieren des Mitarbeiters: " . $e->getMessage();
        }
    }

}
