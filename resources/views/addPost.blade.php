<form id="postForm" action="{{url('api/auth/posts/save')}}" method="post" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input type="text" id="title" name="title" placeholder="Your Title" value="" />

        <p id="errorr" style="color:red"></p>
    </div>
    <div class="form-group pt-sm">
        <textarea id="description" name="description" placeholder="Your Description" value=""></textarea>
    </div>
    <div class="form-group pt-sm">
        <input type="file" id="image" name="image" value="" />
    </div>
    <div class="form-group pt-sm">
        <button type="submit" id="button" class="btnSubmit pull-left">Submit Post</button>
    </div>
</form>