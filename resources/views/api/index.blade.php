@extends('layouts/main')

@section('judul_halaman','List API')

@section('konten')


    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#exampleModal">Add new API</button>
                </div>
            </div>
            <div class="table-responsive mb-4 mt-4">
                <table id="zero-config" class="table table-hover dataTable" style="width: 100%;" role="grid" aria-describedby="zero-config_info">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Api</th>
                        <th>Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($api as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->api_nama }}</td>
                            <td><a href="{{ url('') }}/{{ $item->api_link }}" target="_blank">{{ url('') }}/{{ $item->api_link }}</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ url('add-api') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Nama API</label>
                            <input type="text" required name="api_nama" placeholder="Masukkan Nama Api" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Link API</label>
                            <input type="text" required name="api_link" placeholder="Ex: api/user/.." class="form-control">
                        </div>


                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

