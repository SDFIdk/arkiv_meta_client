<?php
    include_once __DIR__.'/Classes/KFProxy.php';
    include_once __DIR__.'/Classes/Document.php';

    
    function makeSelectOption($val)
    {
        return "<option value=\"" . $val . "\">" . $val . "</option>";
    }
    
    $msg = [];

    // Get data for listboxes
    $proxy = new KFProxy();

    // dækningsområde
    $proxy->setUrl($proxy->getHost() . "/rest/arkivmeta/metadata/daekningsomraade");
    $response = $proxy->getData();
    $daekningsomraadeData = [];
    if($response) {
        foreach($response as $value) {
            $daekningsomraadeData[] = makeSelectOption($value);
        }
    } else {
        $msg[] = "Kunne ikke hente data fra " . $proxy->getUrl();
    }

    // kortværker
    $proxy->setUrl($proxy->getHost() . "/rest/arkivmeta/metadata/kortvaerker");
    $response = $proxy->getData();
    $kortvaerkData = [];
    if($response) {
        foreach($response as $value) {
            $kortvaerkData[] = makeSelectOption($value);
        }
    } else {
        $msg[] = "Kunne ikke hente data fra " . $proxy->getUrl();
    }

    // målestok
    $proxy->setUrl($proxy->getHost() . "/rest/arkivmeta/metadata/maalestok");
    $response = $proxy->getData();
    $maalestokData = [];
    if($response) {
        foreach($response as $value) {
            $maalestokData[] = makeSelectOption($value);
        }
    } else {
        $msg[] = "Kunne ikke hente data fra " . $proxy->getUrl();
    }

    $document = new Document("Arkivkort - Test site");

    $document->generateDocumentStartHTML(
        ["js/bootstrap-select-1.12.4/bootstrap-select.min.js"],
        ["css/bootstrap-select-1.12.4/bootstrap-select.min.css","css/forkongithub.css"]
    );
    
    ?>
    <div class="row">
        <div class="col-md-12">
            <br>
            <p>&nbsp;</p>
            <p>
                Dette website er udviklet i forbindelse med testen af det REST API der leverer historiske kort.
                <br />
                <a href="https://docs.kortforsyningen.dk/" target="_blank" rel="noopener">
                    https://docs.kortforsyningen.dk/
                </a>
            </p>
            <p>
                Vi kan ikke garantere at alle informationer eller funktionaliteter fra API'et er tilgængelige på websitet.
                <br />
                Websitet repræsenterer ikke SDFE's officielle udstilling af historiske kort og kan blive lukket ned uden varsel.
            </p>
            <p>
                I 2021 vil SDFE udvikle et officielt website til fremfinding af historiske kort og forskellige typer af protokoller som fx. sogneprotokoller, matrikelprotokoller m.fl.
                <br />Det nye website vil på sigt erstatte historiske kort på nettet
                <a title="Historiske kort på nettet" href="https://hkpn.gst.dk/" target="_blank" rel="noopener">
                    https://hkpn.gst.dk/
                </a>
            </p>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>Arkivkort</h1>
        </div>
    </div>
    <form action="viewSearchResult.php" method="get" autocomplete="off">

        <?php if($msg) { ?>
        <div class="row">
            <div class="col-md-12 col-sm-6">
                <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4>Fejl</h4>
                    <p><?php echo implode("<br>",$msg);?></p>
                </div>
            </div>
        </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="form-group">
                    <label for="kortvaerk">Kortværk <span class="small"><a id="kortvaerkReset" href="#" title="Nulstil"><i class="fa fa-remove"></i></a></span></label>
                    <select name="kortvaerk" id="kortvaerk" data-width="100%" data-live-search="true" data-container="body" class="selectpicker">
                        <option value="" selected>Intet valgt</option>
                        <?php echo implode("", $kortvaerkData); ?>
                    </select>
                    <script type="text/javascript">
                        $('#kortvaerkReset').click(function() {
                            $('#kortvaerk').selectpicker('deselectAll')
                                    .val([])
                                    .trigger('change.abs.preserveSelected')
                                    .selectpicker('refresh');
                            return false;
                        });
                    </script>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="form-group">
                    <label for="daekningsomraade">Dækningsområde <span class="small"><a id="daekningsomraadeReset" href="#" title="Nulstil"><i class="fa fa-remove"></i></a></span></label>
                    <select name="daekningsomraade" id="daekningsomraade" data-width="100%" data-live-search="true" data-container="body" class="selectpicker">
                        <option value="" selected>Intet valgt</option>
                        <?php echo implode("", $daekningsomraadeData); ?>
                    </select>
                    <script type="text/javascript">
                        $('#daekningsomraadeReset').click(function() {
                            $('#daekningsomraade').selectpicker('deselectAll')
                                    .val([])
                                    .trigger('change.abs.preserveSelected')
                                    .selectpicker('refresh');
                            return false;
                        });
                    </script>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="form-group">
                    <label for="maalestok">Målestok <span class="small"><a id="maalestokReset" href="#" title="Nulstil"><i class="fa fa-remove"></i></a></span></label>
                    <select name="maalestok" id="maalestok" data-width="100%" data-live-search="true" data-container="body" class="selectpicker">
                        <option value="" selected>Intet valgt</option>
                        <?php echo implode("", $maalestokData); ?>
                    </select>
                    <script type="text/javascript">
                        $('#maalestokReset').click(function() {
                            $('#maalestok').selectpicker('deselectAll')
                                    .val([])
                                    .trigger('change.abs.preserveSelected')
                                    .selectpicker('refresh');
                            return false;
                        });
                    </script>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="form-group">
                    <label for="titel">Titel <span class="small"><a id="titelReset" href="#" title="Nulstil"><i class="fa fa-remove"></i></a></span></label>
                    <input class="form-control" type="text" placeholder="Indtast titel" id="titel" name="titel" autocomplete="off">                
                    <script type="text/javascript">
                        $('#titelReset').click(function() {
                            $('#titel').val("");
                            return false;
                        });
                    </script>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="form-group">
                    <label for="gyldighedsaar">Gyldighedsår <span class="small"><a id="gyldighedsaarReset" href="#" title="Nulstil"><i class="fa fa-remove"></i></a></span></label>
                    <input class="form-control" type="number" min="0" placeholder="Indtast gyldighedsår" id="gyldighedsaar" name="gyldighedsaar" autocomplete="off">                
                    <script type="text/javascript">
                        $('#gyldighedsaarReset').click(function() {
                            $('#gyldighedsaar').val("");
                            return false;
                        });
                    </script>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="form-group">
                    <label for="kortbladnummer">Kortbladnummer <span class="small"><a id="kortbladnummerReset" href="#" title="Nulstil"><i class="fa fa-remove"></i></a></span></label>
                    <input class="form-control" type="text" placeholder="Indtast kortbladnummer" id="kortbladnummer" name="kortbladnummer" autocomplete="off">                
                    <script type="text/javascript">
                        $('#kortbladnummerReset').click(function() {
                            $('#kortbladnummer').val("");
                            return false;
                        });
                    </script>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="form-group">
                    <label for="bemaerk">Bemærkning <span class="small"><a id="bemaerkReset" href="#" title="Nulstil"><i class="fa fa-remove"></i></a></span></label>
                    <input class="form-control" type="text" placeholder="Indtast bemærkning" id="bemaerk" name="bemaerk" autocomplete="off">                
                    <script type="text/javascript">
                        $('#bemaerkReset').click(function() {
                            $('#bemaerk').val("");
                            return false;
                        });
                    </script>
                </div>
            </div>
            <div class="col-md-8 col-sm-6">
                <div class="form-group">
                    <label for="geometri">Geometri <span class="small"><a id="geometriReset" href="#" title="Nulstil"><i class="fa fa-remove"></i></a></span></label>
                    <input class="form-control" type="text" placeholder="Indtast WKT geometri" id="geometri" name="geometri" autocomplete="off" value="">
                    <div class="small pull-right">
                        <a href="#" class="wktlink" title="Danmark">Danmark</a>
                        <a href="#" class="wktlink" title="Næstved">Næstved</a>
                        <a href="#" class="wktlink" title="Odense">Odense</a>
                    </div>
                    <script type="text/javascript">
                        $('#geometriReset').click(function() {
                            $('#geometri').val("");
                            return false;
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="vertical-align: bottom">
                <button class="btn btn-primary">Søg</button>
            </div>
        </div>        
    </form>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.selectpicker').selectpicker({});
            
            $('.wktlink').click(function(e){
                e.preventDefault();
                var wkt;
                switch (this.title) {
                    case 'Danmark':
                        wkt = 'POLYGON((10 54, 10 56, 13 56, 13 54, 10 54))';
                        break;
                    case 'Næstved':
                        wkt = 'POLYGON((11.662259820816189 55.333961620571394,11.988416437027126 55.333961620571394,11.988416437027126 55.11896429099891,11.662259820816189 55.11896429099891,11.662259820816189 55.333961620571394))';
                        break;
                    case 'Odense':
                        wkt = 'POLYGON((10.24577267977952 55.51476210208637,10.59733517977952 55.51476210208637,10.59733517977952 55.30621763024291,10.24577267977952 55.30621763024291,10.24577267977952 55.51476210208637))';
                        break;
                    default:
                        wkt = "";
                }
                $('#geometri').val(wkt);
            });
        });
     </script>
 <?php    
    $document->generateDocumentEndHTML();
?>
