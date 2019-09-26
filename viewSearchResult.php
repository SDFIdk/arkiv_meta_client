<?php
    include_once __DIR__.'/Classes/Document.php';
    
    // Get search criterias
    $input = filter_input_array(INPUT_GET);
    $kortvaerk = !empty($input['kortvaerk']) ? filter_var($input['kortvaerk'], FILTER_SANITIZE_STRING) : null;
    $daekningsomraade = !empty($input['daekningsomraade']) ? filter_var($input['daekningsomraade'], FILTER_SANITIZE_STRING) : null;
    $maalestok = !empty($input['maalestok']) ? filter_var($input['maalestok'], FILTER_SANITIZE_STRING) : null;
    $titel = !empty($input['titel']) ? filter_var($input['titel'], FILTER_SANITIZE_STRING) : null;
    $gyldighedsaar = !empty($input['gyldighedsaar']) ? filter_var($input['gyldighedsaar'], FILTER_SANITIZE_NUMBER_INT) : NULL;
    $kortbladnummer = !empty($input['kortbladnummer']) ? filter_var($input['kortbladnummer'], FILTER_SANITIZE_STRING) : null;
    $bemaerk = !empty($input['bemaerk']) ? filter_var($input['bemaerk'], FILTER_SANITIZE_STRING) : null;
    $geometri = !empty($input['geometri']) ? filter_var($input['geometri'], FILTER_SANITIZE_STRING) : null;

    // serialize search criteria to JSON
    $params = json_encode(array(
        "kortvaerk" => $kortvaerk,
        "daekningsomraade" => $daekningsomraade,
        "maalestok" => $maalestok,
        "titel" => $titel,
        "gyldighedsaar" => $gyldighedsaar,
        "kortbladnummer" => $kortbladnummer,
        "bemaerk" => $bemaerk,
        "geometri" => $geometri,
    ));
    
    // Make document
    $document = new Document("Arkivdata");
    $document->generateDocumentStartHTML(
        [
            "js/bootstrap-table-1.14.1/bootstrap-table.min.js",
            "js/bootstrap-table-1.14.1/bootstrap-table-locale-all.min.js"
        ],
        ["css/bootstrap-table-1.14.1/bootstrap-table.min.css"]
    );
?>    
<h1>Søgeresultater</h1>
    <div class="row">
        <div class="col-md-12">
            <table 
                class="table table-hover" 
                id="searchResultTable" 
                data-sort-order="asc" 
                data-sort-name="id" 
                data-toggle="table" 
                data-remember-order="true" 
                data-show-columns="true" 
                data-pagination="true" 
                data-page-size="100" 
                data-side-pagination="server"
                data-url="getSearchResult.php"
                data-query-params="queryParams"
                data-method="get" 
                data-locale="da_DK">
                <thead>
                    <tr>
                        <th data-sortable="true" data-field="id" data-formatter="">Id</th>
                        <th data-sortable="true" data-field="kortvaerk" data-formatter="">Kortvaerk</th>
                        <th data-sortable="true" data-field="titel" data-formatter="">Titel</th>
                        <th data-sortable="false" data-field="kortbladnummer" data-formatter="">Kortbladnummer</th>
                        <th data-sortable="true" data-field="maalestok" data-formatter="">Målestok</th>
                        <th data-sortable="true" data-field="daekningsomraade" data-formatter="formatDaekningsomraade">Dækningsområde</th>
                        <th data-sortable="true" data-field="gaeldendefra" data-formatter="">Gældende fra</th>
                        <th data-sortable="true" data-field="gaeldendetil" data-formatter="">Gældende til</th>
                        <th data-sortable="false" data-field="filer" data-formatter="formatFiler">Filer</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <script>
        var params = <?php echo $params;?>;
        function queryParams(p) {
            return {
                kortvaerk: params.kortvaerk, 
                daekningsomraade: params.daekningsomraade, 
                maalestok: params.maalestok, 
                titel: params.titel, 
                gyldighedsaar: params.gyldighedsaar, 
                kortbladnummer: params.kortbladnummer,
                bemaerk: params.bemaerk,
                geometri: params.geometri, 
                pagesize: p.limit,
                offset: p.offset,
                direction: p.order,
                sort: p.sort
            }
        }
        formatDaekningsomraade = function(value, row) {
            if(value && value.length > 0) {
                return value.join()
            } else {
                return "-";
            }
        },
        formatFiler = function(value, row) {
            var html = "";
            if(value && value.length > 0) {
                for(var i = 0; i < value.length; i++) {
                    html += (i>0 ? '<br>' : '') + '<a alt="viewImage" href="viewImage.php?id='+encodeURI(row['id'])+'&titel='+encodeURI(row['titel'])+'&imageUrl='+value[i]+'">view</a>';
                }
                return html;
            } else {
                return "-";
            }
        };
        
    </script>    
<?php        
    $document->generateDocumentEndHTML();
?>
