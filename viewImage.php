<?php
    include_once __DIR__.'/Classes/KFProxy.php';
    include_once __DIR__.'/Classes/Document.php';

    $msg = [];
    $input = filter_input_array(INPUT_GET);
    $id = isset($input['id']) ? filter_var($input['id'], FILTER_SANITIZE_STRING) : "InvalidId";
    $imageUrl = isset($input['imageUrl']) ? filter_var($input['imageUrl'], FILTER_SANITIZE_STRING) : null;
    
    // Get IIIF tile info by following URL
    $proxy = new KFProxy($imageUrl);
    $tileInfo = $proxy->getData();
    
    if(!isset($tileInfo) || $tileInfo === false) {
        $msg[] = "Kunne ikke hente data fra " . $proxy->getUrl();
    }

    // Get other metadata
    $proxy->setUrl($proxy->getHost() . "/rest/arkivmeta/kort/" . $id);
    $otherInfo = $proxy->getData();

    $document = new Document("Arkivdata");
    $document->generateDocumentStartHTML(["js/openseadragon-bin-2.4.0/openseadragon.min.js"]);
?>    
    <h1><?php echo $otherInfo["titel"];?></h1>
    <?php if($msg) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4>Fejl</h4>
                <p><?php echo implode("<br>",$msg);?></p>
            </div>
        </div>
    </div>
    <?php } ?>
    <!--<div class="row">
        <div class="col-md-12">
            <div>
                <?php
                foreach($otherInfo as $key=>$val) {
                    $val = ($key=="daekningsomraade" || $key=="filer") ? implode(",", $val) : $val;
                    echo "<span><b>" . $key . ":</b> " . $val . "</span> ";
                }
                ?>
            </div>
        </div>
    </div>-->
    <div class="row">
        <div class="col-md-12">
            <div id="openseadragon"></div>
        </div>
    </div>
    <script type="text/javascript">
        var viewer = OpenSeadragon({
            id: "openseadragon",
            preserveViewport: true,
            visibilityRatio:    1,
            minZoomLevel:       1,
            defaultZoomLevel:   1,
            sequenceMode:       true,
            prefixUrl:          "js/openseadragon-bin-2.4.0/images/",
            tileSources:        [<?php echo json_encode($tileInfo);?>],
            loadTilesWithAjax: true,
            ajaxHeaders: {
                "token": "<?php echo $proxy->getToken();?>"
            }
        });
    </script>    
 
<?php        
    $document->generateDocumentEndHTML();
?>
