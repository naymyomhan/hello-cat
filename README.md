
# Hello Cat

<p align="center">
  <img src="resources/hello-cat.png" alt="Hello Cat Logo" width="500"/>
</p>


A simple Laravel package to get random cat images. This package provides two main functions to retrieve a single cat image or multiple images with optional breed filters.

<p align="center">
  <img src="resources/screenshot.png" alt="Hello Cat Logo" width="800px"/>
</p>

## Installation

To install the package via Composer, use:

```bash
composer require naymyomhan/hello-cat
```

After installation, publish the configuration file to set up your API key:

```bash
php artisan vendor:publish --tag=hello-cat
```


Set your `CAT_API_KEY` in the `.env` file:(optional)

```
CAT_API_KEY=your-cat-api-key-here
```

## Usage

This package provides two main classes: `Cat` and `CatGroup`.

### 1. Get a Single Random Cat Image

You can use the `Cat` class to fetch a single random cat image.

```php
use Naymyomhan\HelloCat\Cat;

$cat = new Cat(); 
$response = $cat->image();
```

Example JSON Response
```json
{
    "success": true,
    "message": "OK",
    "data": {
        "image": "https://cdn2.thecatapi.com/images/abc.jpg",
        "width": 500,
        "height": 400
    }
}
```

### 2. Get Multiple Random Cat Images
The `CatGroup` class allows you to retrieve multiple random cat images with optional breed filtering.
```php
use Naymyomhan\HelloCat\CatGroup;

$catGroup = new CatGroup();
$response = $catGroup->images(5, 'beng'); // Fetch 5 images of 'beng' breed
```

Example JSON Response

```json
{
    "success": true,
    "message": "OK",
    "data": [
        {
            "url": "https://cdn2.thecatapi.com/images/abc.jpg",
            "width": 500,
            "height": 400
        },
        {
            "url": "https://cdn2.thecatapi.com/images/xyz.jpg",
            "width": 600,
            "height": 450
        }
        // Additional images
    ]
}
```

    
### Credits
This package uses [The Cat API](https://thecatapi.com/) to fetch random cat images. A big thank you to them for providing such an awesome service!

### Error Handling
The `CatGroup` class allows you to retrieve multiple random cat images with optional breed filtering.
```json   
{
    "success": false,
    "message": "Something went wrong"
}
```
## License

This package is open-source software licensed under the MIT license.


### Additional Notes

- Make sure to replace `"your-cat-api-key-here"` with an actual API key from [The Cat API](https://thecatapi.com/).
- Customize the package configuration as needed, especially if you have more environment settings.

This `README.md` file provides clear instructions for installation, configuration, and usage of the package's two functions.
