<html>
<head>
    <title>Posts</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container">
    <h2>Laravel Blog</h2>
    <button id="btn-add" name="btn-add" class="btn btn-primary btn-xs">Add New Post</button>
    <div>

        <!-- Data table -->
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date Created</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="posts-list" name="posts-list">
            @foreach ($posts as $post)
            <tr id="task{{$post->id}}">
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->description}}</td>
                <td>{{$post->created_at}}</td>
                <td>
                    <button class="btn btn-warning btn-xs btn-detail open-modal" value="{{$post->id}}">Edit</button>
                    <button class="btn btn-danger btn-xs btn-delete delete-task" value="{{$post->id}}">Delete</button>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <!-- End of Data Table -->

        <!-- Modal (Pop up when detail button clicked) -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Task Editor</h4>
                    </div>
                    <div class="modal-body">
                        <form id="frmTasks" name="frmTasks" class="form-horizontal" novalidate="">

                            <div class="form-group error">
                                <label for="inputTask" class="col-sm-3 control-label">Task</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control has-error" id="task" name="task" placeholder="Task" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Description</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                        <input type="hidden" id="task_id" name="task_id" value="0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>