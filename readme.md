# README

## To run:
In the command line, type:

```
docker-compose build
docker-compose up
```
Then, in the web browser, visit `http://localhost:80`

## Assumptions:
* Assumed that the search fields should behave as "AND" instead of "OR"
* Assumed that the language in the search can just be the language code rather than the language name
* Assumed that country data does not change so does not need to be updated at any point once in the database
* Assumed that if there is matching data in the database, do not look up using the API as a match has been found.  This means that there may be more data available that will not be found unless an exact search is performed.
