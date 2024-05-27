<?php
  // LLAVE PARA ENCRIPTAR
  define("KEY", "MAX");
  define("COD", "AES-128-ECB"); // metodo de encriptacion (NO CAMBIAR)

  // Variables necesarias para realizar la conexion con la base de datos
  $server = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'muebleria';
  #Intenta conectar con la base de datos
  try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
  } catch (PDOException $e) {
    //IMPRIME EL ERROR
    die('Connection Failed: ' . $e->getMessage());
  }