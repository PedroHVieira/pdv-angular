import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Response } from '../interface/Response';

@Injectable({
  providedIn: 'root'
})
export class ProdutoService {

  private apiUrl = "http://localhost/pdv-api/produto";
  private httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json',
      'Authorization': 'Bearer a9cf40d2-a621-4dbf-80f2-fbb2db0230ed'
    })
  };

  constructor(private http: HttpClient) { }

  getAll(): Observable<Response>{
    return this.http.get<Response>(`${this.apiUrl}/listar`, this.httpOptions);
  }

  create(dados:any){
    return this.http.post(`${this.apiUrl}/cadastrar`,dados, this.httpOptions);
  }

  update(dados:any,id:any){
    return this.http.put(`${this.apiUrl}/atualizar/${id}`,dados, this.httpOptions);
  }

  delete(id:any){
    return this.http.delete<Response>(`${this.apiUrl}/deletar/${id}`, this.httpOptions);
  }
}
