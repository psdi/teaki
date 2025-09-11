# teaki
Portmanteau of *tea* and *wiki*.

Teaki is a REST API that returns data on teas, tea sessions,
vendors, and the like.

## Setup
todo

## Routes
| Endpoint     | HTTP Method | Description                                                                  |
|--------------|:-----------:|------------------------------------------------------------------------------|
| `/teas`      |     GET     | Retrieves teas. Supports sorting by `id` and `name` (e.g. `?sort=+id,-name`) |
| `/teas/{id}` |    POST     | Creates a new tea resource. Sample JSON body below.                          |

## Examples
JSON body for POST `/teas`:
```json
{
  "typeId": 1,
  "name": "TEA_NAME",
  "alias": "TEA_ALIAS",
  "harvestYear": 2023,
  "originId": 3,
  "vendor": "TEA_VENDOR",
  "amount": 50,
  "isAvailable": true,
  "remarks": "TEA_REMARKS"
}
```
Teaki will first look for a `nameId`, an `originId`, and a `vendorId`.
If any of these respective values is not available, the values `name`,
`origin`, and `vendor` will be saved as new resources and their identifiers
will then be added to the tea entity.
