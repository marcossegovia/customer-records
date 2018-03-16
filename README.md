# Customer Records

We have some customer records in a text file (customers.json) -- one customer per line, JSON-encoded. We want to invite any customer within 100km of our Dublin office for some food and drinks on us. Write a program that will read the full list of customers and output the names and user ids of matching customers (within 100km), sorted by User ID (ascending).
- You can use the first formula from [this Wikipedia article](https://en.wikipedia.org/wiki/Great-circle_distance) to calculate distance. Don't forget, you'll need to convert degrees to radians.
- The GPS coordinates for our Dublin office are 53.339428, -6.257664.
- You can find the Customer list [here](https://gist.github.com/brianw/19896c50afa89ad4dec3).

## Install

```bash
git clone https://github.com/marcossegovia/customer-records.git
```

## Run

> On your mac/linux

- You should have [php](https://php-osx.liip.ch/) 7.1.10 on you mac
- You should also have [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx) on your mac

Install dependencies
```bash
composer install
```

To run the test suite
```bash
composer test
```

To run the app
```bash
php index.php
```

> With Docker

- You should have [Docker](https://www.docker.com/community-edition#/download)
- You should also have Docker Compose

To run the test suite
```bash
docker-compose up phpunit
```

To run the app
```bash
docker-compose up php-cli
```

In both cases you should get the test-suite passing when running tests and the output of the customers within 100 kms when running the app.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

