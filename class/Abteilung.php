<?php

class Abteilung
{
    private int|null $id;
    private string|null $name;

    public function __construct(int $id = null, string $nm = null)
    {
        if (isset($id)) { //Bei dummy objekten //NULL construktoren immer fälle unterscheiden.. .Falls nicht leer dann auch füllen
            $this->name = $nm;
            $this->id = $id;
        }
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function createObject(string $nm): Abteilung
    {
        $this->name = $nm;

        $conn = DBConn::getConn();
        $sqlquery = "INSERT INTO abteilung (name) VALUES (:name)";
        $stmt = $conn->prepare($sqlquery);
        $stmt->execute([':name' => $nm]);
        $id = $conn->lastInsertId();
        return new Abteilung($id, $nm);
    }

    public function getAllAsObjects(): array
    {
        $conn = DBConn::getConn();
        $stmt = $conn->prepare("SELECT * FROM abteilung");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Abteilung');
    }

    public function getObjectById(int $id): Abteilung
    {
        $conn = DBConn::getConn();
        $stmt = $conn->prepare("SELECT * FROM abteilung WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject('Abteilung');
    }

    public function deleteObject($id): void
    {
        $conn = DBConn::getConn();
        $sqlquery = "DELETE FROM abteilung WHERE id = :id";
        $stmt = $conn->prepare($sqlquery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateObject(): void
    {
        $conn = DBConn::getConn();
        $stmt = $conn->prepare("UPDATE abteilung SET name = :name WHERE id = :id");
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }
}
