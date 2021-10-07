<!DOCTYPE html>
<html lang="en">
    <head>
      
        
        
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="">
        <link rel="shortcut icon" type="image/png" href="/assets/img/favicon.png">

        <title>Панель :: <?= NAME; ?></title>

        <!-- Bootstrap core CSS -->
        <link href="/assets/css/stock/adminpanel.css" rel="stylesheet">
        <link href="/assets/css/stock/crypto-fa.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="/assets/css/stock/errorblock.css">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="/"><b>Панель :: <?= NAME; ?></b></a>
                        </div>
                        <div class="collapse navbar-collapse navbar-right">
                            <ul class="nav navbar-nav nav-pills">
                                
                            <?php if ($this->admin()) : ?>
                                
                                <li><a href="/admin">Панель</a></li>
                                
                            <?php endif ?>
                                
                            <?php if ($this->usid) : ?>
                                
                                <li><a href="/cabinet">Кабинет</a></li>
                                <li><a href="/exit">Выход</a></li>
                                
                            <?php else : ?>
                                
                                <li><a href="/login">Войти</a></li>
                                <li><a href="/signup">Регистрация</a></li>
                                
                            <?php endif ?>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="starter-template">
            <div class="container">
                <div class="row">
                
                <?php if ($this->admin) : ?>
                    
                    <div class="col-lg-9">
                        <h1 class="text-center"><?= $_title[$this->lang]; ?></h1>
                    </div>
                        
                <?php else : ?>
                        
                    <div class="col-lg-12">
                        <h1 class="text-center"><?= $_title[$this->lang]; ?></h1>
                    </div>
                        
                <?php endif ?>
                        
                </div>
                <div class="row">