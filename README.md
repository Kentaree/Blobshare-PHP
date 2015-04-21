# Blobshare-PHP
Simple PHP interface for http://blobshare.rocks

Simply store and retrieve blobs of JSON from PHP.

## Usage

Instantiate the BlobShare class

```php
$bs = new BlobShare();

```

Retrieving a blob of JSON

```php
$json = $bs->get('Blobname');

```

Adding a new blob

```php
$json = array('Somekey'=>'SomeOtherValue', 'NewKey'=>'NewValue');
$res = $bs->add('Blobname',$json);

```

Updating a blob

```php
$res = $bs->update('Blobname',$json);

```

Deleting a new blob

```php
$res = $bs->delete('Blobname',$json);

```



