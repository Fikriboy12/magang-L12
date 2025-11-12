@extends('template_admin.master')
@section('contents')

<section class="section">
    <div class="section-header">
    <h1>{{$data['title']}}</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                @if (session()->has('err_message'))
                    <div class="alert alert-danger alert-dismissible" role="alert" auto-close="120">
                        <strong>Error! </strong>{{ session()->get('err_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('suc_message'))
                    <div class="alert alert-success alert-dismissible" role="alert" auto-close="120">
                        <strong>Success! </strong>{{ session()->get('suc_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama </th>
                            <th>Status Pengajuan</th>
                        
                            <th class ="text-center" width = "15%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1;
                          foreach ($data['data_sertifikat'] as $value) {?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value->nama_sertifikat?></td>
                            <td><?= $value->status_pengajuan?></td>
                        
                            <td class ="text-center"> 
                                <button type="button" class="btn btn-primary btn-sm " data-toggle="modal" data-target="#updatedata<?= $value->id_sertifikat ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete{{$value->id_sertifikat}}">
                                    <i class="fa fa-trash"></i> 
                                </button>
                            </td>
                        
                          </tr>
                        <?php } ?>
                      </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


@foreach ($data['data_sertifikat'] as $item)


<div class="modal fade" id="updatedata{{$item->id_sertifikat}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{url('approve-sertifikat')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="">Status Pengajuan</label>
                        <input type="hidden" name = "id_sertifikat" value = "{{$item->id_sertifikat}}">
                        <select class="form-control" name="status_pengajuan" required id="">
                            <option value="acc">Acc</option>
                            <option value="rejected">Rejected</option>
                          </select>
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="Delete{{$item->id}}">
    <div class="modal-dialog ">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Delete Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
           
                <div class="modal-body">
                   <p>Apakah Anda Yakin untuk Mennghapus</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <a href="{{url('delete-sertifikat/'.$item->id_sertifikat)}}" class="btn btn-success">Hapus</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endforeach
@endsection
