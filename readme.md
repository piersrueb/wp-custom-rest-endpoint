## Wordpress custom rest API endpoint

Create custom rest API endpoint for your Wordpress site. You can also include advanced Custom Fields data fields. Just include this php file in your functions.php.

Endpoint url:

```
https://yoursite.com/wp-json/custom/v1/custom
```

Edit the post type argument to include the data required.

```php
'post_type' => array( 'post', 'page', 'my-custom-post-type' )
```

### Credit

Grazianodev, from his answer on [Stackexchange](https://wordpress.stackexchange.com/questions/298447/fetch-all-posts-including-those-using-a-custom-post-type-with-wordpress-api).
