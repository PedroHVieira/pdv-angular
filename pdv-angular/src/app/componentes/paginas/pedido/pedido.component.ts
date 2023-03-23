import { Component } from '@angular/core';
import Swal from 'sweetalert2';
import { Location } from '@angular/common';
import { Response } from 'src/app/interface/Response';
import { Produto } from 'src/app/interface/Produto';
import { PedidoService } from 'src/app/service/pedido.service';
import { Pedido } from 'src/app/interface/Pedido';
import { ProdutoService } from 'src/app/service/produto.service';
import { ItensPedido } from 'src/app/interface/ItensPedido';
import { CategoriaService } from 'src/app/service/categoria.service';

@Component({
  selector: 'app-pedido',
  templateUrl: './pedido.component.html',
  styleUrls: ['./pedido.component.css']
})
export class PedidoComponent {
  formId:number = 0;
  formNome:string = '';
  formPreco:number = 0;
  formProduto:number = 0;
  formQtd:number = 0;
  id:number = 0;

  totalImposto:number = 0;
  totalBruto:number = 0;
  totalLiquido:number = 0;

  produtos: Produto[]= [];
  pedidos: Pedido[]= [];
  itens: ItensPedido[] = [];
  response: Response = {tipe: '', response: []};

  constructor(
    private pedido: PedidoService,
    private prouto: ProdutoService,
    private categoria: CategoriaService,
    private location: Location){

    this.getPedidos();
  }

  getPedidos(): void{
    this.pedido.getAll().subscribe(response => {
      response.response.forEach((element,indice) => {
        this.pedidos.push(element);
      });
    });

    this.prouto.getAll().subscribe(response => {
      response.response.forEach((element,indice) => {
        this.produtos.push(element);
      });
    });
  }

  salvar():void{
    const pedido = {
      "valor_bruto": this.totalBruto,
      "valor_liquido": this.totalLiquido,
      "imposto_total": this.totalImposto,
      "itens": this.itens
    }

    if(this.itens.length >= 1){
      this.pedido.create(pedido).subscribe(response => {
        (window as any).location.reload();
      });
    }else{
      Swal.fire({
        position: 'top-end',
        icon: 'warning',
        title: 'Necessário inserir pelo menos um Produto!',
        showConfirmButton: false,
        timer: 1500
      })
    }

  }

  deletar(pedido:any):void{
    Swal.fire({
      title: 'Você tem certeza?',
      text: "Essa ação não tem volta!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Sim, pode deletar!',
    }).then((result) => {
      if (result.isConfirmed) {
        this.pedido.delete(pedido.pedi_id).subscribe(response => {
          Swal.fire(
            'Deletado!',
            'O registro foi deletado com sucesso...',
            'success'
          )
          setTimeout(() => {
            (window as any).location.reload();
          }, 1000);
        });
      }
    })
  }

  adicionarPedido():void{
    if(this.formQtd > 0 && this.formProduto > 0){
      const index = this.produtos.findIndex(obj => obj.prod_id == this.formProduto);
      this.categoria.getById(this.produtos[index].prod_categoria).subscribe(response => {
        const item: ItensPedido = {
          qtd : this.formQtd,
          bruto:Number((this.produtos[index].prod_preco*this.formQtd).toFixed(2)),
          liquido: Number(((this.produtos[index].prod_preco*this.formQtd) - (this.produtos[index].prod_preco*response.response.cate_imposto*this.formQtd)).toFixed(2)),
          imposto: Number((this.produtos[index].prod_preco*response.response.cate_imposto*this.formQtd).toFixed(2)),
          produto: this.formProduto,
          nome_produto: this.produtos[index].prod_nome,
          preco_produto: this.produtos[index].prod_preco,
          id: this.id++
        }

        this.totalBruto = Number((this.totalBruto + item.bruto).toFixed(2));
        this.totalLiquido = Number((this.totalLiquido + item.liquido).toFixed(2));
        this.totalImposto =Number((this.totalImposto + item.imposto).toFixed(2));

        this.itens.push(item);
      })
    }else{
      Swal.fire({
        position: 'top-end',
        icon: 'warning',
        title: 'Necessário preencher todos os campos!',
        showConfirmButton: false,
        timer: 1500
      })
    }
  }

  remover(id:any):void{
    const indexItem = this.itens.findIndex(obj => obj.id == id);

    this.totalBruto = Number((this.totalBruto - this.itens[indexItem].bruto).toFixed(2));
    this.totalLiquido = Number((this.totalLiquido - this.itens[indexItem].liquido).toFixed(2));
    this.totalImposto =Number((this.totalImposto - this.itens[indexItem].imposto).toFixed(2));

    this.itens.splice(indexItem,1);
  }
}
