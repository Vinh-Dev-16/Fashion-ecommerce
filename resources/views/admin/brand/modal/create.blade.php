 <form action="{{route('admin.brand.create')}}" method="POST">
                @csrf
                <div class="card-body px-3 pt-2 pb-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleName">Tên brand</label>
                            <input type="text" class="form-control" id="slug" onkeyup="ChangeToSlug();"
                                   placeholder="Điền tên brand" name="name">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleName">Slug brand</label>
                            <input type="text" class="form-control" id="convert_slug" name="slug">
                            @error('slug')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleName">Logo brand</label>
                            <input type="text" class="form-control" id="exampleInputName"
                                   placeholder="Link logo brand" name="logo">
                            @error('logo')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="examplePrice">Voucher</label>
                            <select class="tag_multiple" name="value[]" multiple="multiple"
                                    style="width: 100%">
                            </select>
                            @error('value')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="examplePrice">Giá Voucher</label>
                            <select class="tag_multiple" name="percent[]" multiple="multiple"
                                    style="width: 100%">
                            </select>
                            @error('percent')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="examplePrice">Số lượng Voucher</label>
                            <select class="tag_multiple" name="quantity[]" multiple="multiple"
                                    style="width: 100%">
                            </select>
                            @error('quantity')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleDesce">Chi tiết Brand</label>
                            <textarea type="text" class="form-control" id="editor" name="description"
                                      placeholder="Điền thông tin sản phẩm"></textarea>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </div>
                </div>
            </form>



<script defer>
    $(document).ready(function () {
        $('.select2').select2();

        $('.tag_multiple').select2({
            theme: "classic",
            tags: true,
        });
    });
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
