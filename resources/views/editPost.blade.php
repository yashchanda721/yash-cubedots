<form id="postForm" action="{{url('api/auth/posts/edit')}}" method="post" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input type="text" id="title" name="title" placeholder="Your Title" value="{{$post->title}}" />

        <p id="errorr" style="color:red"></p>
    </div>
    <div class="form-group pt-sm">
        <textarea id="description" name="description" placeholder="Your Description" value="">{{$post->description}}</textarea>
    </div>
    <div class="form-group pt-sm">
        <input type="file" id="image" name="image" value="" />
    </div>
    <div class="form-group pt-sm">
    <input type="hidden" name="post_id" value="{{$post->id}}">
        <button type="submit" id="button" class="btnSubmit pull-left">Submit Post</button>
    </div>
</form>