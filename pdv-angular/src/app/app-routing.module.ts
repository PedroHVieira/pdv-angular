import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ProdutoComponent } from './componentes/paginas/produto/produto.component';
import { HomeComponent } from './componentes/paginas/home/home.component';
import { CategoriaComponent } from './componentes/paginas/categoria/categoria.component';
import { PedidoComponent } from './componentes/paginas/pedido/pedido.component';

const routes: Routes = [
  {path: '', component: HomeComponent},
  {path: 'produto', component: ProdutoComponent},
  {path: 'categoria', component: CategoriaComponent},
  {path: 'pedido', component: PedidoComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
