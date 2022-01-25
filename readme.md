# Laravel Query Filter

![](laravel_query_filter.jpg)

Laravel query filter is a package that offers you to create filters easy-peasy.

### Installation

```
composer require diar/laravel-query-filter
```

### Usage:

```php
Book::filter()->get();
```

In order to use a filter you have to create a new one by the command that is provided by the package:

```
php artisan make:filter BookFilters
```
This command will create a directory ```Filters``` and ```BookFilters``` class inside. To use the filter method of ```Book``` model use the `Filterable` trait:

```php 
<?php

namespace App\Models;

use Deviar\LaravelQueryFilter\Filters\Filterable;

class Book extends Model
{
    use Filterable;

```
And set the `defaultFilter` of a model by adding:

```php
protected $defaultFilter = BooksFilters::class;
```
if you want to override the default filters just call the `CustomFilter` when calling the filter method:

```php
Book::filter(CustomerFilter::class)->get();
```
The package provides many options in Filter class:

To use attributes in filter like `/books?title=hero&author_id=2` you have to add: 
```php
protected array $allowedFilters  = ['title' , 'author_id']; 
```
To set columns that will be included in search `/books?search=annabel` you have to add:
```php
protected array $columnSearch= ['title','descriptions']; 
```
To search by relationship columns `/books?search=kathlen` you have to add:
```php
protected array $relationSearch = [
    'author' => ['first_name', 'last_name']
]; 
```
To allow relationship model to be loaded `/books?include=author` you have to add:
```php
protected array $allowedIncludes = ['author'];
```
To sort resource by an attribute you have to add:
```php
protected array $allowedSorts= ['created_at'];
// desc : /books?sorts=created_at
// asc  : /books?sorts=-created_at
```
You can create a custom query by creating a new function in the `Filter` class, for example filtering books by publishing date:
```php
public function publish_at($date)
{
    $this->builder->whereDate('publish_at', $date);
}
// /books?publish_at=20151124
```
or filter by relationship:
```php
public function custom($term)
{
    $this->builder->whereHas('options', function($query) => $query->where('custom_id', $term));
}
// /books?custom=33

