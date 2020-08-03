<?php

class Document
{
    private $appName;
    private $title;
    private $description;
    private $keywords;

    public function __construct($title = "Arkivdata", $description = null, $keywords = null)
    {
        $this->appName = $this->title = $title;
        $this->description = (isset($description) ? $description : $this->appName);
        $this->keywords = (isset($keywords) ? $keywords : $this->appName);
        $this->canonicalPageUrl = $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
    }

    public function generateDocumentStartHTML($jsResources = [], $cssResources = []) 
    {
    ?>
        <!DOCTYPE html>
        <html lang="da" prefix="og: http://ogp.me/ns#" itemscope itemtype="https://schema.org/WebPage">
            <?php $this->generateDocumentHeadHTML($jsResources, $cssResources); ?>
            <body>
                <span id="forkongithub">
                    <a href="https://github.com/dataforsyningen/arkiv_meta_client/fork">
                        Fork on Github
                    </a>
                </span>
                <?php $this->generateNavbarHTML(); ?>
                <main class="container-fluid">
    <?php
    }

    public function generateDocumentEndHTML() 
    {
    ?>
                </main>
                <?php //$this->generateFooterHTML(); ?>    
            </body>
        </html>
    <?php
    }
    
    private function generateDocumentHeadHTML($jsResources = [], $cssResources = []) 
    {
    ?>
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title><?php echo htmlspecialchars($this->title);?></title>

            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <meta name="apple-mobile-web-app-title" content="<?php echo $this->appName; ?>">
            <meta name="application-name" content="<?php echo $this->appName; ?>">

            <meta name="keywords" content="<?php echo htmlspecialchars($this->keywords); ?>">
            <meta name="description" content="<?php echo htmlspecialchars($this->description); ?>">
            <meta name="author" content="SDFE">
            <link href="<?php echo $this->canonicalPageUrl; ?>" rel="canonical">

            <!-- css -->
            <link href="css/bootstrap-3.3.7/bootstrap.min.css" rel="stylesheet">
            <link href="css/font-awesome.min.css" rel="stylesheet">
            <link href="css/application.css" rel="stylesheet">
            
        <?php foreach($cssResources as $css) { ?>
            <link href="<?php echo $css; ?>" rel="stylesheet">
        <?php } ?>
       
            <!-- js -->
            <script src="js/jquery-3.3.1/jquery.min.js"></script>
            <script src="js/bootstrap-3.3.7/bootstrap.min.js"></script>
            
        <?php foreach($jsResources as $js) { ?>
            <script src="<?php echo $js; ?>"></script>
        <?php } ?>
            <script>
                $(document).ready(function() {
                });
            </script>
        </head>
        <?php 
    }

    private function generateFooterHTML() 
    {
    ?>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        Min footer
                    </div>
                </div>
            </div>
        </footer>
   <?php        
    }    
    
