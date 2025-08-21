<?php 
class Demo { 
    public $file = 'index.php';
    public function __construct($file) {
        $this->file = $file; 
    }
    function __destruct() { 
        echo @highlight_file($this->file, true); //flag在根目录/flag中
    }
}

if (isset($_GET['var'])) {
    @unserialize($_GET['var']); 
} else { 
    highlight_file("index.php"); 
} 
?>
