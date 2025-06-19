@extends('dashboard.admin.home')
@section('konten')
<p class="card-title">TAMBAH KELAS</p>
<div class="pb-3"><a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary"><< Kembali</a>
<button type="button" class="btn btn-danger text-white" id="tambah_form">Tambah Form</button>

</div>

<form action="{{ route('admin.kelas.store') }}" method="POST">
    @csrf

    <table id="table" width="40%">
        <tr>
            <td>
                <div class="form-group">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" name="kelas[]" id="kelas" class="form-control form-control-sm" placeholder="kelas" value="{{ old('kelas.0') }}">
                    @error('kelas.*')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-xs" style="margin-top: 5px; padding: 1px 10px;" disabled><i class="mdi mdi-window-minimize"></i></button>
            </td>
            
        </tr>
    </table>

    <button class="btn btn-primary" name="simpan" type="submit">simpan</button>

</form>

<script>
$(document).ready(function(){
    $("#tambah_form").click(function(){
        $("#table").append('<tr><td><div class="form-group"><label for="kelas">Kelas</label><input type="text" name="kelas[]" id="kelas" class="form-control form-control-sm" placeholder="kelas" value="{{ old('kelas.*') }}"></div></td><td><button type="button" class="btn btn-danger btn-xs d-inline" style="margin-top: 5px; padding: 1px 10px;"><i class="mdi mdi-window-minimize"></i></button></td></tr>');
    });

    $(document).on("click", ".btn-danger", function() {
        $(this).closest('tr').remove();
    });
});
</script>
@endsection
