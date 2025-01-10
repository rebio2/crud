<?php
include_once "config.php";
require_once "Cliente.php";

/**
 * Clase AccesoDAO
 * 
 * Clase que se encarga de acceder a la base de datos y obtener los datos de los clientes
 * 
 */

class AccesoDAO
{

    private static $modelo = null;
    private $dbh = null;
    private $stmt_clientes = null;
    private $stmt_cliente = null;
    private $stmt_numclientes = null;
    private $stmt_boruser  = null;
    private $stmt_moduser  = null;
    private $stmt_creauser = null;


    public static function getModelo()
    {
        if (self::$modelo == null) {
            self::$modelo = new AccesoDAO();
        }
        return self::$modelo;
    }



    // Constructor privado  Patron singleton

    private function __construct()
    {

        try {
            $dsn = "mysql:host=" . SERVER_DB . ";dbname=" . DATABASE . ";charset=utf8";
            $this->dbh = new PDO($dsn, DB_USER, DB_PASSWD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
        } catch (PDOException $e) {
            echo "Error de conexión " . $e->getMessage();
            exit();
        }
        // Construyo las consultas de golpe y no las emulo.
        $this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
        try {
            $this->stmt_clientes  = $this->dbh->prepare("select * from Clientes limit :primero ,:cuantos");
            $this->stmt_cliente  = $this->dbh->prepare("select * from Clientes where id =:id");
            $this->stmt_boruser   = $this->dbh->prepare("delete from Clientes where id =:id");
            $this->stmt_moduser = $this->dbh->prepare("UPDATE Clientes SET first_name = :first_name, email = :email, gender = :gender, ip_address = :ip_address, telefono = :telefono WHERE id = :id");
            $this->stmt_numclientes  = $this->dbh->prepare("select count(*) FROM Clientes ");
            $this->stmt_creauser  = $this->dbh->prepare("insert into Clientes (id,first_name,email,gender,ip_address, telefono) Values(?,?,?,?,?,?)");
        } catch (PDOException $e) {
            echo " Error al crear la sentencias " . $e->getMessage();
            exit();
        }
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo()
    {
        if (self::$modelo != null) {
            $obj = self::$modelo;
            $obj->stmt_clientes = null;
            $obj->stmt_cliente = null;
            $obj->stmt_numclientes = null;
            $obj->stmt_boruser = null;
            $obj->dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo la lista de Clientes
    public function getClientes(int $primero, int $cuantos): array
    {
        $tuser = [];
        $this->stmt_clientes->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        $this->stmt_clientes->bindParam(":primero", $primero);
        $this->stmt_clientes->bindParam(":cuantos", $cuantos);
        if ($this->stmt_clientes->execute()) {
            while ($user = $this->stmt_clientes->fetch()) {
                $tuser[] = $user;
            }
        }
        return $tuser;
    }

    public function getCliente(int $id): object
    {
        $cliente = null;
        $this->stmt_cliente->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        $this->stmt_cliente->bindParam(":id", $id);
        if ($this->stmt_cliente->execute()) {
            if ($obj = $this->stmt_cliente->fetch()) {
                $cliente = $obj;
            }
        }
        return $cliente;
    }

    public function getNextId(): int
    {
        $stmt = $this->dbh->prepare("SELECT id + 1 AS next_id FROM Clientes t1 WHERE NOT EXISTS (SELECT 1 FROM Clientes t2 WHERE t2.id = t1.id + 1) ORDER BY id LIMIT 1");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['next_id'] : 1; // Si no hay filas, retorna 1
    }

    //INSERT
    public function addUsuario($cliente): bool
    {
        $this->stmt_creauser->execute([$cliente->id, $cliente->first_name, $cliente->email, $cliente->gender, $cliente->ip_address, $cliente->telefono]);
        $resu = ($this->stmt_creauser->rowCount() == 1);
        return $resu;
    }

    //DELETE
    public function borrarUsuario(String $id): bool
    {
        $this->stmt_boruser->bindValue(':id', $id);
        $this->stmt_boruser->execute();
        $resu = ($this->stmt_boruser->rowCount() == 1);
        return $resu;
    }

    // UPDATE
    public function modUsuario($cliente): bool
    {
        $this->stmt_moduser->bindValue(':id', $cliente->id);
        $this->stmt_moduser->bindValue(':first_name', $cliente->first_name);
        $this->stmt_moduser->bindValue(':email', $cliente->email);
        $this->stmt_moduser->bindValue(':gender', $cliente->gender);
        $this->stmt_moduser->bindValue(':ip_address', $cliente->ip_address);
        $this->stmt_moduser->bindValue(':telefono', $cliente->telefono);

        $this->stmt_moduser->execute();
        $resu = ($this->stmt_moduser->rowCount() == 1);
        return $resu;
    }

    public function totalClientes(): int
    {
        $this->stmt_numclientes->execute();
        $valor = $this->stmt_numclientes->fetch();
        return $valor[0];
    }

    // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    {
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }
}
