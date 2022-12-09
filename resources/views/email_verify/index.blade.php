@include('layouts.header')

<br><br><br>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
      <div class="card text-center">
        <div class="card-body">
          <h4 class="header-title">Email terverifikasi silahkan login kembali</h4>
          <br>
          <a href="http://localhost:8081/email-verify/{{ $id }}" class="btn btn-primary">klik disini!!!</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4"></div>
  </div>
</div>

@include('layouts.footer')