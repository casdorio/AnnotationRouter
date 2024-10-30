````markdown
# Annotation Router for CodeIgniter 4

**Available in: [English](README.en.md)**

## Descrição

O **annotation-router** é um pacote para CodeIgniter 4 que permite usar anotações ou atributos em controladores sem modificar a configuração do framework. Com este pacote, você pode definir rotas diretamente nas classes de controle, melhorando a organização e a legibilidade do código.

**Observação**: Este projeto ainda está em fase de testes e desenvolvimento. No entanto, a princípio, está funcionando perfeitamente.

## Requisitos

-   PHP 8.0 ou superior
-   CodeIgniter 4.x

## Instalação

### 1. Instalar via Composer

Execute o seguinte comando no terminal dentro do diretório do seu projeto CodeIgniter:

```bash
composer require casdorio/annotation-router
```
````

## Uso

### Definição de Controladores

Você pode usar tanto anotações quanto atributos para definir controladores e suas rotas. **Caso ambos sejam utilizados, os atributos prevalecerão sobre as anotações.**

#### Usando Anotações

```php
/**
 * @Controller(path:"api/v1", options:['filter' => 'roles:user,admin'])
 */
class MyController extends BaseController
{
    /**
     * @Route(method:"GET", path:"items", options:['filter' => 'roles:user,admin'])
     */
    public function getItems()
    {
        // Lógica para retornar itens
    }

    /**
     * @Route(method:"POST", path:"items", options:['filter' => 'roles:user,admin'])
     */
    public function createItem()
    {
        // Lógica para criar um item
    }
}
```

#### Usando Atributos

```php
#[Controller(path: 'api/v2', options: ['filters' => 'roles:user,admin'])]
class MyController extends BaseController
{
    #[Route(method: 'GET', path: 'items', options: ['filters' =>'roles:user,admin'])]
    public function getItems()
    {
        // Lógica para retornar itens
    }

    #[Route(method: 'POST', path: 'items', options: ['filters' => 'roles:user,admin'])]
    public function createItem()
    {
        // Lógica para criar um item
    }
}
```

### Controladores Sem Grupo

Se um controlador não estiver definido como parte de um grupo, ele ainda deve ser adicionado como controlador usando a anotação ou atributo `Controller`.

#### Exemplo de Controlador Simples

```php
#[Controller]
class SimpleController extends BaseController
{
    #[Route(method: 'GET', path: 'status')]
    public function status()
    {
        return 'OK';
    }
}
```

### Opções Possíveis

As opções aceitas em `Controller` e `Route` incluem, mas não se limitam a:

-   **namespace**: O namespace onde o controlador está localizado.
-   **filters**: Um ou mais filtros que devem ser aplicados a este controlador ou método.
-   **methods**: Métodos HTTP permitidos para a rota (GET, POST, PUT, DELETE, etc.).
-   **options**: Qualquer outra configuração que o roteador do CodeIgniter permita.

### Observações

-   **Detecção de Controladores**: Para que um controlador seja detectado, ele deve ter uma anotação ou atributo `Controller`. Isso se aplica tanto a controladores que definem um grupo quanto a controladores simples sem grupo.
-   **Opções**: As opções podem ser utilizadas tanto na anotação `Controller` quanto na anotação `Route`, permitindo passar parâmetros como namespace, filtros, etc.

### Visualização de Rotas

Para visualizar as rotas cadastradas, acesse a URL `http://seu_dominio/routes`. As rotas só serão exibidas se o aplicativo estiver em modo de desenvolvimento.

## Ambiente de Desenvolvimento

As rotas só serão exibidas se você estiver em modo de desenvolvimento. Certifique-se de que sua configuração de ambiente esteja definida corretamente para ver as rotas.

## Contribuição

Sinta-se à vontade para contribuir para o projeto. Para isso:

1. Faça um fork do repositório.
2. Crie uma nova branch (`git checkout -b feature/nome-da-sua-funcionalidade`).
3. Faça suas alterações e commit (`git commit -m 'Adiciona nova funcionalidade'`).
4. Envie para o seu repositório (`git push origin feature/nome-da-sua-funcionalidade`).
5. Crie um Pull Request.

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

```



```
