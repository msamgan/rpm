# rpm

role, permission and menu

## Installation

RPM uses a [composer](https://getcomposer.org/) based installation system, use the following command to install.

```composer
    composer require msamgan/rpm
```

## Configuration

To configure the package use the following commands.

#### Run Migrations

```composer
    php artisan migrate
```

#### Add public assets

```composer
    php artisan vendor:publish --tag=public
```

#### Add rpm to middleware list

add the below lines of code to **Http/Kernel.php**

```composer
    use Msamgan\Rpm\RpmMiddleware; //add at the begining
   
    'rpm' => RpmMiddleware::class //add this in $routeMiddleware
```

## How to Use

##### NOTE : rpm comes with a default role "Developer", please assign this role to on user to ger started. To do that add a manual entry in user_roles with role_id  = 1 and user_id = "what so ever is your user ID."

```composer
    visit: https://domain.xyz/roles
```

#### Create Roles

1. Individual roles will be create and manages here. 
2. Assigning Permission to created Roles

#### Create Permission Groups

All the permissions we will create will be grouped together in these groups.

#### Create Permissions



