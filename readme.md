## Wordpress custom rest API endpoint

Create custom rest API endpoint for your Wordpress site. Just include this php file in your functions.php.

Endpoint url:

```
https://yoursite.com/wp-json/custom/v1/custom-data
```

Edit the post type argument to include the data required.

```php
'post_type' => array( 'post', 'page', 'my-custom-post-type' )
```

### Advanced Custom Fields

You can also include Advanced Custom Fields data in your endpoint. In this case I'm retrieving the url of a file from an ACF file upload field called 'file'.

```php
$post_document = "";
if(get_field( 'file', $id )){
    $post_document = get_field( 'file', $id )['url'];
}
```

### Credit

Grazianodev, from his answer on [Stackexchange](https://wordpress.stackexchange.com/questions/298447/fetch-all-posts-including-those-using-a-custom-post-type-with-wordpress-api).
