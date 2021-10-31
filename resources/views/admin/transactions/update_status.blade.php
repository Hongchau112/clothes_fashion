@extends('admin.transactions.layout', [
    'title' => ( $title ?? 'Chi tiết đặt hàng' )
])
@section('content')
<form action="{{route('admin.transaction.update_status', ['id' => $trans->id])}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Thay đổi trạng thái:</label>
        <div class="form-control-wrap">
            <select class="form-select" name="status" id="status">
                <option value="0">Đang xác nhận</option>
                <option value="1">Đã xác nhận</option>
                <option value="2">Đang giao hàng</option>
                <option value="3">Đã giao</option>
                <option value="4">Hủy</option>
            </select>
        </div>
    </div>


    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>
@endsection
