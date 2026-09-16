@extends('layouts.admin')
@section('content')
    <main class="dashboard-content">
        <div class="container-fluid px-3 px-lg-4 py-4">
          <div class="page-heading">
            <div class="page-heading-copy">
              <span class="page-icon"><i class="bi bi-person-gear" aria-hidden="true"></i></span>
              <div>
                <p class="eyebrow mb-1">Management</p>
                <h1 class="h3 mb-1">View & Edit Operator</h1>
                <p class="text-muted mb-0">Review or modify details for {{ $user->name }}.</p>
              </div>
            </div>
            <div class="heading-actions">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.user.index') }}">
                    <i class="bi bi-arrow-left" aria-hidden="true"></i> Back to Operators
                </a>
            </div>
          </div>

          @if ($errors->any())
              <div class="alert alert-danger mt-3">
                  <ul class="mb-0">
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

          <section class="row g-3 mt-1">
            <div class="col-12 col-xl-8">
              {{-- Form langsung diarahkan ke proses update --}}
              <form class="panel needs-validation" action="{{ route('admin.user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="panel-header">
                    <div>
                        <h2 class="h5 mb-1 section-title"><i class="bi bi-info-circle" aria-hidden="true"></i><span>Operator Information</span></h2>
                        <p class="text-muted mb-0">Update fields below and click save.</p>
                    </div>
                </div>

                <div class="row g-3">
                  <div class="col-md-12">
                      <label class="form-label" for="name">Full Name</label>
                      <input class="form-control" id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required>
                  </div>

                  <div class="col-md-6">
                      <label class="form-label" for="username">Username</label>
                      <input class="form-control" id="username" name="username" type="text" value="{{ old('username', $user->username) }}" required>
                  </div>

                  <div class="col-md-6">
                      <label class="form-label" for="password">Password <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                      <input class="form-control" id="password" name="password" type="password">
                  </div>

                  <div class="col-md-6">
                      <label class="form-label text-muted small mb-1">Role</label>
                      <input class="form-control bg-light" type="text" value="{{ $user->role }}" readonly>
                  </div>

                  <div class="col-md-6">
                      <label class="form-label text-muted small mb-1">Joined Date</label>
                      <input class="form-control bg-light" type="text" value="{{ $user->created_at->format('d M, Y - H:i') }}" readonly>
                  </div>
                </div>

                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.user.index') }}">Cancel</a>
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-check-lg" aria-hidden="true"></i> Save Changes
                    </button>
                </div>
              </form>
            </div>

            <div class="col-12 col-xl-4">
              <div class="panel h-100">
                <h2 class="h5 mb-3 section-title"><i class="bi bi-shield-check" aria-hidden="true"></i><span>Quick Info</span></h2>
                <div class="activity-list">
                  <div class="activity-item"><span class="activity-dot bg-primary"></span><div><p class="mb-1 fw-semibold">Direct Edit</p><p class="text-muted small mb-0">You can view and modify operator data right from this screen.</p></div></div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </main>
@endsection
