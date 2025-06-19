@include('dashboard.admin.layout.header')
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo text-center">
                <img src="{{ asset('majestic') }}/images/smk1.svg" alt="logo">
              </div>
              <div class="text-center">
              <h4>FORM LOGIN ADMIN</h4>
              <h6 class="font-weight-light">Silahkan untuk login</h6>
            </div>
              <form action="{{ route('admin.check') }}" method="post">
                @include('dashboard.admin.layout.pesan')
                @csrf
                 <div class="form-group">
                     <label for="email">Email</label>
                     <input type="text" class="form-control" name="email" placeholder="Enter email address" value="{{ old('email') }}">
                     
                 </div>
                 <div class="form-group">
                     <label for="password">Password</label>
                     <input type="password" class="form-control" name="password" placeholder="Enter password" value="{{ old('password') }}">
                    
                 </div>
                 <div class="form-group">
                     <button type="submit" class="btn btn-primary">Login</button>
                 </div>
             </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  @include('dashboard.admin.layout.footer')
