<?php
/**
 * TechAssist - Sistema de Aprendizaje Interactivo
 * Copyright (c) 2024 TechAssist
 * Autor: Angel Jesús Romero Pérez
 * 
 * Este archivo es parte de TechAssist y está protegido por derechos de autor.
 * Uso no autorizado de este código está prohibido.
 * 
 * @package TechAssist
 * @author Angel Jesús Romero Pérez
 * @copyright 2024 TechAssist
 */
class Database {
    private $conn = null;
    private $host = "localhost";
    private $user = "u409226135_TechAssistRoot";
    private $pass = "TechAssist1234";
    private $db = "u409226135_tech_assist";
    
    public function __construct() {
        try {
            $this->conn = new mysqli(
                $this->host,
                $this->user,
                $this->pass,
                $this->db
            );

            if ($this->conn->connect_error) {
                throw new Exception("Error de conexión: " . $this->conn->connect_error);
            }

            $this->conn->set_charset("utf8");

        } catch (Exception $e) {
            error_log($e->getMessage());
            throw new Exception('Error al conectar con la base de datos');
        }
    }

    public function getConnection() {
        if ($this->conn === null) {
            throw new Exception('No hay conexión establecida');
        }
        return $this->conn;
    }

    public function close() {
        if ($this->conn) {
            $this->conn->close();
            $this->conn = null;
        }
    }

    public function query($sql) {
        if ($this->conn === null) {
            throw new Exception('No hay conexión establecida');
        }
        return $this->conn->query($sql);
    }

    public function prepare($sql) {
        if ($this->conn === null) {
            throw new Exception('No hay conexión establecida');
        }
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception('Error preparando consulta: ' . $this->conn->error);
        }
        return $stmt;
    }

    public function escapeString($str) {
        if ($this->conn === null) {
            throw new Exception('No hay conexión establecida');
        }
        return $this->conn->real_escape_string($str);
    }

    public function beginTransaction() {
        if ($this->conn === null) {
            throw new Exception('No hay conexión establecida');
        }
        $this->conn->begin_transaction();
    }

    public function commit() {
        if ($this->conn === null) {
            throw new Exception('No hay conexión establecida');
        }
        $this->conn->commit();
    }

    public function rollback() {
        if ($this->conn === null) {
            throw new Exception('No hay conexión establecida');
        }
        $this->conn->rollback();
    }
}