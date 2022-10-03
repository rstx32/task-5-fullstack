## run this for the first time
- **php artisan migrate --seed**
- **php artisan passport:client --personal**

command above to create table & sample record, and personal access client for registration API purpose.
and don't forget to run : **npm run dev** at another terminal for bootstrap render.

## disclaimer
 - since laravel does not support PUT (update) method directly while using form-data, we should add key : **_method** and value : **PUT** to update, tested on postman.
 - /api/v1 require authorization, please fill key : **Authorization**, and value **Bearer *jwt_token_here*** 
 - i'm using **image-test.jpg** for all sample articles, so if an article deleted, then another articles sample image is gone.

## relation
| entity | relation | entity
|--|--|--|
| user | has many | categories
| user |has many | articles
| categories | belongs to | user
| articles | belongs to | user
| articles | belongs to | categories
