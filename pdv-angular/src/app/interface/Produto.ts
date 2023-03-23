export interface Produto{
  prod_id?: number,
  prod_nome: string,
  prod_preco: number,
  prod_categoria: number,
  categoria_nome?: string,
  created_at?: Date,
  updated_at?: Date
}
