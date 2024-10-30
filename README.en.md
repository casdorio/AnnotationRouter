# Annotation Router for CodeIgniter 4

**Available in: [Português](README.md)**

## Description

The **annotation-router** is a package for CodeIgniter 4 that allows the use of annotations or attributes in controllers without modifying the framework's configuration. With this package, you can define routes directly in controller classes, improving code organization and readability.

**Note**: This project is still in testing and development. However, it is currently functioning perfectly.

## Requirements

-   PHP 8.0 or higher
-   CodeIgniter 4.x

## Installation

### 1. Install via Composer

Run the following command in the terminal within your CodeIgniter project directory:

```bash
composer require casdorio/annotation-router
```

## Usage

### Defining Controllers

You can use both annotations and attributes to define controllers and their routes. **If both are used, attributes will take precedence over annotations.**

#### Using Annotations

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
        // Logic to return items
    }

    /**
     * @Route(method:"POST", path:"items", options:['filter' => 'roles:user,admin'])
     */
    public function createItem()
    {
        // Logic to create an item
    }
}
```

#### Using Attributes

```php
#[Controller(path: 'api/v2', options: ['filters' => 'roles:user,admin'])]
class MyController extends BaseController
{
    #[Route(method: 'GET', path: 'items', options: ['filters' =>'roles:user,admin'])]
    public function getItems()
    {
        // Logic to return items
    }

    #[Route(method: 'POST', path: 'items', options: ['filters' => 'roles:user,admin'])]
    public function createItem()
    {
        // Logic to create an item
    }
}
```

### Controllers Without Groups

If a controller is not defined as part of a group, it should still be added as a controller using the `Controller` annotation or attribute.

#### Example of a Simple Controller

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

### Possible Options

The options accepted in `Controller` and `Route` include, but are not limited to:

-   **namespace**: The namespace where the controller is located.
-   **filters**: One or more filters that should be applied to this controller or method.
-   **methods**: Allowed HTTP methods for the route (GET, POST, PUT, DELETE, etc.).
-   **options**: Any other configuration that the CodeIgniter router allows.

### Notes

-   **Controller Detection**: For a controller to be detected, it must have a `Controller` annotation or attribute. This applies to both group controllers and simple controllers without a group.
-   **Options**: Options can be used in both the `Controller` annotation and the `Route` annotation, allowing parameters like namespace, filters, etc.

### Route Visualization

To view the registered routes, access the URL `http://your_domain/routes`. The routes will only be displayed if the application is in development mode.

## Development Environment

Routes will only be displayed if you are in development mode. Make sure your environment configuration is set correctly to see the routes.

## Contribution

Feel free to contribute to the project. To do so:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/your-feature-name`).
3. Make your changes and commit (`git commit -m 'Add new feature'`).
4. Push to your repository (`git push origin feature/your-feature-name`).
5. Create a Pull Request.

## License

This project is licensed under the [MIT License](LICENSE).