    private function generateNavbarHTML() 
    {
    ?>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".targetme" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a id="logo" class="navbar-brand" href="index.php" title="Styrelsen for Dataforsyning og Effektivisering">
                        <svg height="24" width="24" viewBox="0 0 145.6 145.6" preserveAspectRatio="xMinYMin meet" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
                            <defs>
                                <path class="f3" d="M25.6 51.5H35v9.4h-9.4zM25.6 51.5H35v9.4h-9.4zM51.5 25.6h9.4V35h-9.4zM51.5 25.6h9.4V35h-9.4zM0 25.6H9.4V35H0ZM0 25.6H9.4V35H0ZM43.9 7.5h9.4v9.4h-9.4zM43.9 7.5h9.4v9.4h-9.4zM7.5 43.9h9.4v9.4H7.5ZM7.5 43.9h9.4v9.4H7.5ZM44.1 43.9h9.4v9.4h-9.4zM44.1 43.9h9.4v9.4h-9.4zM7.7 7.4h9.4v9.4H7.7ZM7.7 7.4h9.4v9.4H7.7Z"></path>
                            </defs>
                            <g transform="translate(-34.981697,-114.31844)">
                                <g transform="matrix(2.3909521,0,0,2.3909521,34.981697,114.31844)">
                                    <g class="f2">
                                        <path d="M35.1 4.8C35.1 2.2 33 0 30.4 0c-2.6 0-4.7 2.1-4.7 4.7 0 2.6 2.1 4.7 4.7 4.7 2.6 0.1 4.7-2 4.7-4.6"></path>
                                        <path class="o1" d="m9.1 15.5c1.8 1.8 4.8 1.8 6.7 0 1.8-1.8 1.8-4.8 0-6.7C13.9 7 10.9 7 9.1 8.8c-1.9 1.9-1.9 4.8 0 6.7"></path>
                                        <path class="o2" d="M4.7 35C7.3 35 9.4 32.9 9.4 30.3 9.4 27.7 7.3 25.6 4.7 25.6 2.1 25.6 0 27.7 0 30.3 0 32.9 2.1 35 4.7 35"></path>
                                        <path class="o3" d="m15.5 52c1.8-1.8 1.8-4.8 0-6.7-1.8-1.8-4.8-1.8-6.7 0C7 47.1 7 50.1 8.9 52c1.8 1.8 4.8 1.8 6.6 0"></path>
                                        <path class="o4" d="m35.1 56.2c0-2.6-2.1-4.7-4.7-4.7-2.6 0-4.7 2.1-4.7 4.7 0 2.6 2.1 4.7 4.7 4.7 2.6 0.1 4.7-2.1 4.7-4.7"></path>
                                        <path class="o5" d="m45.5 51.9c1.8 1.8 4.8 1.8 6.7 0 1.8-1.8 1.8-4.8 0-6.7-1.8-1.8-4.8-1.8-6.7 0-1.9 1.9-1.9 4.9 0 6.7"></path>
                                        <path class="o6" d="m56.2 35c2.6 0 4.7-2.1 4.7-4.7 0-2.6-2.1-4.7-4.7-4.7-2.6 0-4.7 2.1-4.7 4.7 0 2.6 2.1 4.7 4.7 4.7"></path>
                                        <path class="o7" d="m51.9 15.6c1.8-1.8 1.8-4.8 0-6.7-1.8-1.8-4.8-1.8-6.7 0-1.8 1.8-1.8 4.8 0 6.7 1.9 1.8 4.9 1.8 6.7 0"></path>
                                    </g>
                                    <path class="f1" d="m38.9 26.6c-0.3-2.1-1.9-2.9-4-2.9-1 0-1.9 0.3-2.7 0.7 0.1-1-0.6-1.8-1.4-1.9v-1.1c0-0.2-0.1-0.3-0.3-0.3-0.2 0-0.3 0.1-0.3 0.3v1.1c-0.8 0.1-1.6 0.9-1.4 1.9-0.7-0.3-1.6-0.7-2.7-0.7-2.1 0-3.7 0.9-4 2.9C20 26.8 18.9 28 19 30c0.1 1.6 2.1 4 3.2 5.5h0.9c-1.5-1.7-3.4-4.2-3.4-5.5 0-0.9 0.1-1.6 0.6-1.9 0.3-0.3 0.9-0.6 1.6-0.7V28c0.1 0.9 0.6 1.9 1.1 3.1 0.2 0.5 1.3 2.2 3 4.5h0.9c0 0-4.1-5-4.3-7.7 0 0-0.6-3.4 3.3-3.4 2.5 0 4.1 1.8 4.1 1.8v9.3h0.7v-9.3c0 0 1.6-1.8 4.1-1.8 4 0 3.3 3.4 3.3 3.4-0.2 2.6-4.3 7.7-4.3 7.7h0.9c1.8-2.3 2.7-4 3-4.5 0.6-1.1 1-2.2 1.1-3.1v-0.6c0.7 0.1 1.3 0.3 1.6 0.7 0.5 0.5 0.6 1.1 0.6 1.9-0.1 1.3-1.9 3.9-3.4 5.5h0.9C39.8 34.1 41.7 31.6 41.7 30 42 28 41 26.8 38.9 26.6Zm-8.5-1.4c-0.6 0-1.1-0.5-1.1-1.1 0-0.6 0.5-1.1 1.1-1.1 0.6 0 1.1 0.5 1.1 1.1 0 0.6-0.5 1.1-1.1 1.1zm0-5.8c0.2 0 0.3-0.1 0.3-0.3v-1.4c0-0.2-0.1-0.3-0.3-0.3-0.2 0-0.3 0.1-0.3 0.3V19c0 0.3 0.1 0.4 0.3 0.4zm-2.5 1.1h1.5c0.2 0 0.3-0.1 0.3-0.3 0-0.2-0.1-0.3-0.3-0.3h-1.5c-0.2 0-0.3 0.1-0.3 0.3 0 0.1 0.1 0.3 0.3 0.3zm3.6 0H33c0.2 0 0.3-0.1 0.3-0.3 0-0.2-0.1-0.3-0.3-0.3h-1.5c-0.2 0-0.3 0.1-0.3 0.3-0.1 0.1 0.2 0.3 0.3 0.3zM22.2 38h16.5v0.7H22.2Zm0 1.4h16.5v0.7H22.2Zm0-2.9v0.7h16.5v-0.7z"></path>
                                </g>
                            </g>
                        </svg>
                        <span><?php echo $this->appName;?></span>
                    </a>
                </div>
                <div id="navbar" class="targetme collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                    </ul>
                </div>
            </div>
        </nav>
    <?php        
    }
}
