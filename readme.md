## Prerequisites

- PHP 7.2
- Composer
- Laravel 6.2


## Installation

- Clone git from the Repository (git clone https://github.com/sourcecde/charging_process.git
)
- composer update
- Rename .env.example to .env and provide your database details there.
- Run below mentioned command
```
$ php artisan key:generate
$ php artisan serve
```
- open http://127.0.0.1:8000/rate in your browser for graphical input

## API Testing (POSTMAN or any pther tools)
- http://127.0.0.1:8000/api/rate
- Json Data
```
{
  "rate": { "energy": 0.3, "time": 2, "transaction": 1 },
  "cdr": { "meterStart": 1204307, "timestampStart": "2021-04-05T10:04:00Z", "meterStop": 1215230, "timestampStop": "2021-04-05T11:27:00Z" }
}
```
