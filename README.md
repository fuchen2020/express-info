<h1 align="center"> express-info </h1>

<p align="center"> a express info sdk.</p>


## Installing

```shell
$ composer require fuchen2020/express-info -vvv
```

## Usage
```php
require __DIR__ .'/vendor/autoload.php';

use Fuchen2020\ExpressInfo\Express;
//快递100开放授权 API Key
$key = '*****************';//客户授权key
$customer = '*****************';//查询公司编号
$exp = new Express($key,$customer);
echo "获取实时快递轨迹：\n";
$response = $exp->getExpressInfo('zhongtong','77110160482518');
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/fuchen2020/express-info/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/fuchen2020/express-info/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT
