# CodeIgniter Boilerplate
> My Personal boilerplate for faster development

## Highlight
+ Codeigniter 3.1.9
+ Laravel blade
+ [MY_Model](https://github.com/avenirer/CodeIgniter-MY_Model)

### Install
```bash
cd application
composer install
```

### Usage
Just code!

##### Model
```php
<?php

class Table_Model extends MY_Model
{
	public $table = 'table_name';
	public $primary_key = 'id';
	public $fillable = array();
	public $protected = array(); 

	public function __construct()
	{
		parent::__construct();
	}
}
```
