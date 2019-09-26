# arkiv_meta_client
Test klient til arkivmeta og arkivkort API. Klienten kan benyttes som inspiration hvis du ønsker at udvikle en klient oven på API'et. API dokumentation 

Applikationen er skrevet i Php. Der anvendes diverse eksterne libraries fx [jQuery](https://jquery.com/), [Bootstrap](https://getbootstrap.com/) og [OpenSeadragon](https://openseadragon.github.io/). Alle libraries er lagret lokalt.

**[Demo app](https://apps.kortforsyningen.dk/arkivkort/)**

## Beskrivelse af filer og mapper
* **index.php** - forsiden af applikationen. Her vælger brugeren kriterier til søgning.
* **viewSearchResult.php** - viser brugeren resultatet af en søgning. I praksis foretages søgningen vha. et AJAX kald til getSearchResult.php, som vil returnere JSON med info for hvert kort, der er indeholdt i søgeresultatet. Hvert søgeresultat vil vises inkl. et link til viewImage.php?id=XXX hvor XXX er kortets unikke id.
* **viewImage.php** - viser kortet (raster) samt få metadata for kortet. Der kan panoreres og zoomes i kortet.
* **getSearchResult.php** - fil, der forespørger databasen og returnerer data i JSON. Kaldes via AJAX.
* **/css** - indeholder CSS. Filen application.css indeholder CSS klasser specifikt til denne applikation. Alle andre CSS filer stammer fra eksterne libraries.
* **/fonts** - indeholder Font Awesome filer
* **/js** - indeholder diverse eksterne JavaScript moduler fx jQuery, Bootstrap, diverse Bootstrap udvidelser, OpenSeadragon
* **/Classes** - indeholder diverse hjælpeklasser fx cURL kald til Kortforsyningen/Arkiv API samt opbygning af HTML5 dokument
