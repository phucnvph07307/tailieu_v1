<form action="{{route($routeLayFormBieuMau)}}" method="post">
    @csrf
    <div class="modal fade" id="exportBieuMauModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hãy chọn trường</h5>
                    <button type="button" id="closeFileBieuMau" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select name="id_cs" class="form-control">
                        @foreach($coso as $csdt)
                        <option value="{{$csdt->id}}">{{$csdt->ten}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit"  onclick="closeModal()" class="btn btn-primary">Tải</a>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="{{route($routeImportError)}}" id="form_import_file" method="post"
    enctype="multipart/form-data">
    @csrf
    <div class="modal fade " id="moDalImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import file</h5>
                    <button type="button"
                     {{-- id="closeImportFile" --}}
                     class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" id="file_import_id" name="file_import">
                    </div>
                    <div class="form-group">
                        <label for="">Chọn năm</label>
                        <select name="nam" id="nam_id" class="form-control">
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                            <option value="2018">2018</option>
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Chọn đợt</label>
                        <select name="dot" id="dot_id" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <p class="pt-1" style="color:red;margin-right: 119px" id="echoLoi">
                    </p>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" id="submitTai">Tải</a>
                        <button type="submit" hidden class="btn btn-primary" id="submitTaiok">Tải ok</a>
                </div>
            </div>
        </div>
    </div>
</form>

    <form action="{{route($routeExportData)}}" id="from_xuat_data" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade " id="moDalExportData" tabindex="-1" role="dialog"
            aria-labelledby="moDalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="moDalLabel">Xuất dữ liệu</h5>
                        <button type="button" id='closeXuatDuLieu' class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Chọn ngày xuất</label>
                            <div class='input-group date datepicker' name="datepicker" >
                                <p>From: <input type="text" autocomplete="off" class="form-control" name="dateFrom" id="datepickerFrom"></p>
                                @error('dateFrom')
                                      <div class="text-danger">{{$message}}</div>
                                @enderror
                                <p>To: <input type="text" autocomplete="off" class="form-control" name="dateTo" id="datepickerTo"></p>
                                @error('dateTo')
                                  <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Chọn Trường</label>
                            <select multiple name="truong_id[]" id="truong_id_xuat" class="form-control select2">
                                @foreach($coso as $csdt)
                                <option value="{{$csdt->id}}">{{$csdt->ten}}</option>
                                @endforeach
                                <option value="all">Tất cả</option>
                            </select>
                        </div>
                        @error('truong_id')
                          <div class="text-danger">{{$message}}</div>
                          @enderror

                    </div>
                    <div class="modal-footer">
                        <p class="pt-1" style="color:red;margin-right: 119px" id="echoLoiXuat">
                        </p>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" id="submitXuatData" onclick="closeModalXuat('closeXuatDuLieu')">Tải</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
