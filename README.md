![Log Viewer](https://user-images.githubusercontent.com/13532448/123785726-816eaa80-d8f6-11eb-801c-47aa8596a5e6.png)

[![Latest Stable Version](http://poser.pugx.org/juashyam/logviewer/v)](https://packagist.org/packages/juashyam/logviewer)
[![Total Downloads](http://poser.pugx.org/juashyam/logviewer/downloads)](https://packagist.org/packages/juashyam/logviewer)
[![License](http://poser.pugx.org/juashyam/logviewer/license)](https://packagist.org/packages/juashyam/logviewer)

A simple Magento 2 module to view system logs (**`var/log`**) and system reports (**`var/report`**) in the Admin.

## Installation

```
composer require juashyam/logviewer
php bin/magento module:enable Juashyam_LogViewer
php bin/magento setup:upgrade
```

## Features
- Shows all log and report files recursively in a tree
- Allows log and report files to be downloaded
- Supports ACL to restrict access to the log and report files
- Zero configuration 


## Preview

> Admin → System → System Messages and Errors

##### System Log(s) in backend
![System Log](https://user-images.githubusercontent.com/13532448/56204450-23cb4c00-6065-11e9-865d-c5a6b2f18073.png)

##### System Report(s) in backend
![System Report](https://user-images.githubusercontent.com/13532448/56204486-39d90c80-6065-11e9-800a-722b241fe914.png)

## Authors

[Shyam Kumar](https://github.com/juashyam)

## License

This project is licensed under the MIT License
