# Almoxarifado
Projeto para o 5º Ciclo de ADS

## Como instalar

* Gere o código SSH na sua máquina com ```ssh-keygen```
* Copie o código em ```C:\Users\<usuario>\.ssh\id_rsa.pub``` do sshkeygen para as suas configurações de conta no Github
* Instale o Git
* Escolha uma pasta para replicar o seu projeto
* Vá na pasta e abra o PowerShell do Windows ou GitShell
* Execute o comando ```git clone git@github.com:gu-nogueira/Almoxarifado.git```

## Como dar commit e push

* Entre na pasta do projeto com o Powershell
* Digite ```git status``` para saber o status das alterações
* Digite ```git pull origin master``` para baixar as atualizações do projeto
* Digite ```git add <arquivos>``` para adicionar arquivos para commitar
* Digite ```git commit -m "Mensagem"``` para criar o commit das alterações
* Digite ```git push origin master``` para dar push nas suas alterações 

## Afazeres

* [x] Cadastro de fornecedores;
* [x] Cadastro de produtos;
* [x] Cadastro de categorias;
* [x] Cadastro de requisições;
* [x] Consulta de fornecedores;
* [x] Delete e update de fornecedores;
* [x] Consulta de produtos;
* [X] Delete e update de produtos;
* [x] Consulta de categorias;
* [x] Delete e update de categorias;
* [x] Consulta de requisições;
* [x] Dar baixa nass requisições;
* [x] Delete de requisições; `del_requisicao.php`
* [x] Função para pegar a data de hoje em `requisicao.php`;
* [x] Fazer `rel_requisitante.php`;
* [x] Fazer `del_requisitante.php`;
* [x] Fazer `upd_requisitante.php`;
* [x] Fazer `rel_users.php`;
* [x] Fazer `del_users.php`;
* [x] Fazer `upd_users.php`;
* [x] Construir a dashboard na tela `welcome.php`;
* [ ] Ajustar elementos em `profile.php`;
* [ ] Ajustar elementos do menu de navegação superior em `home.php`;
* [x] Ajustar menu lateral em `home.php`, separar em cadastros e relatórios;
* [ ] Ajustar inputs;