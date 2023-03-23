export interface ItensPedido{
  qtd: number,
  bruto: number,
  liquido: number,
  imposto: number,
  created_at?: Date,
  updated_at?: Date,
  produto: number,
  pedido?: number,
  nome_produto?: string,
  preco_produto?: number,
  id?: number
}
