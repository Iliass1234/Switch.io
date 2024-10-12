# TC CMB2 AJAX Search

Aggiunge un Custom Field Type di CMB2
per selezionare dei post tramite un input di ricerca.

## Basic usage

* L'input di ricerca può essere attivato in qualsiasi campo di CMB2 definendolo nel parametro "type".
* Per specificare il Post Type da ricercare bisogna specificare il parametro "post_type"

### Esempio:

```php
$cmb->add_field(array(
'name' => 'Ricerca Pagina',
'id' => 'tc_search_page',
'type' => 'tc_ajax_search',
'desc' => 'Descrizione',
'post_type' => 'page',
));
```

## Filtrare la query

* Per filtrare la query eseguita dal plugin è sufficiente agganciarsi all'hook **tc_cmb2_ajax_search_filter_query**
* E' obbligatorio inserire l'attributo data-tc-id nel **setup del custom field** per far funzionare il filtro
* In **fase di aggancio** riportiamo l'esempio di una query che cerca i post assegnati ad un a determinata categoria, in
  base al tc-id del campo e alla pagina dove mi trovo (parametro $queryString)

## Filtrare il risultato della query

* Per filtrare la query eseguita dal plugin è sufficiente agganciarsi all'hook **tc_cmb2_ajax_search_filter_result**
* Valgono le stesse regole e specifiche di **tc_cmb2_ajax_search_filter_query** tenendo conto che filtriamo il risultato di una
* query già avvenuta
### Setup del custom field:

```php
$cmb->add_field(array(
'name' => 'Ricerca Pagina',
'id' => 'tc_search_page',
'type' => 'tc_ajax_search',
'desc' => 'Descrizione',
'post_type' => 'page',
'attributes' => [
'data-tc-id' => 'filter_query_example_field'
],
)); 
```

### Fase di aggancio:

```php
add_filter('tc_cmb2_ajax_search_filter_query', function ($sql, $tcFieldID, $searchTerm, $postType, $queryString) {
global $wpdb;
if ($tcFieldID === 'filter_query_example_field' && isset($queryString['tag_ID'])) {
$sql = $wpdb->prepare(
'SELECT * FROM %1$s LEFT JOIN %2$s   as t ON ID = t.object_id WHERE post_type = "%3$s" AND post_status="publish" AND post_title LIKE "%4$s" AND t.term_taxonomy_id = "%5$s"', $wpdb->posts, $wpdb->term_relationships,
$postType, '%' . $searchTerm . '%', "6"        ); 
} 
return $sql;
}, 10, 5);
```
