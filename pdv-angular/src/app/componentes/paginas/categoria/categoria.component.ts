import { Component } from '@angular/core';
import { Categoria } from 'src/app/interface/Categoria';
import { Response } from 'src/app/interface/Response';
import { CategoriaService } from 'src/app/service/categoria.service';
import Swal from 'sweetalert2';
import { Location } from '@angular/common';

@Component({
  selector: 'app-categoria',
  templateUrl: './categoria.component.html',
  styleUrls: ['./categoria.component.css']
})
export class CategoriaComponent {
  validador:boolean = true;

  formId:number = 0;
  formNome:string = '';
  formImposto:number = 0;

  categorias: Categoria[]= [];
  response: Response = {tipe: '', response: []};

  constructor(
    private categoria: CategoriaService,
    private location: Location){

    this.getCategorias();
  }

  getCategorias(): void{
    this.categoria.getAll().subscribe(response => {
      response.response.forEach((element,indice) => {
        this.categorias.push(element);
      });
    });
  }

  salvar():void{
    if(this.formNome != '' && this.formImposto > 0){
      const categoria = {
        "nome" : this.formNome,
        "imposto" : this.formImposto/100,
      };

      if(this.validador){
        this.categoria.create(categoria).subscribe(response => {
          (window as any).location.reload();
        });
      }else if(this.formId > 0){
        this.categoria.update(categoria, this.formId ).subscribe(response => {
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

  alterar(item:any):void{
    this.formId = item.cate_id;
    this.formNome = item.cate_nome;
    this.formImposto = item.cate_imposto*100;

    this.validador = false;
  }

  deletar(categoria:any):void{
    Swal.fire('Mensagem de sucesso!', 'Operação concluída com sucesso.', 'success');
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
        this.categoria.delete(categoria.cate_id).subscribe(response => {
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
