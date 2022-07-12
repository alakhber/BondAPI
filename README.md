## Requirements
- PHP >= 8.0
- BCMath PHP Extension
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## API Description
### Get Bond Payout Dates
* Method: GET
* Route: `http://localhost:8000/api/bond/{id}/payouts`
##### Param id
* With: path
* Description: Bond Id
* Required: true
* Example: 1
* Type: int
### Bond Order  
* Method: POST
* Route: `http://localhost:8000/api/{id}/order`
##### Param id
* With: path
* Description: Bond Id
* Required: true
* Example: 1
* Type: int
##### Param order_date
* With: query
* Description: Bond Order Date
* Required: true
* Format: Year-month-day
* Example: 2021-01-25
* Type: date
##### Param bond_received
* With: query
* Description: Number Of Bonds Received
* Required: true
* Example: 5
* Type: int

### Bond Order Interest Payments
* Method: POST
* Route: `http://localhost:8000/api/order/{id}`
##### Param id
* With: path
* Description: ID Of The Received Bond
* Required: true
* Example: 1
* Type: int

## Note
##### If you are going to use POSTMAN or a similar program, please read the above carefully. Otherwise, once the installation is complete, visit the link mentioned below
http://127.0.0.1:8000/v1/api/list
