<nav class="navbar navbar-default navbar-fixed-top">
    <div class="brand">
        <a href=""><img src="{{asset('admin/assets/img/22.png')}}" alt="Klorofil Logo" class="img-responsive logo"></a>
    </div>
    <div class="container-fluid">
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
        </div>
        <form class="navbar-form navbar-left" method="GET" action="/donatur/cari">
            <div class="input-group">
                <input type="text" name="cari" value="" class="form-control" placeholder="Cari Kegiatan...">
                <span class="input-group-btn"><button type="submit" class="btn btn-primary">Cari</button></span>
            </div>
        </form>
        <div id="navbar-menu">
        <br>
            <ul class="navbar-nav navbar-right">
                <a href="/login">LOGIN</a>
            </ul>
        </div>
    </div>
        
</nav>