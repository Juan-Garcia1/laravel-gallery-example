<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

An image gallery that uses a one to many relationship.

### Product Table

| id  | name    | desctiption                   | price | image      |
| --- | ------- | ----------------------------- | ----- | ---------- |
| 1   | T-shirt | t-shirt description goes here | 12    | tshirt.jpg |

### Gallery Table

| id  | product_id | image       |
| --- | ---------- | ----------- |
| 1   | 1          | image-1.jpg |
| 2   | 1          | image-2.jpg |
| 3   | 1          | image-3.jpg |
