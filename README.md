```php
use Web3\Web3;

$web3 = new Web3('http://localhost:8546');
$accounts = $web3->eth()->accounts(); // ['0x407d73d8a49eeb85d32cf465507dd71d507100c1']
```
