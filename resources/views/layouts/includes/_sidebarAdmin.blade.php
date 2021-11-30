<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
            <div class="logo text-center"><img src="{{asset('admin/assets/img/2.png')}}" alt="Klorofil Logo" style="width:150px; height:150px; margin:auto"></div>
			@if(auth()->user()->role == 'super admin')
				<li><a href="/superAdmin" class="active" ><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
				<li><a href="kegiatan/create" class="active" ><i class="lnr lnr-file-add"></i> <span>Kegiatan Baru</span></a></li>
				<li><a href="/user" class="active" ><i class="lnr lnr-user"></i> <span>User</span></a></li>
				<li><a href="/superAdmin/postingan" class="active" ><i class="lnr lnr-file-empty"></i> <span>Postingan</span></a></li>
				<li><a href="/laporankegiatan" class="active" ><i class="lnr lnr-printer"></i> <span>Laporan</span></a></li>
			@endif
			@if(auth()->user()->role == 'admin')
				<li><a href="/admin/{{$user->id}}/{{$kegiatan->id}}/dashboard" class="active" ><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
				<li><a href="/postingan/{{$user->id}}/{{$kegiatan->id}}/index" class="active" ><i class="lnr lnr-pencil"></i> <span>Postingan</span></a></li>
				<li><a href="/admin/{{$user->id}}/{{$kegiatan->id}}" class="active" ><i class="lnr lnr-users"></i> <span>Donatur</span></a></li>
				<li><a data-toggle="modal" data-target="#cetak" class="active"><i class="lnr lnr-printer"></i> <span>Laporan</span></a></li>
			@endif
			</ul>
		</nav>
	</div>
</div>

@if(auth()->user()->role == 'admin')
<!-- MODAL CETAK -->
<div class="modal fade" id="cetak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3class="modal-title" id="exampleModalLabel1">Filter Tanggal</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <div class="modal-body">
        <form action="/admin/{{$user->id}}/{{$kegiatan->id}}/laporan" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1">Dari</label>
                <input name="dari" type="date" class="form-control" id="dari" aria-describedby="emailHelp" value={{$kegiatan->created_at}}>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Sampai</label>
                <input name="sampai" type="date" class="form-control" id="sampai" aria-describedby="emailHelp" value={{Carbon\carbon::now()}}>
            </div>
            <button type="submit" class="btn btn-primary">Cetak</button>
        </form>
        </div>
    </div>
</div>
</div>
@endif