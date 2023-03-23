<?php

namespace Util;

abstract class Constantes
{
    /* REQUESTS */
    public const TIPO_REQUEST = ['GET', 'POST', 'DELETE', 'PUT'];
    public const TIPO_GET = ['PRODUTO','CATEGORIA','PEDIDO'];
    public const TIPO_POST = ['PRODUTO','CATEGORIA','PEDIDO'];
    public const TIPO_DELETE = ['PRODUTO','CATEGORIA','PEDIDO'];
    public const TIPO_PUT = ['PRODUTO','CATEGORIA'];
    public const PREFIX_TABLE = ['produto' => 'prod_','categoria' => 'cate_', 'pedido' => 'pedi_'];
    public const TABELA_ROTA = ['PRODUTO' => 'produto','CATEGORIA' => 'categoria', 'PEDIDO' => 'pedido'];

    /* ERROS */
    public const MSG_ERRO_TIPO_ROTA = 'Rota não permitida!';
    public const MSG_PARAMETRO_NAO_AUTORIZADO = 'Algum dos parâmetros enviado não está no padrão correto!';
    public const MSG_ERRO_RECURSO_INEXISTENTE = 'Recurso inexistente!';
    public const MSG_ERRO_GENERICO = 'Algum erro ocorreu na requisição!';
    public const MSG_ERRO_GENERICO_DEPENDENCIA = 'Algum erro ocorreu na requisição! Pode ser que ainda não esteja criado a Categoria do Produto';
    public const MSG_ERRO_SEM_RETORNO = 'Nenhum registro encontrado ou ainda tem dependência no sistema!';
    public const MSG_ERRO_NAO_AFETADO = 'Nenhum registro afetado!';
    public const MSG_ERRO_TOKEN_VAZIO = 'É necessário informar um Token!';
    public const MSG_ERRO_TOKEN_NAO_AUTORIZADO = 'Token não autorizado!';
    public const MSG_ERRO_JSON_VAZIO = 'O Corpo da requisição não pode ser vazio!';

    /* SUCESSO */
    public const MSG_DELETADO_SUCESSO = 'Registro deletado com Sucesso!';
    public const MSG_ATUALIZADO_SUCESSO = 'Registro atualizado com Sucesso!';

    /* RECURSO USUARIOS */
    public const MSG_ERRO_ID_OBRIGATORIO = 'ID é obrigatório!';    
    public const MSG_ERRO_CAMPOS_OBRIGATORIO = 'Ainda falta campos a serem preenchidos!';

    /* RETORNO JSON */
    const TIPO_SUCESSO = 'success'; 
    const TIPO_ERRO = 'error';

    /* OUTRAS */    
    public const TIPO = 'tipe';
    public const RESPOSTA = 'response';
}