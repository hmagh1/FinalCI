# Instructions de test Postman

Voici les endpoints REST disponibles à tester via Postman :

Base URL : http://localhost:8055

| Méthode | URL               | Corps attendu               | Description               |
|--------|--------------------|-----------------------------|---------------------------|
| GET    | /users             | —                           | Récupérer tous les users  |
| GET    | /users/{id}        | —                           | Récupérer un user par ID  |
| POST   | /users             | name, email (form-data)     | Créer un utilisateur      |
| PUT    | /users/{id}        | name, email (raw JSON)      | Mettre à jour un user     |
| DELETE | /users/{id}        | —                           | Supprimer un utilisateur  |

Exemples :

POST /users
Body (x-www-form-urlencoded) :
- name: Alice
- email: alice@example.com

PUT /users/1
Body (raw JSON) :
{
  "name": "Alice Updated",
  "email": "alice@newmail.com"
}

DELETE /users/1
