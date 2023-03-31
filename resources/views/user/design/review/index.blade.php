<form class="user_review" action="{{url('/review/store/'. $products->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <p>
        <label>Tiêu đề</label>
        <input type="text" name="title">
    </p>
    <p>
        <label>Ảnh review</label>
        <input type="file" name="image">
    </p>
    <p>
        <label>Bình luận</label>
        <textarea cols="30" rows="10" name="content"></textarea>
    </p>
    <button type="submit"
        class="primary_button"
        style="border:none; outline:none">Bình
        luận</button>
</form>