<?php
include_once('funcoes.php');

class AgendaException extends Exception {
}

class Agenda {
    function listar() {
        $conexao = conectar();
        $consulta = $conexao->prepare("SELECT * FROM contatos");
        $lista = array();
        if ($consulta->execute()) {
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $lista[] = $linha;
            }
        }
        return $lista;
    }
    function validar($contato) {
        if ($contato['nome'] == '') {
            throw new AgendaException('Nome não pode ser em branco!');
        }
    }
    function cadastrar($contato) {
        $this->validar($contato);
    
        $conexao = conectar();
        $sql = "INSERT INTO contatos (nome, telefone, ano) VALUES (?, ?, ?)";
        $st = $conexao->prepare($sql);
        $st->bindParam(1, $contato['nome']);
        $st->bindParam(2, $contato['telefone']);
        $st->bindParam(3, $contato['ano']);
        $st->execute();
        $id = $conexao->lastInsertId();
        
        return $id;
    }
    function procurar($nome) {
        $conexao = conectar();
        $sql = "SELECT * FROM contatos WHERE nome like ?";
        $consulta = $conexao->prepare($sql);
        $consulta->bindParam(1, $nome);
    
        $contatos = array();
        if ($consulta->execute()) {
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $contatos[] = $linha;
            }
        }
        return $contatos;
    }
    function autenticar($usuario, $senha) {
        $conexao = conectar();
        $sql = "SELECT * FROM contatos WHERE nome=? and telefone=?";
        $consulta = $conexao->prepare($sql);
        $consulta->bindParam(1, $usuario);
        $consulta->bindParam(2, $senha);
        try {
            $consulta->execute();
            if ($contato = $consulta->fetch(PDO::FETCH_ASSOC)) {
                return $contato;
            }
        } catch (Exception $e) {}
        return null;
    }

}
