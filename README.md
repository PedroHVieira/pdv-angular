<h3>Desafio Técnico PHP</h3>
<strong><p>Desenvolva um programa para um mercado que permita:</p></strong>
<ul>
  <li>Cadastro dos produtos;</li>
  <li>Cadastro dos tipos de cada produto;</li>
  <li>Cadastro dos valores percentuais de imposto dos tipos de produtos;</li>
  <li>A tela de venda, onde serão informados os produtos e quantidades adquiridas;</li>
  <li>O sistema deve apresentar o valor de cada item multiplicado pela quantidade adquirida e a
    quantidade pago de imposto em cada item, um totalizador do valor da compra e um
    totalizador do valor dos impostos;</li>
    <li>A venda deverá ser salva;</li>
</ul>
<strong><p>Características do sistemas:</p></strong>
<ul>
  <li>PHP 7.4.4</li>
  <li>PostgreSQL</li>
  <ul>
    <li><b>HOST:</b> localhost</li>
    <li><b>USER:</b> postgres</li>
    <li><b>SENHA:</b> root</li>
    <li><b>BANCO:</b> pdv</li>
    <li><b>PORTA:</b> 5432</li>
   </ul>
  <li>Angular</li>
</ul>
<strong><p>Documentação da API:</p></strong>
<p>Essa API trabalha com 3 entidades, sendo elas: <b>Categoria</b>, <b>Produto</b> e <b>Pedido</b>. Adicionalmente foi inserido uma autenticação em todos os métodos HTTP, sendo essa auteticação do tipo <b>Bearer</b> e já com um <b>token</b> válido salvo no banco de dados, sendo ele: <b>a9cf40d2-a621-4dbf-80f2-fbb2db0230ed</b></p>
<p>Referente as entidades Categoria e Produto, é aceito os seguinte métodos <b>HTTP: GET, DEETE, POST e PUT</b>. Já a entidade Pedido aceita somente os seguinte métodos, <b>HTTP: GET, DELETE e POST</b></p>
<ul>
  <li><b>GET</b> para retornar uma lista:
    <ul>
      <li>url: <b>http://localhost/pdv-api/(nome_da_entidade)/listar</b></li>
    </ul>
  </li>
  <li><b>GET</b> para retornar somente um dado:</li>
  <ul>
    <li>url: <b>http://localhost/pdv-api/(nome_da_entidade)/listar/(id)</b></li>
  </ul>
  <li><b>DELETE</b></li>
  <ul>
    <li>url: <b>http://localhost/pdv-api/(nome_da_entidade)/deletar/(id)</b></li>
  </ul>
  <li><b>POST</b></li>
  <ul>
    <li>url: <b>http://localhost/pdv-api/(nome_da_entidade)/cadastrar</b></li>
  </ul>
  <li><b>PUT</b></li>
  <ul>
    <li>url: <b>http://localhost/pdv-api/(nome_da_entidade)/atualizar/(id)</b></li>
  </ul>
</ul>
<p>Padrões <i>json</i> para serem usados nos métodos <b>PUT</b> e/ou <b>POST</b></p>
<ul>
  <li>Padrão <i>json</i>  para <b>Categoria</b>: <br>
    { <br>
      "nome": "Categoria Teste", <br>
      "imposto": 0.20 <br>
    {<br>
  </li>
  <li>Padrão <i>json</i>  para <b>Produto</b>: <br>
    { <br>
    "nome" : "Produto Teste", <br>
    "preco" : 2.99, <br>
    "categoria" : 1 <br>
    {<br>
  </li>
  <li>Padrão <i>json</i>  para <b>Pedido</b>: <br>
    { <br>
    "valor_bruto": "100",<br>
    "valor_liquido": "90",<br>
    "imposto_total": "10",<br>
    "itens": [<br>
    {<br>
            "qtd": 1,<br>
            "bruto": "60",<br>
            "liquido": "50",<br>
            "imposto": "5",<br>
            "produto": 12<br>
            {,<br>
        {<br>
            "qtd": 1,<br>
            "bruto": "50",<br>
            "liquido": "40",<br>
            "imposto": "5",<br>
            "produto": 12<br>
            {<br>
    ]<br>
    {<br>
  </li>
</ul>
<strong><p>Observações:</p></strong>
<ul>
  <li>Esse sistema foi dividido em dois módulo distintos:</li>
  <ul>
    <ol>
      <li><b>Back-End:</b> Nenhum framework foi utilizado, toda configuração do sistema de API REST foi feita em PHP puro. Para o servidor foi utilizado serviços do <b>Apache</b> para possibilitar o rewrite <b>(.htaccess)</b> e fazer url amigaveis, com isso foi utilizado o programa <strong>XAMPP</strong> e inserido o sistema na pasta <strong>htdocs</strong> do mesmo. </li>
      <li><b>Front-End:</b> Foi utilizado o framework Angular fazendo comunicação com os end-points da API criada no Back-End. Não tive muito intuito de inserir muitos <b>CSS</b>, queria mais mostrar a programação com o Angular.</li>
    </ol>
  </ul>
</ul>
