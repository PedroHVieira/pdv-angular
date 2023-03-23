import { ItensPedido } from "./ItensPedido";

export interface Pedido{
  pedi_id?: number,
  pedi_valo_bruto: number,
  pedi_valor_liquido: number,
  pedi_valor_imposto: number,
  created_at?: Date,
  updated_at?: Date,
  itens: ItensPedido[]
}
