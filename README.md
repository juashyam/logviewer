# Magento 2 Log and Report Viewer

A simple Magento 2 module which allows all the system logs (**`var/log`**) and system reports (**`var/report`**) to be viewed and downloaded via **`System > System Messages and Errors`** in the admin.

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

##### System Log(s) in backend
![System Log](https://user-images.githubusercontent.com/13532448/56204450-23cb4c00-6065-11e9-865d-c5a6b2f18073.png)

##### System Report(s) in backend
![System Report](https://user-images.githubusercontent.com/13532448/56204486-39d90c80-6065-11e9-800a-722b241fe914.png)

## Authors

[Shyam Kumar](https://github.com/juashyam)

## License

This project is licensed under the MIT License