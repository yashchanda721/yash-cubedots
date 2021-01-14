<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css" />
<div>
    <a href="{{ url('api/auth/posts/add') }}">Add New Post</a>
    <a href="{{ url('api/auth/signOut') }}">Logout</a>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered" id="posts">
            <thead>
                <th>Id</th>
                @if($user->user_type ==1)
                <th>Slug</th>
                @endif
                <th>Title</th>
                <th>Description</th>
                <th>Featured Image</th>
                @if($user->user_type !=3)
                <th>Options</th>
                @endif
            </thead>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        var user_type = "{{ $user->user_type  }}";
        if (user_type == 3) {
            var columns = [{
                    "data": "id"
                },
                {
                    "data": "title"
                },
                {
                    "data": "description"
                },
                {
                    "data": "thumb_image"
                }
            ];

        } else if (user_type == 2) {
            var columns = [{
                    "data": "id"
                },
                {
                    "data": "slugs"
                },
                {
                    "data": "title"
                },
                {
                    "data": "description"
                },
                {
                    "data": "thumb_image"
                }
            ];
        } else {
            var columns = [{
                    "data": "id"
                },
                {
                    "data": "slugs"
                },
                {
                    "data": "title"
                },
                {
                    "data": "description"
                },
                {
                    "data": "thumb_image"
                },

                {
                    "data": "options"
                }
            ];
        }


        $('#posts').DataTable({
            "pageLength": 6,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ url('api/auth/posts') }}",
                "dataType": "json",
                "type": "POST",
                "data": {
                    _token: "{{csrf_token()}}"
                }
            },
            "columns": columns

        });
    });

    $(document).on('click', '#delete', function(e) {
        var r = confirm("Are you sure you want to delete this post!");
        var post_id = $(this).attr('post_id');
        if (r == true) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ url('api/auth/posts/delete') }}" + "/" + post_id,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: {
                    _token: "{{csrf_token()}}"
                },
                success: function(result) {
                    console.log(result);
                }
            });
        }
    });
</script>