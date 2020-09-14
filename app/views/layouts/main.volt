<!--このファイルが共通のやつ-->
<!--layouts/companies.volt,invoices.volt, products.volt, progucttypes.volt以外-->
<!--このlayouts/各.voltのviewがしたのcontent()に入る-->

<nav class="navbar navbar-default navbar-inverse" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">INVO</a>
        </div>
        <!--app/library/Elements.phpのgetMenuメソッド-->
        {{ elements.getMenu() }}
    </div>
</nav>

<div class="container">
    {{ flash.output() }}
    {{ content() }}
    <hr>
    <footer>
        <p>&copy; Company 2017</p>
    </footer>
</div>
