import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './componentes/header/header.component';
import { FooterComponent } from './componentes/footer/footer.component';
import { HomeComponent } from './componentes/paginas/home/home.component';
import { ImportScriptComponent } from './componentes/import-script/import-script.component';
import { ImportLinkComponent } from './componentes/import-link/import-link.component';
import { NavbarComponent } from './componentes/navbar/navbar.component';
import { ProdutoComponent } from './componentes/paginas/produto/produto.component';
import { CategoriaComponent } from './componentes/paginas/categoria/categoria.component';
import { PedidoComponent } from './componentes/paginas/pedido/pedido.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    HomeComponent,
    ImportScriptComponent,
    ImportLinkComponent,
    NavbarComponent,
    ProdutoComponent,
    CategoriaComponent,
    PedidoComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
