## **Informações**

Esse teste foi desenvolvido utilizando SQLITE e LocalStack, para simular um ambiente S3 para armazenamento dos arquivos enviados pelo formulário.

A variável de ambiente `AWS_ENDPOINT`, no `.env`, redireciona para o localhost, como mostrando no `.env.example`. 

### **Forma de Envio**

Para a entrega do teste, siga as instruções abaixo:

1.  Publique o código em um repositório público (como GitHub, GitLab ou Bitbucket).
2.  Envie um e-mail para `dev@paytour.com.br` com o link para o repositório.

---

### **Requisitos do Teste**

O objetivo é criar uma aplicação para envio de currículos. A aplicação deve atender aos seguintes requisitos:

1.  **Formulário:** Crie um formulário com os campos:
    * `Nome`
    * `E-mail`
    * `Telefone`
    * `Cargo Desejado` (campo de texto livre)
    * `Escolaridade` (campo `select`)
    * `Observações`
    * `Arquivo` (para o currículo)
    * `Data e Hora do Envio` (informação a ser gerada automaticamente)

2.  **Testes:** Crie testes unitários para a aplicação.

---

### **Observações e Regras Específicas**

* **Validação de Campos:**
    * Apenas o campo `Observações` é opcional. Todos os outros campos são obrigatórios.
    * Implemente as validações que você considerar necessárias (ex: formato de e-mail, formato de telefone, etc.).

* **Validação de Arquivo:**
    * Apenas arquivos com as extensões **`.doc`**, **`.docx`** ou **`.pdf`** devem ser aceitos.
    * O tamanho máximo do arquivo é de **1MB**.

* **Padrões Técnicos:**
    * Utilize o padrão **PSR-4** de importação (`use`/`namespace`) em vez de `include` ou `require`.
    * As bibliotecas externas devem ser carregadas via **Composer**.
    * A escolha de um framework (ou a ausência dele) é livre.