# PHP alapú CRUD RestApi

Alapvető CRUD műveletek végrehajtásáért felelős Rest API, PHP nyelven. Adatbázisban tárolt egyedek létrehozását, olvasását és módosítását teszi lehetővé.

Végppontok teszteléséhez ajánlott szoftver: [Postman](https://postman.com)
 
## Műveletek

- Termék-kategóriákhoz kapcsolódó
    -Kategória létrehozása
    -Kategória listázása (láthatók)
    -Minden kategória listázása (rejtettek is)
    -Kategória lekérése (azonosító alapján)
    -Kategória módosítása
- Termékekhez kapcsolódó
    -Termék létrehozása
    -Termék listázása (elérhető)
    -Minden termék listázása (a nem elérhetőek is)
    -Termék lekérése (azonosító alapján)
    -Termék módosítása

##Végpontok
|  Végpont                 | Kérés | Paraméterek    |          Leírás            |
|--------------------------|-------|----------------|----------------------------|
|**/category**             | GET   |-               |Látható kategóriák listázása|
|**/category/main/all**    | GET   |-               |Minden kategória listázása  |
|**/category/create**      | POST  |*name, *visible*|Kategória listázása         |
|**/category/get/*:id***   | GET   |-               |Kategória adatainak lekérése|
|**/category/update/*:id***| POST  |*name, *visible*|Kategória módosítása        |
