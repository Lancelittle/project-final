# CS3620_Final 
# Tyler Evans, Lance Walker
</br>
## Database Information:
#### Database name: cs3620
#### Database username: root
#### Database password: 
#### Table name: user
</br>

## Endpoints:
| ACTION | ENDPOINT | NOTES 
| ------ | -------- | ----- |
| create | POST /users |Json Format: { "username":"Don", "is_admin": 1, "is_owner": 0 } (is_admin/is_owner is optional)|
| read | GET /users/{uuid} ||
| update | PUT /users/{uuid} | Json Format: { "username":"Don", "is_admin": 1, "is_owner": 0 } (is_admin/is_owner is optional) |
| delete | DELETE /users/{uuid} |  |
| list | GET /users | Ascending order is default, but you can use /users?sort-username=ASC/DESC |