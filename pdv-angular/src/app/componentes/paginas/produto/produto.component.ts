import { Categoria } from 'src/app/interface/Categoria';
import { Produto } from 'src/app/interface/Produto';
import { Response } from 'src/app/interface/Response';
import { CategoriaService } from 'src/app/service/categoria.service';
import { ProdutoService } from 'src/app/service/produto.service';
import { Component, ElementRef, ViewChild } from '@angular/core';
import { Location } from '@angular/common';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-produto',
  templateUrl: './produto.component.html',
  styleUrls: ['./produto.component.css']
})
export class ProdutoComponent {

  validador:boolean = true;

  formId:number = 0;
  formNome:string = '';
  formPreco:number = 0;
  formCategoria:number = 0;

  produtos: Produto[]= [];
  categorias: Categoria[]= [];
  response: Response = {tipe: '', response: []};
  categoriaAux: Categoria = {cate_id: 0, cate_imposto: 0, cate_nome: '',created_at: new Date(), updated_at: new Date()};

  constructor(
    private lista: ProdutoService,
    private categoria: CategoriaService,
    private location: Location){

    this.getProdutos();
  }

  getProdutos(): void{
    this.lista.getAll().subscribe(response => {
      response.response.forEach((element,indice) => {
        this.produtos.push(element);
        this.setNomeCategoria(this.produtos[indice]);
      });
    });

    this.categoria.getAll().subscribe(response => {
      response.response.forEach((element,indice) => {
        this.categorias.push(element);
      });
    });
  }

  setNomeCategoria(produto:Produto): void{
    this.categoria.getById(produto.prod_categoria).subscribe(response => {
      produto.categoria_nome = response.response.cate_nome;
    });
  }

  salvar():void{
    if(this.formNome != '' && this.formCategoria > 0 && this.formPreco > 0){
      const produto = {
        "nome" : this.formNome,
        "preco" : this.formPreco,
        "categoria" : this.formCategoria
      };

      if(this.validador){
        this.lista.create(produto).subscribe(response => {
          (window as any).location.reload();
        });
      }else if(this.formId > 0){
        this.lista.update(produto, this.formId ).subscribe(response => {
          (window as any).location.reload();
        });
      }
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

  alterar(produto:any):void{
    this.formId = produto.prod_id;
    this.formNome = produto.prod_nome;
    this.formPreco = produto.prod_preco;
    this.formCategoria = produto.prod_categoria;

    this.validador = false;
  }

  deletar(produto:any):void{
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
        this.lista.delete(produto.prod_id).subscribe(response => {
          if(response.tipe == 'error'){
            Swal.fire(
              'Não foi possível deletar!',
              'Ainda tem alguma dependência no sistema...',
              'error'
            )
          }else{
            Swal.fire(
              'Deletado!',
              'O registro foi deletado com sucesso...',
              'success'
            )
            setTimeout(() => {
              (window as any).location.reload();
            }, 1000);
          }
        });
      }
    })
  }
}
